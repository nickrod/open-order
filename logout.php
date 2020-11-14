<?php

//

include 'config.php';

// display message

$message = '';

//

if (isset($_COOKIE['auth']))
{
  unset($_COOKIE['auth']);
  setcookie('auth', '', ['expires' => 1, 'path' => '/', 'domain' => $site_domain, 'samesite' => 'Strict', 'secure' => true, 'httponly' => true]);
  $message = 'You have been successfully logged out.';
}
else
{
  $message = 'You are not logged in.';
}

?>

<html>
  <body>
    <p><?=$message . ' Return to the <a href="/">home</a> page.';?></p>
  </body>
</html>
