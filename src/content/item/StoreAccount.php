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

class StoreAccount extends Item
{
  // variables

  protected $id;
  protected $title;
  protected $title_url;
  protected $account_id;
  protected $featured;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'store_account';
  public const TABLE_KEY = 'id';
  public const TABLE_SEQ = 'store_account_id_seq';
  public const CATEGORY = 'openorder\content\tag\category\StoreAccount';
  public const FAVORITE = 'openorder\content\tag\favorite\StoreAccount';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true, 'search' => true],
    'title_url' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'account_id' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'updated_date' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => true],
    'store_account_category' . '__' . 'category_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'store_account_favorite' . '__' . 'favorite_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'store_account_category' . '__' . 'store_account_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'store_account_favorite' . '__' . 'store_account_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true]
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

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
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

  public function getAccountId(): ?int 
  {
    return $this->account_id;
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

  public function setAccountId(?int $account_id): void 
  {
    if (is_null($account_id) || Validate::intLength($account_id, 1))
    {
      $this->account_id = $account_id;
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
      return $return_object->getTotalStoreAccount();
    }
  }
}
