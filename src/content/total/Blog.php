<?php

//

declare(strict_types=1);

//

namespace openorder\content\total;

//

use openorder\base\Table;

//

class Blog extends Table
{
  // variables

  protected $blog_id;
  protected $total_favorites;

  // constants

  public const TABLE = 'blog_total';

  //

  public const COLUMN = [
    'blog_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // getters

  public function getBlogId(): int 
  {
    return $this->blog_id;
  }

  //

  public function getTotalFavorites(): int 
  {
    return $this->total_favorites;
  }
}
