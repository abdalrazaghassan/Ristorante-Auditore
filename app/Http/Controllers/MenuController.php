<?php

namespace App\Http\Controllers;

use App\Carts;
use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{

    private function initData(){

        return array(
            'Entrees' => DB::table('Items')->where('cat' , '=' , 'Entrees')->get(),
            'Main Dishes' => DB::table('Items')->where('cat', '=' , 'Main Dishes')->get(),
            'Side Dishes' => DB::table('Items')->where('cat' , '=' , 'Side Dishes')->get(),
            'offers' => $this->getAllOffers(),
            'SizeItem' => DB::table('SizeItem')->get(),
            'Carts' => $this->getOrdersFromCarts(),
        );

    }


    public function index(){
        return view('customer/menu')->with('initData' , $this->initData());
    }

    public function submitOrder(Request $request)
    {

        $order = new Carts;

        $order->item_id = $request->id_order;
        $order->user_id = session('table');
        $order->price_size_id = $request['pizzaSize'];
        $order->quantity = $request['amountInput'];
        $order->customize = $request['bioOrder'];

        $order->save();


       return redirect('/menu')->with('initData' , $this->initData());

//       return $request;
    }

    public function addNotes($id)
    {

        $item = DB::table('Items')->where('id' , '=' , $id)->get();

        return "<h1>$item</h1>";
    }

    public function removeOrderFromCart($cartOrder_id)
    {

        DB::table('Carts')->where('cartOrder_id','=',$cartOrder_id)->delete();

        return redirect('/menu')->with('initData' , $this->initData());
    }

    private function getAllOffers()
    {
        return
            $offer = DB::table('Offers')
                ->join('Items','Items.id','=','Offers.id_item')
                ->join('SizeItem',function ($join){
                    $join->on('SizeItem.item_id','=','Offers.id_item')
                        ->on('SizeItem.size','=','Offers.size');
                })->get();
    }

    private function getOrdersFromCarts()
    {
       return DB::table('Carts')
           ->where('user_id','=',session('table'))
           ->join('Items','Items.id','=','Carts.item_id')
           ->join('SizeItem','SizeItem.price_size_id','=','Carts.price_size_id')
           ->get();
    }

    private function clearCarts()
    {
        DB::table('Carts')->delete();
    }

    public function ConfirmOrderAndTransfer(Request $request)
    {
        $orderInCarts = DB::table('Carts')->get();

        foreach ($orderInCarts as $order)
        {
            $singleOrder = new Orders;
            $singleOrder->item_id =  $order->item_id;
            $singleOrder->price_size_id =  $order->price_size_id;
            $singleOrder->quantity =  $order->quantity;
            $singleOrder->customize =  $order->customize;
            $singleOrder->user_id =  $order->user_id;
            $singleOrder->save();
//            DB::table('orders')->insert(
//                [
//                 'item_id'  => $order->item_id,
//                 'price_size_id' => $order->price_size_id,
//                 'quantity'      => $order->quantity,
//                 'customize'     => $order->customize,
//                 'created_at'    => \Carbon\Carbon::now()->toDateTimeString(),
//                 'updated_at'    => \Carbon\Carbon::now()->toDateTimeString(),
//                 'user_id ' => $order->user_id,
//                ]
//            );
        }

        $this->clearCarts();

        return redirect('/menu')->with('initData' , $this->initData());
    }

}
