<?php

namespace GamingEngine\Timezone\Tests;

use DateTimeZone;
use GamingEngine\Timezone\Exceptions\TimezoneListReadonlyException;
use GamingEngine\Timezone\Timezone;
use GamingEngine\Timezone\TimezoneList;
use PHPUnit\Framework\TestCase;

class TimezoneListTest extends TestCase
{
    /**
     * @test
     */
    public function timezone_list_can_retrieve_all_timezones()
    {
        // Arrange

        // Act
        $subject = TimezoneList::all();

        // Assert
        $this->assertCount(
            count(DateTimeZone::listIdentifiers()),
            $subject
        );
    }

    /**
     * @test
     */
    public function timezone_list_can_filter_down_timezones()
    {
        // Arrange

        // Act
        $subject = TimezoneList::fromTimezoneGroup(DateTimeZone::AUSTRALIA);

        // Assert
        $this->assertCount(
            count(DateTimeZone::listIdentifiers(DateTimeZone::AUSTRALIA)),
            $subject
        );
    }

    /**
     * @test
     */
    public function timezone_list_provide_timezones_as_a_timezone_class()
    {
        // Arrange
        $subject = TimezoneList::all();

        // Act
        [$first,] = $subject;

        // Assert
        $this->assertInstanceOf(Timezone::class, $first);
    }

    /**
     * @test
     */
    public function timezone_list_cannot_have_values_assigned_to_it()
    {
        // Arrange
        $subject = TimezoneList::all();
        $this->expectException(TimezoneListReadonlyException::class);

        // Act
        $subject['foo'] = 'hello';

        // Assert
    }

    /**
     * @test
     */
    public function timezone_list_cannot_have_values_removed_from_it()
    {
        // Arrange
        $subject = TimezoneList::all();
        $this->expectException(TimezoneListReadonlyException::class);

        // Act
        unset($subject[0]);

        // Assert
    }

    /**
     * @test
     */
    public function timezone_list_can_retrieve_specific_values()
    {
        // Arrange
        $subject = TimezoneList::all();

        // Act
        $result = $subject[0];

        // Assert
        $this->assertInstanceOf(
            Timezone::class,
            $result
        );
    }

    /**
     * @test
     */
    public function timezone_list_can_retrieve_the_first_value()
    {
        // Arrange
        $subject = TimezoneList::all();

        // Act
        $result = $subject->current();

        // Assert
        $this->assertInstanceOf(
            Timezone::class,
            $result
        );
    }

    /**
     * @test
     */
    public function timezone_list_can_retrieve_check_if_an_offset_exists_and_it_doesnt()
    {
        // Arrange
        $subject = TimezoneList::all();

        // Act
        $result = $subject->offsetExists('foo');

        // Assert
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function timezone_list_can_retrieve_check_if_an_offset_exists_and_it_does()
    {
        // Arrange
        $subject = TimezoneList::all();

        // Act
        $result = $subject->offsetExists(0);

        // Assert
        $this->assertTrue($result);
    }
}