<?php

namespace GoodWe;

class YouLessConnector
{

    public function sendMessage($inverter)
    {
      $curl = curl_init();

    //if (!array_key_exists('youless', $inverter)) {
    //      throw new \Exception('No youless details given');
    //  }

      $ip = $inverter['youless']['ip'];

      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://".$ip."/a?f=j",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache"
        ),
      ));

      $response = curl_exec($curl);
      $response = str_replace(' ', '', $response);
      $err = curl_error($curl);

      //test data
      //$response = '{"cnt":"14295,827","pwr":-4624,"lvl":0,"dev":"","det":"","con":"OK","sts":"(35)","cs0":"1564,054","ps0":0,"raw":0}';

      curl_close($curl);

      $response = json_decode($response, true);

      return $response;
    }

    public function sendUsageMessage($inverter)
    {
        return $this->sendMessage($inverter);
    }

}
