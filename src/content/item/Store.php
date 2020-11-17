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

class Store extends Item
{
  // variables

  protected $id;
  protected $title;
  protected $title_url;
  protected $store_account_title_url;
  protected $store_id;
  protected $store_number;
  protected $latitude;
  protected $longitude;
  protected $featured = 0;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'store';
  public const TABLE_KEY = 'id';
  public const TABLE_SEQ = 'store_id_seq';
  public const CATEGORY = 'openorder\content\tag\category\Store';
  public const FAVORITE = 'openorder\content\tag\favorite\Store';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true, 'search' => true],
    'title_url' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'store_account_title_url' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'store_id' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'store_number' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'latitude' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'longitude' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'updated_date' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => true],
    'store_category' . '__' . 'category_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'store_favorite' . '__' . 'favorite_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'user_account_store' . '__' . 'user_account_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'store_category' . '__' . 'store_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'store_favorite' . '__' . 'store_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'user_account_store' . '__' . 'store_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true]
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

    if (isset($column['store_account_title_url']))
    {
      $this->setStoreAccountTitleUrl($column['store_account_title_url']);
    }

    //

    if (isset($column['store_id']))
    {
      $this->setStoreId($column['store_id']);
    }

    //

    if (isset($column['store_number']))
    {
      $this->setStoreNumber($column['store_number']);
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

    if (isset($column['featured']))
    {
      $this->setFeatured($column['featured']);
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

  public function getStoreAccountTitleUrl(): string 
  {
    return Sanitize::noHTML(urlencode($this->store_account_title_url));
  }

  //

  public function getStoreId(): ?int 
  {
    return $this->store_id;
  }

  //

  public function getStoreNumber(): ?int 
  {
    return $this->store_number;
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

  public function getFeatured(): bool 
  {
    return $this->featured;
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

  public function setStoreAccountTitleUrl(string $store_account_title_url): void 
  {
    if (Validate::strLength($store_account_title_url, 1, 70))
    {
      $this->store_account_title_url = $store_account_title_url;
    }
  }

  //

  private function setStoreId(?int $store_id): void 
  {
    if (is_null($store_id) || Validate::intLength($store_id, 1))
    {
      $this->store_id = $store_id;
    }
  }

  //

  private function setStoreNumber(?int $store_number): void 
  {
    if (is_null($store_number) || Validate::intLength($store_number, 1))
    {
      $this->store_number = $store_number;
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

  public function setFeatured(bool $featured): void 
  {
    $this->featured = Sanitize::setBoolean($featured);
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
      return $return_object->getTotalStore();
    }
  }
}
