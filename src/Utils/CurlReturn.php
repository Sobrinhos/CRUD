<?php

declare(strict_types=1);

namespace Youtube\Crud\Utils;

class CurlReturn
{
    private $output;
    private $statusCode;

    public function __construct($output, $statusCode)
    {
        $this->output = $output;
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getOutput()
    {
        return $this->output;
    }
}
