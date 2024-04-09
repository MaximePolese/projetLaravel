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
        $product->fill($request->validated());
        $shop = Auth::user()->shops()->find($request->shop_id);
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
        $product->fill($request->validated());
        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.'], 200);
    }

    public function filterBy(Request $request): Collection
    {
        $params = $request->input();
        $query = Product::query();
        foreach ($params as $key => $value) {
            $query->where($key, $value);
        }
        return $query->get();
    }

    public function sortBy(Request $request): Collection
    {
        $field = $request->input('field', null);
        $order = $request->input('order', null);

        // Validate the field and order
        $allowedFields = ['price', 'updated_at', 'stock_quantity'];
        $allowedOrders = ['asc', 'desc'];

        if (!in_array($field, $allowedFields) || !in_array($order, $allowedOrders)) {
            // You can choose to handle this error however you like
            throw new \InvalidArgumentException('Invalid field or order');
        }

        return Product::orderBy($field, $order)->get();
    }

    public function searchBy(Request $request): Collection
    {
        $searchTerm = $request->input('search_term', null);

        $query = Product::query();

        if ($searchTerm) {
            $fields = [
                'product_name',
                'description',
                'story',
                'material',
                'color',
                'size',
                'category',
            ];

            foreach ($fields as $field) {
                $query->orWhere($field, 'like', '%' . $searchTerm . '%');
            }
        }

        return $query->get();
    }
}
