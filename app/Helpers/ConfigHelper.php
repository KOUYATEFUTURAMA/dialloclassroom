<?php
namespace App\Helpers\ConfigHelper;

use Illuminate\Support\Facades\DB;

class Configuration {
    /**
    * @param int $configuration_id Configuration-id
    * 
    * @return string
    */
    public static function getConfigInfos() {
        $config = DB::table('configurations')->where('id', 1)->first();
        return (isset($config->id) ? $config : '');
    }
}