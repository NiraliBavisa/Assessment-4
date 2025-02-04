<?php

namespace App\Http\Controllers;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LoginResource;

class LoginController extends Controller
{
    public function index()
    {
        $login=Login::get();
        if($login->count()>0)
        {
            return LoginResource::collection($login);
        }
        else
        {
            return response()->json(['message'=>"No Data Found..!!"]);
        }
    }
    public function store(Request $request)
    {
      
        $login=Login::create(['email'=>$request->email,
        'password'=>$request->password]);
        return response()->json(['msg'=>"Created....!",'data'=>new LoginResource($login)]);
        $validator=Validator::make($request->all(),['email','password']);
        if($validator->fails())
        {
            return response()->json(['error'=>"All fields are required..!"]);
        }
    }
    public function show(Login $login)
    {
        $login=Login::find($login->id);
        return response()->json(['data'=>new LoginResource($login)]);
    }
    public function update(Login $login,Request $request)
    {
        $validator=Validator::make($request->all(),['email'=>"required",
        'password'=>"required"]);
        if($validator->fails())
        {
            return response()->json(['error'=>"All Fields Are Required..!"]);
        }
        $login->update(['email'=>$request->email,
        'password'=>$request->password]);
        $login=Login::find($login->id);
        return response()->json(['msg'=>"Updated..!",'data'=>new LoginResource($login)]);
    }
    public function destroy(Login $login)
    {
        $login->delete();
        return response()->json($login);
    }
}
