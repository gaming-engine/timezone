<?php

namespace GamingEngine\Timezone\Exceptions;

use Exception;

class TimezoneListReadonlyException extends Exception
{
    public function __construct(string $parameter)
    {
        parent::__construct("Tried to set the value for, $parameter, however it is readonly.");
    }
}