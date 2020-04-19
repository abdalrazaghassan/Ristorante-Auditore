<?php

namespace App\Http\Controllers;

use App\Ingrediant;
use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\choose_handler;


class KitchenController extends Controller
{
    public function index(){

        return view('kitchen/kitchen')->with('initData',$this->initData());
    }

    private function initData()
    {
        return array(
            'ITEMS'=>DB::table('Items')->get(),
            'Orders'=>DB::table('orders')
                ->join('Items', 'Items.id', '=', 'orders.item_id')
                ->join('users', 'users.user_id', '=', 'orders.user_id')
                ->join('SizeItem' , 'SizeItem.price_size_id' , '=' , 'orders.price_size_id')
                ->select('Items.*','orders.*', 'SizeItem.*' ,'users.name as table_number')->orderBy('table_number')
                ->get(),
            'Ingrediant' => DB::table('Ingrediant')->get()
        );
    }

    public function confirmOrder($id){

        $order = Orders::find($id);
//
        DB::table('OrdersHistory')->insert(
            ['user_id' => $order->user_id , 'item_id' => $order->item_id , 'id_price_size' => $order->price_size_id ,
                'quantity' => $order->quantity  , 'customize' => $order->customize]
        );


        DB::table('orders')->where('id_order','=',$id)->delete();

        return view('kitchen/kitchen')->with('initData',$this->initData());
    }

    public function addIngrediant(Request $request){


        $ingrediant = new Ingrediant;

        $ingrediant->name = $request->item_name;
        $ingrediant->quantity = $request->quantity ;

        $ingrediant->save();

        return redirect('/kitchen')->with('initData',$this->initData());
    }

    public function removeIngrediant($id)
    {
        DB::table('Ingrediant')->where('id','=',$id)->delete();

        return redirect('/kitchen')->with('initData',$this->initData());
    }



}
