<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\category;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class Store extends SimpleDb
{
  // variables

  protected $store_id;
  protected $category_id;

  // constants

  public const TABLE = 'store_category';

  //

  public const COLUMN = [
    'store_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['store_id']))
    {
      $this->setStoreId($column['store_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getStoreId(): int 
  {
    return $this->store_id;
  }

  //

  public function getCategoryId(): int 
  {
    return $this->category_id;
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

  public function setCategoryId(int $category_id): void 
  {
    if (Validate::intLength($category_id, 1))
    {
      $this->category_id = $category_id;
    }
  }
}
