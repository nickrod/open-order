<?php

//

namespace openorder\content\item;

//

interface ItemInterface
{
  public function getCategory(\PDO $pdo, int $limit, int $offset);
  public function getFavorite(\PDO $pdo, int $limit, int $offset);
  public function getRelated(\PDO $pdo, array $category, int $limit, int $offset);
  public function addCategory(\PDO $pdo, array $category);
  public function addFavorite(\PDO $pdo, array $favorite);
  public function removeCategory(\PDO $pdo, array $category);
  public function removeFavorite(\PDO $pdo, array $favorite);
}
