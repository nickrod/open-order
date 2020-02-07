<?php

//

declare(strict_types=1);

//

namespace openorder\content\group;

//

use openorder\base\Table;
use openorder\tools\Validate;
use openorder\tools\Sanitize;

//

class Currency extends Table
{
  // variables

  protected $id;
  protected $code;
  protected $title;
  protected $title_url;
  protected $title_unit;
  protected $page_title;
  protected $page_description;
  protected $page_header;
  protected $featured;
  protected $crypto;
  protected $symbol;
  protected $symbol_unit;
  protected $multiplier_unit;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'currency';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'code' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 6],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 200, 'search' => true],
    'title_url' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false, 'min_length' => 2, 'max_length' => 200, 'max_display' => 80],
    'title_unit' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 100],
    'page_title' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'page_description' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'page_header' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'crypto' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'symbol' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 60],
    'symbol_unit' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 60],
    'multiplier_unit' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 1, 'max_length' => 100000000],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'updated_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
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

    if (isset($column['page_title']))
    {
      $this->setPageTitle($column['page_title']);
    }

    //

    if (isset($column['page_description']))
    {
      $this->setPageDescription($column['page_description']);
    }

    //

    if (isset($column['page_header']))
    {
      $this->setPageHeader($column['page_header']);
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
    return Sanitize::noHTML(urlencode(Sanitize::length($this->title_url, self::COLUMN['title_url']['max_display'])));
  }

  //

  public function getTitleUnit(): string 
  {
    return Sanitize::noHTML($this->title_unit);
  }

  //

  public function getPageTitle(): string 
  {
    return Sanitize::noHTML(Sanitize::length($this->page_title, self::COLUMN['page_title']['max_display']));
  }

  //

  public function getPageDescription(): string 
  {
    return Sanitize::noHTML(Sanitize::length($this->page_description, self::COLUMN['page_description']['max_display']));
  }

  //

  public function getPageHeader(): string 
  {
    return Sanitize::noHTML(Sanitize::length($this->page_header, self::COLUMN['page_header']['max_display']));
  }

  //

  public function getFeatured(): bool 
  {
    return Sanitize::getBoolean($this->featured);
  }

  //

  public function getCrypto(): bool 
  {
    return Sanitize::getBoolean($this->crypto);
  }

  //

  public function getSymbol(): string 
  {
    return Sanitize::noHTML($this->symbol);
  }

  //

  public function getSymbolUnit(): string 
  {
    return Sanitize::noHTML($this->symbol_unit);
  }

  //

  public function getMultiplierUnit(): int 
  {
    return $this->multiplier_unit;
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
    if ($id > 0)
    {
      $this->id = $id;
    }
  }

  //

  public function setCode(string $code): void 
  {
    if (Validate::strLength($code, self::COLUMN['code']['min_length'], self::COLUMN['code']['max_length']))
    {
      $this->code = $code;
    }
  }

  //

  public function setTitle(string $title): void 
  {
    if (Validate::strLength($title, self::COLUMN['title']['min_length'], self::COLUMN['title']['max_length']))
    {
      $this->title = $title;
      $this->setTitleUrl($title);
    }
  }

  //

  private function setTitleUrl(string $title_url): void 
  {
    if (Validate::strLength($title_url, self::COLUMN['title_url']['min_length'], self::COLUMN['title_url']['max_length']))
    {
      $this->title_url = Sanitize::slugify($title_url);
    }
  }

  //

  private function setTitleUnit(string $title_unit): void 
  {
    if (Validate::strLength($title_unit, self::COLUMN['title_unit']['min_length'], self::COLUMN['title_unit']['max_length']))
    {
      $this->title_unit = $title_unit;
    }
  }

  //

  public function setPageTitle(string $page_title): void 
  {
    if (Validate::strLength($page_title, self::COLUMN['page_title']['min_length'], self::COLUMN['page_title']['max_length']))
    {
      $this->page_title = $page_title;
    }
  }

  //

  public function setPageDescription(string $page_description): void 
  {
    if (Validate::strLength($page_description, self::COLUMN['page_description']['min_length'], self::COLUMN['page_description']['max_length']))
    {
      $this->page_description = $page_description;
    }
  }

  //

  public function setPageHeader(string $page_header): void 
  {
    if (Validate::strLength($page_header, self::COLUMN['page_header']['min_length'], self::COLUMN['page_header']['max_length']))
    {
      $this->page_header = $page_header;
    }
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

  public function setSymbol(string $symbol): void 
  {
    if (Validate::strLength($symbol, self::COLUMN['symbol']['min_length'], self::COLUMN['symbol']['max_length']))
    {
      $this->symbol = $symbol;
    }
  }

  //

  public function setSymbolUnit(string $symbol_unit): void 
  {
    if (Validate::strLength($symbol_unit, self::COLUMN['symbol_unit']['min_length'], self::COLUMN['symbol_unit']['max_length']))
    {
      $this->symbol_unit = $symbol_unit;
    }
  }

  //

  public function setMultiplierUnit(int $multiplier_unit): void 
  {
    if (Validate::intLength($multiplier_unit, self::COLUMN['multiplier_unit']['min_length'], self::COLUMN['multiplier_unit']['max_length']))
    {
      $this->multiplier_unit = $multiplier_unit;
    }
  }
}
