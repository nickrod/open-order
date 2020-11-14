<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\favorite;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class SalesOrder extends SimpleDb
{
  // variables

  protected $sales_order_id;
  protected $favorite_id;

  // constants

  public const TABLE = 'sales_order_favorite';

  //

  public const COLUMN = [
    'sales_order_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'favorite_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['sales_order_id']))
    {
      $this->setSalesOrderId($column['sales_order_id']);
    }

    //

    if (isset($column['favorite_id']))
    {
      $this->setFavoriteId($column['favorite_id']);
    }
  }

  // getters

  public function getSalesOrderId(): int 
  {
    return $this->sales_order_id;
  }

  //

  public function getFavoriteId(): int 
  {
    return $this->favorite_id;
  }

  // setters

  public function setSalesOrderId(int $sales_order_id): void 
  {
    if (Validate::intLength($sales_order_id, 1))
    {
      $this->sales_order_id = $sales_order_id;
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
