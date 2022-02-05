<?php

namespace Vspf\Core\Http;

class Request
{
    private $method;
    private $parameters = [];

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->parameters['GET'] = $_GET;
        $this->parameters['POST'] = $_POST;

        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * getParameter
     *
     * @param  string $method
     * @param  string $parameter
     * @param  mixed $default
     * @return mixed
     */
    public function getParameter( $method, $parameter, $default = null)
    {
        if (isset($this->parameters[$method][$parameter])) {
            return htmlspecialchars($this->parameters[$method][$parameter], ENT_QUOTES, 'UTF-8');
        } else {
            return !is_null($default) ? $default : null;
        }
    }

    /**
     * getInt
     *
     * @param  string $method
     * @param  string $parameter
     * @return mixed
     */
    public function getInt($method, $parameter)
    {
        return filter_var($this->getParameter($method, $parameter), FILTER_VALIDATE_INT) ? $this->getParameter($method, $parameter) : null;
    }

    /**
     * getBoolean
     *
     * @param  string $method
     * @param  string $parameter
     * @return mixed
     */
    public function getBoolean( $method, $parameter)
    {
        return filter_var($this->parameters[$method][$parameter], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * getEmail
     *
     * @param  string $method
     * @param  string $parameter
     * @return mixed
     */
    public function getEmail( $method, $parameter)
    {
        return filter_var($this->getParameter($method, $parameter), FILTER_VALIDATE_EMAIL) ? $this->getParameter($method, $parameter) : null;
    }


    /**
     * @return string Request method like 'GET', 'HEAD', 'POST', 'PUT'
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * @return bool
     */
    public function isGet() : bool
    {
        return $this->method === 'GET';
    }

    /**
     * @return bool
     */
    public function isPost() : bool
    {
        return $this->method === 'POST';
    }

}
