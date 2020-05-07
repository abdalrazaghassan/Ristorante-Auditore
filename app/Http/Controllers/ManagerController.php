<?php

namespace App\Http\Controllers;

use App\SizeItem;
use App\User;
use Illuminate\Http\Request;
use App\Items as Items;
use App\Offers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            if ($request->hasFile('item_pic'))
            {
                $imgWithExtentin = $request->file('item_pic')->getClientOriginalName();
                $fileName = pathinfo($imgWithExtentin,PATHINFO_FILENAME);
                $extetion = $request->file('item_pic')->getClientOriginalExtension();
                $fileNameStore = $fileName.'_'.time().'.'.$extetion;
                $path = $request->file('item_pic')->storeAs('public/Images',$fileNameStore);
            }
            else
            {
                $fileNameStore = "no Image"."jpg";
            }
            $item->item_img = $fileNameStore;
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
            'getAllOffers' => $this->getAllOffers(),
            'suppliers' => $this->gettAllSuppliers(),
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

        DB::table('users')->where('user_id', '=',$request->table)->delete();

        return view('admin/manager')->with('InetialData' , $this->initData());

    }

    public function addCategory(Request $request)
    {
        DB::table('Category')->insert(
            ['category' => $request->category_name]
        );

        return redirect('/manager')->with('InetialData' , $this->initData());
    }


    private function retriveOrdersFromWareHouseOrder()
    {

      return  DB::select("SELECT OrdersHistory.* , SizeItem.* , Items.* , users.name as table_name 
        FROM `OrdersHistory` JOIN Items ON Items.id = OrdersHistory.item_id 
        JOIN users ON users.user_id = OrdersHistory.user_id 
        JOIN SizeItem ON SizeItem.price_size_id = OrdersHistory.id_price_size "
      );
    }

    private function getTotalProfitOfAllOrder()
    {
        return DB::table('OrdersHistory')
            ->join('Items', 'Items.id', '=', 'OrdersHistory.item_id')
            ->join('users', 'users.user_id', '=', 'OrdersHistory.user_id')
            ->join('SizeItem' , 'SizeItem.price_size_id' , '=' , 'OrdersHistory.id_price_size')
            ->select('Items.*','OrdersHistory.*', 'SizeItem.*' , 'users.name as table_number')->orderBy('created_at')
            ->sum('SizeItem.price');
    }

    private function getItemsWithSizeAndPrice(){

        return DB::table('SizeItem')
                 ->join('Items' , 'Items.id','=','SizeItem.item_id')->get();
    }

    public function addOffers(Request $request)
    {

        $item = Items::where('id', $request->offerItem)
                ->first();

        $offer = new Offers;
        $offer->id_item = $item->id;
        $offer->size = $request->sizeDish;
        $offer->discount = $request->amountDiscount;

        $offer->save();

        return redirect('/manager')->with('InetialData' , $this->initData());
    }

    public function removeOffer($id)
    {
        Offers::find($id)->delete();

        return redirect('/manager')->with('InetialData' , $this->initData());
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

    private function gettAllSuppliers()
    {
        return DB::table('suppliers')->get();
    }

    public function addTable(Request $request)
    {

        $table = new User;

        $table->name = $request['nameTable'];
        $table->username = $request['table_name'];
        $table->password = Hash::make($request['table_pass']);
        $table->save();


        return redirect('/manager')->with('InetialData' , $this->initData());
    }
}
