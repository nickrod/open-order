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

class SalesOrder extends Item
{
  // variables

  protected $id;
  protected $notes;
  protected $currency_code;
  protected $base_currency_code;
  protected $user_account_name_url;
  protected $store_title_url;
  protected $order_id;
  protected $total_weight;
  protected $total_volume;
  protected $currency_price;
  protected $shipping_price;
  protected $tax_price;
  protected $subtotal_price;
  protected $discount_price;
  protected $total_price;
  protected $case_quantity;
  protected $unit_quantity;
  protected $latitude;
  protected $longitude;
  protected $pickup;
  protected $paid;
  protected $enabled;
  protected $deliver_date;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'sales_order';
  public const TABLE_KEY = 'id';
  public const TABLE_SEQ = 'sales_order_id_seq';
  public const CATEGORY = 'openorder\content\tag\category\SalesOrder';
  public const FAVORITE = 'openorder\content\tag\favorite\SalesOrder';
  public const SALES_ITEM = 'openorder\content\tag\sales-item\SalesOrder';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'notes' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'currency_code' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'base_currency_code' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'user_account_name_url' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'store_title_url' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'order_id' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'total_weight' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'total_volume' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'currency_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'shipping_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'tax_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'subtotal_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'discount_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'total_price' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'case_quantity' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'unit_quantity' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'latitude' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'longitude' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'pickup' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'paid' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'enabled' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'deliver_date' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'updated_date' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => true],
    'sales_order_category' . '__' . 'category_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'sales_order_favorite' . '__' . 'favorite_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'sales_order_sales_item' . '__' . 'sales_item_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'sales_order_category' . '__' . 'sales_order_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'sales_order_favorite' . '__' . 'sales_order_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'sales_order_sales_item' . '__' . 'sales_order_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['id']))
    {
      $this->setId($column['id']);
    }

    //

    if (isset($column['notes']))
    {
      $this->setNotes($column['notes']);
    }

    //

    if (isset($column['currency_code']))
    {
      $this->setCurrencyCode($column['currency_code']);
    }

    //

    if (isset($column['base_currency_code']))
    {
      $this->setBaseCurrencyCode($column['base_currency_code']);
    }

    //

    if (isset($column['user_account_name_url']))
    {
      $this->setUserAccountNameUrl($column['user_account_name_url']);
    }

    //

    if (isset($column['store_title_url']))
    {
      $this->setStoreTitleUrl($column['store_title_url']);
    }

    //

    if (isset($column['order_id']))
    {
      $this->setOrderId($column['order_id']);
    }

    //

    if (isset($column['total_weight']))
    {
      $this->setTotalWeight($column['total_weight']);
    }

    //

    if (isset($column['total_volume']))
    {
      $this->setTotalVolume($column['total_volume']);
    }

    //

    if (isset($column['currency_price']))
    {
      $this->setCurrencyPrice($column['currency_price']);
    }

    //

    if (isset($column['shipping_price']))
    {
      $this->setShippingPrice($column['shipping_price']);
    }

    //

    if (isset($column['tax_price']))
    {
      $this->setTaxPrice($column['tax_price']);
    }

    //

    if (isset($column['discount_price']))
    {
      $this->setDiscountPrice($column['discount_price']);
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

    if (isset($column['latitude']))
    {
      $this->setLatitude($column['latitude']);
    }

    //

    if (isset($column['longitude']))
    {
      $this->setLongitude($column['longitude']);
    }

    //

    if (isset($column['pickup']))
    {
      $this->setPickup($column['pickup']);
    }

    //

    if (isset($column['paid']))
    {
      $this->setPaid($column['paid']);
    }

    //

    if (isset($column['enabled']))
    {
      $this->setEnabled($column['enabled']);
    }

    //

    if (isset($column['deliver_date']))
    {
      $this->setDeliverDate($column['deliver_date']);
    }
  }

  // getters

  public function getId(): int 
  {
    return $this->id;
  }

  //

  public function getNotes(): ?string 
  {
    return (is_null($this->notes)) ? null : Sanitize::noHTML($this->notes);
  }

  //

  public function getCurrencyCode(): string 
  {
    return Sanitize::noHTML($this->currency_code);
  }

  //

  public function getBaseCurrencyCode(): string 
  {
    return Sanitize::noHTML($this->base_currency_code);
  }

  //

  public function getUserAccountNameUrl(): ?string 
  {
    return (is_null($this->user_account_name_url)) ? null : Sanitize::noHTML(urlencode($this->user_account_name_url));
  }

  //

  public function getStoreTitleUrl(): string 
  {
    return Sanitize::noHTML(urlencode($this->store_title_url));
  }

  //

  public function getOrderId(): ?int 
  {
    return $this->order_id;
  }

  //

  public function getTotalWeight(): ?float 
  {
    return (is_null($this->total_weight)) ? null : Sanitize::getFloat($this->total_weight);
  }

  //

  public function getTotalVolume(): ?float 
  {
    return (is_null($this->total_volume)) ? null : Sanitize::getFloat($this->total_volume);
  }

  //

  public function getCurrencyPrice(): ?float 
  {
    return $this->currency_price;
  }

  //

  public function getShippingPrice(): ?float 
  {
    return (is_null($this->shipping_price)) ? null : Sanitize::getFloat($this->shipping_price);
  }

  //

  public function getTaxPrice(): ?float 
  {
    return (is_null($this->tax_price)) ? null : Sanitize::getFloat($this->tax_price);
  }

  //

  public function getSubtotalPrice(): ?float 
  {
    return (is_null($this->subtotal_price)) ? null : Sanitize::getFloat($this->subtotal_price);
  }

  //

  public function getDiscountPrice(): ?float 
  {
    return (is_null($this->discount_price)) ? null : Sanitize::getFloat($this->discount_price);
  }

  //

  public function getTotalPrice(): ?float 
  {
    return (is_null($this->total_price)) ? null : Sanitize::getFloat($this->total_price);
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

  public function getLatitude(): ?float 
  {
    return $this->latitude;
  }

  //

  public function getLongitude(): ?float 
  {
    return $this->longitude;
  }

  //

  public function getPickup(): bool 
  {
    return $this->pickup;
  }

  //

  public function getPaid(): bool 
  {
    return $this->paid;
  }

  //

  public function getEnabled(): bool 
  {
    return $this->enabled;
  }

  //

  public function getDeliverDate(): ?string 
  {
    return $this->deliver_date;
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

  //

  public function getSalesItem(\PDO $pdo, int $limit = 10, int $offset = 0): ?array
  {
    if (isset($this->id))
    {
      return $sales_item = &SalesItem::getList($pdo, ['index' => [(self::SALES_ITEM)::TABLE . '__' . self::TABLE . '_id' => $this->id], 'join' => [(self::SALES_ITEM)::TABLE . '__' . 'sales_item_id' => 'INNER'], 'limit' => $limit, 'offset' => $offset]);
    }
    else
    {
      return null;
    }
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

  public function setNotes(?string $notes): void 
  {
    if (is_null($notes) || Validate::strLength($notes, 1, 200))
    {
      $this->notes = $notes;
    }
  }

  //

  private function setCurrencyCode(string $currency_code): void 
  {
    if (Validate::strLength($currency_code, 2, 6))
    {
      $this->currency_code = $currency_code;
    }
  }

  //

  private function setBaseCurrencyCode(string $base_currency_code): void 
  {
    if (Validate::strLength($base_currency_code, 2, 6))
    {
      $this->base_currency_code = $base_currency_code;
    }
  }

  //

  public function setUserAccountNameUrl(?string $user_account_name_url): void 
  {
    if (is_null($user_account_name_url) || Validate::strLength($user_account_name_url, 1, 70))
    {
      $this->user_account_name_url = $user_account_name_url;
    }
  }

  //

  public function setStoreTitleUrl(string $store_title_url): void 
  {
    if (Validate::strLength($store_title_url, 1, 70))
    {
      $this->store_title_url = $store_title_url;
    }
  }

  //

  public function setOrderId(?int $order_id): void 
  {
    if (is_null($order_id) || Validate::intLength($order_id, 1))
    {
      $this->order_id = $order_id;
    }
  }

  //

  public function setTotalWeight(?float $total_weight): void 
  {
    $this->total_weight = (is_null($total_weight) || !Validate::intLength(Sanitize::setFloat($total_weight), 1)) ? null : Sanitize::setFloat($total_weight);
  }

  //

  public function setTotalVolume(?float $total_volume): void 
  {
    $this->total_volume = (is_null($total_volume) || !Validate::intLength(Sanitize::setFloat($total_volume), 1)) ? null : Sanitize::setFloat($total_volume);
  }

  //

  public function setCurrencyPrice(?float $currency_price): void 
  {
    if (is_null($currency_price) || Validate::intLength(Sanitize::setFloat($currency_price), 1))
    {
      $this->currency_price = $currency_price;
    }
  }

  //

  public function setShippingPrice(?float $shipping_price): void 
  {
    $this->shipping_price = (is_null($shipping_price) || !Validate::intLength(Sanitize::setFloat($shipping_price), 1)) ? null : Sanitize::setFloat($shipping_price);
  }

  //

  public function setTaxPrice(?float $tax_price): void 
  {
    $this->tax_price = (is_null($tax_price) || !Validate::intLength(Sanitize::setFloat($tax_price), 1)) ? null : Sanitize::setFloat($tax_price);
  }

  //

  private function setSubtotalPrice(?float $subtotal_price): void 
  {
    $this->subtotal_price = (is_null($subtotal_price) || !Validate::intLength(Sanitize::setFloat($subtotal_price), 1)) ? null : Sanitize::setFloat($subtotal_price);
  }

  //

  public function setDiscountPrice(?float $discount_price): void 
  {
    $this->discount_price = (is_null($discount_price) || !Validate::intLength(Sanitize::setFloat($discount_price), 1)) ? null : Sanitize::setFloat($discount_price);
  }

  //

  public function setCaseQuantity(?int $case_quantity): void 
  {
    if (is_null($case_quantity) || Validate::intLength($case_quantity, 1))
    {
      $this->case_quantity = $case_quantity;
    }
  }

  //

  public function setUnitQuantity(?int $unit_quantity): void 
  {
    if (is_null($unit_quantity) || Validate::intLength($unit_quantity, 1))
    {
      $this->unit_quantity = $unit_quantity;
    }
  }

  //

  public function setLatitude(?float $latitude): void 
  {
    if (is_null($latitude) || Validate::intLength(Sanitize::setFloat($latitude), 1))
    {
      $this->latitude = $latitude;
    }
  }

  //

  public function setLongitude(?float $longitude): void 
  {
    if (is_null($longitude) || Validate::intLength(Sanitize::setFloat($longitude), 1))
    {
      $this->longitude = $longitude;
    }
  }

  //

  public function setPickup(bool $pickup): void 
  {
    $this->pickup = Sanitize::setBoolean($pickup);
  }

  //

  public function setPaid(bool $paid): void 
  {
    $this->paid = Sanitize::setBoolean($paid);
  }

  //

  public function setEnabled(bool $enabled): void 
  {
    $this->enabled = Sanitize::setBoolean($enabled);
  }

  //

  public function setDeliverDate(?string $deliver_date): void 
  {
    if (is_null($deliver_date) || Validate::isDate($deliver_date))
    {
      $this->deliver_date = $deliver_date;
    }
  }

  //

  public function addSalesItem(\PDO $pdo, array $sales_item = []): void
  {
    if (isset($this->id))
    {
      $total_volume = $total_weight = $subtotal_price = $discount_price = $total_case_quantity = $total_unit_quantity = null;

      //

      foreach ($sales_item as $sales_item_id => $quantity)
      {
        $case_quantity = (isset($quantity['case']) && is_int($quantity['case']) && $quantity['case'] > 0) ? $quantity['case'] : null;
        $unit_quantity = (isset($quantity['unit']) && is_int($quantity['unit']) && $quantity['unit'] > 0) ? $quantity['unit'] : null;

        //

        if (is_int($sales_item_id) && Validate::intLength($sales_item_id, 1) && ($case_quantity !== null || $unit_quantity !== null))
        {
          if ($item_object = SalesItem::getObject($pdo, ['index' => ['item_id' => $sales_item_id]]))
          {
            $case_price = $item_object->getCasePrice();
            $unit_price = $item_object->getUnitPrice();
            $case_volume = $item_object->getCaseVolume();
            $unit_volume = $item_object->getUnitVolume();
            $case_weight = $item_object->getCaseWeight();
            $unit_weight = $item_object->getUnitWeight();
            $case_discount_price = $unit_discount_price = null;
            $sales_order = self::SALES_ITEM;

            //

            if ($case_quantity !== null)
            {
              $case_price = ($case_price !== null) ? ($case_price * $case_quantity) : null;
              $subtotal_price += $case_price;
              $case_discount_price = ($item_object->getCaseDiscountQuantity() !== null && $item_object->getCaseDiscountPercent() !== null && $case_quantity >= $item_object->getCaseDiscountQuantity()) ? (int) ($case_price * .01 * $item_object->getCaseDiscountPercent()) : null;
              $discount_price += $case_discount_price;
              $total_case_quantity += $case_quantity;
              $total_volume += $case_volume;
              $total_weight += $case_weight;
            }

            //

            if ($unit_quantity !== null)
            {
              $unit_price = ($unit_price !== null) ? ($unit_price * $unit_quantity) : null;
              $subtotal_price += $unit_price;
              $unit_discount_price = ($item_object->getUnitDiscountQuantity() !== null && $item_object->getUnitDiscountPercent() !== null && $unit_quantity >= $item_object->getUnitDiscountQuantity()) ? (int) ($unit_price * .01 * $item_object->getUnitDiscountPercent()) : null;
              $discount_price += $unit_discount_price;
              $total_unit_quantity += $unit_quantity;
              $total_volume += $unit_volume;
              $total_weight += $unit_weight;
            }

            //

            (new $sales_order([self::TABLE . '_id' => $this->id, 'sales_item_id' => $sales_item_id, 'case_volume' => $case_volume, 'unit_volume' => $unit_volume, 'case_weight' => $case_weight, 'unit_weight' => $unit_weight, 'case_price' => $case_price, 'unit_price' => $unit_price, 'case_cost_price' => $item_object->getCaseCostPrice(), 'unit_cost_price' => $item_object->getUnitCostPrice(), 'case_quantity' => $case_quantity, 'unit_quantity' => $unit_quantity, 'case_discount_price' => $case_discount_price, 'unit_discount_price' => $unit_discount_price, 'case_discount_percent' => $item_object->getCaseDiscountPercent(), 'unit_discount_percent' => $item_object->getUnitDiscountPercent(), 'case_discount_quantity' => $item_object->getCaseDiscountQuantity(), 'unit_discount_quantity' => $item_object->getUnitDiscountQuantity()]))->save($pdo);
          }
          else
          {
            throw new \InvalidArgumentException('Sales item id does not exist: ' . $sales_item_id);
          }
        }

        //

        if ($total_case_quantity !== null || $total_unit_quantity !== null)
        {
          $this->setCaseQuantity((($this->getCaseQuantity() + $total_case_quantity) > 0) ? ($this->getCaseQuantity() + $total_case_quantity) : null);
          $this->setUnitQuantity((($this->getUnitQuantity() + $total_unit_quantity) > 0) ? ($this->getUnitQuantity() + $total_unit_quantity) : null);
          $this->setTotalVolume((($this->getTotalVolume() + $total_volume) > 0) ? ($this->getTotalVolume() + $total_volume) : null);
          $this->setTotalWeight((($this->getTotalWeight() + $total_weight) > 0) ? ($this->getTotalWeight() + $total_weight) : null);
          $this->setSubtotalPrice((($this->getSubtotalPrice() + $subtotal_price) > 0) ? ($this->getSubtotalPrice() + $subtotal_price) : null);
          $this->setDiscountPrice((($this->getDiscountPrice() + $discount_price) > 0) ? ($this->getDiscountPrice() + $discount_price) : null);
          $this->edit($pdo);
        }
      }
    }
  }

  //

  public function removeSalesItem(array $sales_item = []): void
  {
    if (isset($this->id))
    {
      $total_volume = $total_weight = $subtotal_price = $discount_price = $total_case_quantity = $total_unit_quantity = null;

      //

      foreach (array_unique($sales_item) as $sales_item_id)
      {
        if (is_int($sales_item_id) && Validate::intLength($sales_item_id, 1))
        {
          if ($item_object = SalesItem::getObject($pdo, ['index' => ['item_id' => $sales_item_id]]))
          {
            if ($order_object = (self::SALES_ITEM)::getObject($pdo, ['index' => ['sales_order_id' => $this->id, 'sales_item_id' => $item_object->getId()]]))
            {
              $case_quantity = $order_object->getCaseQuantity();
              $unit_quantity = $order_object->getUnitQuantity();

              //

              if ($case_quantity !== null)
              {
                $subtotal_price += $order_object->getCasePrice();
                $discount_price += $order_object->getCaseDiscountPrice();
                $total_case_quantity += $case_quantity;
                $total_volume += $order_object->getCaseVolume();
                $total_weight += $order_object->getCaseWeight();
              }

              //

              if ($unit_quantity !== null)
              {
                $subtotal_price += $order_object->getUnitPrice();
                $discount_price += $order_object->getUnitDiscountPrice();
                $total_unit_quantity += $unit_quantity;
                $total_volume += $order_object->getUnitVolume();
                $total_weight += $order_object->getUnitWeight();
              }

              //

              $order_object->remove($pdo);
            }
          }
          else
          {
            throw new \InvalidArgumentException('Sales item id does not exist: ' . $sales_item_id);
          }
        }
      }

      //

      if ($total_case_quantity !== null || $total_unit_quantity !== null)
      {
        $this->setCaseQuantity((($this->getCaseQuantity() - $total_case_quantity) > 0) ? ($this->getCaseQuantity() - $total_case_quantity) : null);
        $this->setUnitQuantity((($this->getUnitQuantity() - $total_unit_quantity) > 0) ? ($this->getUnitQuantity() - $total_unit_quantity) : null);
        $this->setTotalVolume((($this->getTotalVolume() - $total_volume) > 0) ? ($this->getTotalVolume() - $total_volume) : null);
        $this->setTotalWeight((($this->getTotalWeight() - $total_weight) > 0) ? ($this->getTotalWeight() - $total_weight) : null);
        $this->setSubtotalPrice((($this->getSubtotalPrice() - $subtotal_price) > 0) ? ($this->getSubtotalPrice() - $subtotal_price) : null);
        $this->setDiscountPrice((($this->getDiscountPrice() - $discount_price) > 0) ? ($this->getDiscountPrice() - $discount_price) : null);
        $this->edit($pdo);
      }
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
      return $return_object->getTotalSalesOrder();
    }
  }
}
