<?php

namespace GoodWe;

final class GoodWeOutput
{
    const WORK_MODE_WAIT = 0;
    const WORK_MODE_NORMAL = 1;
    const WORK_MODE_ERROR = 2;
    const WORK_MODE_CHECK = 4;

    /**
     * @var \DateTime
     */
    private $dateTime;

    protected $voltDc1;
    protected $currentDc1;
    protected $powerDc1;
    protected $voltDc2;
    protected $currentDc2;
    protected $powerDc2;
    protected $voltAc1;
    protected $voltAc2;
    protected $voltAc3;
    protected $currentAc1;
    protected $currentAc2;
    protected $currentAc3;
    protected $frequencyAc1;
    protected $frequencyAc2;
    protected $frequencyAc3;
    protected $power;
    protected $workMode;
    protected $temperature;
    protected $generationToday;
    protected $generationTotal;
    protected $totalHours;
    protected $setSafetyCode;
    protected $rssi;

    public function __construct()
    {
    }

    public function setDateTime($dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    public function toArray(): array
    {
        return [
            'dateTime' => $this->dateTime->format(DATE_ATOM),
            'voltDc1' => $this->voltDc1,
            'powerDc1' => $this->powerDc1,
            'currentDc1' => $this->currentDc1,
            'voltDc2' => $this->voltDc2,
            'powerDc2' => $this->powerDc2,
            'currentDc2' => $this->currentDc2,
            'voltAc1' => $this->voltAc1,
            'voltAc2' => $this->voltAc2,
            'voltAc3' => $this->voltAc3,
            'currentAc1' => $this->currentAc1,
            'currentAc2' => $this->currentAc2,
            'currentAc3' => $this->currentAc3,
            'frequencyAc1' => $this->frequencyAc1,
            'frequencyAc2' => $this->frequencyAc2,
            'frequencyAc3' => $this->frequencyAc3,
            'power' => $this->power,
            'workMode' => $this->workMode,
            'readableWorkMode' => $this->getReadableWorkMode(),
            'temperature' => $this->temperature,
            'generationToday' => $this->generationToday,
            'generationTotal' => $this->generationTotal,
            'totalHours' => $this->totalHours,
            'SafetyCode' => $this->SafetyCode,
            'rssi' => $this->rssi,
        ];
    }

    public function setVoltDc1($voltDc1)
    {
        $this->voltDc1 = $voltDc1;
    }

    public function setCurrentDc1($currentDc1)
    {
        $this->currentDc1 = $currentDc1;
    }

    public function setPowerDc1($powerDc1)
    {
        $this->powerDc1 = $voltDc1 * $currentDc1;
    }

    public function setVoltDc2($voltDc2)
    {
        $this->voltDc2 = $voltDc2;
    }

    public function setCurrentDc2($currentDc2)
    {
        $this->currentDc2 = $currentDc2;
    }

    public function setPowerDc2($powerDc2)
    {
        $this->powerDc2 = $voltDc2 * $currentDc2;
    }

    public function setVoltAc1($voltageAc1)
    {
        $this->voltAc1 = $voltageAc1;
    }

    public function getVoltageAc1()
    {
        return $this->voltAc1;
    }

    public function setVoltAc2($voltAc2)
    {
        $this->voltAc2 = $voltAc2;
    }
    public function getVoltageAc2()
    {
        return $this->voltAc2;
    }

    public function setVoltAc3($voltAc3)
    {
        $this->voltAc3 = $voltAc3;
    }
    public function getVoltageAc3()
    {
        return $this->voltAc3;
    }

    public function setCurrentAc1($currentAc1)
    {
        $this->currentAc1 = $currentAc1;
    }

    public function setCurrentAc2($currentAc2)
    {
        $this->currentAc2 = $currentAc2;
    }

    public function setCurrentAc3($currentAc3)
    {
        $this->currentAc3 = $currentAc3;
    }

    public function setFrequencyAc1($frequencyAc1)
    {
        $this->frequencyAc1 = $frequencyAc1;
    }

    public function setFrequencyAc2($frequencyAc2)
    {
        $this->frequencyAc2 = $frequencyAc2;
    }

    public function setFrequencyAc3($frequencyAc3)
    {
        $this->frequencyAc3 = $frequencyAc3;
    }

    public function setPower($power)
    {
        $this->power = $power;
    }

    public function getPower()
    {
        return $this->power;
    }

    public function setWorkMode($workMode)
    {
        $this->workMode = $workMode;
    }

    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function setGenerationToday($today)
    {
        $this->generationToday = $today;
    }

    public function getGenerationToday()
    {
        return $this->generationToday;
    }

    public function setGenerationTotal($total)
    {
        $this->generationTotal = $total;
    }

    public function setTotalHours($hours)
    {
        $this->totalHours = $hours;
    }

    public function setSafetyCode($SafetyCode)
    {
        $this->SafetyCode = $SafetyCode;
    }

    public function setRSSI($rssi)
    {
        $this->rssi = $rssi;
    }

    private function getReadableWorkMode()
    {
        $workModes = [
            self::WORK_MODE_WAIT => 'Wait',
            self::WORK_MODE_NORMAL => 'Normal',
            self::WORK_MODE_ERROR => 'Error',
            self::WORK_MODE_CHECK => 'Check',
        ];

        return $workModes[$this->workMode];
    }

    public function show()
    {
        echo 'GoodWe output from ' . $this->dateTime->format(DATE_ISO8601) . PHP_EOL;

        echo 'DC1 Voltage   ' . $this->voltDc1 . 'V' . PHP_EOL;
        echo 'DC1 Current   ' . $this->currentDc1 . 'A' . PHP_EOL;
        echo 'DC1 Power     ' . $this->powerDc1 . 'kW'. PHP_EOL;
        echo 'DC2 Voltage   ' . $this->voltDc2 . 'V' . PHP_EOL;
        echo 'DC2 Current   ' . $this->currentDc2 . 'A' . PHP_EOL;
        echo 'DC2 Power     ' . $this->powerDc2 . 'kW'. PHP_EOL;
        echo 'AC1 Voltage   ' . $this->voltAc1 . 'V' . PHP_EOL;
        echo 'AC2 Voltage   ' . $this->voltAc2 . 'V' . PHP_EOL;
        echo 'AC3 Voltage   ' . $this->voltAc3 . 'V' . PHP_EOL;
        echo 'AC1 Current   ' . $this->currentAc1 . 'A' . PHP_EOL;
        echo 'AC2 Current   ' . $this->currentAc2 . 'A' . PHP_EOL;
        echo 'AC3 Current   ' . $this->currentAc3 . 'A' . PHP_EOL;
        echo 'AC1 Frequency ' . $this->frequencyAc1 . 'Hz' . PHP_EOL;
        echo 'AC2 Frequency ' . $this->frequencyAc2 . 'Hz' . PHP_EOL;
        echo 'AC3 Frequency ' . $this->frequencyAc3 . 'Hz' . PHP_EOL;
        echo 'Power         ' . $this->power . 'kW'. PHP_EOL;
        echo 'WorkMode      ' . $this->workMode . PHP_EOL;
        echo 'WorkMode      ' . $this->getReadableWorkMode() . PHP_EOL;
        echo 'temperature   ' . $this->temperature . '°C' . PHP_EOL;
        echo 'Energy Today  ' . $this->generationToday . 'kWh' . PHP_EOL;
        echo 'Energy Total  ' . $this->generationTotal . 'kWh' . PHP_EOL;
        echo 'Total hours   ' . $this->totalHours . 'h' . PHP_EOL;
        echo 'SafetyCode    ' . $this->SafetyCode . '-' . PHP_EOL;
        echo 'WiFi RSSI     ' . $this->rssi . '%' . PHP_EOL;
    }
}
