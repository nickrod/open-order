<?php

//

declare(strict_types=1);

//

namespace openorder\content\total;

//

use openorder\base\Table;

//

class Account extends Table
{
  // variables

  protected $account_id;
  protected $total_blog_favorites;
  protected $total_consultant_favorites;
  protected $total_gig_favorites;
  protected $total_service_favorites;
  protected $total_service_partners;
  protected $total_blogs;
  protected $total_gigs;
  protected $total_services;

  // constants

  public const TABLE = 'account_total';

  //

  public const COLUMN = [
    'account_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_blog_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_consultant_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_gig_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_service_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_service_partners' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_blogs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_gigs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_services' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // getters

  public function getAccountId(): int 
  {
    return $this->account_id;
  }

  //

  public function getTotalBlogFavorites(): int 
  {
    return $this->total_blog_favorites;
  }

  //

  public function getTotalConsultantFavorites(): int 
  {
    return $this->total_consultant_favorites;
  }

  //

  public function getTotalGigFavorites(): int 
  {
    return $this->total_gig_favorites;
  }

  //

  public function getTotalServiceFavorites(): int 
  {
    return $this->total_service_favorites;
  }

  //

  public function getTotalServicePartners(): int 
  {
    return $this->total_service_partners;
  }

  //

  public function getTotalBlogs(): int 
  {
    return $this->total_blogs;
  }

  //

  public function getTotalGigs(): int 
  {
    return $this->total_gigs;
  }

  //

  public function getTotalServices(): int 
  {
    return $this->total_services;
  }
}
