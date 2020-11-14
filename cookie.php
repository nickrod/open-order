<?php

//

use openorder\auth\UserAccountAuth;

// auth variable

$authenticated = false;

// cookie selector

$cookie_selector = filter_input(INPUT_COOKIE, 'auth');

//

if (isset($site_pdo) && isset($cookie_selector) && $cookie_selector !== false)
{
  $user_account_auth = UserAccountAuth::getObject($site_pdo, ['index' => ['selector' => $cookie_selector, 'enabled' => true]]);

  //

  if (isset($user_account_auth))
  {
    if (hash_equals(hash('sha256', $cookie_selector), $user_account_auth->getValidator()))
    {
      $authenticated = true;
    }
  }
}

?>
