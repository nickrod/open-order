<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\favorite;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;

//

class UserAccount extends SimpleDb
{
  // variables

  protected $user_account_id;
  protected $favorite_id;

  // constants

  public const TABLE = 'user_account_favorite';

  //

  public const COLUMN = [
    'user_account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'favorite_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['user_account_id']))
    {
      $this->setUserAccountId($column['user_account_id']);
    }

    //

    if (isset($column['favorite_id']))
    {
      $this->setFavoriteId($column['favorite_id']);
    }
  }

  // getters

  public function getUserAccountId(): int 
  {
    return $this->user_account_id;
  }

  //

  public function getFavoriteId(): int 
  {
    return $this->favorite_id;
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

  public function setFavoriteId(int $favorite_id): void 
  {
    if (Validate::intLength($favorite_id, 1))
    {
      $this->favorite_id = $favorite_id;
    }
  }
}
