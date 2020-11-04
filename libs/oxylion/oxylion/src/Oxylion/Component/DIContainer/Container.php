<?php
namespace Oxylion\Component\DI;

class Container
{
    private $parameters;
    
    function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }
}