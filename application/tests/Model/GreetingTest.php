<?php

namespace tests\Model;

use Model\Greeting;
use PHPUnit\Framework\TestCase;

/**
 * Class GreetingTest
 * @package Model
 */
class GreetingTest extends TestCase
{
    private $greetings = [
        "Good evening",
        "Good evening",
        "Good evening",
        "Good evening",
        "Good morning",
        "Good morning",
        "Good morning",
        "Good morning",
        "Good morning",
        "Good morning",
        "Good morning",
        "Good morning",
        "Hello",
        "Hello",
        "Hello",
        "Hello",
        "Hello",
        "Hello",
        "Hello",
        "Hello",
        "Good evening",
        "Good evening",
        "Good evening",
        "Good evening",
    ];

    /**
     * @param \DateTime $target_date
     * @param string $expected
     *
     * @dataProvider provideGetMessage
     */
    public function testGetMessage(\DateTime $target_date, string $expected)
    {
        $greeting = new Greeting();
        $message = $greeting->getMessage($target_date);
        $this->assertSame($expected, $message);
    }

    public function provideGetMessage(): array
    {
        $return_array = [];
        for ($hour = 0; $hour < 24; $hour++) {
            $return_array[] = [
                new \DateTime("midnight + {$hour} hour"),
                $this->greetings[$hour],
            ];
        }
        return $return_array;
    }

    public function testGetMassageWithNull()
    {
        $greeting = new Greeting();
        $message = $greeting->getMessage();

        $current_date = new \DateTime();
        $this->assertSame($this->greetings[(int)$current_date->format("G")], $message);
    }
}
