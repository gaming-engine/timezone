<?php

namespace GamingEngine\Timezone;

use ArrayAccess;
use DateTimeZone;
use GamingEngine\Timezone\Exceptions\InvalidTimezoneException;
use GamingEngine\Timezone\Exceptions\TimezoneListReadonlyException;
use Iterator;
use League\ISO3166\ISO3166;

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
     * @return TimezoneList[]
     * @throws InvalidTimezoneException
     */
    public static function groupByRegion(): array
    {
        $timezones = DateTimeZone::listIdentifiers();
        $countries = [];
        $lists = [];

        foreach ($timezones as $timezone) {
            $details = explode('/', $timezone);
            $countries[$details[0]][] = new Timezone($timezone);
        }

        foreach($countries as $country => $timezones) {
            $lists[$country] = new TimezoneList($timezones);
        }

        return $lists;
    }

    /**
     * @throws InvalidTimezoneException
     */
    public static function fromTimezoneGroup(int $timezoneGroup, ?string $countryCode = null): TimezoneList
    {
        $timezones = [];

        foreach (DateTimeZone::listIdentifiers($timezoneGroup, $countryCode) as $identifier) {
            $timezones[] = new Timezone($identifier);
        }

        return new self($timezones);
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->timezones);
    }

    public function offsetGet(mixed $offset): ?Timezone
    {
        return $this->timezones[$offset];
    }

    /**
     * @throws TimezoneListReadonlyException
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new TimezoneListReadonlyException($offset);
    }

    /**
     * @throws TimezoneListReadonlyException
     */
    public function offsetUnset(mixed $offset): void
    {
        throw new TimezoneListReadonlyException($offset);
    }

    public function current(): Timezone
    {
        return $this->timezones[$this->key];
    }

    public function next(): void
    {
        $this->key++;
    }

    public function key(): int
    {
        return $this->key;
    }

    public function valid(): bool
    {
        return array_key_exists($this->key, $this->timezones);
    }

    public function rewind(): void
    {
        $this->key = 0;
    }
}
