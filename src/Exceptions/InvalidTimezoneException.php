<?php

namespace GamingEngine\Timezone\Exceptions;

use Exception;

class InvalidTimezoneException extends Exception
{
    public function __construct(string $timezone)
    {
        parent::__construct("The specified timezone is invalid: $timezone");
    }
}