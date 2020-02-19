<?php

//

include 'config.php';

//

use openorder\tools\Sanitize;
use openorder\tools\Validate;
use openorder\account\UserAccount;
use openorder\account\UserAccountActive;
use openorder\account\UserAccountAuth;

// mark if user is authenticated

$authenticated = false;

// input type

$auth_type = filter_input(INPUT_POST, 'type');

//

if (isset($auth_type))
{
  if ($auth_type == 'logout')
  {
    setcookie('auth', '', ['expires' => 1]);
  }
  elseif ($auth_type == 'email')
  {
    $auth_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    //

    if (isset($auth_email))
    {
      $site_url = $site_config->getSiteUrl();
      $site_domain = $site_config->getSiteDomain();
      $selector = Sanitize::getRandomString();
      $subject = 'Welcome to ' . parse_url($site_url, PHP_URL_HOST);
      $message = 'Please click the following link to complete registration:' . PHP_EOL . PHP_EOL . '<a href="' . $site_url . '?selector=' . $selector . '">' . $site_url . '?selector=' . $selector . '</a>';
      $headers = 'From: noreply@' . $site_domain . PHP_EOL . 'Reply-To: noreply@' . $site_domain . PHP_EOL . 'X-Mailer: PHP/' . phpversion();
      mail(Sanitize::noHTML($auth_email), $subject, $message, $headers);
    }
  }
}
else
{
  $auth_cookie_selector = filter_input(INPUT_COOKIE, 'auth');
  $auth_http_selector = filter_input(INPUT_GET, 'selector');
  $auth_selector = (isset($auth_cookie_selector)) ? $auth_cookie_selector : $auth_http_selector;

  //

  if (isset($auth_selector))
  {
    if (hash_equals(hash('sha256', $auth_selector), $auth_validator))
    {
      $authenticated = true;
      setcookie('auth', Sanitize::getRandomString(), ['expires' => strtotime('+1 year'), 'path' => '/', 'domain' => $site_config->getSiteDomain(), 'samesite' => 'Strict', 'secure' => true, 'httponly' => true]);
    }
  }

  //

  if (isset($auth_cookie_selector) || isset($auth_http_selector))
  {
    if (hash_equals(hash('sha256', $auth_cookie_selector), $auth_validator))
    {
      $authenticated = true;
    }
  }
}
