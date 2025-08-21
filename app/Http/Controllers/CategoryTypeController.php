<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryType;

class CategoryTypeController extends Controller
{
    public function index()
    {
        $types = CategoryType::with('user')->get();
        return view('category_types.index', compact('types'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all(); // إذا كان لديك جدول categories
        return view('category_types.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:categories_type,name',
        ]);

        CategoryType::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
        ]);

        return back()->with('success', 'Category type added successfully.');
    }

    public function edit($id)
    {
        $type = CategoryType::findOrFail($id);
        $types = CategoryType::with('user')->get();
        return view('category_types.index', compact('types', 'type'));
    }

    public function update(Request $request, $id)
    {
        $type = CategoryType::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories_type,name,' . $id,
        ]);

        $type->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category-types.index')->with('success', 'Category type updated successfully.');
    }

    public function destroy($id)
    {
        $type = CategoryType::findOrFail($id);
        
        // Check if this type is being used by any categories
        $categoriesCount = \App\Models\Category::where('type_id', $id)->count();
        
        if ($categoriesCount > 0) {
            return redirect()->route('category-types.index')->with('error', "Cannot delete this type. It is being used by {$categoriesCount} category(ies).");
        }

        $type->delete();

        return redirect()->route('category-types.index')->with('success', 'Category type deleted successfully.');
    }
}
