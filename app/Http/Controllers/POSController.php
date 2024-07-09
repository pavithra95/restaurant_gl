<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\POS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(POS $pOS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(POS $pOS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, POS $pOS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(POS $pOS)
    {
        //
    }

    public function insertNewRecord(Request $request){
        // dd($request->all());
        // $orderId = $request->input('orderId');
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
        $cus = new Customer();
        $cus->customer_name = $request->input('customerName');
        $cus->customer_mobile = $request->input('customerPhone');
        $cus->order_id = $request->input('orderId');
        $cus->save();

        $order = Order::find( $cus->order_id);
        $order->status = 'closed';
        $order->save();

        return response()->json(['success' => true]);

        // $total = OrderDetails::where('order_id',$orderId)->where('status','kot')->get();
        // $total_price = $total->sum('total_price');
        // $order = Order::find($orderId);
        // // dd($orderId);
        // $pp = POS::where('order_id',$order->id)->delete();
        // $pos = new POS();
        // $pos->order_id = $orderId;
        // $pos->invoice_no = POS::generatePOS();
        // $pos->invoice_date = date('Y-m-d');
        // $pos->total_amount = $total_price;
        // $pos->save();
    }
    public function CustomerStore(Request $request,$id){
    //    dd($request->all());
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
        $cus = new Customer();
        $cus->customer_name = $request->customer_name;
        $cus->customer_mobile = $request->customer_mobile;
        $cus->order_id = $request->order_id;
        $cus->save();

        $pos = POS::where('order_id',$cus->order_id)->first();
        $pos->customer_id =  $cus->id;
        $pos->save();
         return redirect()->back();
    }
}
