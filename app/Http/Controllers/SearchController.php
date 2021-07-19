<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request){
        $search = $request->input('search');
        $searchTest = str_replace(' ','',$search);
        if(empty($searchTest) || $searchTest === '' || $searchTest === null)
            return redirect('/');
        else{
            $topics = Topic::where('name','like','%'.$search.'%')->orderBy('id','desc')->get();
            $users = User::all();
            $top5Users = User::where('user_type','<','3')->orderBy('likes_received','desc')->limit('10')->get();
            return view('forum.search',[
                'topics'=>$topics,
                'users'=>$users,
                't5Users'=>$top5Users,
                'search'=>$search
            ]);
        }
    }
}
