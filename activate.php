<?php

//

include 'config.php';

//

use openorder\util\Sanitize;
use openorder\auth\UserAccountAuth;
use openorder\content\item\UserAccount;

// display message

$message = '';

// input selector

$auth_selector = filter_input(INPUT_GET, 'selector');

// check if selector is set

if (isset($auth_selector) && $auth_selector !== false)
{
  if (!isset($_COOKIE['auth']))
  {
    try
    {
      // begin transaction

      $site_pdo->beginTransaction();

      // check if user auth exists

      $user_account_auth = UserAccountAuth::getObject($site_pdo, ['index' => ['selector' => $auth_selector, 'enabled' => true]]);

      //

      if (isset($user_account_auth))
      {
        if (hash_equals(hash('sha256', $auth_selector), $user_account_auth->getValidator()))
        {
          // create selector/validator

          $selector = Sanitize::getRandomString();
          $validator = hash('sha256', $selector);
          $ip = $_SERVER['REMOTE_ADDR'];

          // create cookie auth

          $user_account_auth_cookie = new UserAccountAuth(['selector' => $selector, 'validator' => $validator, 'user_account_id' => $user_account_auth->getUserAccountId(), 'ip' => $ip]);
          $user_account_auth_cookie->save($site_pdo);

          // set account auth disabled

          $user_account_auth->setEnabled(false);
          $user_account_auth->edit($site_pdo);

          // set registered disabled

          $user_account = new UserAccount(['id' => $user_account_auth->getUserAccountId(), 'registered' => false]);
          $user_account->edit($site_pdo);

          // set cookie

          setcookie('auth', $selector, ['expires' => strtotime('+1 year'), 'path' => '/', 'domain' => $site_domain, 'samesite' => 'Strict', 'secure' => true, 'httponly' => true]);
        }
      }

      //

      $message = 'If that user exists, then the account has been successfully activated and you are logged in.';

      // end transaction

      $site_pdo->commit();
    }
    catch (Exception $e)
    {
      $site_pdo->rollback();
      throw $e;
    }
  }
  else
  {
    $message = 'You must <a href="logout.php">logout</a> first.';
  }
}
else
{
  $message = 'A selector has not been specified.';
}

?>

<html>
  <body>
    <p><?=$message . ' Return to the <a href="/">home</a> page.';?></p>
  </body>
</html>
