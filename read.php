<?php

use GoodWe\GoodWeInfo;
use GoodWe\GoodWeProcessor;
use GoodWe\GoodWeConnector;
use GoodWe\YouLessConnector;
use GoodWe\YouLessProcessor;
use GoodWe\ToPvOutput;

require_once "GoodWeInfo.php";
require_once "GoodWeConnector.php";
require_once "GoodWeProcessor.php";
require_once "GoodWeOutput.php";
require_once "GoodWeValidator.php";
require_once "ToPvOutput.php";
require_once "inverters.php";
require_once "YouLessConnector.php";
require_once "YouLessProcessor.php";
require_once "YouLessOutput.php";

$connector = new GoodWeConnector();
$connector2 = new YouLessConnector();

foreach ($inverters as $inverter) {
    echo "===========================" . PHP_EOL;
    echo "Trying " . $inverter['name'] . ' (' . $inverter['ip'] . ')' . PHP_EOL;

    $serialReply = $connector->getSerial($inverter['ip']);
    $goodWeInfo = new GoodWeInfo($serialReply);
    $goodWeInfo->show();

    $reply = $connector->sendUsageMessage($inverter['ip']);
    $goodweOutput = GoodWeProcessor::process($reply);

    if (array_key_exists('youless', $inverter)) {
        //only run if youless is setup
    }
    $reply2 = $connector2->sendUsageMessage($inverter);
    $YouLessOutput = YouLessProcessor::process($reply2);

    $goodweOutput->show();
    $YouLessOutput->show();
    if (array_key_exists('pvoutput', $inverter)) {
        ToPvOutput::send($inverter, $goodweOutput, $YouLessOutput);
    }
}
