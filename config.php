<?php

//

use openorder\config\Config;

//

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//

$site_config = new Config(['db_settings' => '/usr/local/include/openorder.ini']);

?>
