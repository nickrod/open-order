<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\favorite;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class Store extends SimpleDb
{
  // variables

  protected $store_id;
  protected $favorite_id;

  // constants

  public const TABLE = 'store_favorite';

  //

  public const COLUMN = [
    'store_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'favorite_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['store_id']))
    {
      $this->setStoreId($column['store_id']);
    }

    //

    if (isset($column['favorite_id']))
    {
      $this->setFavoriteId($column['favorite_id']);
    }
  }

  // getters

  public function getStoreId(): int 
  {
    return $this->store_id;
  }

  //

  public function getFavoriteId(): int 
  {
    return $this->favorite_id;
  }

  // setters

  public function setStoreId(int $store_id): void 
  {
    if (Validate::intLength($store_id, 1))
    {
      $this->store_id = $store_id;
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
