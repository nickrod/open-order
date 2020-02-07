<?php

//

declare(strict_types=1);

//

namespace openorder\content\item;

//

use openorder\config\Config;
use openorder\tools\Validate;
use openorder\tools\Sanitize;

//

class Blog extends Item
{
  // variables

  protected $id;
  protected $title;
  protected $title_short;
  protected $title_url;
  protected $description;
  protected $description_short;
  protected $canonical_url;
  protected $image;
  protected $consultant_id;
  protected $featured;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'blog';
  public const CATEGORY = 'openconsult\content\tag\category\Blog';
  public const FAVORITE = 'openconsult\content\tag\favorite\Blog';
  public const TOTAL = 'openconsult\content\total\Blog';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false, 'search' => false],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 200, 'search' => true],
    'title_short' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 100, 'max_display' => 80, 'search' => true],
    'title_url' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'min_length' => 2, 'max_length' => 200, 'max_display' => 80, 'search' => false],
    'description' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 100, 'search' => true],
    'description_short' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 10, 'max_length' => 200, 'search' => true],
    'canonical_url' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => false],
    'image' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => false],
    'consultant_id' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'search' => false],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'search' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true, 'search' => false],
    'updated_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true, 'search' => false],
    'category_id' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false, 'search' => false, 'filter' => true, 'filter_join' => self::CATEGORY::TABLE],
    'related_count' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true, 'search' => false]
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

    if (isset($column['title_short']))
    {
      $this->setTitleShort($column['title_short']);
    }

    //

    if (isset($column['description']))
    {
      $this->setDescription($column['description']);
    }

    //

    if (isset($column['description_short']))
    {
      $this->setDescriptionShort($column['description_short']);
    }

    //

    if (isset($column['image']))
    {
      $this->setImage($column['image']);
    }

    //

    if (isset($column['consultant_id']))
    {
      $this->setConsultantId($column['consultant_id']);
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

  public function getTitleShort(): string 
  {
    return Sanitize::noHTML(Sanitize::length($this->title_short, self::COLUMN['title_short']['max_display']));
  }

  //

  public function getTitleUrl(): string 
  {
    return Sanitize::noHTML(urlencode(Sanitize::length($this->title_url, self::COLUMN['title_url']['max_display'])));
  }

  //

  public function getDescription(): string 
  {
    return Sanitize::noHTML($this->description);
  }

  //

  public function getDescriptionShort(): string 
  {
    return Sanitize::noHTML(Sanitize::length($this->description_short, self::COLUMN['description_short']['max_display']));
  }

  //

  public function getCanonicalUrl(): string 
  {
    return Sanitize::noHTML($this->canonical_url);
  }

  //

  public function getConsultantId(): int 
  {
    return $this->consultant_id;
  }

  //

  public function getFeatured(): bool 
  {
    return Sanitize::getBoolean($this->featured);
  }

  //

  public function getCreatedDate(): string 
  {
    return Sanitize::noHTML($this->created_date);
  }

  //

  public function getUpdatedDate(): string 
  {
    return Sanitize::noHTML($this->updated_date);
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

  public function setTitle(string $title): void 
  {
    if (Validate::strLength($title, ['min' => self::COLUMN['title']['min_length'], 'max' => self::COLUMN['title']['max_length']]))
    {
      $this->title = $title;

      //

      if (!isset($this->title_short))
      {
        $this->setTitleUrl($title);
      }
    }
  }

  //

  public function setTitleShort(string $title_short): void 
  {
    if (Validate::strLength($title_short, ['min' => self::COLUMN['title_short']['min_length'], 'max' => self::COLUMN['title_short']['max_length']]))
    {
      $this->title_short = $title_short;
      $this->setTitleUrl($title_short);
    }
  }

  //

  private function setTitleUrl(string $title_url): void 
  {
    if (Validate::strLength($title_url, ['min' => self::COLUMN['title_url']['min_length'], 'max' => self::COLUMN['title_url']['max_length']]))
    {
      $this->title_url = Sanitize::slugify($title_url);

      //

      if (isset($this->id))
      {
        $this->setCanonicalUrl(Config::getInstance()->getSiteUrl() . self::TABLE . '/' . $this->id . '/' . $this->title_url);
      }
    }
  }

  //

  public function setDescription(string $description): void 
  {
    if (Validate::strLength($description, ['min' => self::COLUMN['description']['min_length']]))
    {
      $this->description = $description;
    }
  }

  //

  public function setDescriptionShort(string $description_short): void 
  {
    if (Validate::strLength($description_short, ['min' => self::COLUMN['description_short']['min_length'], 'max' => self::COLUMN['description_short']['max_length']]))
    {
      $this->description_short = $description_short;
    }
  }

  //

  private function setCanonicalUrl(string $canonical_url): void 
  {
    if (!filter_var($canonical_url, FILTER_VALIDATE_URL))
    {
      throw new \InvalidArgumentException('Canonical url is invalid: ' . $canonical_url);
    }
    else
    {
      $this->canonical_url = $canonical_url;
    }
  }

  //

  public function setImage(string $image): void 
  {
    $this->image = $image;
  }

  //

  public function setConsultantId(int $consultant_id): void 
  {
    if ($consultant_id > 0)
    {
      $this->consultant_id = $consultant_id;
    }
  }

  //

  public function setFeatured(bool $featured): void 
  {
    $this->featured = Sanitize::setBoolean($featured);
  }
}
