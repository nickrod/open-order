<?php

setcookie('auth', '', ['expires' => 1]);
header('Location: index.php', true, 302);
exit();

?>
