<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

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
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('foods', 'public');
        }

        Food::create($data);
        return redirect()->route('foods.index')->with('success', 'Makanan ditambahkan!');
    }

    public function edit(Food $food)
    {
        return view('admin.foods.edit', compact('food'));
    }

    public function update(Request $request, Food $food)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('foods', 'public');
        }

        $food->update($data);
        return redirect()->route('foods.index')->with('success', 'Makanan diperbarui!');
    }

    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('foods.index')->with('success', 'Makanan dihapus!');
    }
}
