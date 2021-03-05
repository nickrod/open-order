<?php

//

declare(strict_types=1);

//

namespace openorder\content\tag\salesitem;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;
use openorder\util\Sanitize;

//

class SalesOrder extends SimpleDb
{
  // variables

  protected $sales_order_id;
  protected $sales_item_id;
  protected $case_volume;
  protected $unit_volume;
  protected $case_weight;
  protected $unit_weight;
  protected $case_price;
  protected $unit_price;
  protected $case_cost_price;
  protected $unit_cost_price;
  protected $case_quantity;
  protected $unit_quantity;
  protected $case_discount_price;
  protected $unit_discount_price;
  protected $case_discount_percent;
  protected $unit_discount_percent;
  protected $case_discount_quantity;
  protected $unit_discount_quantity;
  protected $created_date;

  // constants

  public const TABLE = 'sales_order_sales_item';

  //

  public const COLUMN = [
    'sales_order_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'sales_item_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'case_volume' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_volume' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_weight' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_weight' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_cost_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_cost_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_quantity' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_quantity' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_discount_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_discount_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_discount_percent' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_discount_percent' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_discount_quantity' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_discount_quantity' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['sales_order_id']))
    {
      $this->setSalesOrderId($column['sales_order_id']);
    }

    //

    if (isset($column['sales_item_id']))
    {
      $this->setSalesItemId($column['sales_item_id']);
    }

    //

    if (isset($column['case_volume']))
    {
      $this->setCaseVolume($column['case_volume']);
    }

    //

    if (isset($column['unit_volume']))
    {
      $this->setUnitVolume($column['unit_volume']);
    }

    //

    if (isset($column['case_weight']))
    {
      $this->setCaseWeight($column['case_weight']);
    }

    //

    if (isset($column['unit_weight']))
    {
      $this->setUnitWeight($column['unit_weight']);
    }

    //

    if (isset($column['case_price']))
    {
      $this->setCasePrice($column['case_price']);
    }

    //

    if (isset($column['unit_price']))
    {
      $this->setUnitPrice($column['unit_price']);
    }

    //

    if (isset($column['case_cost_price']))
    {
      $this->setCaseCostPrice($column['case_cost_price']);
    }

    //

    if (isset($column['unit_cost_price']))
    {
      $this->setUnitCostPrice($column['unit_cost_price']);
    }

    //

    if (isset($column['case_quantity']))
    {
      $this->setCaseQuantity($column['case_quantity']);
    }

    //

    if (isset($column['unit_quantity']))
    {
      $this->setUnitQuantity($column['unit_quantity']);
    }

    //

    if (isset($column['case_discount_price']))
    {
      $this->setCaseDiscountPrice($column['case_discount_price']);
    }

    //

    if (isset($column['unit_discount_price']))
    {
      $this->setUnitDiscountPrice($column['unit_discount_price']);
    }

    //

    if (isset($column['case_discount_percent']))
    {
      $this->setCaseDiscountPercent($column['case_discount_percent']);
    }

    //

    if (isset($column['unit_discount_percent']))
    {
      $this->setUnitDiscountPercent($column['unit_discount_percent']);
    }

    //

    if (isset($column['case_discount_quantity']))
    {
      $this->setCaseDiscountQuantity($column['case_discount_quantity']);
    }

    //

    if (isset($column['unit_discount_quantity']))
    {
      $this->setUnitDiscountQuantity($column['unit_discount_quantity']);
    }
  }

  // getters

  public function getSalesOrderId(): int 
  {
    return $this->sales_order_id;
  }

  //

  public function getSalesItemId(): int 
  {
    return $this->sales_item_id;
  }

  //

  public function getCaseVolume(): ?float 
  {
    return (is_null($this->case_volume)) ? null : Sanitize::getFloat($this->case_volume);
  }

  //

  public function getUnitVolume(): ?float 
  {
    return (is_null($this->unit_volume)) ? null : Sanitize::getFloat($this->unit_volume);
  }

  //

  public function getCaseWeight(): ?float 
  {
    return (is_null($this->case_weight)) ? null : Sanitize::getFloat($this->case_weight);
  }

  //

  public function getUnitWeight(): ?float 
  {
    return (is_null($this->unit_weight)) ? null : Sanitize::getFloat($this->unit_weight);
  }

  //

  public function getCasePrice(): ?float 
  {
    return (is_null($this->case_price)) ? null : Sanitize::getFloat($this->case_price);
  }

  //

  public function getUnitPrice(): ?float 
  {
    return (is_null($this->unit_price)) ? null : Sanitize::getFloat($this->unit_price);
  }

  //

  public function getCaseCostPrice(): ?float 
  {
    return (is_null($this->case_cost_price)) ? null : Sanitize::getFloat($this->case_cost_price);
  }

  //

  public function getUnitCostPrice(): ?float 
  {
    return (is_null($this->unit_cost_price)) ? null : Sanitize::getFloat($this->unit_cost_price);
  }

  //

  public function getCaseQuantity(): ?int 
  {
    return $this->case_quantity;
  }

  //

  public function getUnitQuantity(): ?int 
  {
    return $this->unit_quantity;
  }

  //

  public function getCaseDiscountPrice(): ?float 
  {
    return (is_null($this->case_discount_price)) ? null : Sanitize::getFloat($this->case_discount_price);
  }

  //

  public function getUnitDiscountPrice(): ?float 
  {
    return (is_null($this->unit_discount_price)) ? null : Sanitize::getFloat($this->unit_discount_price);
  }

