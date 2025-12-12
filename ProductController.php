<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // READ: Menampilkan semua produk
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    // CREATE: Form tambah produk (untuk view)
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // STORE: Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|max:255',
            'description' => 'nullable',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($request->only(['nama', 'description', 'price', 'category_id']));

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Product added successfully',
                'data' => $product
            ], 201);
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // READ: Menampilkan detail produk
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json($product);
        }

        return view('products.show', compact('product'));
    }

    // UPDATE: Form edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    // UPDATE: Update produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'        => 'required|max:255',
            'description' => 'nullable',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['nama', 'description', 'price', 'category_id']));

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Product updated successfully',
                'data' => $product
            ], 200);
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate.');
    }

    // DELETE: Hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Product deleted successfully'
            ], 200);
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}