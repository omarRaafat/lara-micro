<?php 

namespace App\Http\Singletones;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;


class Configuration{

    private static $instance  = null;
    private $settings = [
        'key',
        'value'
    ];


    private function __construct(){

    }

    public static function getInstance(){

        if(self::$instance === null)
            self::$instance = new self();

        return self::$instance;
    } 


    public function setSettings($key ,$value){
         $this->settings['key'] = $key;
         $this->settings['value'] = $value;
         Setting::create($this->settings);
    }

    public function getSettings(){
        return settings();
    }

}





?>