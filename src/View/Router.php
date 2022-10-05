<?php

namespace Youtube\Crud\View;

use Youtube\Crud\Controller\LeadController;

class Router
{
    public $routes = array();

    public function __construct()
    {
        $this->addNewRoute("subscribe", "POST", function () {
            $lead = new LeadController();
            $lead->subscribe();
        });

        $this->getRequestRoute();
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
        foreach ($this->routes as $key => $route) {
            if ($arrayStringURL[1] == $route['route'] && $method == $route['method']) {
                return $route['resouce'];
                $notFound = false;
            }
        }

        if ($notFound) {
            http_response_code(404);
            return;
        }
    }
}
