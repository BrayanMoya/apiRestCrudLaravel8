<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Exception;
use Symfony\Component\Process\Process;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $products = Product::all()->toArray();
        return response()->json($products, 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return string
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->notes = $request->notes ?? 'N.A';
        $product->cost = $request->cost ?? 0;
        $product->stock = $request->stock ?? 0;

        $product->save();

        return response('Product saved', 200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return string
     * @throws \JsonException
     */
    public function show(Request $request)
    {
        try {
            $product = Product::findOrFail($request->id)->toArray();
        } catch (ModelNotFoundException $e) {
            return response('Product not found', 200)
                ->header('Content-Type', 'text/plain');
        }

        return response(json_encode($product, JSON_THROW_ON_ERROR), 200)
        ->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(UpdateProductRequest $request)
    {
        $product = Product::findOrFail($request->id);

        $product->notes = $request->notes;
        $product->cost = $request->cost;
        $product->stock = $request->stock;

        $product->save();


        return response('Product updated', 200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Request $request, Product $product)
    {
        Product::destroy($request->id);

        return response('Product deleted', 200)
            ->header('Content-Type', 'text/plain');
    }
}
