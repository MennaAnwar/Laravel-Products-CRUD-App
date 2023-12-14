<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
/*     public function __construct() {
        // auth for all except main page ad showing data
        //$this->middleware('auth')->except(['index','show']);
        //or
        // auth only for creating, editing or deleting
        $this->middleware('auth')->only(['store', 'create', 'edit','delete','update']);
    } */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products'))
                -> with ('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // to make sure all data is send : for viewing req. data
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);


        $input = $request->all();

        if ($image = $request->file('image')){
            $destinationPath = 'images/';
            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        Product::create($input);

        return redirect()->route('products.index')
                ->with('success','Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')){
            $destinationPath = '/images';
            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        } else{
            unset( $input['image'] );
        }

        $product->update($input);

        return redirect()->route('products.index')
                ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                ->with('success','Product deleted successfully');
    }
}
