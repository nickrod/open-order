<?php

//

declare(strict_types=1);

//

namespace openorder\total;

//

use openorder\database\SimpleDb;

//

class Total extends SimpleDb
{
  // variables

  protected $id;
  protected $total_user_account;
  protected $total_currency;
  protected $total_category;
  protected $total_sales_item;
  protected $total_sales_order;
  protected $total_store_account;
  protected $total_store;

  // constants

  public const TABLE = 'total';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_user_account' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_currency' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_category' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_sales_item' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_sales_order' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_store_account' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_store' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false]
  ];

  // getters

  public function getId(): int 
  {
    return $this->id;
  }

  //

  public function getTotalUserAccount(): int 
  {
    return $this->total_user_account;
  }

  //

  public function getTotalCurrency(): int 
  {
    return $this->total_currency;
  }

  //

  public function getTotalCategory(): int 
  {
    return $this->total_category;
  }

  //

  public function getTotalSalesItem(): int 
  {
    return $this->total_sales_item;
  }

  //

  public function getTotalSalesOrder(): int 
  {
    return $this->total_sales_order;
  }

  //

  public function getTotalStoreAccount(): int 
  {
    return $this->total_store_account;
  }

  //

  public function getTotalStore(): int 
  {
    return $this->total_store;
  }
}
