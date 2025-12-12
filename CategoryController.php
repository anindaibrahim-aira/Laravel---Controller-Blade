<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // READ: Menampilkan semua kategori
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // CREATE: Form tambah kategori (untuk view)
    public function create()
    {
        return view('categories.create');
    }

    // STORE: Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255'
        ]);

        $category = Category::create(['nama' => $request->nama]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Category added successfully',
                'data' => $category
            ], 201);
        }

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // READ: Menampilkan detail kategori
    public function show($id)
    {
        $category = Category::findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json(['data' => $category]);
        }

        return view('categories.show', compact('category'));
    }

    // UPDATE: Form edit kategori (untuk view)
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // UPDATE: Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255'
        ]);

        $category = Category::findOrFail($id);
        $category->update(['nama' => $request->nama]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Category updated successfully',
                'data' => $category
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    // DELETE: Hapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Category deleted successfully'
            ], 200);
        }

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}