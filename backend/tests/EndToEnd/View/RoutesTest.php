<?php

declare(strict_types=1);

namespace Youtube\Crud\Tests\Entities\RoutesTest;

use PHPUnit\Framework\TestCase;
use Youtube\Crud\Entities\User;
use Youtube\Crud\Model\UserModel;
use Youtube\Crud\Utils\Curl;

class RoutesTest extends TestCase
{
    public function testRoutesReturn404StatusCodeWhenRouteNotFound()
    {
        $result = Curl::get("127.0.0.1:8000/notexisits");
        $this->assertEquals(404, $result->getStatusCode(), "Retornou diferente de 404");
    }

    public function testSubscribeReturnStatusCode200WhenEmailInformedOk()
    {
        $body = array(
          "email" => "teste@teste.com"
        );
        $bodyJson = json_encode($body);
        $result = Curl::post("127.0.0.1:8000/subscribe", $bodyJson);

        $this->assertEquals(200, $result->getStatusCode(), "Retornou diferente de 200");
    }

    public function testSubscribeReturnStatusCode406WhenEmailIsNotInformed()
    {
        $body = array();
        $bodyJson = json_encode($body);
        $result = Curl::post("127.0.0.1:8000/subscribe", $bodyJson);

        $this->assertEquals(406, $result->getStatusCode(), "Retornou diferente de 406");
    }

    public function testSubscribeReturnStatusCode406WhenEmailIsInvalid()
    {
        $body = array("email" => "testeEmailInvalido");
        $bodyJson = json_encode($body);
        $result = Curl::post("127.0.0.1:8000/subscribe", $bodyJson);

        $this->assertEquals(406, $result->getStatusCode(), "Retornou diferente de 406");
    }
}
