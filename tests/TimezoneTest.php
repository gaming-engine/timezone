<?php

namespace GamingEngine\Timezone\Tests;

use GamingEngine\Timezone\Exceptions\InvalidPropertyException;
use GamingEngine\Timezone\Exceptions\InvalidTimezoneException;
use GamingEngine\Timezone\Timezone;
use PHPUnit\Framework\TestCase;

class TimezoneTest extends TestCase
{
    /**
     * @test
     */
    public function timezone_throws_an_exception_if_an_invalid_timezone_is_provided()
    {
        // Arrange
        $this->expectException(InvalidTimezoneException::class);

        // Act
        new Timezone('invalid-timezone');

        // Assert
    }

    /**
     * @test
     */
    public function timezone_provides_the_correct_offset_from_utc()
    {
        // Arrange
        $today = new \DateTime();

        // Act
        $subject = new Timezone('America/Toronto');

        // Assert
        $this->assertEquals(
            ( $today->format('I') === 1 ? -4 : -5) * 60 * 60,
            $subject->offset()
        );
    }

    /**
     * @test
     */
    public function timezone_provides_the_correct_offset_from_utc_through_a_getter()
    {
        // Arrange
        $today = new \DateTime();

        // Act
        $subject = new Timezone('America/Toronto');

        // Assert
        $this->assertEquals(
            ( $today->format('I') === 1 ? -4 : -5) * 60 * 60,
            $subject->offset
        );
    }

    /**
     * @test
     */
    public function timezone_gives_an_invalid_property_exception_if_you_access_something_that_doesnt_exist()
    {
        // Arrange
        $this->expectException(InvalidPropertyException::class);

        $subject = new Timezone('America/Toronto');

        // Act
        $result = $subject->foo;

        // Assert
    }

    /**
     * @test
     */
    public function timezone_returns_the_name_if_asked()
    {
        // Arrange
        $subject = new Timezone('America/Toronto');

        // Act
        $result = $subject->name;

        // Assert
        $this->assertEquals(
            'America/Toronto',
            $result
        );
    }

    /**
     * @test
     */
    public function timezone_returns_the_proper_offset_for_humans_text()
    {
        // Arrange
        $subject = new Timezone('America/Halifax');

        // Act
        $result = $subject->offsetForHumans();

        // Assert
        $this->assertEquals(
            '(GMT -04:00) America/Halifax',
            $result
        );
    }
}
