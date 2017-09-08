<?php

namespace Model;

/**
 * Class Greeting
 * @package Model
 */
class Greeting
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
     * 4:00 - 12:00 Good morning
     * 12:00 - 20:00 Hello
     * 20:00 - 4:00 Good evening
     *
     * @param \DateTime|null $current_date
     * @return string
     */
    public function getMessage(\DateTime $current_date = null): string
    {
        if (!$current_date) {
            $current_date = new \DateTime();
        }

        /*
         * formatの"G"は「時。24時間単位。先頭にゼロを付けない。」
         * http://php.net/manual/ja/function.date.php
         */
        return $this->greetings[(int)$current_date->format("G")];
    }

}
