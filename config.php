<?php

//

use openorder\config\SimpleConfig;

//

require __DIR__ . '/vendor/autoload.php';

// dev

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// prod

//ini_set('display_errors', 0);
//ini_set('log_errors', 1);

//

error_reporting(E_ALL);

// set global config vars

$site_config = $site_pdo = $site_url = $site_domain = $site_currency = $site_language = null;

//

try
{
  $site_config = new SimpleConfig(['settings_file' => '/usr/local/include/openorder.ini']);
  $site_pdo = $site_config->getPdo();
  $site_url = $site_config->getSiteUrl();
  $site_domain = $site_config->getSiteDomain();
  $site_currency = $site_config->getSiteCurrency();
  $site_language = $site_config->getSiteLanguage();
}
catch (Exception $e)
{
  throw $e;
}

?>
