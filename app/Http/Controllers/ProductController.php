<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->paginate(15);
        return view('products.index', ['products' => $products]);
    }

    public function getProducts(): View
    {
        $products = DB::table('products')->paginate(15);
        return view('products.index', ['products' => $products]);
    }

    public function createProductPage()
    {
        $categories = DB::table('categories')->get();
        return view('products.create', ['categories' => $categories]);
    }

    public function createProduct(ProductRequest $request)
    {
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price ?? 0,
            'stock' => $request->stock ?? 0,
        ]);

        return redirect('/admin/products')->with('status', [
            'type' => 'success',
            'message' => 'Product successfully created'
        ]);
    }

    public function editProductPage($id)
    {
        $product = Product::where('id', $id)->get();
        $categories = DB::table('categories')->get();
        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function updateProduct(ProductRequest $request)
    {
        Product::find($request->id)->update($request->all());
        return redirect('/admin/products')->with('status', [
            'type' => 'success',
            'message' => 'Product successfully updated'
        ]);
    }

    public function deleteProduct($id)
    {
        DB::table('products')->delete($id);
        return back()->with('status', [
            'type' => 'success',
            'message' => 'Product successfully deleted'
        ]);
    }
}
