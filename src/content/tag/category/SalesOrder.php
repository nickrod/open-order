<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\category;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class SalesOrder extends SimpleDb
{
  // variables

  protected $sales_order_id;
  protected $category_id;

  // constants

  public const TABLE = 'sales_order_category';

  //

  public const COLUMN = [
    'sales_order_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['sales_order_id']))
    {
      $this->setSalesOrderId($column['sales_order_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getSalesOrderId(): int 
  {
    return $this->sales_order_id;
  }

  //

  public function getCategoryId(): int 
  {
    return $this->category_id;
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

  public function setCategoryId(int $category_id): void 
  {
    if (Validate::intLength($category_id, 1))
    {
      $this->category_id = $category_id;
    }
  }
}
