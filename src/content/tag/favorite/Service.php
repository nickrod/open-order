<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\favorite;

//

use openorder\base\Table;

//

class Service extends Table
{
  // variables

  protected $service_id;
  protected $account_id;

  // constants

  public const TABLE = 'service_favorite';

  //

  public const COLUMN = [
    'service_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['service_id']))
    {
      $this->setServiceId($column['service_id']);
    }

    //

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }
  }

  // getters

  public function getServiceId(): int 
  {
    return $this->service_id;
  }

  //

  public function getAccountId(): int 
  {
    return $this->account_id;
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

  public function setAccountId(int $account_id): void 
  {
    if ($account_id > 0)
    {
      $this->account_id = $account_id;
    }
  }
}
