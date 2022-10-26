<?php

namespace Youtube\Crud\Utils;

use Exception;

class ReturnErrorREST
{
    private $error;
    public function __construct(Exception $error)
    {
        $this->error = $error;
    }

    public function send()
    {
        if ($this->error->getCode() != 1) {
            http_response_code((int)$this->error->getCode());
        } else {
            http_response_code(500);
        }


        $result = array(
           "success" => false,
           "message" => $this->error->getMessage(),
           "code" => $this->error->getCode()
        );

        echo json_encode($result);
    }
}
