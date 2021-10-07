<?php

namespace GamingEngine\Timezone\Exceptions;

use Exception;

class InvalidPropertyException extends Exception
{
    public function __construct(string $property)
    {
        parent::__construct("The property you requested, $property, does not exist.");
    }
}