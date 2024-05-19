<?php
namespace App\Helpers;

class Uri
{
  public static function get($type): string
  {
    return parse_url($_SERVER['REQUEST_URI'])[$type];
  }
}
