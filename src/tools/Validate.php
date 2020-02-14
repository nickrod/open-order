<?php

//

declare(strict_types=1);

//

namespace openorder\tools;

//

class Validate
{
  public static function verifyPassword(string $password, string $hash): bool
  {
    return password_verify($password, $hash);
  }

  //

  public static function intLength(int $length, int $min = 0, int $max = 0): bool
  {
    if ($length < $min)
    {
      throw new \RangeException('Integer length must be greater than ' . $min . ':' . $length);
    }
    elseif ($max > 0 && $length > $max)
    {
      throw new \RangeException('Integer length must be less than ' . $max . ':' . $length);
    }
    else
    {
      return true;
    }
  }

  //

  public static function strLength(string $str, int $min = 0, int $max = 0): bool
  {
    $length = mb_strlen($str);

    //

    if ($length < $min)
    {
      throw new \RangeException('String length must be greater than ' . $min . ':' . $length);
    }
    elseif ($max > 0 && $length > $max)
    {
      throw new \RangeException('String length must be less than ' . $max . ':' . $length);
    }
    else
    {
      return true;
    }
  }
}
