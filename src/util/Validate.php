<?php

//

declare(strict_types=1);

//

namespace openorder\util;

//

class Validate
{
  public static function intLength(int $length, int $min = 0, int $max = 0): bool
  {
    if ($length < $min)
    {
      throw new \RangeException('Length must be greater than ' . $min . ': ' . $length);
    }
    elseif ($max > 0 && $length > $max)
    {
      throw new \RangeException('Length must be less than ' . $max . ': ' . $length);
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
      throw new \RangeException('String must be greater than ' . $min . ': ' . $length);
    }
    elseif ($max > 0 && $length > $max)
    {
      throw new \RangeException('String must be less than ' . $max . ': ' . $length);
    }
    else
    {
      return true;
    }
  }

  //

  public static function isDate(string $date): bool
  {
    if (!preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/', $date))
    {
      throw new \InvalidArgumentException('Date format (e.g. 2010-03-04) is invalid: ' . $date);
    }
    else
    {
      $timestamp = strtotime($date);

      //

      if ($timestamp === false)
      {
        throw new \InvalidArgumentException('Date is invalid: ' . $date);
      }
      else
      {
        return true;
      }
    }
  }
}
