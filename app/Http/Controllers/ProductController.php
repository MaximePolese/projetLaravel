<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): Product
    {
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->story = $request->story;
        $product->image = $request->image;
        $product->material = $request->material;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $shop = Auth::user()->shops()->first();
        $shop->products()->save($product);
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Product
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): Product
    {
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->story = $request->story;
        $product->image = $request->image;
        $product->material = $request->material;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->updated_at = now();
        $product->save();
        return $product;
    }

    public function filterBy(Request $request): Collection
    {
        $category = $request->input('category', null);
        $color = $request->input('color', null);
        $size = $request->input('size', null);
        $material = $request->input('material', null);
        $shop_id = $request->input('shop_id', null);

        $query = Product::query();

        if ($category) {
            $query->where('category', $category);
        }

        if ($color) {
            $query->where('color', $color);
        }

        if ($size) {
            $query->where('size', $size);
        }

        if ($material) {
            $query->where('material', $material);
        }

        if ($shop_id) {
            $query->where('shop_id', $shop_id);
        }

        return $query->get();
    }

    public function sortBy(Request $request): Collection
    {
        $field = $request->input('field', 'price'); // Default to 'price' if no field is provided
        $order = $request->input('order', 'asc'); // Default to 'asc' if no order is provided

        // Validate the field and order
        $allowedFields = ['price', 'updated_at', 'stock_quantity'];
        $allowedOrders = ['asc', 'desc'];

        if (!in_array($field, $allowedFields) || !in_array($order, $allowedOrders)) {
            // You can choose to handle this error however you like
            throw new \InvalidArgumentException('Invalid field or order');
        }

        return Product::orderBy($field, $order)->get();
    }

    public function searchByProductName($productName): Collection
    {
        return Product::where('product_name', 'like', '%' . $productName . '%')->get();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.'], 200);
    }
}
