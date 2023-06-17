<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $users = DB::table('categories')->paginate(15);
        // return view('users.index', ['users' => $users]);
    }

    public function getCategories(): View
    {
        $categories = DB::table('categories')->paginate(15);
        return view('categories.index', ['categories' => $categories]);
    }

    public function createCategoryPage()
    {
        return view('categories.create');
    }

    public function createCategory(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
        ]);

        return redirect('/admin/categories')->with('status', [
            'type' => 'success',
            'message' => 'Category successfully created'
        ]);
    }

    public function editCategoryPage($id)
    {
        $category = Category::where('id', $id)->get();
        return view('categories.edit', ['category' => $category]);
    }

    public function updateCategory(CategoryRequest $request)
    {
        Category::find($request->id)->update($request->all());
        return redirect('/admin/categories')->with('status', [
            'type' => 'success',
            'message' => 'Category successfully updated'
        ]);
    }

    public function deleteCategory($id)
    {
        DB::table('categories')->delete($id);
        return back()->with('status', [
            'type' => 'success',
            'message' => 'Category successfully deleted'
        ]);
    }
}
