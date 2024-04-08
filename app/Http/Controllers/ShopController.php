<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Shop::all();
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
    public function store(StoreShopRequest $request): Shop
    {
        $shop = new Shop();
        $shop->shop_name = $request->shop_name;
        $shop->shop_theme = $request->shop_theme;
        $shop->biography = $request->biography;
        $shop->save();
//        $user = Auth::user();
//        $user->shops()->save($shop);
        return $shop;
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop): Shop
    {
        return $shop;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop): Shop
    {
        $shop->shop_name = $request->shop_name;
        $shop->shop_theme = $request->shop_theme;
        $shop->biography = $request->biography;
        $shop->updated_at = now();
        $shop->save();
        return $shop;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop): JsonResponse
    {
        $shop->delete();
        return response()->json(['message' => 'Product deleted successfully.'], 200);
    }
}
