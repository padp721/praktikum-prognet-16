<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Product_Categories;
use App\Product_Image;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user();
        $data_product = Product::get();
        return view('admin/Product/product', ['user'=>$user, 'data_product'=>$data_product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $categories = Product_Categories::get();
        return view('admin/Product/add_product', compact('user','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['price'] = filter_var($request->price, FILTER_SANITIZE_NUMBER_INT);

        $this->validate($request,[
            'price' => 'numeric|digits_between:1,7',
            'categories' => 'required',
            'stock' => 'numeric|digits_between:1,9',
            'weight' => 'numeric|digits_between:1,3',
            'image_name' => 'required',
            'image_name.*' => 'max:2048'

        ]);

        if ($request->price < 1) {
            return back()->with('fail','Price cannot be zero!');
        }
        if ($request->stock < 1) {
            return back()->with('fail','Stock cannot be zero!');
        }

        $product =  new Product();
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $product->product_rate = 0;
        $product->save();
        
        foreach ($request->categories as $category) {
            $product->categories()->attach($category);
        }

        if($request->hasfile('image_name')){
            $i = 0;

            $product_id = Product::select('id')->orderBy('id','DESC')->first();

            foreach ($request->file('image_name') as $image) {
                $folderName = 'product_image';
                $fileName = $product_id->id.'_'.$i;
                $fileExtension = $image->getClientOriginalExtension();
                $fileNameToStorage = $fileName.'_'.time().'.'.$fileExtension;
                $filePath = $image->storeAs('public/'.$folderName , $fileNameToStorage);

                $images = new Product_Image();
                $images->product_id = $product_id->id;
                $images->image_name = $fileNameToStorage;
                $images->save();

                $i++;
            }
        }
        return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $categories = Product_Categories::get();
        $product = Product::find($id);
        return view('admin/Product/edit_product', compact('user','categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['price'] = filter_var($request->price, FILTER_SANITIZE_NUMBER_INT);

        $this->validate($request,[
            'price' => 'numeric|digits_between:1,7',
            'categories' => 'required',
            'stock' => 'numeric|digits_between:1,9',
            'weight' => 'numeric|digits_between:1,3',
            'image_name.*' => 'max:2048'

        ]);

        if ($request->price < 1) {
            return back()->with('fail','Price cannot be zero!');
        }
        if ($request->stock < 1) {
            return back()->with('fail','Stock cannot be zero!');
        }

        $product =  Product::find($id);
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $product->save();

        $product->categories()->detach();
        
        foreach ($request->categories as $category) {
            $product->categories()->attach($category);
        }

        if($request->hasfile('image_name')){
            $i = 0;

            foreach ($request->file('image_name') as $image) {
                $folderName = 'product_image';
                $fileName = $id.'_'.$i;
                $fileExtension = $image->getClientOriginalExtension();
                $fileNameToStorage = $fileName.'_'.time().'.'.$fileExtension;
                $filePath = $image->storeAs('public/'.$folderName , $fileNameToStorage);

                $images = new Product_Image();
                $images->product_id = $id;
                $images->image_name = $fileNameToStorage;
                $images->save();

                $i++;
            }
        }
        return redirect('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $images = Product_Image::where('product_id',$id)->get();
        foreach ($images as $image) {
            Storage::delete('public/product_image/'.$image->image_name);
            $image->delete();
        }

        $product =  Product::find($id);
        $product->categories()->detach();
        $product->delete();
        return redirect('admin/product')->with('success','Product successfully deleted!');
    }

    public function imageDelete($id)
    {
        $image = Product_Image::find($id);
        Storage::delete('public/product_image/'.$image->image_name);
        $image->delete();
        return back()->with('success','Image successfully deleted!');
    }
}
