<?php

//

namespace openorder\content\item;

//

interface ItemInterface
{
  public function getAccountId();
  public function getConsultantTitle();
  public function getConsultantUrl();
  public function getImageThumb();
  public function getUsername();
  public function getChatOnline();
  public function getSiteOnline();
  public function getCategory();
  public function getLocation();
  public function getCurrency();
  public function getFavorite();
  public function getTotal();
  public function getRelated($limit, $offset);
  public function getNearby($limit, $offset, $radius);
  public function addCategory($category);
  public function addLocation($location);
  public function addCurrency($currency);
  public function addFavorite($favorite);
  public function removeCategory($category);
  public function removeLocation($location);
  public function removeCurrency($currency);
  public function removeFavorite($favorite);
}
