<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return view('admin.foods.index', compact('foods'));
    }

    public function create()
    {
        return view('admin.foods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Food::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.foods.index')->with('success', 'Makanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.foods.edit', compact('food'));
    }

    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('image')) {
            if ($food->image && file_exists(public_path('images/' . $food->image))) {
                unlink(public_path('images/' . $food->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $food->image = $imageName;
        }

        $food->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $food->image,
        ]);

        return redirect()->route('admin.foods.index')->with('success', 'Makanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        if ($food->image && file_exists(public_path('images/' . $food->image))) {
            unlink(public_path('images/' . $food->image));
        }
        $food->delete();
        return redirect()->route('admin.foods.index')->with('success', 'Makanan berhasil dihapus.');
    }
}
