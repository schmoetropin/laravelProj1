<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function show($id){
        $user = User::find($id);
        if($user){
            $topics = Topic::where('created_by','=',$user->id)->orderBy('id','desc')->get();
            return view('forum.profile',[
                'user'=> $user,
                'topics'=> $topics
            ]);
        }
        return view('forum.notFound');
    }

    public function showMyProfile(){
        if(auth()->user()){
            $id = auth()->user()->id;
            $user = User::find($id);
            $topics = Topic::where('created_by','=',$id)->orderBy('id','desc')->get();
            return view('forum.myProfile',[
                'user'=>$user,
                'topics'=> $topics
            ]);
        }
        return redirect('/');
    }

    public function editMyProfile(){
        if(auth()->user()){
            $user = User::find(auth()->user()->id);
            $topics = Topic::where('created_by','=',auth()->user()->id)->get();
            return view('forum.editMyProfile',[
                'user'=>$user,
                'topics'=> $topics
            ]);
        }
        return redirect('/');
    }

    public function updateMyProfile(Request $request){
        if(auth()->user()){
            $id = auth()->user()->id;
            $name = $request->input('name');
            if(empty($request->input('password'))){
                $request->validate([
                    'name' => 'required|string|max:255'
                ]);
                $user = User::where('id','=',$id)->update([
                    'name'=>$name
                ]);
                return redirect('/myProfile');
            }else{
                $password = $request->input('password');
                $request->validate([
                    'name' => 'required|string|max:255',
                    'password' => ['required', 'confirmed', Rules\Password::defaults()]
                ]);
                $user = User::where('id','=',$id)->update([
                    'name' => $name,
                    'password' => Hash::make($password)
                ]);
                return redirect('/myProfile');
            }
        }
        return redirect('/');
    }

    public function destroy(){

    }

    public function AdmModDestroy($id){

    }
}
