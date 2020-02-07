<?php

//

declare(strict_types=1);

//

namespace openorder\content\total;

//

use openorder\base\Table;

//

class Currency extends Table
{
  // variables

  protected $currency_id;
  protected $total_consultants;
  protected $total_gigs;
  protected $total_services;

  // constants

  public const TABLE = 'currency_total';

  //

  public const COLUMN = [
    'currency_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_consultants' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_gigs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_services' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // getters

  public function getCurrencyId(): int
  {
    return $this->currency_id;
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
