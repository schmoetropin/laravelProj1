<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use App\Http\Requests\TopicRequest;
use App\Http\Requests\TopicRequestUpdate;
use Illuminate\Support\Facades\File;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $topics = Topic::orderBy('id','desc')->get();
        $users = User::all();
        $top5Users = User::where('user_type','<','3')->orderBy('likes_received','desc')->limit('10')->get();
        return view('forum.index',[
            'topics'=>$topics,
            'users'=>$users,
            't5Users'=>$top5Users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request)
    {
        $request->validated();
        $name = $request->input('name');
        $content = $request->input('content');
        $file = $request->file('media');
        $user = auth()->user()->id;
        $extension = $file->extension();
        if($extension === 'jpeg' || $extension === 'jpg' || $extension === 'png')
            $media_type = 'image';
        else
            $media_type = 'video';
        $fileName = time().'-'.$user.'-'.str_replace(' ','_',$name).'-'.uniqid().'.'.$extension;
        $topic = Topic::create([
            'name'=> $name,
            'media'=> $fileName,
            'content'=> $content,
            'created_by'=> $user,
            'media_type'=>$media_type
        ]);
        if($topic){
            $file->move(public_path('media'), $fileName);
            $topCreated = auth()->user()->topics_created;
            $topCreated++;
            $user = User::where('id',$user)->update([
                'topics_created'=> $topCreated
            ]);
            return redirect("/");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::find($id);
        if($topic){
            $user = User::find($topic->created_by);
            return view('forum.show',[
                'topic'=> $topic,
                'user'=> $user
            ]);
        }
        return view('forum.notFound');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::find($id);
        if($topic){
            if(auth()->user()){
                if(auth()->user()->id === $topic->created_by){
                    return view('forum.edit',['topic'=>$topic]);
                }
                return redirect('/');
            }
            return redirect('/');
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequestUpdate $request, $id)
    {
        $request->validated();
        $name = $request->input('name');
        $content = $request->input('content');
        if(empty($request->media)){
            $topic = Topic::where('id','=',$id)->update([
                'name'=>$name,
                'content'=>$content
            ]);
            return redirect('/show/'.$id);
        }else{
            $file = $request->file('media');
            $t = Topic::find($id);
            File::delete('media/'.$t->media);
            $user = auth()->user()->id;
            $extension = $file->extension();
            if($extension === 'jpeg' || $extension === 'jpg' || $extension === 'png')
                $media_type = 'image';
            else
                $media_type = 'video';
            $fileName = time().'-'.$user.'-'.str_replace(' ','_',$name).'-'.uniqid().'.'.$extension;
            $file->move(public_path('media'),$fileName);
            $topic = Topic::where('id','=',$id)->update([
                'name'=>$name,
                'content'=>$content,
                'media'=>$fileName,
                'media_type'=>$media_type
            ]);
            return redirect('/show/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        if(auth()->user()->id === $topic->created_by){
            File::delete('media/'.$topic->media);
            $topic->delete();
            return redirect('/');
        }
        return redirect('/');
    }
}
