<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function listFood(){
        $data = [
            // 'foods' => Food::with('category')->get(),
            'categories' => Category::get(),
            'foods' => Food::get()
        ];
        return view('food.list', $data);
    }

    public function viewFood($id){
        $data = [
            'category' => Category::get(),
            'food' => Food::find($id)
        ];
        return view('food.view', $data);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'categories' => Category::get(),
            'foods' =>Food::latest()->paginate(10)
        ];
        return view('food.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'categories' => Category::get()
        ];
        return view('food.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        if($image = $request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationParth = public_path('/image');
            $image->move($destinationParth, $name);
            Food::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category,
                'image'=>$name 
            ]);
        }else{
            Food::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category,
            ]);
        }
        return back()->with('message', 'Food Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'food' => Food::find($id),
            'categories' => Category::get()
        ];
        return view('food.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $food = Food::find($id);
        $name = $food->image;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationParth = public_path('/image');
            $image->move($destinationParth, $name);
        }
        $food->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category,
            'image'=>$name
        ]);
        return back()->with('message', 'Food Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $food = Food::find($id);
        $food->delete();
        return back()->with('message', 'Food Deleted Successfully');
    }

    public function deleteImage(Request $request, $id)
    {
        $food = Food::find($id);
        dd($food);
        if($food->image){
            $image = $request->file('image');
            $destinationParth = public_path('/image');
            $image->move($destinationParth, $name);
        }
        return back()->with('message', 'Image Deleted Successfully');
    }
    
}