<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\currency;

//

use openorder\base\Table;

//

class Service extends Table
{
  // variables

  protected $service_id;
  protected $currency_id;

  // constants

  public const TABLE = 'service_currency';

  //

  public const COLUMN = [
    'service_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'currency_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['service_id']))
    {
      $this->setServiceId($column['service_id']);
    }

    //

    if (isset($column['currency_id']))
    {
      $this->setCurrencyId($column['currency_id']);
    }
  }

  // getters

  public function getServiceId(): int 
  {
    return $this->service_id;
  }

  //

  public function getCurrencyId(): int 
  {
    return $this->currency_id;
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

  public function setCurrencyId(int $currency_id): void 
  {
    if ($currency_id > 0)
    {
      $this->currency_id = $currency_id;
    }
  }
}
