<?php

//

declare(strict_types=1);

//

namespace openorder\config;

//

use PDO;
use PDOException;
use openorder\exceptions\OpenOrderException;
use openorder\tools\Singleton;

//

class Config extends Singleton
{
  // pdo connection

  private $pdo;

  // pdo options

  private $pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
  ];

  // dsn

  private $dsn;

  // db username

  private $username;

  // db password

  private $password;

  // settings file

  private $settings_file;

  // site url

  private $site_url;

  // site domain

  private $site_domain;

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['dsn']))
    {
      $this->setDsn($column['dsn']);
    }

    //

    if (isset($column['username']))
    {
      $this->setUsername($column['username']);
    }

    //

    if (isset($column['password']))
    {
      $this->setPassword($column['password']);
    }

    //

    if (isset($column['pdo_options']))
    {
      $this->setPdoOptions($column['pdo_options']);
    }

    //

    if (isset($column['settings_file']))
    {
      $this->setSettingsFile($column['settings_file']);
    }

    //

    if (isset($column['site_url']))
    {
      $this->setSiteUrl($column['site_url']);
    }

    //

    if (isset($column['site_domain']))
    {
      $this->setSiteDomain($column['site_domain']);
    }

    // setup pdo object

    $this->setPdo();
  }

  // getters

	public function getPdo(): PDO
  {
    return $this->pdo;
	}

  //

	public function getSiteUrl(): string
  {
    return $this->site_url;
	}

  //

	public function getSiteDomain(): string
  {
    return $this->site_domain;
	}

  // setters

	public function setDsn(string $dsn): void
  {
    $this->dsn = $dsn;
  }

  //

	public function setUsername(string $username): void
  {
    $this->username = $username;
  }

  //

	public function setPassword(string $password): void
  {
    $this->password = $password;
  }

  //

	public function setSiteUrl(string $site_url): void
  {
    if (!filter_var($site_url, FILTER_VALIDATE_URL))
    {
      throw new \InvalidArgumentException('Site url is invalid: ' . $site_url);
    }
    else
    {
      $this->site_url = $site_url;
    }
  }

  //

	public function setSiteDomain(string $site_domain): void
  {
    if (!filter_var($site_domain, FILTER_VALIDATE_DOMAIN))
    {
      throw new \InvalidArgumentException('Site domain is invalid: ' . $site_domain);
    }
    else
    {
      $this->site_domain = $site_domain;
    }
  }

  //

	public function setSettingsFile(string $settings_file): void
  {
    if (!file_exists($settings_file))
    {
      throw new \InvalidArgumentException('Settings file does not exist: ' . $settings_file);
    }
    else
    {
      $this->settings_file = $settings_file;
      $this->loadSettingsFile();
    }
	}

  //

	public function setPdoOptions(array $pdo_options): void
  {
    $this->pdo_options = $pdo_options;
	}

  //

	private function setPdo(): void
  {
    try
    {
      $this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->pdo_options);
    }
    catch (PDOException $e)
    {
      throw new PDOException($e->getMessage(), (int) $e->getCode());
    }
	}

  //

  private function loadSettingsFile(): void
  {
    if (!$settings = parse_ini_file($this->settings_file, true))
    {
      throw new \InvalidArgumentException('Settings file cannot be parsed: ' . $this->settings_file);
    }
    else
    {
      $this->setDsn($settings['database']['driver'] . ':host=' . $settings['database']['host'] . ';port=' . $settings['database']['port'] . ';dbname=' . $settings['database']['dbname'] . ';options=\'-c client_encoding=' . $settings['database']['charset'] . '\'');
      $this->setUsername($settings['database']['username']);
      $this->setPassword($settings['database']['password']);
      $this->setSiteUrl($settings['site']['url']);
      $this->setSiteDomain($settings['site']['domain']);
    }
  }
}
