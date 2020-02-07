<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\favorite;

//

use openorder\base\Table;

//

class Gig extends Table
{
  // variables

  protected $gig_id;
  protected $account_id;

  // constants

  public const TABLE = 'gig_favorite';

  //

  public const COLUMN = [
    'gig_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['gig_id']))
    {
      $this->setGigId($column['gig_id']);
    }

    //

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }
  }

  // getters

  public function getGigId(): int 
  {
    return $this->gig_id;
  }

  //

  public function getAccountId(): int 
  {
    return $this->account_id;
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

  public function setAccountId(int $account_id): void 
  {
    if ($account_id > 0)
    {
      $this->account_id = $account_id;
    }
  }
}
