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

class UserAccount extends Item
{
  // variables

  protected $id;
  protected $email;
  protected $name;
  protected $name_url;
  protected $phone;
  protected $password;
  protected $pubkey;
  protected $account_id;
  protected $min_order_price;
  protected $max_order_price;
  protected $admin = 0;
  protected $registered = 0;
  protected $enabled = 1;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'user_account';
  public const TABLE_KEY = 'id';
  public const TABLE_SEQ = 'user_account_id_seq';
  public const CATEGORY = 'openorder\content\tag\category\UserAccount';
  public const FAVORITE = 'openorder\content\tag\favorite\UserAccount';
  public const STORE = 'openorder\content\tag\store\UserAccount';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'email' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'name' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true, 'search' => true],
    'name_url' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'phone' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'password' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'pubkey' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'account_id' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'min_order_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'max_order_price' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'admin' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false],
    'registered' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'enabled' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'updated_date' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => true],
    'user_account' . '__' . 'id' => ['key' => false, 'index' => true, 'index_not' => true, 'allowed' => false, 'order_by' => false],
    'user_account_category' . '__' . 'category_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'filter' => true],
    'user_account_favorite' . '__' . 'favorite_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'filter' => true],
    'user_account_store' . '__' . 'store_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'filter' => true],
    'user_account_category' . '__' . 'user_account_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'user_account_favorite' . '__' . 'user_account_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true],
    'user_account_store' . '__' . 'user_account_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'join' => true]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['id']))
    {
      $this->setId($column['id']);
    }

    //

    if (isset($column['email']))
    {
      $this->setEmail($column['email']);
    }

    //

    if (isset($column['name']))
    {
      $this->setName($column['name']);
    }

    //

    if (isset($column['phone']))
    {
      $this->setPhone($column['phone']);
    }

    //

    if (isset($column['password']))
    {
      $this->setPassword($column['password']);
    }

    //

    if (isset($column['pubkey']))
    {
      $this->setPubkey($column['pubkey']);
    }

    //

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }

    //

    if (isset($column['min_order_price']))
    {
      $this->setMinOrderPrice($column['min_order_price']);
    }

    //

    if (isset($column['max_order_price']))
    {
      $this->setMaxOrderPrice($column['max_order_price']);
    }

    //

    if (isset($column['admin']))
    {
      $this->setAdmin($column['admin']);
    }

    //

    if (isset($column['registered']))
    {
      $this->setRegistered($column['registered']);
    }

    //

    if (isset($column['enabled']))
    {
      $this->setEnabled($column['enabled']);
    }
  }

  // getters

  public function getId(): int 
  {
    return $this->id;
  }

  //

  public function getEmail(): string 
  {
    return Sanitize::noHTML($this->email);
  }

  //

  public function getName(): string 
  {
    return Sanitize::noHTML($this->name);
  }

  //

  public function getNameUrl(): string 
  {
    return Sanitize::noHTML(urlencode($this->name_url));
  }

  //

  public function getPhone(): ?string 
  {
    return (is_null($this->phone)) ? null : Sanitize::noHTML($this->phone);
  }

  //

  public function getPassword(): ?string 
  {
    return $this->password;
  }

  //

  public function getPubkey(): ?string 
  {
    return $this->pubkey;
  }

  //

  public function getAccountId(): ?int 
  {
    return $this->account_id;
  }

  //

  public function getMinOrderPrice(): ?int 
  {
    return $this->min_order_price;
  }

  //

  public function getMaxOrderPrice(): ?int 
  {
    return $this->max_order_price;
  }

  //

  public function getAdmin(): bool 
  {
    return $this->admin;
  }

  //

  public function getRegistered(): bool 
  {
    return $this->registered;
  }

  //

  public function getEnabled(): bool 
  {
    return $this->enabled;
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

  public function getStore(\PDO $pdo, int $limit = 10, int $offset = 0): ?array
  {
    if (isset($this->id))
    {
      return $store = &Store::getList($pdo, ['index' => [(self::STORE)::TABLE . '__' . self::TABLE . '_id' => $this->id], 'join' => [(self::STORE)::TABLE . '__' . 'store_id' => 'INNER'], 'limit' => $limit, 'offset' => $offset]);
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

  public function setEmail(string $email): void 
  {
    if (Validate::strLength($email, 1, 100))
    {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        throw new \InvalidArgumentException('Email is invalid: ' . $email);
      }
      else
      {
        $this->email = $email;
      }
    }
  }

  //

  public function setName(string $name): void 
  {
    if (Validate::strLength($name, 1, 60))
    {
      $this->name = $name;
      $this->setNameUrl($name);
    }
  }

  //

  private function setNameUrl(string $name_url): void 
  {
    if (Validate::strLength($name_url, 1, 70))
    {
      $this->name_url = Sanitize::slugify($name_url);
    }
  }

  //

  public function setPhone(?string $phone): void 
  {
    if (is_null($phone) || Validate::strLength($phone, 1, 60))
    {
      $this->phone = $phone;
    }
  }

  //

  public function setPassword(?string $password): void 
  {
    if (is_null($password) || Validate::strLength($password, 1, 100))
    {
      $this->password = $password;
    }
  }

  //

  public function setPubkey(?string $pubkey): void 
  {
    if (is_null($pubkey) || Validate::strLength($pubkey, 1, 100))
    {
      $this->pubkey = $pubkey;
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

  public function setMinOrderPrice(?float $min_order_price): void 
  {
    $this->min_order_price = (is_null($min_order_price) || !Validate::intLength(Sanitize::setFloat($min_order_price), 1)) ? null : Sanitize::setFloat($min_order_price);
  }

  //

  public function setMaxOrderPrice(?float $max_order_price): void 
  {
    $this->max_order_price = (is_null($max_order_price) || !Validate::intLength(Sanitize::setFloat($max_order_price), 1)) ? null : Sanitize::setFloat($max_order_price);
  }

  //

  public function setAdmin(bool $admin): void 
  {
    $this->admin = Sanitize::setBoolean($admin);
  }

  //

  public function setRegistered(bool $registered): void 
  {
    $this->registered = Sanitize::setBoolean($registered);
  }

  //

  public function setEnabled(bool $enabled): void 
  {
    $this->enabled = Sanitize::setBoolean($enabled);
  }

  // add

  public function addStore(\PDO $pdo, array $store = []): void
  {
    if (isset($this->id))
    {
      foreach (array_unique($store) as $store_id)
      {
        if (is_int($store_id) && Validate::intLength($store_id, 1))
        {
          $store_object = Store::getObject($pdo, ['index' => ['store_id' => $store_id]]);
          $user_account = self::STORE;

          //

          if (!isset($store_object))
          {
            throw new \InvalidArgumentException('Store id does not exist: ' . $store_id);
          }
          else
          {
            (new $user_account([self::TABLE . '_id' => $this->id, 'store_id' => $store_object->getId()]))->save($pdo);
          }
        }
      }
    }
  }

  // remove

  public function removeStore(\PDO $pdo, array $store = []): void
  {
    if (isset($this->id))
    {
      foreach (array_unique($store) as $store_id)
      {
        if (is_int($store_id) && Validate::intLength($store_id, 1))
        {
          $store_object = Store::getObject($pdo, ['index' => ['store_id' => $store_id]]);
          $user_account = self::STORE;

          //

          if (!isset($store_object))
          {
            throw new \InvalidArgumentException('Store id does not exist: ' . $store_id);
          }
          else
          {
            (new $user_account([self::TABLE . '_id' => $this->id, 'store_id' => $store_object->getId()]))->remove($pdo);
          }
        }
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
      return $return_object->getTotalUserAccount();
    }
  }
}
