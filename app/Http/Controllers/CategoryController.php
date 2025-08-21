<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Address;

class CategoryController extends Controller
{
    // عرض الفورم لإضافة فئة
    public function create()
    {
        $types = CategoryType::all(); // جلب أنواع الفئات للقائمة المنسدلة
        return view('categories.create', compact('types'));
    }

    // حفظ الفئة الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:categories_type,id',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::id(),
            'type_id' => $request->type_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    // عرض الفئات الخاصة بالمستخدم الحالي
    public function index()
    {
        $categories = Category::with('type')->get();
        $types = CategoryType::all();
        return view('categories.index', compact('categories', 'types'));
    }

    public function edit($id)
    {
        // For modal-based editing, we don't need a separate edit view
        // The edit functionality is handled via JavaScript modals
        return redirect()->route('categories.index');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:categories_type,id',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // You can add additional checks here if needed
        // For example, check if the category is being used by any tickets
        
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    // حفظ عنوان جديد للمستخدم
    public function storeAddress(Request $request)
    {
        $request->validate([
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'building_number' => 'nullable|string|max:20',
            'details' => 'nullable|string',
        ]);

        Address::create([
            'user_id' => Auth::id(),
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
            'postal_code' => $request->postal_code,
            'building_number' => $request->building_number,
            'details' => $request->details,
        ]);

        return redirect()->back()->with('success', 'تم حفظ العنوان بنجاح');
    }
}