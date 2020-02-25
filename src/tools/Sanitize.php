<?php

//

declare(strict_types=1);

//

namespace openorder\tools;

//

use openorder\exceptions\SanitizeException;

//

class Sanitize
{
  public static function base64EncodeUrl(string $str = ''): string
  {
    return strtr(base64_encode($str), ['+' => '-', '/' => '_', '=' => '']);
  }

  //

  public static function base64DecodeUrl(string $str = ''): string
  {
    return base64_decode(strtr($str, ['-' => '+', '_' => '/']));
  }

  //

  public static function getRandomString(int $length = 10): string
  {
    return bin2hex(random_bytes($length));
  }

  //

  public static function noHTML(string $str = ''): string
  {
    return htmlentities($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
  }

  //

  public static function getBoolean(string $pg_boolean = ''): bool
  {
    return ($pg_boolean === 't');
  }

  //

  public static function setBoolean(bool $boolean): string
  {
    return ($boolean ? 't' : 'f');
  }

  //

  public static function arrayToInt(array &$arr): string
  {
    $str = '';
    $key_count = 0;

    //

    foreach ($arr as $key => $value)
    {
      $int_val = (int) $value;

      //

      if ($int_val > 0)
      {
        $str .= (($key_count === 0) ? '' : ', ') . $int_val;
        $key_count++;
      }
    }

    //

    return $str;
  }

  //

  public static function slugify(string $str): string
  {
    $str = transliterator_transliterate("Any-Latin; Latin-ASCII; [\u0080-\u7fff] Remove; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $str);
    $str = preg_replace('/[-\s]+/', '-', $str);
    $str = trim($str, '-');

    //

    return $str;
  }

  //

  public static function length(string $str, int $limit): string
  {
    return mb_substr($str, 0, $limit);
  }

  //

  public static function escapeSearch(string $str): string
  {
    return strtr($str, ['_' => '\_', '%' => '\%', '\\' => '\\\\']);
  }

  //

  public static function column(array &$type, array &$column, array &$column_value): array
  {
    $arr = [];
    $key_count = $index_count = $allowed_insert_count = $allowed_edit_count = $search_count = $filter_count = $order_by_count = 0;

    //

    foreach ($column_value as $key => &$value)
    {
      foreach ($type as $type_value)
      {
        if (!isset($column[$key]))
        {
          throw new SanitizeException('Column key not found: ' . $key);
        }
        elseif (!isset($column[$key][$type_value]))
        {
          throw new SanitizeException('Column type not found: ' . $type_value);
        }
        elseif ($column[$key][$type_value] !== true)
        {
          continue;
        }
        elseif (!isset($value))
        {
          continue;
        }
        else
        {
          if ($type_value === 'key')
          {
            $arr[$type_value] .= (($key_count === 0) ? '' : ' AND ') . $key . ' = :' . $key;
            $key_count++;
          }
          elseif ($type_value === 'index' || $type_value === 'index_not')
          {
            if ($type_value === 'index_not' && isset($column_value['index'][$key]))
            {
              continue;
            }
            else
            {
              $arr['index'] .= (($index_count === 0) ? '' : ' AND ') . $key . ' ' . (($type_value === 'index_not') ? '!' : '') . '= :' . $key;
              $index_count++;
            }
          }
          elseif ($type_value === 'allowed')
          {
            if (is_string($value) && trim($value) === '')
            {
              $value = null;
            }

            //

            if ($column[$key]['key'] !== true)
            {
              $arr[$type_value] .= (($allowed_edit_count === 0) ? '' : ', ') . $key . ' = :' . $key;
              $allowed_edit_count++;
            }

            //

            $arr['allowed_keys'] .= (($allowed_insert_count === 0) ? '' : ', ') . $key;
            $arr['allowed_values'] .= (($allowed_insert_count === 0) ? '' : ', ') . ':' . $key;
            $allowed_insert_count++;
          }
          elseif ($type_value === 'search')
          {
            if (is_string($value) && trim($value) !== '')
            {
              $value = self::escapeSearch($value) . '%';
              $arr[$type_value] .= (($search_count === 0) ? '' : ' OR ') . $key . ' LIKE = :' . $key;
              $search_count++;
            }
          }
          elseif ($type_value === 'filter')
          {
            if (is_array($value))
            {
              if (isset($column[$key]['filter_join']))
              {
                $arr['filter_from'] .= ' INNER JOIN ' . $column[$key]['filter_join'] . ' ON ' . $key . ' = ' . $column[$key]['filter_join'] . '.' . key;
              }

              //

              $in_val = self::arrayToInt($value);
              $arr[$type_value] .= (($filter_count === 0) ? '' : ' AND ') . $key . ' IN (' . (($in_val !== '') ? $in_val : '0') . ')';
              $filter_count++;
            }
          }
          elseif ($type_value === 'order_by')
          {
            if (is_string($value) && (strtoupper($value) === 'ASC' || strtoupper($value) === 'DESC'))
            {
              $arr[$type_value] .= (($order_by_count === 0) ? '' : ', ') . $key . ' ' . $value;
              $order_by_count++;
            }
          }
          else
          {
            continue;
          }
        }
      }
    }

    //

    return $arr;
  }
}
