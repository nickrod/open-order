<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\store;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class UserAccount extends SimpleDb
{
  // variables

  protected $user_account_id;
  protected $store_id;

  // constants

  public const TABLE = 'user_account_store';

  //

  public const COLUMN = [
    'user_account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'store_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['user_account_id']))
    {
      $this->setUserAccountId($column['user_account_id']);
    }

    //

    if (isset($column['store_id']))
    {
      $this->setStoreId($column['store_id']);
    }
  }

  // getters

  public function getUserAccountId(): int 
  {
    return $this->user_account_id;
  }

  //

  public function getStoreId(): int 
  {
    return $this->store_id;
  }

  // setters

  public function setUserAccountId(int $user_account_id): void 
  {
    if (Validate::intLength($user_account_id, 1))
    {
      $this->user_account_id = $user_account_id;
    }
  }

  //

  public function setStoreId(int $store_id): void 
  {
    if (Validate::intLength($store_id, 1))
    {
      $this->store_id = $store_id;
    }
  }
}
