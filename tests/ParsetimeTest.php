<?php

/**
 * Part of the parsetime package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the MIT License.
 *
 * @package    parsetime
 * @version    1.0.0
 * @author     invokemedia
 * @license    MIT
 */

namespace invokemedia\parsetime\Tests;

use PHPUnit_Framework_TestCase;

class ParsetimeTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function theParseTimeFunctionExists()
    {
        $this->assertTrue(function_exists('parse_time'));
    }

    /** @test */
    public function itCanIgnoreNonTimeSentences()
    {
        $actual = parse_time('I contain no time at all');

        $this->assertFalse($actual);
    }

    /** @test */
    public function itCanParseASimpleTime()
    {
        $actual = parse_time('11 AM');
        $expected = [
            'hour' => 11,
            'period' => 'AM',
        ];

        $this->assertEquals($expected['hour'], $actual['hour']);
        $this->assertEquals($expected['period'], $actual['period']);
    }

    /** @test */
    public function itCanHandleATimeThatDoesntExist()
    {
        $actual = parse_time('30:00');
        $expected = [
            'hour' => '0',
        ];

        $this->assertEquals($expected['hour'], $actual['hour']);
    }

    /** @test */
    public function itCanParseAMoreAdvancedTimeWithPeriod()
    {
        $actual = parse_time('11 AM - 5 PM');
        $expected = [
            [
                'hour' => 11,
                'period' => 'AM'
            ],
            [
                'hour' => 17,
                'period' => 'PM'
            ],
        ];

        $this->assertEquals($expected[0]['hour'], $actual[0]['hour']);
        $this->assertEquals($expected[1]['hour'], $actual[1]['hour']);

        $this->assertEquals($expected[0]['period'], $actual[0]['period']);
        $this->assertEquals($expected[1]['period'], $actual[1]['period']);
    }

    /** @test */
    public function itCanParseAMoreAdvancedTime2()
    {
        $actual = parse_time('11 AM to 5 PM');
        $expected = [
            ['hour' => 11, 'period' => 'AM'],
            ['hour' => 17, 'period' => 'PM']
        ];

        $this->assertEquals($expected[0]['hour'], $actual[0]['hour']);
        $this->assertEquals($expected[1]['hour'], $actual[1]['hour']);

        $this->assertEquals($expected[0]['period'], $actual[0]['period']);
        $this->assertEquals($expected[1]['period'], $actual[1]['period']);
    }

    /** @test */
    public function itCanParseAMoreAdvancedTime3()
    {
        $actual = parse_time('from 11am-5am');
        $expected = [
            ['hour' => 11],
            ['hour' => 5]
        ];

        $this->assertEquals($expected[0]['hour'], $actual[0]['hour']);
        $this->assertEquals($expected[1]['hour'], $actual[1]['hour']);
    }

    /** @test */
    public function itCanParseAMoreAdvancedTime4()
    {
        $actual = parse_time('from 11am and ending at 5am');
        $expected = [
            ['hour' => 11],
            ['hour' => 5]
        ];

        $this->assertEquals($expected[0]['hour'], $actual[0]['hour']);
        $this->assertEquals($expected[1]['hour'], $actual[1]['hour']);
    }

    /** @test */
    public function itCanParseAMoreAdvancedTime5()
    {

        $actual = parse_time('I will arrive at 1:22 and leave at 9:45');
        $expected = [
            ['hour' => 1, 'minute' => 22, 'period' => 'AM'],
            ['hour' => 9, 'minute' => 45, 'period' => 'AM']
        ];

        $this->assertEquals($expected[0]['hour'], $actual[0]['hour']);
        $this->assertEquals($expected[1]['hour'], $actual[1]['hour']);

        $this->assertEquals($expected[0]['minute'], $actual[0]['minute']);
        $this->assertEquals($expected[1]['minute'], $actual[1]['minute']);

        $this->assertEquals($expected[0]['period'], $actual[0]['period']);
        $this->assertEquals($expected[1]['period'], $actual[1]['period']);
    }

    /** @test */
    public function itCanParseAMoreAdvancedTime6()
    {
        $this->markTestIncomplete('This test does not pass');

        $actual = parse_time('from 11 and ending at 5');
        $expected = [
            ['hour' => 11],
            ['hour' => 5]
        ];

        $this->assertEquals($expected[0]['hour'], $actual[0]['hour']);
        $this->assertEquals($expected[1]['hour'], $actual[1]['hour']);
    }

    /** @test */
    public function itCanParseATimeWithMinutes()
    {
        $actual = parse_time('11:30 - 5:21 PM');
        $expected = [
            ['hour' => 11, 'minute' => 30],
            ['hour' => 17, 'minute' => 21],
        ];

        $this->assertEquals($expected[0]['hour'], $actual[0]['hour']);
        $this->assertEquals($expected[1]['hour'], $actual[1]['hour']);

        $this->assertEquals($expected[0]['minute'], $actual[0]['minute']);
        $this->assertEquals($expected[1]['minute'], $actual[1]['minute']);
    }

    /** @test */
    public function itCanParseATimeWithMinutesAndALeadingZero()
    {
        $actual = parse_time('11:00 - 05:01');
        $expected = [
            ['hour' => 11, 'minute' => 0],
            ['hour' => 5, 'minute' => 1],
        ];

        $this->assertEquals($expected[0]['hour'], $actual[0]['hour']);
        $this->assertEquals($expected[1]['hour'], $actual[1]['hour']);

        $this->assertEquals($expected[0]['minute'], $actual[0]['minute']);
        $this->assertEquals($expected[1]['minute'], $actual[1]['minute']);
    }

    /** @test */
    public function itCanParseASingleTimeWithADifferentFormat()
    {
        $actual = parse_time('the time is 17:01 and not a minute more');
        $expected = [
            'hour' => 17, 'minute' => 1,
        ];

        $this->assertEquals($expected['hour'], $actual['hour']);

        $this->assertEquals($expected['minute'], $actual['minute']);
    }

    /** @test */
    public function itCanParseASingleTimeWithADifferentFormat2()
    {
        $actual = parse_time('the time is 1 PM and not a minute more');
        $expected = [
            'hour' => 13, 'minute' => false,
        ];

        $this->assertEquals($expected['hour'], $actual['hour']);

        $this->assertEquals($expected['minute'], $actual['minute']);
    }

    /** @test */
    public function itCanUnderstandSomeCommonTimes()
    {
        $actual = parse_time('11 AM - Midnight', true);
        $expected = [
            ['hour' => 11],
            ['hour' => 0],
        ];

        $this->assertEquals($expected[0]['hour'], $actual[0]['hour']);
        $this->assertEquals($expected[1]['hour'], $actual[1]['hour']);
    }
}
