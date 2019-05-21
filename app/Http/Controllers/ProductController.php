<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{


    public function _construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    public function index()
    {
        return ProductCollection::collection(Product::paginate(20));
    }

    public function create()
    {

    }


    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->save();
        return response([
            'data' => new ProductResource($product)
        ],201);
    }

    public function show(Product $product)
    {

        return new ProductResource($product);
    }


    public function edit(Product $product)
    {

    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->save();
        return response($product,201);

    }


    public function destroy(Product $product)
    {
         $product->delete();
         return response(
              null
         ,201);

    }
}
