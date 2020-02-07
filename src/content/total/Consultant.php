<?php

//

declare(strict_types=1);

//

namespace openorder\content\total;

//

use openorder\base\Table;

//

class Consultant extends Table
{
  // variables

  protected $consultant_id;
  protected $total_favorites;

  // constants

  public const TABLE = 'consultant_total';

  //

  public const COLUMN = [
    'consultant_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // getters

  public function getConsultantId(): int
  {
    return $this->consultant_id;
  }

  //

  public function getTotalFavorites(): int 
  {
    return $this->total_favorites;
  }
}
