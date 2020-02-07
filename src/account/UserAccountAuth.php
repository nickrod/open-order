<?php

//

declare(strict_types=1);

//

namespace openorder\account;

//

use openorder\base\Table;
use openorder\tools\Validate;
use openorder\tools\Sanitize;

//

class UserAccountAuth extends Table
{
  // variables

  protected $id;
  protected $selector;
  protected $hashed_validator;
  protected $account_id;
  protected $ip;
  protected $authenticated;
  protected $enabled;
  protected $created_date;
  protected $expired_date;

  // constants

  public const TABLE = 'user_account_auth';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'selector' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 1, 'max_length' => 100],
    'hashed_validator' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 1],
    'account_id' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'ip' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 8, 'max_length' => 100],
    'authenticated' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'enabled' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'expired_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['id']))
    {
      $this->setId($column['id']);
    }

    //

    if (isset($column['selector']))
    {
      $this->setSelector($column['selector']);
    }

    //

    if (isset($column['hashed_validator']))
    {
      $this->setHashedValidator($column['hashed_validator']);
    }

    //

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }

    //

    if (isset($column['ip']))
    {
      $this->setIp($column['ip']);
    }

    //

    if (isset($column['authenticated']))
    {
      $this->setAuthenticated($column['authenticated']);
    }

    //

    if (isset($column['enabled']))
    {
      $this->setEnabled($column['enabled']);
    }
  }

  // getters

  public function getId(): int 
  {
    return $this->id;
  }

  //

  public function getSelector(): string 
  {
    return $this->selector;
  }

  //

  public function getHashedValidator(): string 
  {
    return $this->hashed_validator;
  }

  //

  public function getAccountId(): int 
  {
    return $this->account_id;
  }

  //

  public function getIp(): string 
  {
    return $this->ip;
  }

  //

  public function getAuthenticated(): bool 
  {
    return Sanitize::getBoolean($this->authenticated);
  }

  //

  public function getEnabled(): bool 
  {
    return Sanitize::getBoolean($this->enabled);
  }

  //

  public function getUpdatedDate(): string 
  {
    return $this->updated_date;
  }

  //

  public function getExpiredDate(): string 
  {
    return $this->expired_date;
  }

  // setters

  public function setId(int $id): void 
  {
    if ($id > 0)
    {
      $this->id = $id;
    }
  }

  //

  public function setSelector(string $selector): void 
  {
    if (Validate::strLength($selector, self::COLUMN['selector']['min_length'], self::COLUMN['selector']['max_length']))
    {
      $this->selector = $selector;
    }
  }

  //

  public function setHashedValidator(string $hashed_validator): void 
  {
    if (Validate::strLength($hashed_validator, self::COLUMN['hashed_validator']['min_length']))
    {
      $this->hashed_validator = $hashed_validator;
    }
  }

  //

  public function setAccountId(int $account_id): void 
  {
    if ($account_id > 0)
    {
      $this->account_id = $account_id;
    }
  }

  //

  public function setIp(string $ip): void 
  {
    if (!filter_var($ip, FILTER_VALIDATE_IP))
    {
      throw new \InvalidArgumentException('Ip is invalid: ' . $ip);
    }
    else
    {
      $this->ip = $ip;
    }
  }

  //

  public function setAuthenticated(bool $authenticated): void 
  {
    $this->authenticated = Sanitize::setBoolean($authenticated);
  }

  //

  public function setEnabled(bool $enabled): void 
  {
    $this->enabled = Sanitize::setBoolean($enabled);
  }
}
