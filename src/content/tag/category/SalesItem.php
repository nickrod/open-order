<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\category;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class SalesItem extends SimpleDb
{
  // variables

  protected $sales_item_id;
  protected $category_id;

  // constants

  public const TABLE = 'sales_item_category';

  //

  public const COLUMN = [
    'sales_item_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['sales_item_id']))
    {
      $this->setSalesItemId($column['sales_item_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getSalesItemId(): int 
  {
    return $this->sales_item_id;
  }

  //

  public function getCategoryId(): int 
  {
    return $this->category_id;
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

  public function setCategoryId(int $category_id): void 
  {
    if (Validate::intLength($category_id, 1))
    {
      $this->category_id = $category_id;
    }
  }
}
