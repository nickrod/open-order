<?php

//

declare(strict_types=1);

//

namespace openorder\content\item;

//

use openorder\account\Account;
use openorder\tools\Sanitize;
use openorder\content\group\Category;
use openorder\content\group\Location;
use openorder\content\group\Currency;
use openorder\base\Table;

//

class Item extends Table implements ItemInterface
{
  // variables

  protected $account_id;
  protected $consultant_title;
  protected $consultant_url;
  protected $image_thumb;
  protected $username;
  protected $chat_online;
  protected $site_online;

  //

  public const COLUMN = [
    'account_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'consultant_title' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => true, 'max_display' => 200, 'search' => true],
    'consultant_url' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'max_display' => 100, 'search' => false],
    'image_thumb' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'search' => false],
    'username' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'search' => true],
    'chat_online' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'search' => false],
    'site_online' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'search' => false]
  ];

  // getters

  public function getAccountId(): int
  {
    return $this->account_id;
  }

  //

  public function getConsultantTitle(): string
  {
    return Sanitize::noHTML($this->consultant_title);
  }

  //

  public function getConsultantUrl(): string
  {
    return Sanitize::noHTML(urlencode(Sanitize::length($this->consultant_url, self::COLUMN['title_url']['max_display'])));
  }

  //

  public function getImageThumb(): string
  {
    return Sanitize::noHTML(urlencode($this->image_thumb));
  }

  //

  public function getUsername(): string
  {
    return Sanitize::noHTML(urlencode($this->username));
  }

  //

  public function getChatOnline(): bool
  {
    return Sanitize::getBoolean($this->chat_online);
  }

  //

  public function getSiteOnline(): bool
  {
    return Sanitize::getBoolean($this->site_online);
  }

  //

  public function getCategory(int $limit = 10, int $offset = 0): array
  {
    if (isset($this->id) && isset($this::CATEGORY))
    {
      return Category::getList(['index' => [$this::TABLE . '_id' => $this->id], 'column' => $this::CATEGORY::COLUMN, 'limit' => $limit, 'offset' => $offset, 'from' => 'category INNER JOIN ' . $this::CATEGORY::TABLE . ' ON category.id = ' . $this::CATEGORY::TABLE . '.category_id']);
    }
    else
    {
      return null;
    }
  }

  //

  public function getLocation(int $limit = 10, int $offset = 0): array
  {
    if (isset($this->id) && isset($this::LOCATION))
    {
      return Location::getList(['index' => [$this::TABLE . '_id' => $this->id], 'column' => $this::LOCATION::COLUMN, 'limit' => $limit, 'offset' => $offset, 'from' => 'location INNER JOIN ' . $this::LOCATION::TABLE . ' ON location.id = ' . $this::LOCATION::TABLE . '.location_id']);
    }
    else
    {
      return null;
    }
  }

  //

  public function getCurrency(int $limit = 10, int $offset = 0): array
  {
    if (isset($this->id) && isset($this::CURRENCY))
    {
      return Currency::getList(['index' => [$this::TABLE . '_id' => $this->id], 'column' => $this::CURRENCY::COLUMN, 'limit' => $limit, 'offset' => $offset, 'from' => 'account INNER JOIN ' . $this::CURRENCY::TABLE . ' ON currency.id = ' . $this::CURRENCY::TABLE . '.currency_id']);
    }
    else
    {
      return null;
    }
  }

  //

  public function getFavorite(int $limit = 10, int $offset = 0): array
  {
    if (isset($this->id) && isset($this::FAVORITE))
    {
      return Account::getList(['index' => [$this::TABLE . '_id' => $this->id], 'column' => $this::FAVORITE::COLUMN, 'limit' => $limit, 'offset' => $offset, 'from' => 'account INNER JOIN ' . $this::FAVORITE::TABLE . ' ON account.id = ' . $this::FAVORITE::TABLE . '.account_id']);
    }
    else
    {
      return null;
    }
  }

  //

  public function getTotal(): object
  {
    if (isset($this->id) && isset($this::TOTAL))
    {
      return $this::TOTAL::getObject(['index' => [$this::TABLE . '_id' => $this->id]]);
    }
    else
    {
      return null;
    }
  }

  //

  public function getRelated(int $limit = 5, int $offset = 0): array
  {
    if (isset($this->id) && isset($this::CATEGORY))
    {
      return $this::getList(['order_by' => ['related_count' => 'DESC'], 'limit' => $limit, 'offset' => $offset, 'from' => $this::TABLE . ' INNER JOIN (SELECT COUNT(' . $this::CATEGORY::TABLE . '.' . $this::TABLE . '_id) AS related_count, ' . $this::CATEGORY::TABLE . '.' . $this::TABLE . '_id FROM ' . $this::CATEGORY::TABLE . ' related INNER JOIN ' . $this::CATEGORY::TABLE . ' related_inner ON related.category_id = related_inner.category_id AND related.' . $this::TABLE . '_id != related_inner.' . $this::TABLE . '_id WHERE related_inner.' . $this::TABLE . '_id = ' . $this->getId() . ' GROUP BY related.' . $this::TABLE . '_id ORDER BY related_count DESC) related_outer ON ' . $this::TABLE . '.id = related_outer.' . $this::TABLE . '_id']);
    }
    else
    {
      return null;
    }
  }

  //

  public function getNearby(int $limit = 5, int $offset = 0, int $radius = 100): array
  {
    if (isset($this->id) && isset($this::LOCATION))
    {
      return $this::getList(['index' => [$this::TABLE . '_id' => $this->id], 'column' => $this::LOCATION::COLUMN, 'from' => ' INNER JOIN (SELECT id, calc_dist() AS distance FROM city HAVING distance < ' . $radius . ' ORDER BY distance) AS match ON ']);
    }
    else
    {
      return null;
    }
  }

  // add tags

  public function addCategory(array $category = []): void
  {
    if (isset($this->id) && isset($this::CATEGORY))
    {
      foreach (array_unique($category) as $category_id)
      {
        if (is_string($category_id))
        {
          if (!Category::exists(['index' => ['title' => $category_id]]))
          {
            $cat = new Category(['title' => $category_id]);
            $cat->save();
            $category_id = $cat->getId();
          }
          else
          {
            $category_id = null;
          }
        }

        //

        if (isset($category_id))
        {
          (new $this::CATEGORY::TABLE([$this::TABLE . '_id' => $this->id, 'category_id' => $category_id]))->save();
        }
      }
    }
  }

  //

  public function addLocation(array $location = []): void
  {
    if (isset($this->id) && isset($this::LOCATION))
    {
      foreach (array_unique($location) as $location_id)
      {
        (new $this::LOCATION::TABLE([$this::TABLE . '_id' => $this->id, 'location_id' => $location_id]))->save();
      }
    }
  }

  //

  public function addCurrency(array $currency = []): void
  {
    if (isset($this->id) && isset($this::CURRENCY))
    {
      foreach (array_unique($currency) as $currency_id)
      {
        (new $this::CURRENCY::TABLE([$this::TABLE . '_id' => $this->id, 'currency_id' => $currency_id]))->save();
      }
    }
  }

  //

  public function addFavorite(array $favorite = []): void
  {
    if (isset($this->id) && isset($this::FAVORITE))
    {
      foreach (array_unique($favorite) as $account_id)
      {
        (new $this::FAVORITE::TABLE([$this::TABLE . '_id' => $this->id, 'account_id' => $account_id]))->save();
      }
    }
  }

  // remove tags

  public function removeCategory(array $category = []): void
  {
    if (isset($this->id) && isset($this::CATEGORY))
    {
      foreach (array_unique($category) as $category_id)
      {
        (new $this::CATEGORY::TABLE([$this::TABLE . '_id' => $this->id, 'category_id' => $category_id]))->remove();
      }
    }
  }

  //

  public function removeLocation(array $location = []): void
  {
    if (isset($this->id) && isset($this::LOCATION))
    {
      foreach (array_unique($location) as $location_id)
      {
        (new $this::LOCATION::TABLE([$this::TABLE . '_id' => $this->id, 'location_id' => $location_id]))->remove();
      }
    }
  }

  //

  public function removeCurrency(array $currency = []): void
  {
    if (isset($this->id) && isset($this::CURRENCY))
    {
      foreach (array_unique($currency) as $currency_id)
      {
        (new $this::CURRENCY::TABLE([$this::TABLE . '_id' => $this->id, 'currency_id' => $currency_id]))->remove();
      }
    }
  }

  //

  public function removeFavorite(array $favorite = []): void
  {
    if (isset($this->id) && isset($this::FAVORITE))
    {
      foreach (array_unique($favorite) as $account_id)
      {
        (new $this::FAVORITE::TABLE([$this::TABLE . '_id' => $this->id, 'account_id' => $account_id]))->remove();
      }
    }
  }
}
