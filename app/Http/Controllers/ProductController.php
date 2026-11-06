<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        // dd($request->file('images'));
        $validated = $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string|max:255',
            'slug'              => 'nullable|string|unique:products,slug,',
            'price'             => 'required|numeric',
            'price_art_cartoon' => 'nullable|numeric',
            'price_art_paper'   => 'nullable|numeric',
            'price_hvs'         => 'nullable|numeric',
            'price_doft'        => 'nullable|numeric',
            'price_glossy'      => 'nullable|numeric',
            'price_cutting'     => 'nullable|numeric',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',

            //validasi product image
            'images'            => 'nullable|array',
            'images.*'          => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'alt'               => 'nullable|array',
            'alt.*'             => 'nullable|string|max:255',
            
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        try {
            DB::beginTransaction();

            $arrImage = [];

            if ($request->file('images') && is_array($request->images)) {
                if (count($request->images) > 0) {
                    foreach ($request->file('images', []) as $key => $image) {
                        if ($request->hasFile('images.' . $key)) {
                            $path = $image->store('products', 'public');

                            $arrImage[] = [
                                'path' => $path,
                                'alt' => $request->alt[$key] ?? $validated['name'],
                                'sort_order' => $key
                            ];
                            
                        }
                    }
                }
            }

            $product = Product::create([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'price_art_paper' => $validated['price_art_paper'],
                'description' => $validated['description'],
                'short_description' => $validated['short_description'],
                'price_art_cartoon' => $validated['price_art_cartoon'],
                'price_hvs' => $validated['price_hvs'],
                'price_doft' => $validated['price_doft'],
                'price_glossy' => $validated['price_glossy'],
                'price_cutting' => $validated['price_cutting'],
                'price' => $validated['price'],
            ]);


            $product->images()->createMany($arrImage);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
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
    public function edit(Product $product)
    {
        $title = 'Edit Product || PPKD Sticker';
        $categories = Category::get();

        return view('admin.product.edit', compact('product', 'categories', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:60|unique:products,slug,' . $product->id,
            'price' => 'nullable|numeric|min:0',
            'price_art_cartoon' => 'nullable|numeric',
            'price_art_paper' => 'nullable|numeric',
            'price_hvs' => 'nullable|numeric',
            'price_doft' => 'nullable|numeric',
            'price_glossy' => 'nullable|numeric',
            'price_cutting' => 'nullable|numeric',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($validated);

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
