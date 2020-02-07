<?php

//

declare(strict_types=1);

//

namespace openorder\total;

//

use openorder\base\Table;

//

class Total extends Table
{
  // variables

  protected $id;
  protected $total_accounts;
  protected $total_accounts_active;
  protected $total_currencies;
  protected $total_categories;
  protected $total_locations;
  protected $total_blogs;
  protected $total_consultants;
  protected $total_gigs;
  protected $total_services;

  // constants

  public const TABLE = 'total';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_accounts' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_accounts_active' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_currencies' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_categories' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_locations' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_blogs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_consultants' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_gigs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_services' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false]
  ];

  // getters

  public function getId(): int 
  {
    return $this->id;
  }

  //

  public function getTotalAccounts(): int 
  {
    return $this->total_accounts;
  }

  //

  public function getTotalAccountsActive(): int 
  {
    return $this->total_accounts_active;
  }

  //

  public function getTotalCurrencies(): int 
  {
    return $this->total_currencies;
  }

  //

  public function getTotalCategories(): int 
  {
    return $this->total_categories;
  }

  //

  public function getTotalLocations(): int 
  {
    return $this->total_locations;
  }

  //

  public function getTotalBlogs(): int 
  {
    return $this->total_blogs;
  }

  //

  public function getTotalConsultants(): int 
  {
    return $this->total_consultants;
  }

  //

  public function getTotalGigs(): int 
  {
    return $this->total_gigs;
  }

  //

  public function getTotalServices(): int 
  {
    return $this->total_services;
  }
}
