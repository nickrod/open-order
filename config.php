<?php

//

use openorder\config\Config;

//

require __DIR__ . '/vendor/autoload.php';

//

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//

try
{
  $site_config = new Config(['settings_file' => '/usr/local/include/openorder.ini']);
}
catch (Exception $e)
{
}

?>
