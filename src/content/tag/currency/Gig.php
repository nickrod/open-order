<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\currency;

//

use openorder\base\Table;

//

class Gig extends Table
{
  // variables

  protected $gig_id;
  protected $currency_id;

  // constants

  public const TABLE = 'gig_currency';

  //

  public const COLUMN = [
    'gig_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'currency_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['gig_id']))
    {
      $this->setGigId($column['gig_id']);
    }

    //

    if (isset($column['currency_id']))
    {
      $this->setCurrencyId($column['currency_id']);
    }
  }

  // getters

  public function getGigId(): int 
  {
    return $this->gig_id;
  }

  //

  public function getCurrencyId(): int 
  {
    return $this->currency_id;
  }

  // setters

  public function setGigId(int $gig_id): void 
  {
    $this->gig_id = $gig_id;
  }

  //

  public function setCurrencyId(int $currency_id): void 
  {
    $this->currency_id = $currency_id;
  }
}
