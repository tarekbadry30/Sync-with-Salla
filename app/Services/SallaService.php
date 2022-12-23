<?php


namespace App\Services;


use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class SallaService
{
    /**
     * get all  products in salla platform.
     *
     * @return Collection
     */
    public static function listAll(){
        $list= Http::withHeaders(static::getHeaders())->get('https://api.salla.dev/admin/v2/products')->json();
        return collect($list['data'])->map(function($item) {
            return [
                'id'   =>$item['id'],
                'sku'   =>$item['sku'],
                'name'  =>$item['name'],
                'description'   =>$item['description'],
                'main_image'    =>$item['main_image'],
                'price' =>$item['price']['amount']
            ];
        });
    }

    /**
     * create new product in salla platform.
     * @param Product $product
     * @return Collection
     */
    public static function create( Product $product){
        return Http::withHeaders(static::getHeaders())->post('https://api.salla.dev/admin/v2/products',[
            'product_type'   =>'product',
            'id'   =>$product->id,
            'sku'   =>$product->sku,
            'name'  =>$product->name,
            'description'   =>$product->description,
            'main_image'    =>$product->main_image,
            'price' =>$product->price
        ])->json()['data'];

    }

    /**
     * update  product in salla platform.
     * @param Product $product
     * @return Collection
     */
    public static function update(Product $product){
        return$list= Http::withHeaders(static::getHeaders())->put('https://api.salla.dev/admin/v2/products/'.$product->id,[
            'sku'   =>$product->sku,
            'name'  =>$product->name,
            'description'   =>$product->description,
            'main_image'    =>$product->main_image,
            'price' =>$product->price
        ])->json();
    }

    /**
     * get salla api headers.
     *
     * @return Collection
     */
    public static function getHeaders(){
        return [
            'Content-Type'=>'application/json',
            'Authorization'=>'Bearer '.env('SALLA_TOKEN'),
        ];
    }
}
