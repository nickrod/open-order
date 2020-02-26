<?php

//

include 'config.php';

//

use openorder\tools\Sanitize;
use openorder\account\UserAccount;
use openorder\account\UserAccountAuth;

// input type

$auth_type = filter_input(INPUT_POST, 'type');

//

if (isset($auth_type))
{
  if ($auth_type == 'login')
  {
    // input email

    $auth_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    //

    if (isset($auth_email))
    {
      try
      {
        // check if user exists

        $user_account_exists = UserAccount::exists(['email' => $auth_email, 'enabled' => true]);

        //

        if ($user_account_exists)
        {
          # create selector/validator

          $selector = Sanitize::getRandomString();
          $validator = hash('sha256', $selector);

          # set account auth

          $user_account_auth = new UserAccountAuth(['' => '']);
          $user_account_auth->save();

          # get site url and domain

          $site_url = $site_config->getSiteUrl();
          $site_domain = $site_config->getSiteDomain();

          # send activation email

          $subject = 'Welcome to ' . $site_domain;
          $message = 'Please click the following link to complete registration:' . PHP_EOL . PHP_EOL . '<a href="' . $site_url . '?selector=' . $selector . '">' . $site_url . '?selector=' . $selector . '</a>';
          $headers = 'From: noreply@' . $site_domain . PHP_EOL . 'Reply-To: noreply@' . $site_domain . PHP_EOL . 'X-Mailer: PHP/' . phpversion();
          mail(Sanitize::noHTML($auth_email), $subject, $message, $headers);
        }
      }
      catch (Exception $e)
      {
      }
    }
  }
}

?>
