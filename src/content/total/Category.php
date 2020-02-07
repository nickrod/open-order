<?php

//

declare(strict_types=1);

//

namespace openorder\content\total;

//

use openorder\base\Table;

//

class Category extends Table
{
  // variables

  protected $category_id;
  protected $total_blogs;
  protected $total_consultants;
  protected $total_gigs;
  protected $total_services;

  // constants

  public const TABLE = 'category_total';

  //

  public const COLUMN = [
    'category_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_blogs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_consultants' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_gigs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_services' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // getters

  public function getCategoryId(): int
  {
    return $this->category_id;
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
