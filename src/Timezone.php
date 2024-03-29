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

    /**
     * @throws InvalidTimezoneException
     */
    public function __construct(string $timezone)
    {
        try {
            $this->timezone = new DateTimeZone($timezone);
        } catch (Exception $e) {
            throw new InvalidTimezoneException($timezone);
        }
    }

    public function offset(): int
    {
        return $this->timezone->getOffset(
            new DateTime('now', new DateTimeZone('UTC'))
        );
    }

    public function offsetForHumans(): string
    {
        $offsetSeconds = $this->offset();

        $offsetHours = floor($offsetSeconds / 3600);
        $offsetMinutes = floor(($offsetSeconds % 3600) / 60);

        $offsetSign = ($offsetSeconds < 0) ? '-' : '+';

        return sprintf(
            "(GMT %s%02d:%02d) %s",
            $offsetSign,
            abs($offsetHours),
            abs($offsetMinutes),
            $this->timezone->getName()
        );
    }

    /**
     * @throws InvalidPropertyException
     */
    public function __get($name): mixed
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        }

        if (method_exists($this->timezone, $name)) {
            return $this->timezone->$name();
        }

        $method = "get". ucfirst($name);
        if (method_exists($this->timezone, $method)) {
            return $this->timezone->$method();
        }

        throw new InvalidPropertyException($name);
    }
}
