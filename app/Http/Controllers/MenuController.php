<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        );

    }


    public function index(){
        return view('customer/menu')->with('initData' , $this->initData());
    }

    public function submitOrder(Request $request)
    {




//        return redirect('/menu')->with('initData' , $this->initData());

        return $request;
    }

    public function addNotes($id)
    {

        $item = DB::table('Items')->where('id' , '=' , $id)->get();

        return "<h1>$item</h1>";
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

}
