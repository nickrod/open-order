<?php

//

declare(strict_types=1);

//

namespace openorder\content\total;

//

use openorder\base\Table;

//

class Service extends Table
{
  // variables

  protected $service_id;
  protected $total_favorites;

  // constants

  public const TABLE = 'service_total';

  //

  public const COLUMN = [
    'service_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_partners' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // getters

  public function getServiceId(): int 
  {
    return $this->service_id;
  }

  //

  public function getTotalFavorites(): int 
  {
    return $this->total_favorites;
  }

  //

  public function getTotalPartners(): int 
  {
    return $this->total_partners;
  }
}
