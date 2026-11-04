<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Product Management || PPKD Sticker";
        $products = Product::with('category')->get();
        return view("admin.product.index", compact("title", "products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Product || PPKD Sticker";
        $categories = Category::get();
        return view("admin.product.create", compact("title", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "category_id" => "required|exists:categories,id",
            "image"=> "nullable|image|mimes:png,jpg,jpeg,gif|max:2048",
            "name" => "required|string|max:255",
            "slug"=> "nullable|string|unique:products,slug",
            "price_art_cartoon"=> "nullable|integer|min:0",
            "price_art_paper"=> "nullable|integer|min:0",
            "price_hvs"=> "nullable|integer|min:0",
            "price_doft"=> "nullable|integer|min:0",
            "price_glossy"=> "nullable|integer|min:0",
            "price_cutting"=> "nullable|integer|min:0",
            "short_description"=> "nullable|string",
            "description"=> "nullable|string",
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        return redirect()->route('admin.product.index')
            ->with('success', 'Produk has been created successfully.');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ($request-> hasFile('image')) {
            Storage::disk('public')->delete($product->image);
        }

        $validate['image'] = $request->file('image')->store('products', 'public');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
