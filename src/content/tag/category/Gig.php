<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\category;

//

use openorder\base\Table;

//

class Gig extends Table
{
  // variables

  protected $gig_id;
  protected $category_id;

  // constants

  public const TABLE = 'gig_category';

  //

  public const COLUMN = [
    'gig_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['gig_id']))
    {
      $this->setGigId($column['gig_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getGigId(): int 
  {
    return $this->gig_id;
  }

  //

  public function getCategoryId(): int 
  {
    return $this->category_id;
  }

  // setters

  public function setGigId(int $gig_id): void 
  {
    if ($gig_id > 0)
    {
      $this->gig_id = $gig_id;
    }
  }

  //

  public function setCategoryId(int $category_id): void 
  {
    if ($category_id > 0)
    {
      $this->category_id = $category_id;
    }
  }
}
