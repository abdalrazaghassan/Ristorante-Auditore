<?php

namespace App\Http\Controllers;

use App\SizeItem;
use Illuminate\Http\Request;
use App\Items as Items;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{

    public function dashboard(){

        return view('admin/manager')->with('InetialData' , $this->initData());

    }

    public function addItem(Request $request){

            $item = new Items;


            $item->name = $request->item_name;
            $item->cat  = $request->cats;
            $item->bio  = $request->item_bio;
            $item->save();

     return redirect('/manager')->with('InetialData' , $this->initData());

    }

    public function submitSizeAndPrice(Request $request)
    {
        $sizeItem = new SizeItem;

        $sizeItem->item_id = $request->itemId;
        $sizeItem->price = $request->item_price;
        $sizeItem->size = $request->size;

        $sizeItem->save();

        return redirect('/manager')->with('InetialData' , $this->initData());
    }

    private function initData(){
        $InetialData = array(
            'category'=> DB::table('Category')->get(),
            'dish'   => DB::table('Items')->get(),
            'users'   => DB::table('users')->get(),
            'Ingrediant' => DB::table('Ingrediant')->get(),
            'IngrediantHistory' => DB::table('IngrediantHistory')->get(),
            'OrderHistory' => $this->retriveOrdersFromWareHouseOrder(),
            'total_profit' => number_format($this->getTotalProfitOfAllOrder() , 2),
            'sizePriceItem' => $this->getItemsWithSizeAndPrice(),
        );

        return $InetialData;
    }

    public function deleteItem(Request $request){

        DB::table('Items')->where('id', '=',$request->dish)->delete();

        return redirect('/manager')->with('InetialData' , $this->initData());
    }



    public function deleteIngrediant(Request $request){

        DB::table('Ingrediant')->where('name', '=',$request->ingrediant_name)->delete();

    }

    public function improveIngrediant(Request $request){

        DB::table('IngrediantForSupplier')->insert(
            ['name' => $request->ingrediant_name  , 'quantity' => $request->amountIngrediant ]
        );

        $this->deleteIngrediant($request);

    }

    public function submitIngrediant(Request $request){

        switch ($request['submit']){

            case 'Approve Refill':
                  $this->improveIngrediant($request);
                break;
            default :
                $this->deleteIngrediant($request);
                break;
        }

        return redirect('/manager')->with('InetialData' , $this->initData());
    }

    public function deleteTable(Request $request){

        DB::table('users')->where('id', '=',$request->table)->delete();

        return view('admin/manager')->with('InetialData' , $this->initData());

    }

    public function addCategory(Request $request)
    {
        DB::table('Category')->insert(
            ['category' => $request->category_name]
        );

        return redirect('/manager')->with('InetialData' , $this->initData());
    }


    public function retriveOrdersFromWareHouseOrder()
    {

        return DB::table('OrdersHistory')
            ->join('Items', 'Items.id', '=', 'OrdersHistory.item_id')
            ->join('users', 'users.user_id', '=', 'OrdersHistory.user_id')
            ->select('Items.*','OrdersHistory.*','users.name as table_number')
            ->get();
    }

    private function getTotalProfitOfAllOrder()
    {
        return DB::table('OrdersHistory')
            ->join('Items', 'Items.id', '=', 'OrdersHistory.item_id')
            ->join('users', 'users.user_id', '=', 'OrdersHistory.user_id')
            ->join('SizeItem' , 'SizeItem.item_id' , '=' , 'OrdersHistory.item_id')
            ->select('Items.*','OrdersHistory.*', 'SizeItem.*' , 'users.name as table_number')->orderBy('created_at')
            ->sum('SizeItem.price');
    }

    private function getItemsWithSizeAndPrice(){

        return DB::table('SizeItem')
                 ->join('Items' , 'Items.id','=','SizeItem.item_id')->get();
    }

}