  //

  public function getCaseDiscountPercent(): ?float
  {
    return (is_null($this->case_discount_percent)) ? null : Sanitize::getFloat($this->case_discount_percent);
  }

  //

  public function getUnitDiscountPercent(): ?float 
  {
    return (is_null($this->unit_discount_percent)) ? null : Sanitize::getFloat($this->unit_discount_percent);
  }

  //

  public function getCaseDiscountQuantity(): ?int 
  {
    return $this->case_discount_quantity;
  }

  //

  public function getUnitDiscountQuantity(): ?int 
  {
    return $this->unit_discount_quantity;
  }

  //

  public function getCreatedDate(): string 
  {
    return $this->created_date;
  }

  // setters

  public function setSalesOrderId(int $sales_order_id): void 
  {
    if (Validate::intLength($sales_order_id, 1))
    {
      $this->sales_order_id = $sales_order_id;
    }
  }

  //

  public function setSalesItemId(int $sales_item_id): void 
  {
    if (Validate::intLength($sales_item_id, 1))
    {
      $this->sales_item_id = $sales_item_id;
    }
  }

  //

  public function setCaseVolume(?float $case_volume): void 
  {
    $this->case_volume = (is_null($case_volume) || !Validate::intLength(Sanitize::setFloat($case_volume), 1)) ? null : Sanitize::setFloat($case_volume);
  }

  //

  public function setUnitVolume(?float $unit_volume): void 
  {
    $this->unit_volume = (is_null($unit_volume) || !Validate::intLength(Sanitize::setFloat($unit_volume), 1)) ? null : Sanitize::setFloat($unit_volume);
  }

  //

  public function setCaseWeight(?float $case_weight): void 
  {
    $this->case_weight = (is_null($case_weight) || !Validate::intLength(Sanitize::setFloat($case_weight), 1)) ? null : Sanitize::setFloat($case_weight);
  }

  //

  public function setUnitWeight(?float $unit_weight): void 
  {
    $this->unit_weight = (is_null($unit_weight) || !Validate::intLength(Sanitize::setFloat($unit_weight), 1)) ? null : Sanitize::setFloat($unit_weight);
  }

  //

  public function setCasePrice(?float $case_price): void 
  {
    $this->case_price = (is_null($case_price) || !Validate::intLength(Sanitize::setFloat($case_price), 1)) ? null : Sanitize::setFloat($case_price);
  }

  //

  public function setUnitPrice(?float $unit_price): void 
  {
    $this->unit_price = (is_null($unit_price) || !Validate::intLength(Sanitize::setFloat($unit_price), 1)) ? null : Sanitize::setFloat($unit_price);
  }

  //

  public function setCaseCostPrice(?float $case_cost_price): void 
  {
    $this->case_cost_price = (is_null($case_cost_price) || !Validate::intLength(Sanitize::setFloat($case_cost_price), 1)) ? null : Sanitize::setFloat($case_cost_price);
  }

  //

  public function setUnitCostPrice(?float $unit_cost_price): void 
  {
    $this->unit_cost_price = (is_null($unit_cost_price) || !Validate::intLength(Sanitize::setFloat($unit_cost_price), 1)) ? null : Sanitize::setFloat($unit_cost_price);
  }

  //

  public function setCaseQuantity(?int $case_quantity): void 
  {
    $this->case_quantity = (is_null($case_quantity) || !Validate::intLength($case_quantity, 1)) ? null : $case_quantity;
  }

  //

  public function setUnitQuantity(?int $unit_quantity): void 
  {
    $this->unit_quantity = (is_null($unit_quantity) || !Validate::intLength($unit_quantity, 1)) ? null : $unit_quantity;
  }

  //

  public function setCaseDiscountPrice(?float $case_discount_price): void 
  {
    $this->case_discount_price = (is_null($case_discount_price) || !Validate::intLength(Sanitize::setFloat($case_discount_price), 1)) ? null : Sanitize::setFloat($case_discount_price);
  }

  //

  public function setUnitDiscountPrice(?float $unit_discount_price): void 
  {
    $this->unit_discount_price = (is_null($unit_discount_price) || !Validate::intLength(Sanitize::setFloat($unit_discount_price), 1)) ? null : Sanitize::setFloat($unit_discount_price);
  }

  //

  public function setCaseDiscountPercent(?float $case_discount_percent): void 
  {
    $this->case_discount_percent = (is_null($case_discount_percent) || !Validate::intLength(Sanitize::setFloat($case_discount_percent), 100, 10000)) ? null : Sanitize::setFloat($case_discount_percent);
  }

  //

  public function setUnitDiscountPercent(?float $unit_discount_percent): void 
  {
    $this->unit_discount_percent = (is_null($unit_discount_percent) || !Validate::intLength(Sanitize::setFloat($unit_discount_percent), 100, 10000)) ? null : Sanitize::setFloat($unit_discount_percent);
  }

  //

  public function setCaseDiscountQuantity(?int $case_discount_quantity): void 
  {
    $this->case_discount_quantity = (is_null($case_discount_quantity) || !Validate::intLength($case_discount_quantity, 1)) ? null : $case_discount_quantity;
  }

  //

  public function setUnitDiscountQuantity(?int $unit_discount_quantity): void 
  {
    $this->unit_discount_quantity = (is_null($unit_discount_quantity) || !Validate::intLength($unit_discount_quantity, 1)) ? null : $unit_discount_quantity;
  }
}
