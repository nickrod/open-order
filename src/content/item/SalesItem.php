<?php

//

declare(strict_types=1);

//

namespace openorder\content\item;

//

use openorder\util\Validate;
use openorder\util\Sanitize;
use openorder\total\Total;

//

class SalesItem extends Item
{
  // variables

  protected $id;
  protected $title;
  protected $title_url;
  protected $image_url;
  protected $upc;
  protected $case_dimension;
  protected $unit_dimension;
  protected $item_id;
  protected $unit_case;
  protected $case_weight;
  protected $unit_weight;
  protected $case_volume;
  protected $unit_volume;
  protected $case_price;
  protected $unit_price;
  protected $case_cost_price;
  protected $unit_cost_price;
  protected $case_discount_percent;
  protected $unit_discount_percent;
  protected $case_discount_quantity;
  protected $unit_discount_quantity;
  protected $featured = 0;
  protected $instock = 1;
  protected $instock_date;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'sales_item';
  public const TABLE_KEY = 'id';
  public const TABLE_SEQ = 'sales_item_id_seq';
  public const CATEGORY = 'openorder\content\tag\category\SalesItem';
  public const FAVORITE = 'openorder\content\tag\favorite\SalesItem';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true, 'search' => true],
    'title_url' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'image_url' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'upc' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'case_dimension' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_dimension' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'item_id' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'unit_case' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_weight' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_weight' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_volume' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_volume' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_cost_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_cost_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_discount_percent' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_discount_percent' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'case_discount_quantity' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_discount_quantity' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'instock' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'instock_date' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'updated_date' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => true],
    'sales_item_category' . '__' . 'category_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'sales_item_favorite' . '__' . 'favorite_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'sales_order_sales_item' . '__' . 'sales_order_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'sales_item_category' . '__' . 'sales_item_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'sales_item_favorite' . '__' . 'sales_item_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'sales_order_sales_item' . '__' . 'sales_item_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['id']))
    {
      $this->setId($column['id']);
    }

    //

    if (isset($column['title']))
    {
      $this->setTitle($column['title']);
    }

    //

    if (isset($column['image_url']))
    {
      $this->setImageUrl($column['image_url']);
    }

    //

    if (isset($column['upc']))
    {
      $this->setUpc($column['upc']);
    }

    //

    if (isset($column['case_dimension']))
    {
      $this->setCaseDimension($column['case_dimension']);
    }

    //

    if (isset($column['unit_dimension']))
    {
      $this->setUnitDimension($column['unit_dimension']);
    }

    //

    if (isset($column['item_id']))
    {
      $this->setItemId($column['item_id']);
    }

    //

    if (isset($column['unit_case']))
    {
      $this->setUnitCase($column['unit_case']);
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

    //

    if (isset($column['featured']))
    {
      $this->setFeatured($column['featured']);
    }

    //

    if (isset($column['instock']))
    {
      $this->setInstock($column['instock']);
    }

    //

    if (isset($column['instock_date']))
    {
      $this->setInstockDate($column['instock_date']);
    }
  }

  // getters

  public function getId(): int 
  {
    return $this->id;
  }

  //

  public function getTitle(): string 
  {
    return Sanitize::noHTML($this->title);
  }

  //

  public function getTitleUrl(): string 
  {
    return Sanitize::noHTML(urlencode($this->title_url));
  }

  //

  public function getImageUrl(): ?string 
  {
    return (is_null($this->image_url)) ? null : Sanitize::noHTML($this->image_url);
  }

  //

  public function getUpc(): ?string 
  {
    return (is_null($this->upc)) ? null : Sanitize::noHTML($this->upc);
  }

  //

  public function getCaseDimension(): ?string 
  {
    return (is_null($this->case_dimension)) ? null : Sanitize::noHTML($this->case_dimension);
  }

  //

  public function getUnitDimension(): ?string 
  {
    return (is_null($this->unit_dimension)) ? null : Sanitize::noHTML($this->unit_dimension);
  }

  //

  public function getItemId(): ?int 
  {
    return $this->item_id;
  }

  //

  public function getUnitCase(): ?int 
  {
    return $this->unit_case;
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

  public function getFeatured(): bool 
  {
    return $this->featured;
  }

  //

  public function getInstock(): bool 
  {
    return $this->instock;
  }

  //

  public function getInstockDate(): ?string 
  {
    return $this->instock_date;
  }

  //

  public function getCreatedDate(): string 
  {
    return $this->created_date;
  }

  //

  public function getUpdatedDate(): string 
  {
    return $this->updated_date;
  }

  // setters

  public function setId(int $id): void 
  {
    if (Validate::intLength($id, 1))
    {
      $this->id = $id;
    }
  }

  //

  public function setTitle(string $title): void 
  {
    if (Validate::strLength($title, 1, 60))
    {
      $this->title = $title;
      $this->setTitleUrl($title);
    }
  }

  //

  private function setTitleUrl(string $title_url): void 
  {
    if (Validate::strLength($title_url, 1, 70))
    {
      $this->title_url = Sanitize::slugify($title_url);
    }
  }

  //

  public function setImageUrl(?string $image_url): void 
  {
    if (is_null($image_url) || Validate::strLength($image_url, 1, 200))
    {
      if (!is_null($image_url) && !filter_var($image_url, FILTER_VALIDATE_URL))
      {
        throw new \InvalidArgumentException('Image url is invalid: ' . $image_url);
      }
      else
      {
        $this->image_url = $image_url;
      }
    }
  }

  //

  public function setUpc(?string $upc): void 
  {
    if (is_null($upc) || Validate::strLength($upc, 1, 60))
    {
      $this->upc = $upc;
    }
  }

  //

  public function setCaseDimension(?string $case_dimension): void 
  {
    if (is_null($case_dimension) || Validate::strLength($case_dimension, 1, 60))
    {
      $this->case_dimension = $case_dimension;
    }
  }

  //

  public function setUnitDimension(?string $unit_dimension): void 
  {
    if (is_null($unit_dimension) || Validate::strLength($unit_dimension, 1, 60))
    {
      $this->unit_dimension = $unit_dimension;
    }
  }

  //

  public function setItemId(?int $item_id): void 
  {
    if (is_null($item_id) || Validate::intLength($item_id, 1))
    {
      $this->item_id = $item_id;
    }
  }

  //

  public function setUnitCase(?int $unit_case): void 
  {
    if (is_null($unit_case) || Validate::intLength($unit_case, 1))
    {
      $this->unit_case = $unit_case;
    }
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
    $this->case_cost_price = (is_null($cast_cost_price) || !Validate::intLength(Sanitize::setFloat($case_cost_price), 1)) ? null : Sanitize::setFloat($case_cost_price);
  }

  //

  public function setUnitCostPrice(?float $unit_cost_price): void 
  {
    $this->unit_cost_price = (is_null($unit_cost_price) || !Validate::intLength(Sanitize::setFloat($unit_cost_price), 1)) ? null : Sanitize::setFloat($unit_cost_price);
  }

  //

  public function setCaseDiscountPercent(?float $case_discount_percent): void 
  {
    $this->case_discount_percent = (is_null($case_discount_percent) || !Validate::intLength(Sanitize::setFloat($case_discount_percent), 1)) ? null : Sanitize::setFloat($case_discount_percent);
  }

  //

  public function setUnitDiscountPercent(?float $unit_discount_percent): void 
  {
    $this->unit_discount_percent = (is_null($unit_discount_percent) || !Validate::intLength(Sanitize::setFloat($unit_discount_percent), 1)) ? null : Sanitize::setFloat($unit_discount_percent);
  }

  //

  public function setCaseDiscountQuantity(?int $case_discount_quantity): void 
  {
    if (is_null($case_discount_quantity) || Validate::intLength($case_discount_quantity, 1))
    {
      $this->case_discount_quantity = $case_discount_quantity;
    }
  }

  //

  public function setUnitDiscountQuantity(?int $unit_discount_quantity): void 
  {
    if (is_null($unit_discount_quantity) || Validate::intLength($unit_discount_quantity, 1))
    {
      $this->unit_discount_quantity = $unit_discount_quantity;
    }
  }

  //

  public function setFeatured(bool $featured): void 
  {
    $this->featured = Sanitize::setBoolean($featured);
  }

  //

  public function setInstock(bool $instock): void 
  {
    $this->instock = Sanitize::setBoolean($instock);
  }

  //

  public function setInstockDate(?string $instock_date): void 
  {
    if (is_null($instock_date) || Validate::isDate($instock_date))
    {
      $this->instock_date = $instock_date;
    }
  }

  //

  public static function getTotal(\PDO $pdo): int
  {
    $return_object = Total::getObject($pdo, ['index' => ['id' => 1]]);

    //

    if (!isset($return_object))
    {
      return 0;
    }
    else
    {
      return $return_object->getTotalSalesItem();
    }
  }
}
