<?php

namespace App\Http\Controllers;

use App\Ingrediant;
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
            'Orders'=>DB::table('Orders')
                ->join('Items', 'Items.id', '=', 'Orders.item_id')
                ->join('users', 'users.id', '=', 'Orders.user_id')
                ->select('Items.*','Orders.*','users.name as table_number')->orderBy('table_number')
                ->get()
        );
    }

    public function confirmOrder($id){

        $order = DB::table('Orders')->where('id_order','=',$id)->get()
        ->join('users' , 'users.id'  , '=', 'Orders.user_id');

        DB::table('OrdersHistory')->insert(
            ['user_id' => $order->user_id , 'item_id' => $order->item_id , 'size' => $order->size ,
             'quantity' => $order->quantity , 'customize' => $order->customize]
        );

        DB::table('Orders')->where('id_order','=',$id)->delete();


        return view('kitchen/kitchen')->with('initData',$this->initData());
    }

    public function addIngrediant(Request $request){


        $itemName = DB::table('Items')->where('name','=',$request->item_name)
            ->pluck('name')->first();

        $ingrediant = new Ingrediant;

        $ingrediant->name = $itemName;
        $ingrediant->quantity = $request->amountIngrediant ;

        $ingrediant->save();

        return redirect('/kitchen')->with('initData',$this->initData());
    }
}
