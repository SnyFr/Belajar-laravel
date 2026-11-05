<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Product Management || PPKD Sticker';
        $products = Product::with('category')->get();

        return view('admin.product.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Product || PPKD Sticker';
        $categories = Category::get();

        return view('admin.product.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'image'             => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'name'              => 'required|string|max:255',
            'slug'              => 'nullable|string|unique:products,slug,',
            'price'             => 'nullable|integer|min:0',
            'price_art_cartoon' => 'nullable|integer|min:0',
            'price_art_paper'   => 'nullable|integer|min:0',
            'price_hvs'         => 'nullable|integer|min:0',
            'price_doft'        => 'nullable|integer|min:0',
            'price_glossy'      => 'nullable|integer|min:0',
            'price_cutting'     => 'nullable|integer|min:0',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',

            //validasi product image
            'images'            => 'nullable|array',
            'images.*'          => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            'alt'               => 'nullable|array',
            'alt.*'             => 'nullable|string|max:255',
            
        ]);

        //product, product image
        //transaction
        DB::transaction(function () use ($request, $validated) {
            $product = Product::create([
                'category_id'=> $validated['category_id'],
                'name' => $validated['name'],
            ]);

            if ($request->hasFile('images')) {
            $imageData = [];

                foreach ($request->file('images') as $key => $file) {
                    $path = $file->store('products', 'public');
                    
                    $imageData[] = [
                        'path' => $path,
                        'alt' => $request->input('alt.{$key}') ?? $product->name,
                        'sort_order' => $key + 1,
                        ];
                    }
                    $product->images()->createMany($imageData);
                }
        });


        $validated['slug'] = $request->filled('slug')
        ? Str::slug($request->slug)
        : Str::slug($request->name);

        

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
    public function edit(Product $product)
    {
        $title = 'Edit Product || PPKD Sticker';
        $categories = Category::get();

        return view('admin.product.edit', compact('product', 'categories', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:60', Rule::unique('products', 'slug')->ignore($product->id)],
            'price' => 'nullable|numeric|min:0',
            'price_art_cartoon' => 'nullable|integer|min:0',
            'price_art_paper' => 'nullable|integer|min:0',
            'price_hvs' => 'nullable|integer|min:0',
            'price_doft' => 'nullable|integer|min:0',
            'price_glossy' => 'nullable|integer|min:0',
            'price_cutting' => 'nullable|integer|min:0',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->forceFill([
            'category_id' => $validated['category_id'],
            'image' => $validated['image'] ?? $product->image,
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'price' => $validated['price'] ?? 0,
            'price_art_cartoon' => $validated['price_art_cartoon'] ?? 0,
            'price_art_paper' => $validated['price_art_paper'] ?? 0,
            'price_hvs' => $validated['price_hvs'] ?? 0,
            'price_doft' => $validated['price_doft'] ?? 0,
            'price_glossy' => $validated['price_glossy'] ?? 0,
            'price_cutting' => $validated['price_cutting'] ?? 0,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.product.index')
            ->with('success', 'Product has been deleted successfully.');
    }
}
