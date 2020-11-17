<?php

//

declare(strict_types=1);

//

namespace openorder\auth;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;
use openorder\util\Sanitize;

//

class UserAccountAuth extends SimpleDb
{
  // variables

  protected $id;
  protected $selector;
  protected $validator;
  protected $ip;
  protected $user_account_id;
  protected $enabled = 1;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'user_account_auth';
  public const TABLE_KEY = 'id';
  public const TABLE_SEQ = 'user_account_auth_id_seq';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'selector' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'validator' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'ip' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'user_account_id' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'enabled' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'updated_date' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => true]
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

    if (isset($column['validator']))
    {
      $this->setValidator($column['validator']);
    }

    //

    if (isset($column['ip']))
    {
      $this->setIp($column['ip']);
    }

    //

    if (isset($column['user_account_id']))
    {
      $this->setUserAccountId($column['user_account_id']);
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

  public function getSelector(): ?string 
  {
    return $this->selector;
  }

  //

  public function getValidator(): ?string 
  {
    return $this->validator;
  }

  //

  public function getIp(): ?string 
  {
    return $this->ip;
  }

  //

  public function getUserAccountId(): int 
  {
    return $this->user_account_id;
  }

  //

  public function getEnabled(): bool 
  {
    return $this->enabled;
  }

  //

  public function getCreatedDate(): string 
  {
    return $this->created_date;
  }

  //

  public function getUpdatedDate(): string 
  {
    return $this->updated_date;
  }

  // setters

  public function setId(int $id): void 
  {
    if (Validate::intLength($id, 1))
    {
      $this->id = $id;
    }
  }

  //

  public function setSelector(?string $selector): void 
  {
    if (is_null($selector) || Validate::strLength($selector, 1, 100))
    {
      $this->selector = $selector;
    }
  }

  //

  public function setValidator(?string $validator): void 
  {
    if (is_null($validator) || Validate::strLength($validator, 1, 200))
    {
      $this->validator = $validator;
    }
  }

  //

  public function setIp(?string $ip): void 
  {
    if (is_null($ip) || Validate::strLength($ip, 1, 100))
    {
      if (!is_null($ip) && !filter_var($ip, FILTER_VALIDATE_IP))
      {
        throw new \InvalidArgumentException('Ip is invalid: ' . $ip);
      }
      else
      {
        $this->ip = $ip;
      }
    }
  }

  //

  public function setUserAccountId(int $user_account_id): void 
  {
    if (Validate::intLength($user_account_id, 1))
    {
      $this->user_account_id = $user_account_id;
    }
  }

  //

  public function setEnabled(bool $enabled): void 
  {
    $this->enabled = Sanitize::setBoolean($enabled);
  }
}
