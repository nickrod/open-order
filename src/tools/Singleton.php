<?php

//

namespace openorder\tools;

//

class Singleton
{
  public static function getInstance()
  {
    static $instance = false;

    //

    if ($instance === false)
    {
      $instance = new static();
    }

    //

    return $instance;
  }

  // don't allow these to be called

  private function __construct() {}
  private function __clone() {}
  private function __sleep() {}
  private function __wakeup() {}
}
