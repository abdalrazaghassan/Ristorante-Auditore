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
            'sides' => DB::table('Siddes')->get(),
            'SizeItem' => DB::table('SizeItem')->get(),
        );

    }

    public function index(){
        return view('customer/menu')->with('initData' , $this->initData());
    }

    public function submitOrder(Request $request)
    {

        return redirect('/menu')->with('initData' , $this->initData());
    }
}
