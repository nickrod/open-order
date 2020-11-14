<?php

//

declare(strict_types=1);

//

namespace openorder\content\item;

//

use openorder\database\SimpleDb;
use openorder\content\group\Category;

//

class Item extends SimpleDb implements ItemInterface
{
  public function getCategory(\PDO $pdo, int $limit = 10, int $offset = 0): ?array
  {
    if (isset($this->id))
    {
      return $category = &Category::getList($pdo, ['index' => [($this::CATEGORY)::TABLE . '__' . $this::TABLE . '_id' => $this->id], 'join' => [($this::CATEGORY)::TABLE . '__' . 'category_id' => 'INNER'], 'limit' => $limit, 'offset' => $offset]);
    }
    else
    {
      return null;
    }
  }

  //

  public function getFavorite(\PDO $pdo, int $limit = 10, int $offset = 0): ?array
  {
    if (isset($this->id))
    {
      return $favorite = &UserAccount::getList($pdo, ['index' => [($this::FAVORITE)::TABLE . '__' . $this::TABLE . '_id' => $this->id], 'join' => [($this::FAVORITE)::TABLE . '__' . 'favorite_id' => 'INNER'], 'limit' => $limit, 'offset' => $offset]);
    }
    else
    {
      return null;
    }
  }

  //

  public function getRelated(\PDO $pdo, array $category = [], int $limit = 5, int $offset = 0): ?array
  {
    if (isset($this->id))
    {
      return $category = &$this::getList($pdo, ['index' => [($this::CATEGORY)::TABLE . '__' . $this::TABLE . '_id' => $this->id], 'index_not' => ['id' => $this->id], 'distinct' => true, 'filter' => [($this::CATEGORY)::TABLE . '__' . 'category_id' => $category], 'join' => [($this::CATEGORY)::TABLE . '__' . 'category_id' => 'INNER'], 'limit' => $limit, 'offset' => $offset]);
    }
    else
    {
      return null;
    }
  }

  // add tags

  public function addCategory(\PDO $pdo, array $category = []): void
  {
    if (isset($this->id))
    {
      $category_object = $this::CATEGORY;

      //

      foreach (array_unique($category) as $category_id)
      {
        (new $category_object([$this::TABLE . '_id' => $this->id, 'category_id' => $category_id]))->save($pdo);
      }
    }
  }

  //

  public function addFavorite(\PDO $pdo, array $favorite = []): void
  {
    if (isset($this->id))
    {
      $favorite_object = $this::FAVORITE;

      //

      foreach (array_unique($favorite) as $favorite_id)
      {
        (new $favorite_object([$this::TABLE . '_id' => $this->id, 'favorite_id' => $favorite_id]))->save($pdo);
      }
    }
  }

  // remove tags

  public function removeCategory(\PDO $pdo, array $category = []): void
  {
    if (isset($this->id))
    {
      $category_object = $this::CATEGORY;

      //

      foreach (array_unique($category) as $category_id)
      {
        (new $category_object([$this::TABLE . '_id' => $this->id, 'category_id' => $category_id]))->remove($pdo);
      }
    }
  }

  //

  public function removeFavorite(\PDO $pdo, array $favorite = []): void
  {
    if (isset($this->id))
    {
      $favorite_object = $this::FAVORITE;

      //

      foreach (array_unique($favorite) as $favorite_id)
      {
        (new $favorite_object([$this::TABLE . '_id' => $this->id, 'favorite_id' => $favorite_id]))->remove($pdo);
      }
    }
  }

  //

  public static function getCount(\PDO $pdo, array $option = []): int
  {
    return ($option !== []) ? (static::class)::total($pdo, $option) : (static::class)::getTotal($pdo);
  }
}
