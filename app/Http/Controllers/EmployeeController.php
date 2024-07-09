<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
        $items = Employee::all();
        return view('employee.index')->with(compact('items'));
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
        return view('employee.create');
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
        $employee = new Employee();
        $employee->emp_name = $request->emp_name;
        $employee->mobile = $request->mobile;
        $employee->designation = $request->designation;
        $employee->save();

        return redirect('/employees');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
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
       $item = Employee::find($id);
       return view('employee.edit')->with(compact('item'));
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
        $item = Employee::find($id);
        $item->emp_name = $request->emp_name;
        $item->mobile = $request->mobile;
        $item->designation = $request->designation;
        $item->save();

        return redirect('/employees');
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
        $item = Employee::find($id);
        $item->delete();

        return redirect()->back();
    }
}
