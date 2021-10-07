<?php

namespace GamingEngine\Timezone;

use DateTime;
use DateTimeZone;
use Exception;
use GamingEngine\Timezone\Exceptions\InvalidPropertyException;
use GamingEngine\Timezone\Exceptions\InvalidTimezoneException;

/**
 * @property-read int $offset
 */
class Timezone
{
    private DateTimeZone $timezone;

    public function __construct(string $timezone)
    {
        try {
            $this->timezone = new DateTimeZone($timezone);
        } catch (Exception $e) {
            throw new InvalidTimezoneException($timezone);
        }
    }

    public function offset()
    {
        return $this->timezone->getOffset(
            new DateTime('now', new DateTimeZone('UTC'))
        );
    }

    public function __get($name)
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        }

        throw new InvalidPropertyException($name);
    }
}