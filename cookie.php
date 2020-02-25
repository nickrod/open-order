<?php

//

include 'config.php';

//

use openorder\account\UserAccountAuth;

//

$authenticated = false;

//

$cookie_selector = filter_input(INPUT_COOKIE, 'auth');

//

if (isset($cookie_selector))
{
  try
  {
    $user_account_auth = UserAccountAuth::getObject(['selector' => $cookie_selector, 'enabled' => true, 'activated' => true]);

    //

    if (isset($user_account_auth))
    {
      if (strtotime($user_account_auth->getExpiredDate()) > strtotime($user_account_auth->getCreatedDate()))
      {
        if (hash_equals(hash('sha256', $cookie_selector), $user_account_auth->getValidator()))
        {
          $authenticated = true;
        }
      }
      else
      {
        $user_account_auth->setEnabled(false);
        $user_account_auth->edit();
        include 'logout.php';
      }
    }
  }
  catch (Exception $e)
  {
  }
}

?>
