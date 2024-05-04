<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class settingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function setting(){
        return view('setting');
    }

    function passwordreset(Request $request){
        $id=$request->input("user_id");
        $oldPassword=$request->input("oldPassword");
        $newPassword=$request->input("newPassword");
        $confirmNewPassword=$request->input("confirmNewPassword");

        $userPass=User::select('password')->where('id',$id)->get();
        $passwordResult=hash::check($oldPassword,$userPass[0]->password);
        if($passwordResult==1){
                if($newPassword==$confirmNewPassword){
                    $newPassword=Hash::make($newPassword);
                    $resetpassword=User::where('id',$id)->update(['password'=>$newPassword]);
                    return redirect('setting')->with('status','Password Reset Successful.');
                }
                else{
                    return redirect('setting')->with('status','Password Mismatched!');
                }
        }
        else{
            return redirect('setting')->with('status','Wrong Password!');
        }
        
      
    }
    
}
