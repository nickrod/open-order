<?php

//

declare(strict_types=1);

//

namespace openorder\content\total;

//

use openorder\base\Table;

//

class Location extends Table
{
  // variables

  protected $location_id;
  protected $total_consultants;
  protected $total_gigs;
  protected $total_services;

  // constants

  public const TABLE = 'location_total';

  //

  public const COLUMN = [
    'location_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_consultants' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_gigs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_services' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // getters

  public function getLocationId(): int
  {
    return $this->location_id;
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
