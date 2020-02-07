<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\category;

//

use openorder\base\Table;

//

class Service extends Table
{
  // variables

  protected $service_id;
  protected $category_id;

  // constants

  public const TABLE = 'service_category';

  //

  public const COLUMN = [
    'service_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['service_id']))
    {
      $this->setServiceId($column['service_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getServiceId(): int 
  {
    return $this->service_id;
  }

  //

  public function getCategoryId(): int 
  {
    return $this->category_id;
  }

  // setters

  public function setServiceId(int $service_id): void 
  {
    if ($service_id > 0)
    {
      $this->service_id = $service_id;
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
