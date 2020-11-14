<?php

//

include 'config.php';

//

$message = 'You are NOT logged in';

//

try
{
  // begin pdo

  $site_pdo->beginTransaction();

  // cookie auth

  include 'cookie.php';

  // begin logic

  if ($authenticated)
  {
    $message = 'You are logged in';
  }

  // end logic

  $site_pdo->commit();

  // end pdo
}
catch (Exception $e)
{
  $site_pdo->rollback();
  throw $e;
}

?>

<html>
  <body>
    <p><?=$message;?></p>
    <a href="logout.php">Logout</a>
  </body>
</html>
