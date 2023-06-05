<?php

namespace GoodWe;

final class YouLessProcessor
{
    protected $json;

    public static function process($json)
    {
        $YouLessOutput = new YouLessOutput();

        $YouLessOutput->setCounter(str_replace(',', '.', $json["cnt"]));
        $YouLessOutput->setPower(str_replace(',', '.', $json["pwr"]));

        return $YouLessOutput;

    }

}
