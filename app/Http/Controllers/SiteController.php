<?php

namespace App\Http\Controllers;
use App\SiteInformation;
use App\ECInformation;
use Illuminate\Http\Request; 
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function store(Request $request)
    {
        $validater = Validator::make($request->all(),[ 
            'clinic_name'=>'required|string', 
            'telephone'=>'required|numeric|max:9' , 
            'email'=>'required|string|email' , 
            'website'=>'required|string' , 
            'ec_available'=>'required|string' , 
            'streetaddress'=>'required|string' , 
            'city'=>'required|string' , 
            'state'=>'required|string' , 
            'pincode'=>'required|numeric|max:6',
            'accept'=>'required|string'
        ]);      
        
        if(!$validater->fails()) {
            $info = new SiteInformation([
                'clinic_name'=>$request->clinic_name, 
                'telephone'=>$request->telephone, 
                'email'=>$request->email, 
                'website'=>$request->website, 
                'ec_available'=>$request->ec_available, 
                'streetaddress'=>$request->streetaddress, 
                'city'=>$request->city, 
                'state'=>$request->state, 
                'pincode'=>$request->pincode, 
                'accept'=>$request->accept, 
            ]);        
            $info->save();        
            return response()->json([
                'message' => 'Successfully created site information!',
                'status' => 'success'
            ], 201);
        } else {
            return response()->json([
                'message' => implode(" ", $validater->errors()->all()),
                'status'  => 'fails'
            ], 422);
        }
    }

    public function store_ethics(Request $request)
    {
        $validater = Validator::make($request->all(), [ 
            'name'=>'required|string',
            'telephone'=>'required|numeric|max:9',
            'email'=>'required|string',
            'website'=>'required|string',
            'is_ecno_available'=>'required|string',
            'streetaddress'=>'required|string',
            'city'=>'required|string',
            'state'=>'required|string',
            'pincode'=>'required|numeric|max:6',
            'ec_reg_no'=>'required|numeric', 
        ]);  
        
        if(!$validater->fails()) {
            $info = new ECInformation ([
                'name'=>$request->name, 
                'telephone'=>$request->telephone, 
                'email'=>$request->email, 
                'website'=>$request->website, 
                'is_ecno_available'=>$request->is_ecno_available, 
                'streetaddress'=>$request->streetaddress, 
                'city'=>$request->city, 
                'state'=>$request->state, 
                'pincode'=>$request->pincode, 
                'ec_reg_no'=>$request->ec_reg_no, 
    
            ]);        
            $info->save();        
            return response()->json([
                'message' => 'Successfully created ethics information!',
                'status' => 'success'
            ], 201);
        } else {
            return response()->json([
                'message' => implode(" ", $validater->errors()->all()),
                'status'  => 'fails'
            ], 422);
        }
    }

    public function getData(){

         $users = DB::select('select * from site_information');

         return response()->json(
                [
                    'status' => 'success',
                    $users,
                ]
         );
 
    }

    public function updateData(Request $request ){

        $message = "success" ;
  
        if($request -> input('accept') == "YES") {
            $message = "Site accepted successfully!";
        }      

        if($request -> input('accept') == "NO") {
            $message = "Site rejected successfully!";
        }      

         $acc =  $request -> input('accept');
         $id =  $request -> input('id');


         DB::update('update site_information set accept = ? where id = ?',[$acc,$id]);

         return response()->json([
             'status' => 'success',
             "message" => $message
            ]
         );
    }

}
