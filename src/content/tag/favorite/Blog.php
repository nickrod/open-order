<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\favorite;

//

use openorder\base\Table;

//

class Blog extends Table
{
  // variables

  protected $blog_id;
  protected $account_id;

  // constants

  public const TABLE = 'blog_favorite';

  //

  public const COLUMN = [
    'blog_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['blog_id']))
    {
      $this->setBlogId($column['blog_id']);
    }

    //

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }
  }

  // getters

  public function getBlogId(): int 
  {
    return $this->blog_id;
  }

  //

  public function getAccountId(): int 
  {
    return $this->account_id;
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

  public function setAccountId(int $account_id): void 
  {
    if ($account_id > 0)
    {
      $this->account_id = $account_id;
    }
  }
}
