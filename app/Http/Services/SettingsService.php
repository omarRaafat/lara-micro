<?php 

namespace App\Http\Services;

use App\Http\Singletones\Configuration;
use App\Models\Setting;


class SettingsService {

    private $config ;
    function __construct(){
        $this->config = Configuration::getInstance();
    }

    public function getSettings() {

       return $this->config->getSettings();

    }

    public function setSettings($data){
         $this->config->setSettings($data['key'] , $data['value']);
    }


}




?>