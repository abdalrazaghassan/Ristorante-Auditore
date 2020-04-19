<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{

    private function initData(){

        return DB::table('suppliers')->get();
    }

    public function Dashboard()
    {
        return view('admin/addDeleteSupplier')->with('supplier',$this->initData());
    }

    public function addSupplier(Request $request)
    {

        $supplier = new Supplier;

        $supplier->id = $supplier->getAttribute('id');
        $supplier->name = $request->name;
        $supplier->password  = Hash::make($request->password);

        $supplier->save();

        DB::table('Supplier_Adress')->insert(
            ['id_sup' => $supplier->id,
             'address' => $request->address  ]
        );

        DB::table('Supplier_number_phone')->insert(
            ['id_sup' => $supplier->id , 'phoneNumber' => $request->phoneNumber]
        );

        return view('admin/addDeleteSupplier')->with('supplier',$this->initData());
    }

    public function deleteSupplier(Request $request)
    {
        DB::table('suppliers')
            ->where('id','=',$request->supplier)->delete();

        return view('admin/addDeleteSupplier')->with('supplier',$this->initData());
    }

}
