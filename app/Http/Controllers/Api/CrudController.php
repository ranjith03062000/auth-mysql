<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMessages as Message;
use App\Models\Crud;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
     public function __construct()
    {

    }
    public function add_user(Request $request){
        $data    = $request->all();

        /* for this function data validation to user */
        $validation = Validator::make($data,[ 
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'whatsapp_number' => 'required'
        ]);
    
        /* If data valid any one field that will be return the fail message*/
        if($validation->fails()){
            return $validation->errors()->first();   
        }
        $insertData = array(
            "first_name"=>$request->first_name,
            "middle_name"=>$request->middle_name,
            "last_name"=>$request->last_name,
            "father_name"=>$request->father_name,
            "mother_name"=>$request->mother_name,
            "email"=>$request->email,
            "phone_number"=>$request->phone_number,
            "whatsapp_number"=>$request->whatsapp_number
        );
        $insert = Crud::insert($insertData);
        if($insert){
            return response()->json(["status"=>true,"data"=>[],"messages"=>"Your Data Insert SuccessFully"]);
        }else{
            return response()->json(["status"=>False,"data"=>[],"messages"=>"Your Record Insert Failed"]);
        }
    }
    public function get_user(Request $request){
        $data = Crud::all();
        return response()->json(["status"=>true,"messages"=>"","data"=>$data]);
    }
    public function edit_user(Request $request){
       $editUser = DB::table('user')->where('id',$request->id)->get();
       return response()->json(["status"=>true,"messages"=>"","data"=>$editUser]);
    }
    public function update_user(Request $request){
        $data    = $request->all();

        /* for this function data validation to user */
        $validation = Validator::make($data,[ 
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'whatsapp_number' => 'required'
        ]);
    
        /* If data valid any one field that will be return the fail message*/
        if($validation->fails()){
            return $validation->errors()->first();   
        }
        $updateData = array(
            "first_name"=>$request->first_name,
            "middle_name"=>$request->middle_name,
            "last_name"=>$request->last_name,
            "father_name"=>$request->father_name,
            "mother_name"=>$request->mother_name,
            "email"=>$request->email,
            "phone_number"=>$request->phone_number,
            "whatsapp_number"=>$request->whatsapp_number
        );
        $update = Crud::where('id',$request->id)->update($updateData);
        if($update){
            return response()->json(["status"=>true,"data"=>[],"messages"=>"Your Data Updated SuccessFully"]);
        }else{
            return response()->json(["status"=>False,"data"=>[],"messages"=>"Your Record Updated Failed"]);
        }

    }
    public function delete_user(Request $request){
        $delete = Crud::where('id',$request->id)->delete();
        if($delete){
            return response()->json(["status"=>true,"data"=>[],"messages"=>"Your Record Deleted SuccessFully"]);
        }else{
            return response()->json(["status"=>False,"data"=>[],"messages"=>"Your Record Deleted Failed"]);
        }
    }


	
}
