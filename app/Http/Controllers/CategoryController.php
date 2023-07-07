<?php

namespace App\Http\Controllers;

use App\Http\Requests\subTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\VendorRequest;
use App\Models\Category;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\Vendor;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //write me the CRUD logic for the Category model
    public function index() {
        $categories = Category::with('user')->where('user_id',auth()->user()->id)->get();
        return view('categories.index')->with([
            'categories' => $categories
        ]);
    }
    //write me the create and store logic for the Category model
    public function create() {
        return view('categories.create');
    }
    public function store(Request $request) {
        $category = new Category();
        $category->name = $request->get('name');
        $category->user_id = auth()->user()->id;
        $category->type = $request->get('type');
        $category->save();
        return redirect()->route('categories.index')->with('success','Category created successfully');
    }

    public function update(Request $request, Category $category) {
        $category->name = $request->get('name');
        $category->user_id = auth()->user()->id;
        $category->type = $request->get('type');
        $category->update();
        return redirect()->route('categories.index')->with('success','Category updated successfully');
    }
    //write me the delete logic for the Category model
    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category deleted successfully');
    }

}
