<?php

//

include 'config.php';

//

use openorder\util\Sanitize;
use openorder\content\item\UserAccount;
use openorder\auth\UserAccountAuth;

// display message

$message = '';

// input email

$auth_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

// check if email and cookie are set

if (isset($auth_email) && $auth_email !== false)
{
  if (!isset($_COOKIE['auth']))
  {
    try
    {
      // begin transaction

      $site_pdo->beginTransaction();

      // check if user exists and is enabled

      $user_account = UserAccount::getObject($site_pdo, ['index' => ['email' => $auth_email, 'enabled' => true, 'registered' => false]]);

      //

      if (isset($user_account))
      {
        // create selector/validator

        $selector = Sanitize::getRandomString();
        $validator = hash('sha256', $selector);
        $ip = $_SERVER['REMOTE_ADDR'];

        // send activation email

        $from = 'noreply@' . $site_domain;
        $to = Sanitize::noHTML($auth_email);
        $subject = 'Welcome to ' . $site_domain;
        $mail_message = 'Please click the following link to complete registration:' . PHP_EOL . PHP_EOL . '<a href="' . $site_url . '?selector=' . $selector . '">' . $site_url . '?selector=' . $selector . '</a>';

        //

        $header = [
          'From' => $from,
          'Content-Type' => 'text/html; charset=utf-8',
          'Content-Transfer-Encoding' => 'base64',
          'X-Mailer' => 'PHP/' . phpversion()
        ];

        //

        $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $mail_message = base64_encode($mail_message);

        //

        if (mail($to, $subject, $mail_message, $header))
        {
          // set account auth

          $user_account_auth = new UserAccountAuth(['selector' => $selector, 'validator' => $validator, 'user_account_id' => $user_account->getId(), 'ip' => $ip]);
          $user_account_auth->save($site_pdo);

          // set account registered

          $user_account->setRegistered(true);
          $user_account->edit($site_pdo);
        }
      }

      //

      $message = 'If that user exists, a welcome email will be sent to the provided email address.';

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
  $message = 'An email address has not been specified.';
}

?>

<html>
  <body>
    <p><?=$message . ' Return to the <a href="/">home</a> page.';?></p>
  </body>
</html>
