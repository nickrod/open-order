<?php

//

include 'config.php';

//

use openorder\account\UserAccountActive;
use openorder\account\UserAccountAuth;
use openorder\tools\Sanitize;

//

$auth_selector = filter_input(INPUT_GET, 'selector');

//

if (isset($auth_selector))
{
  try
  {
    $user_account_auth = UserAccountAuth::getObject(['selector' => $auth_selector, 'enabled' => true, 'activated' => false]);

    //

    if (isset($user_account_auth))
    {
      if (hash_equals(hash('sha256', $auth_selector), $user_account_auth->getValidator()))
      {
        # create selector/validator

        $selector = Sanitize::getRandomString();
        $validator = hash('sha256', $selector);

        # set account activated

        $user_account_auth->setActivated(true);
        $user_account_auth->edit();

        # create active account

        $user_account_active = new UserAccountActive(['' => '']);
        $user_account_active->save();

        # create cookie auth

        $user_account_auth_cookie = new UserAccountAuth(['' => '']);
        $user_account_auth_cookie->save();

        # set cookie

        setcookie('auth', $selector, ['expires' => strtotime('+1 year'), 'path' => '/', 'domain' => $site_config->getSiteDomain(), 'samesite' => 'Strict', 'secure' => true, 'httponly' => true]);

        // redirect to the home page

        header('Location: index.php', true, 302);
        exit();
      }
    }
  }
  catch (Exception $e)
  {
  }
}

?>
