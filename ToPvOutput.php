<?php

namespace GoodWe;

class ToPvOutput
{
    const PVOUTPUT_URL = 'https://pvoutput.org/service/r2/addstatus.jsp';

    public static function send(array $inverter, GoodWeOutput $goodWeOutput, YouLessOutput $YouLessOutput)
    {
        if (!array_key_exists('pvoutput', $inverter)) {
            throw new \Exception('No pvoutput details given');
        }

        $ch = curl_init();

        $headers = [
            'X-Pvoutput-Apikey: ' . $inverter['pvoutput']['apiKey'],
            'X-Pvoutput-SystemId: ' . $inverter['pvoutput']['systemId'],
        ];

        curl_setopt($ch, CURLOPT_URL,self::PVOUTPUT_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            http_build_query(
                [
                    'd' => $goodWeOutput->getDateTime()->format('Ymd'),
                    't' => $goodWeOutput->getDateTime()->format('H:i'),
                    'v1' => $goodWeOutput->getGenerationToday() * 1000,
                    'v2' => $goodWeOutput->getPower() * 1000,

                    // try adding YouLess data sometime
                    'v3' => $YouLessOutput-> getCounter(),
                    'v4' => $YouLessOutput-> getPower(),

                    // should be weather info, not the inverter temp. Move to extended data.
                    'v5' => $goodWeOutput->getTemperature(),

                    // v6 - changed to real system voltage (multi string)
                    //'v6' => $goodWeOutput->getVoltageAc1(),
                    'v6' => $goodWeOutput->getVoltDc(),

                    // v7 = Power String 1 (Watt)
                    'v7' => $goodWeOutput->getPowerDc1(),

                    // v8 = Power String 2 (Watt)
                    'v8' => $goodWeOutput->getPowerDc2(),

                    // Cumulative Energy
                    // 1 - Both v1 and v3 values are lifetime energy values.
                    // 2 - Only v1 generation is a lifetime energy value.
                    // 3 - Only v3 consumption is a lifetime energy value.
                    'c1' => 3,
                ]
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $serverOutput = curl_exec($ch);

        curl_close ($ch);
        echo 'PVOutput result: ' . $serverOutput . PHP_EOL;
    }
}
