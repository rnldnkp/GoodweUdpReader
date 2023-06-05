<?php

namespace GoodWe;

final class GoodWeProcessor
{
    protected $binary;

    public static function process($binary)
    {
        GoodWeValidator::validate($binary);
        $date = self::getDateTime($binary);

        $goodweOutput = new GoodWeOutput();
        $goodweOutput->setDateTime($date);
        $goodweOutput->setVoltDc1(hexdec(bin2hex($binary[11] . $binary[12])) / 10);
        $goodweOutput->setCurrentDc1(hexdec(bin2hex($binary[13]. $binary[14])) / 10);
        $goodweOutput->setPowerDc1((hexdec(bin2hex($binary[11] . $binary[12])) / 10) * (hexdec(bin2hex($binary[13]. $binary[14])) / 10) );
        $goodweOutput->setVoltDc2(hexdec(bin2hex($binary[15] . $binary[16])) / 10);
        $goodweOutput->setCurrentDc2(hexdec(bin2hex($binary[17]. $binary[18])) / 10);
        $goodweOutput->setPowerDc2((hexdec(bin2hex($binary[15] . $binary[16])) / 10) * (hexdec(bin2hex($binary[17]. $binary[18])) / 10) );
        $goodweOutput->setVoltDc( round( ((hexdec(bin2hex($binary[61] . $binary[62])) ) / ( (hexdec(bin2hex($binary[13]. $binary[14])) / 10) + (hexdec(bin2hex($binary[17]. $binary[18])) / 10) )),1));
        $goodweOutput->setVoltAc1(hexdec(bin2hex($binary[41] . $binary[42])) / 10);
        $goodweOutput->setVoltAc2(hexdec(bin2hex($binary[43] . $binary[44])) / 10);
        $goodweOutput->setVoltAc3(hexdec(bin2hex($binary[45] . $binary[46])) / 10);
        $goodweOutput->setCurrentAc1(hexdec(bin2hex($binary[47] . $binary[48])) / 10);
        $goodweOutput->setCurrentAc2(hexdec(bin2hex($binary[49] . $binary[50])) / 10);
        $goodweOutput->setCurrentAc3(hexdec(bin2hex($binary[51] . $binary[52])) / 10);
        $goodweOutput->setFrequencyAc1(hexdec(bin2hex($binary[53] . $binary[54])) / 100);
        $goodweOutput->setFrequencyAc2(hexdec(bin2hex($binary[55] . $binary[56])) / 100);
        $goodweOutput->setFrequencyAc3(hexdec(bin2hex($binary[57] . $binary[58])) / 100);
        $goodweOutput->setPower(hexdec(bin2hex($binary[61] . $binary[62])) / 1000);
        $goodweOutput->setWorkMode(hexdec(bin2hex($binary[63] . $binary[64])));
        $goodweOutput->setTemperature(hexdec(bin2hex($binary[87] . $binary[88])) / 10);
        $goodweOutput->setGenerationToday(hexdec(bin2hex($binary[93] . $binary[94])) / 10);
        $goodweOutput->setGenerationTotal(hexdec(bin2hex($binary[95] . $binary[96] . $binary[97] . $binary[98])) / 10);
        $goodweOutput->setTotalHours(hexdec(bin2hex($binary[99] . $binary[100] . $binary[101] . $binary[102])));
        $goodweOutput->setSafetyCode(hexdec(bin2hex($binary[103] . $binary[104])) / 100);
        $goodweOutput->setRSSI(hexdec(bin2hex($binary[149] . $binary[150])));

        return $goodweOutput;

    }

    public static function getDateTime($binary): \DateTime
    {
        $date = \DateTime::createFromFormat(
            'ymdHis',
            str_pad(hexdec(bin2hex($binary[5])), 2, '0', STR_PAD_LEFT) .
            str_pad(hexdec(bin2hex($binary[6])), 2, '0', STR_PAD_LEFT) .
            str_pad(hexdec(bin2hex($binary[7])), 2, '0', STR_PAD_LEFT) .
            str_pad(hexdec(bin2hex($binary[8])), 2, '0', STR_PAD_LEFT) .
            str_pad(hexdec(bin2hex($binary[9])), 2, '0', STR_PAD_LEFT) .
            str_pad(hexdec(bin2hex($binary[10])), 2, '0', STR_PAD_LEFT)
        );
        if ($date === false) {
            throw new \Exception("Invalid date time");
        }

        return $date;
    }
}
