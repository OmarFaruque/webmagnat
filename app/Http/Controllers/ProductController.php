<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Taxonomy;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __invoke(Request $request){

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        $products = array_map(function($v){
            $v['attributes'] = array();
            if($v['origin']) array_push($v['attributes'], $v['origin']);
            if($v['size']) array_push($v['attributes'], $v['size']);
            if($v['color']) array_push($v['attributes'], $v['color']);
            $v['attributes'] = implode(', ', $v['attributes']);
            return $v;
        }, $products->toArray());

        return view('allproduct', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors     = Taxonomy::select('tax')->where('name', 'color')->orderBy('name')->get();
        $sizes      = Taxonomy::select('tax')->where('name', 'size')->orderBy('name')->get();
        $origins    = Taxonomy::select('tax')->where('name', 'origin')->orderBy('name')->get();

        
        return view('create', [
            'colors' => $colors, 
            'sizes' => $sizes, 
            'origins' => $origins
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:120', 
            'photo' => 'required|mimes:png,jpg|max:2048', 
            'price' => 'required'
        ]);

        $fileName = time().'.'.$request->photo->extension(); 
        $request->photo->move(public_path('uploads'), $fileName);

        $product = new Product([
            'name' => $request->name, 
            'color' => $request->color, 
            'size' => $request->size,
            'origin' => $request->origin, 
            'price' => $request->price, 
            'price_with_vat' => $request->price_with_vat,
            'photo' => $fileName
        ]);

        $product->save();

        return to_route('product.create');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        $colors     = Taxonomy::select('tax')->where('name', 'color')->orderBy('name')->get();
        $sizes      = Taxonomy::select('tax')->where('name', 'size')->orderBy('name')->get();
        $origins    = Taxonomy::select('tax')->where('name', 'origin')->orderBy('name')->get();

        return view('create', [
            'colors' => $colors, 
            'sizes' => $sizes, 
            'origins' => $origins, 
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        
        $request->validate([
            'name' => 'required|max:120', 
            'price' => 'required'
        ]);

        if($request->photo && !empty($request->photo)){
            $fileName = time().'.'.$request->photo->extension(); 
            $request->photo->move(public_path('uploads'), $fileName);
        }

        
        $product->name = $request->name;
        $product->color = $request->color; 
        $product->size = $request->size;
        $product->origin = $request->origin; 
        $product->price = $request->price;
        $product->price_with_vat = $request->price_with_vat;

        if(isset($fileName)){
            $product->photo = $fileName;
        }
        
        $product->save();
        return to_route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return to_route('product.index');
    }
}
