<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $items = Product::all();
        return view('product.index')->with(compact('items'));
    }
    public function getProducts()
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $billingItems = Product::where('availablity_status','available')->get();
        return response()->json($billingItems);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $category = Category::all();
        return view('product.create')->with(compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $item = new Product();
        $item->product_name = $request->product_name;
        $item->category_id = $request->category_id;
        $item->actual_price = $request->actual_price;
        $item->tax_rate = $request->tax_rate;
        $item->unit = $request->unit;
        $item->availablity_status = $request->availablity_status;
        $item->preparation_time = $request->preparation_time;
        $item->discount = $request->discount;
        $item->available_qty = $request->available_qty;
        $item->minimum_qty = $request->minimum_qty;
        $item->final_price = $request->final_price;
        $item->description = $request->description;
        $item->save();

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $item = Product::find($id);
        $category = Category::all();
        return view('product.show')->with(compact('item','category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $item = Product::find($id);
        $category = Category::all();
        return view('product.edit')->with(compact('item','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $item = Product::find($id);
        $item->product_name = $request->product_name;
        $item->category_id = $request->category_id;
        $item->actual_price = $request->actual_price;
        $item->tax_rate = $request->tax_rate;
        $item->unit = $request->unit;
        $item->availablity_status = $request->availablity_status;
        $item->preparation_time = $request->preparation_time;
        $item->discount = $request->discount;
        $item->available_qty = $request->available_qty;
        $item->minimum_qty = $request->minimum_qty;
        $item->final_price = $request->final_price;
        $item->description = $request->description;
        $item->save();

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $item = Product::find($id);
        $item->delete();

        return redirect()->back();
    }
}
