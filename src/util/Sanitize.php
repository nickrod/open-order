<?php

//

declare(strict_types=1);

//

namespace openorder\util;

//

class Sanitize
{
  public static function base64EncodeUrl(string $str): string
  {
    return strtr(base64_encode($str), ['+' => '-', '/' => '_', '=' => '']);
  }

  //

  public static function base64DecodeUrl(string $str): string
  {
    return base64_decode(strtr($str, ['-' => '+', '_' => '/']));
  }

  //

  public static function getRandomString(int $length = 10): string
  {
    return bin2hex(random_bytes($length));
  }

  //

  public static function noHTML(string $str): string
  {
    return htmlentities($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
  }

  //

  public static function getFloat(int $float): float
  {
    return (float) ($float / 100);
  }

  //

  public static function setFloat(float $float): int
  {
    return (int) (round($float, 2) * 100);
  }

  //

  public static function setBoolean(bool $boolean): int
  {
    return (int) $boolean;
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

  public static function setExportOutput(string $file, array &$data): void
  {
    header('Cache-Control: max-age=0, no-cache, must-revalidate');
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=' . $file);

    //

    $df = fopen('php://output', 'w');

    //

    fputcsv($df, array_keys(reset($data)));

    //

    foreach ($data as $row)
    {
      fputcsv($df, $row);
    }

    //

    fclose($df);
  }
}
