<?php

namespace GamingEngine\Timezone;

use ArrayAccess;
use DateTimeZone;
use GamingEngine\Timezone\Exceptions\InvalidTimezoneException;
use GamingEngine\Timezone\Exceptions\TimezoneListReadonlyException;
use Iterator;

class TimezoneList implements ArrayAccess, Iterator
{
    private int $key;

    /**
     * @var Timezone[]
     */
    private array $timezones;

    /**
     * @param Timezone[] $timezones
     */
    private function __construct(array $timezones)
    {
        $this->key = 0;
        $this->timezones = $timezones;
    }

    /**
     * @throws InvalidTimezoneException
     */
    public static function all(): TimezoneList
    {
        return static::fromTimezoneGroup(DateTimeZone::ALL);
    }

    /**
     * @throws InvalidTimezoneException
     */
    public static function fromTimezoneGroup(int $timezoneGroup): TimezoneList
    {
        $timezones = [];

        foreach (DateTimeZone::listIdentifiers($timezoneGroup) as $identifier) {
            $timezones[] = new Timezone($identifier);
        }

        return new self($timezones);
    }

    public function offsetExists(mixed $offset)
    {
        return array_key_exists($offset, $this->timezones);
    }

    public function offsetGet(mixed $offset)
    {
        return $this->timezones[$offset];
    }

    /**
     * @throws TimezoneListReadonlyException
     */
    public function offsetSet(mixed $offset, mixed $value)
    {
        throw new TimezoneListReadonlyException($offset);
    }

    /**
     * @throws TimezoneListReadonlyException
     */
    public function offsetUnset(mixed $offset)
    {
        throw new TimezoneListReadonlyException($offset);
    }

    public function current()
    {
        return $this->timezones[$this->key];
    }

    public function next()
    {
        $this->key++;
    }

    public function key()
    {
        return $this->key;
    }

    public function valid()
    {
        return array_key_exists($this->key, $this->timezones);
    }

    public function rewind()
    {
        $this->key = 0;
    }
}