<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\category;

//

use openorder\base\Table;

//

class Blog extends Table
{
  // variables

  protected $blog_id;
  protected $category_id;

  // constants

  public const TABLE = 'blog_category';

  //

  public const COLUMN = [
    'blog_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['blog_id']))
    {
      $this->setBlogId($column['blog_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getBlogId(): int 
  {
    return $this->blog_id;
  }

  //

  public function getCategoryId(): int 
  {
    return $this->category_id;
  }

  // setters

  public function setBlogId(int $blog_id): void 
  {
    if ($blog_id > 0)
    {
      $this->blog_id = $blog_id;
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
