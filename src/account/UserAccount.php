<?php 

//

declare(strict_types=1);

//

namespace openorder\account;

//

use openorder\base\Table;
use openorder\tools\Validate;
use openorder\tools\Sanitize;

//

class UserAccount extends Table
{
  // variables

  protected $id;
  protected $email;
  protected $nickname;
  protected $username;
  protected $password;
  protected $pubkey;
  protected $admin;
  protected $enabled;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'user_account';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'email' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 3, 'max_length' => 100],
    'nickname' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 3, 'max_length' => 30],
    'username' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 3, 'max_length' => 12],
    'password' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 8, 'max_length' => 1000],
    'pubkey' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 1],
    'admin' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'enabled' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
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

    if (isset($column['email']))
    {
      $this->setEmail($column['email']);
    }

    //

    if (isset($column['nickname']))
    {
      $this->setNickname($column['nickname']);
    }

    //

    if (isset($column['username']))
    {
      $this->setUsername($column['username']);
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

    if (isset($column['admin']))
    {
      $this->setAdmin($column['admin']);
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
    return $this->email;
  }

  //

  public function getNickname(): string 
  {
    return Sanitize::noHTML($this->nickname);
  }

  //

  public function getUsername(): string 
  {
    return Sanitize::noHTML(urlencode($this->username));
  }

  //

  public function getPassword(): string 
  {
    return $this->password;
  }

  //

  public function getPubkey(): string 
  {
    return $this->pubkey;
  }

  //

  public function getAdmin(): bool 
  {
    return Sanitize::getBoolean($this->admin);
  }

  //

  public function getEnabled(): bool 
  {
    return Sanitize::getBoolean($this->enabled);
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

  public function setEmail(string $email): void 
  {
    if (Validate::strLength($email, self::COLUMN['email']['min_length'], self::COLUMN['email']['max_length']))
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

  public function setNickname(string $nickname): void 
  {
    if (Validate::strLength($nickname, self::COLUMN['nickname']['min_length'], self::COLUMN['nickname']['max_length']))
    {
      $this->nickname = $nickname;
    }
  }

  //

  public function setUsername(string $username): void 
  {
    if (Validate::strLength($username, self::COLUMN['username']['min_length'], self::COLUMN['username']['max_length']))
    {
      $this->username = Sanitize::slugify($username);
    }
  }

  //

  public function setPassword(string $password): void 
  {
    if (Validate::strLength($password, self::COLUMN['password']['min_length'], self::COLUMN['password']['max_length']))
    {
      $this->password = $password;
    }
  }

  //

  public function setPubkey(string $pubkey): void 
  {
    if (Validate::strLength($pubkey, self::COLUMN['pubkey']['min_length']))
    {
      $this->pubkey = $pubkey;
    }
  }

  //

  public function setAdmin(bool $admin): void 
  {
    $this->admin = Sanitize::setBoolean($admin);
  }

  //

  public function setEnabled(bool $enabled): void 
  {
    $this->enabled = Sanitize::setBoolean($enabled);
  }
}
