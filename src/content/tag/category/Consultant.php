<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\category;

//

use openorder\base\Table;

//

class Consultant extends Table
{
  // variables

  protected $consultant_id;
  protected $category_id;

  // constants

  public const TABLE = 'consultant_category';

  //

  public const COLUMN = [
    'consultant_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['consultant_id']))
    {
      $this->setConsultantId($column['consultant_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getConsultantId(): int 
  {
    return $this->consultant_id;
  }

  //

  public function getCategoryId(): int 
  {
    return $this->category_id;
  }

  // setters

  public function setConsultantId(int $consultant_id): void 
  {
    if ($consultant_id > 0)
    {
      $this->consultant_id = $consultant_id;
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
