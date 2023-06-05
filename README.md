# GoodWe Solar Inverter, Youless Power Meter read out and PVOutput upload

This application makes it possible to read out GoodWe Solar inverters through WiFi (without using a cloud solution like the SEMS portal). Next it's possible to add consumption data from Youless energy meters. The output can be send to PVOutput.

## Usage:
- Copy `inverters.php.dist` to `inverters.php` and set the IP-address(es) and optionally the Youless and/or PVOutput information for you inverter(s) in `inverters.php`.
- Run `php read.php`
- Output of the inverter(s) and Youless is shown in the console
- When setting pv-output ApiKey and SystemId in `inverters.php`, the output will be send to PVOutput. If setup, you can add extended parameters to include per string Watt information (yearly donation of 15 AUD required).

## What has changed in this version
This application is based on https://github.com/aiolos/GoodweUdpReader by Henry de Jong (aiolos).
Changes:
- some minor code fixes
- Added 3-Phase support
- Volts from system (DC), not from a single AC feed (calculated from W and A - Experimental).
- Calculates power per string, can save the data in extended PVOutput parameters.
- Reads Youless power meter for daily consumption and power, add to PVOutput

## Next steps:
- Add option to send output to MQTT

## Requirements:
- PHP, Version 7.3+ with php-curl module.
- A GoodWe solar inverter with minimal version x.y.14 (Inverter should be discoverable with the SolarGo app)

## Acknowledgments:
Based on https://github.com/aiolos/GoodweUdpReader by Henry de Jong (aiolos). With use of https://wiki.td-er.nl/index.php?title=YouLes and https://pvoutput.org/help/overview.html
