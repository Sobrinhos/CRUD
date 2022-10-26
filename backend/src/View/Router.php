<?php

declare(strict_types=1);

namespace Youtube\Crud\View;

use Exception;
use PDOException;
use Youtube\Crud\Utils\ReturnErrorREST;

class Router
{
    public $routes = array();

    public function __construct()
    {
        try {
            $this->addNewRoute("subscribe", "POST", "lead");
            $this->addNewRoute("login", "POST", "user");
            $this->getRequestRoute();
        } catch (Exception $error) {
            file_put_contents("E:/Projetos/youtube/CRUD/debug.txt", print_r($error, true) . "\n", FILE_APPEND);
            $returnError = new ReturnErrorREST($error);
            $returnError->send();
        } catch (PDOException $error) {
            file_put_contents("E:/Projetos/youtube/CRUD/debug_database.txt", print_r($error, true) . "\n", FILE_APPEND);
            $returnError = new ReturnErrorREST($error);
            $returnError->send();
        }
    }

    private function addNewRoute($route, $method, $resouce)
    {
        $route = array(
          "route" => $route,
          "method" => $method,
          "resouce" => $resouce
        );
        array_push($this->routes, $route);
    }

    private function getRequestRoute()
    {
      // var_dump($_SERVER);
        $arrayStringURL = explode("/", $_SERVER['REQUEST_URI']);
        $method = $_SERVER['REQUEST_METHOD'];

        $notFound = true;
        $namespace = "Youtube\Crud\Controller";
        foreach ($this->routes as $key => $route) {
            if ($arrayStringURL[1] == $route['route'] && $method == $route['method']) {
                // return $route['resouce'];
                // $notFound = false;
                // $lead = new LeadController();
                // $lead->subscribe();
                $controller = $namespace . '\\' . ucfirst($route['resouce']) . 'Controller';
                $method = $route['route'];
                if (class_exists($controller)) {
                    $newController = new $controller();
                    if (method_exists($controller, $method)) {
                        $newController->$method();
                        return true;
                    } else {
                        throw new Exception("Não existe metodo", 404);
                    }
                    print_r($controller);
                } else {
                    throw new Exception("Não existe controller", 404);
                }

                // $controller           = $namespace . '\\' . ucfirst($route['resouce']) . 'Controller';

                // $page->controller     = $controller;
                // $page->action         = $method;
                // if (class_exists($controller)) {
                //     $newController = new $controller($page);
                //     if (method_exists($controller, $method)) {
                //         $newController->$method();
                //         return true;
                //     } else {
                //         Erro::render('Método ' . ucfirst($method) . '() não encontrado no controlador ' . $controller . ' !', 'Método ' . ucfirst($method) . '() não encontrado no controlador ' . $controller . ' !', basename(__FILE__));
                //     }
                // } else {
                //     Erro::render('Controlador ' . $controller . ' não encontrado!', 'Controlador ' . $controller . ' não encontrado!', basename(__FILE__));
                // }
                exit;
            }
        }

        if ($notFound) {
            throw new Exception("Não encontrado", 404);
        }
    }
}
