<?php

namespace App\Controller;

use Interop\Container\ContainerInterface;

class Controller
{
    protected $container;

    //Constructor
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
