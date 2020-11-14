<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\category;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class UserAccount extends SimpleDb
{
  // variables

  protected $user_account_id;
  protected $category_id;

  // constants

  public const TABLE = 'user_account_category';

  //

  public const COLUMN = [
    'user_account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['user_account_id']))
    {
      $this->setUserAccountId($column['user_account_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getUserAccountId(): int 
  {
    return $this->user_account_id;
  }

  //

  public function getCategoryId(): int 
  {
    return $this->category_id;
  }

  // setters

  public function setUserAccountId(int $user_account_id): void 
  {
    if (Validate::intLength($user_account_id, 1))
    {
      $this->user_account_id = $user_account_id;
    }
  }

  //

  public function setCategoryId(int $category_id): void 
  {
    if (Validate::intLength($category_id, 1))
    {
      $this->category_id = $category_id;
    }
  }
}
