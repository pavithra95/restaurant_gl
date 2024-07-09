<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
        $items= Category::all();
        return view('category.index')->with(compact('items'));
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
        return view('category.create');
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
        $item = new Category();
        $item->category_name = $request->name;
        $item->status = $request->status;
        $item->save();

        return redirect('/category');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
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
        $item = Category::find($id);
        return view('category.edit')->with(compact('item'));
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
        $item = Category::find($id);
        $item->category_name = $request->name;
        $item->status = $request->status;
        $item->save();

        return redirect('/category');
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
        $item = Category::find($id);
        $item->delete();
        return redirect()->back();
    }
}
