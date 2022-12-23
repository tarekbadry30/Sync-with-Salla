<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\SallaService;
use Illuminate\Console\Command;

class Salla extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salla:pull-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pull products from salla platform';

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
        $sallaProducts=SallaService::listAll();
        foreach ($sallaProducts as $item) {
            Product::updateOrCreate([
                'sku'           =>$item['sku'],
                'name'          =>$item['name'],
                'description'   =>$item['description'],
                'main_image'    =>$item['main_image'],
                'price'         =>is_array($item['price'])?$item['price']['amount']:$item['price'],
            ],
                [
                    'id'   =>$item['id'],
                ]);
        }
        echo count($sallaProducts).' has been updated';
    }
}
