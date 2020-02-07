<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\favorite;

//

use openorder\base\Table;

//

class Consultant extends Table
{
  // variables

  protected $consultant_id;
  protected $account_id;

  // constants

  public const TABLE = 'consultant_favorite';

  //

  public const COLUMN = [
    'consultant_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['consultant_id']))
    {
      $this->setConsultantId($column['consultant_id']);
    }

    //

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }
  }

  // getters

  public function getConsultantId(): int 
  {
    return $this->consultant_id;
  }

  //

  public function getAccountId(): int 
  {
    return $this->account_id;
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

  public function setAccountId(int $account_id): void 
  {
    if ($account_id > 0)
    {
      $this->account_id = $account_id;
    }
  }
}
