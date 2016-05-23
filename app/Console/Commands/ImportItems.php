<?php

namespace App\Console\Commands;

use App\Models\Items;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ImportItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import CS:GO items';

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
     * @return mixed
     */
    public function handle()
    {
        Items::truncate();
        $start = time();
        $api_items = Cache::remember('api.items', 24*60, function(){
            return new \App\Models\API\Items();
        });
        $api_prices = Cache::remember('api.prices', 24*60, function(){
            return new \App\Models\API\Prices();
        });
        foreach($api_items->all() as $i){
            if(!$i->image_url) continue;
            unset($i->image_inventory);
            unset($i->craft_class);
            unset($i->craft_material_type);

            $i->prices = $api_prices->all()->whereLoose('name',$i->defindex);
            Items::create(collect($i)->toArray());
            $this->info($i->item_name . ' imported.');
        }
        $end = time();

        $this->info('All done. Time: '.round(($end-$start)/60,2).'min');
    }
}
