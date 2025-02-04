<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegisterResource;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        $register=Register::get();
        if($register->count()>0)
        {
            return RegisterResource::collection($register);
        }
        else
        {
            return response()->json(['message'=>"No Data Found..!!"]);
        }
    }
    public function store(Request $request)
    {
      
        $register=Register::create(['name'=>$request->name,
            'email'=>$request->email,
        'password'=>$request->password,
    'c_password'=>$request->c_password]);
        return response()->json(['msg'=>"Created....!",'data'=>new RegisterResource($register)]);
        $validator=Validator::make($request->all(),['email','password']);
        if($validator->fails())
        {
            return response()->json(['error'=>"All fields are required..!"]);
        }
    }
    public function show(Register $register)
    {
        $register=Register::find($register->id);
        return response()->json(['data'=>new RegisterResource($register)]);
    }
    public function update(Register $register,Request $request)
    {
        $validator=Validator::make($request->all(),['name'=>$request->name,
            'email'=>$request->email,
        'password'=>$request->password,
    'c_password'=>$request->c_password]);
        if($validator->fails())
        {
            return response()->json(['error'=>"All Fields Are Required..!"]);
        }
        $register->update(['name'=>$request->name,
            'email'=>$request->email,
        'password'=>$request->password,
    'c_password'=>$request->c_password]);
        $register=Register::find($register->id);
        return response()->json(['msg'=>"Updated..!",'data'=>new RegisterResource($register)]);
    }
    public function destroy(Register $register)
    {
        $register->delete();
        return response()->json(['msg'=>"Deleted..!",'data'=>new RegisterResource($register)]);
    }
}
