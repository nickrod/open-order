<?php

//

declare(strict_types=1);

//

namespace openorder\tools;

//

class Ajax
{
  public static function noHTML(string $str): string
  {
    return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
  }
}
