<?php

namespace App\Controllers;

use League\Plates\Engine;

abstract class Controller
{

  public function view(string $view, array $data = [])
  {
    $pathViews = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR;
    $templates = new Engine($pathViews);

    echo $templates->render($view, ['name' => 'Jose']);
  }
}
