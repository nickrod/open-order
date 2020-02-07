<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\currency;

//

use openorder\base\Table;

//

class Consultant extends Table
{
  // variables

  protected $consultant_id;
  protected $currency_id;

  // constants

  public const TABLE = 'consultant_currency';

  //

  public const COLUMN = [
    'consultant_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'currency_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['consultant_id']))
    {
      $this->setConsultantId($column['consultant_id']);
    }

    //

    if (isset($column['currency_id']))
    {
      $this->setCurrencyId($column['currency_id']);
    }
  }

  // getters

  public function getConsultantId(): int 
  {
    return $this->consultant_id;
  }

  //

  public function getCurrencyId(): int 
  {
    return $this->currency_id;
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

  public function setCurrencyId(int $currency_id): void 
  {
    if ($currency_id > 0)
    {
      $this->currency_id = $currency_id;
    }
  }
}
