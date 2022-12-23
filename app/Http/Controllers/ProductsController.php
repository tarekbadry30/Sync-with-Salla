<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\SallaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }
    /**
     * list resource in datatable.
     *
     */
    public function listing(){
        $data = Product::orderBy('name')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('products.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * list resource in datatable.
     *
     * @return \Illuminate\Http\Response
     */
    public function pullNow(){

        Artisan::call('salla:pull-products');
        //return 'sync started wheen finish will tell you';
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product=Product::create([
            //'id'   =>$request->id,
            'sku'   =>$request->sku,
            'name'  =>$request->name,
            'description'   =>$request->description,
            'main_image'    =>$this->uploadImg($request),
            'price'         =>$request->price,
        ]);
        $product->update([
            'id'=>SallaService::create($product)['id']
        ]);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update([
            'sku'           =>$request->sku,
            'name'          =>$request->name,
            'description'   =>$request->description,
            'main_image'    =>is_file($request->main_image)?$this->uploadImg($request):$product->main_image,
            'price'         =>$request->price,
        ]);
         SallaService::update($product);
        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * upload image to storage.
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function uploadImg(Request $request)
    {
        $file = $request->file('image');
        $fileException = $file->getClientOriginalExtension();
        $fileName="img_".time().'.'.$fileException;
        $file->storeAs('public/images/',$fileName);
        return url('storage/images/'.$fileName);
    }
}
