<?php

namespace GoodWe;

final class YouLessOutput
{

    protected $Counter;
    protected $Power;

    public function toArray(): array
    {
        return [
            'Consumption' => $this->Counter,
            'ConsumedPower' => $this->Power,
        ];
    }

    public function setCounter($Counter)
    {
        $this->Counter = $Counter;
    }

    public function getCounter()
    {
        return $this->Counter;
    }

    public function setPower($Power)
    {
        $this->Power = $Power;
    }

    public function getPower()
    {
        return $this->Power;
    }

    public function show()
    {
        echo 'Counter        ' . $this->Counter . 'kWh' . PHP_EOL;
        echo 'Consumed Power ' . $this->Power . 'W' . PHP_EOL;
    }
}
