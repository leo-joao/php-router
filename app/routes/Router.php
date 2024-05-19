<?php
namespace App\Routes;

use App\Helpers\Request;
use App\Helpers\Uri;

class Router
{

  const CONTROLLER_NAMESPACE = 'App\\Controllers';

  public static function load(string $controller, string $method)
  {

    try {

      $controllerNamespace = self::CONTROLLER_NAMESPACE . '\\' . $controller;
      if (!class_exists($controllerNamespace)) {
        throw new \Exception("O Controller {$controller} não existe.");
      }

      $controllerInstance = $controllerNamespace;

      if (!method_exists($controllerInstance, $method)) {
        throw new \Exception("O Método {$method} não existe no Controller {$controller}.");
      }

    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }


  public static function routes(): array
  {
    return [
      'get' => [
        '/' => fn() => self::load('HomeController', 'index'),
        '/contact' => fn() => self::load('ContactController', 'store'),
      ],
      'post' => [
        '/contact' => fn() => self::load('ContactController', 'store'),
      ],
      'put' => [
        '/product' => fn() => self::load('ContactController', 'update'),
      ],
      'delete' => [

      ],
    ];
  }

  public static function execute()
  {
    try {
      $routes = self::routes();
      $request = Request::get();
      $uri = Uri::get('path');

      if (!isset($routes[$request])) {
        throw new \Exception("A rota não existe.");
      }

      if (!array_key_exists($uri, $routes[$request])) {
        throw new \Exception("A rota não existe.");
      }

      $router = $routes[$request][$uri];

      if (!is_callable($router)) {
        throw new \Exception("A rota não existe.");
      }

      $router();
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }
}
