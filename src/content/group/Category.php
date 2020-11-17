<?php

//

declare(strict_types=1);

//

namespace openorder\content\group;

//

use openorder\database\SimpleDb;
use openorder\util\Validate;
use openorder\util\Sanitize;
use openorder\total\Total;

//

class Category extends SimpleDb
{
  // variables

  protected $id;
  protected $title;
  protected $title_url;
  protected $featured = 0;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'category';
  public const TABLE_KEY = 'id';
  public const TABLE_SEQ = 'category_id_seq';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true, 'search' => true],
    'title_url' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'updated_date' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => true],
    'sales_item_category' . '__' . 'sales_item_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'sales_order_category' . '__' . 'sales_order_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'store_category' . '__' . 'store_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'store_account_category' . '__' . 'store_account_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'user_account_category' . '__' . 'user_account_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'sales_item_category' . '__' . 'category_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'sales_order_category' . '__' . 'category_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'store_category' . '__' . 'category_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'store_account_category' . '__' . 'category_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'user_account_category' . '__' . 'category_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true]
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
      return $return_object->getTotalCategory();
    }
  }
}
