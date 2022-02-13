<?php

namespace App\Console\Commands;

use App\Models\Parametre\Theme;
use Illuminate\Console\Command;

class ManageApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:managedata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gestion des données dans la BD';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        /*$tranches = DB::table('astuce_tranche')->get();
        dd($tranches);*/
       /*$array = [9,13,14,18,19,38,88,87,86,81,12,11,10];
       if(in_array($astuce->id, $array)){
        $astuce->tranches = [2,3,4];
        $astuce->save();
        }*/

        $themes = Theme::get();
        foreach ($themes as $theme) {
            $theme->specialites = [$theme->specialite_id];
            $theme->save();
        }

        dd("ok");
    }
}
