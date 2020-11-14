<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\favorite;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class SalesItem extends SimpleDb
{
  // variables

  protected $sales_item_id;
  protected $favorite_id;

  // constants

  public const TABLE = 'sales_item_favorite';

  //

  public const COLUMN = [
    'sales_item_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'favorite_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['sales_item_id']))
    {
      $this->setSalesItemId($column['sales_item_id']);
    }

    //

    if (isset($column['favorite_id']))
    {
      $this->setFavoriteId($column['favorite_id']);
    }
  }

  // getters

  public function getSalesItemId(): int 
  {
    return $this->sales_item_id;
  }

  //

  public function getFavoriteId(): int 
  {
    return $this->favorite_id;
  }

  // setters

  public function setSalesItemId(int $sales_item_id): void 
  {
    if (Validate::intLength($sales_item_id, 1))
    {
      $this->sales_item_id = $sales_item_id;
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
