<?php
namespace App\Http\Controllers;

use App\Models\PlantCategory;
use Illuminate\Http\Request;

class PlantCategoryController extends Controller
{
    public function index()
    {
        $categories = PlantCategory::latest()->paginate(10);
        return view('plant-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('plant-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:plant_categories',
            'description' => 'nullable|string',
        ]);
        PlantCategory::create($request->all());
        return redirect()->route('plant-categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(PlantCategory $plantCategory)
    {
        return view('plant-categories.show', compact('plantCategory'));
    }

    public function edit(PlantCategory $plantCategory)
    {
        return view('plant-categories.edit', compact('plantCategory'));
    }

    public function update(Request $request, PlantCategory $plantCategory)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:plant_categories,category_name,' . $plantCategory->id,
            'description' => 'nullable|string',
        ]);
        $plantCategory->update($request->all());
        return redirect()->route('plant-categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(PlantCategory $plantCategory)
    {
        $plantCategory->delete();
        return redirect()->route('plant-categories.index')->with('success', 'Kategori berhasil dihapus (soft delete).');
    }
}