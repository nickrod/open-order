<?php

//

declare(strict_types=1);

//

namespace openorder\account;

//

use openorder\base\Table;
use openorder\tools\Sanitize;

//

class UserAccountActive extends Table
{
  // variables

  protected $account_id;
  protected $chat_online;
  protected $site_online;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'user_account_active';

  //

  public const COLUMN = [
    'account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'chat_online' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'site_online' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'updated_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }

    //

    if (isset($column['chat_online']))
    {
      $this->setChatOnline($column['chat_online']);
    }

    //

    if (isset($column['site_online']))
    {
      $this->setSiteOnline($column['site_online']);
    }
  }

  // getters

  public function getAccountId(): int 
  {
    return $this->account_id;
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

  public function setAccountId(int $account_id): void 
  {
    if ($account_id > 0)
    {
      $this->account_id = $account_id;
    }
  }

  //

  public function setChatOnline(bool $chat_online): void 
  {
    $this->chat_online = Sanitize::setBoolean($chat_online);
  }

  //

  public function setSiteOnline(bool $site_online): void 
  {
    $this->site_online = Sanitize::setBoolean($site_online);
  }
}
