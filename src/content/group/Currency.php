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

class Currency extends SimpleDb
{
  // variables

  protected $id;
  protected $code;
  protected $title;
  protected $title_url;
  protected $title_unit;
  protected $symbol;
  protected $symbol_unit;
  protected $multiplier_unit;
  protected $price;
  protected $featured = 0;
  protected $crypto = 0;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'currency';
  public const TABLE_KEY = 'id';
  public const TABLE_SEQ = 'currency_id_seq';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'code' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true, 'search' => true],
    'title_url' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'title_unit' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'symbol' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'symbol_unit' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'multiplier_unit' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'crypto' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'updated_date' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => true]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['id']))
    {
      $this->setId($column['id']);
    }

    //

    if (isset($column['code']))
    {
      $this->setCode($column['code']);
    }

    //

    if (isset($column['title']))
    {
      $this->setTitle($column['title']);
    }

    //

    if (isset($column['title_unit']))
    {
      $this->setTitleUnit($column['title_unit']);
    }

    //

    if (isset($column['symbol']))
    {
      $this->setSymbol($column['symbol']);
    }

    //

    if (isset($column['symbol_unit']))
    {
      $this->setSymbolUnit($column['symbol_unit']);
    }

    //

    if (isset($column['multiplier_unit']))
    {
      $this->setMultiplierUnit($column['multiplier_unit']);
    }

    //

    if (isset($column['price']))
    {
      $this->setPrice($column['price']);
    }

    //

    if (isset($column['featured']))
    {
      $this->setFeatured($column['featured']);
    }

    //

    if (isset($column['crypto']))
    {
      $this->setCrypto($column['crypto']);
    }
  }

  // getters

  public function getId(): int 
  {
    return $this->id;
  }

  //

  public function getCode(): string 
  {
    return Sanitize::noHTML($this->code);
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

  public function getTitleUnit(): ?string 
  {
    return (is_null($this->title_unit)) ? null : Sanitize::noHTML($this->title_unit);
  }

  //

  public function getSymbol(): ?string 
  {
    return (is_null($this->symbol)) ? null : Sanitize::noHTML($this->symbol);
  }

  //

  public function getSymbolUnit(): ?string 
  {
    return (is_null($this->symbol_unit)) ? null : Sanitize::noHTML($this->symbol_unit);
  }

  //

  public function getMultiplierUnit(): ?int 
  {
    return $this->multiplier_unit;
  }

  //

  public function getPrice(): ?float 
  {
    return $this->price;
  }

  //

  public function getFeatured(): bool 
  {
    return $this->featured;
  }

  //

  public function getCrypto(): bool 
  {
    return $this->crypto;
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

  public function setCode(string $code): void 
  {
    if (Validate::strLength($code, 2, 6))
    {
      $this->code = $code;
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

  private function setTitleUnit(?string $title_unit): void 
  {
    if (is_null($title_unit) || Validate::strLength($title_unit, 1, 60))
    {
      $this->title_unit = $title_unit;
    }
  }

  //

  public function setSymbol(?string $symbol): void 
  {
    if (is_null($symbol) || Validate::strLength($symbol, 1, 60))
    {
      $this->symbol = $symbol;
    }
  }

  //

  public function setSymbolUnit(?string $symbol_unit): void 
  {
    if (is_null($symbol_unit) || Validate::strLength($symbol_unit, 1, 60))
    {
      $this->symbol_unit = $symbol_unit;
    }
  }

  //

  public function setMultiplierUnit(?int $multiplier_unit): void 
  {
    if (is_null($multiplier_unit) || Validate::intLength($multiplier_unit, 1))
    {
      $this->multiplier_unit = $multiplier_unit;
    }
  }

  //

  public function setPrice(?float $price): void 
  {
    $this->price = (is_null($price) || !Validate::intLength(Sanitize::setFloat($price), 1)) ? null : Sanitize::setFloat($price);
  }

  //

  public function setFeatured(bool $featured): void 
  {
    $this->featured = Sanitize::setBoolean($featured);
  }

  //

  public function setCrypto(bool $crypto): void 
  {
    $this->crypto = Sanitize::setBoolean($crypto);
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
      return $return_object->getTotalCurrency();
    }
  }
}
