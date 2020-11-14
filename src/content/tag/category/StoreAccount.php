<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\category;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class StoreAccount extends SimpleDb
{
  // variables

  protected $store_account_id;
  protected $category_id;

  // constants

  public const TABLE = 'store_account_category';

  //

  public const COLUMN = [
    'store_account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['store_account_id']))
    {
      $this->setStoreAccountId($column['store_account_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getStoreAccountId(): int 
  {
    return $this->store_account_id;
  }

  //

  public function getCategoryId(): int 
  {
    return $this->category_id;
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

  public function setCategoryId(int $category_id): void 
  {
    if (Validate::intLength($category_id, 1))
    {
      $this->category_id = $category_id;
    }
  }
}
