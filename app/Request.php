<?php

namespace App;


class Request
{
    protected $parameters;
    protected $path;
    protected $method;

    public function __construct()
    {
        $this->parameters = $this->getCleanParameters();
        $this->path = strtok($_SERVER['REQUEST_URI'], '?');
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    protected function getCleanParameters()
    {
        $postRequestParameters = $_POST;
        $putRequestParameters = $_GET;
        $parameters = array_merge($postRequestParameters, $putRequestParameters);

        return sanitize($parameters);
    }

    public function getParameter($parameterName, $default = null)
    {
        return isset($this->parameters[$parameterName])
            ? $this->parameters[$parameterName]
            : $default;
    }

    public function getParameters()
    {
        return $this->getCleanParameters();
    }
}