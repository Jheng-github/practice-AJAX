<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);

        // return view('products', [
        //     'products' => $products,
        // ]);
        return view('products', compact('products'));
    }

    public function store(Request $request)
    {   

            $this->validate($request, [
            'name' => ['required', 'unique:products'],
            'price' => ['required']
            ]);

            Product::create([
                'name' => $request->name,
                'price' => $request->price,
            ]);

            
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function update(Request $request)
    {   

            $this->validate($request, [
            'name' => ['required', 'unique:products'],
            'price' => ['required']
            ]);

            Product::where('id', $request->id)->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);

            
        return response()->json([
            'status' => 'success',
        ]);
    }
    
    public function delete(Request $request)
    {
        Product::find($request->id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function search(Request $request){
        $products = Product::where('name', 'like' , '%'.$request->search.'%')->orderBy('id','desc')->paginate(5);

        if($products->count() >= 1){
            return view('pagination_product', compact('products'));
        }else{
            return response()->json([
                'status' => 'nothing found',
            ]);
        }
    }
}
