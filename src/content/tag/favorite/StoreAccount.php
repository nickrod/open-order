<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\favorite;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class StoreAccount extends SimpleDb
{
  // variables

  protected $store_account_id;
  protected $favorite_id;

  // constants

  public const TABLE = 'store_account_favorite';

  //

  public const COLUMN = [
    'store_account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'favorite_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['store_account_id']))
    {
      $this->setStoreAccountId($column['store_account_id']);
    }

    //

    if (isset($column['favorite_id']))
    {
      $this->setFavoriteId($column['favorite_id']);
    }
  }

  // getters

  public function getStoreAccountId(): int 
  {
    return $this->store_account_id;
  }

  //

  public function getFavoriteId(): int 
  {
    return $this->favorite_id;
  }

  // setters

  public function setStoreAccountId(int $store_account_id): void 
  {
    if (Validate::intLength($store_account_id, 1))
    {
      $this->store_account_id = $store_account_id;
    }
  }

  //

  public function setFavoriteId(int $favorite_id): void 
  {
    if (Validate::intLength($favorite_id, 1))
    {
      $this->favorite_id = $favorite_id;
    }
  }
}
