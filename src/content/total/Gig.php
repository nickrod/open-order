<?php

//

declare(strict_types=1);

//

namespace openorder\content\total;

//

use openorder\base\Table;

//

class Gig extends Table
{
  // variables

  protected $gig_id;
  protected $total_favorites;

  // constants

  public const TABLE = 'gig_total';

  //

  public const COLUMN = [
    'gig_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // getters

  public function getGigId(): int 
  {
    return $this->gig_id;
  }

  //

  public function getTotalFavorites(): int 
  {
    return $this->total_favorites;
  }
}
