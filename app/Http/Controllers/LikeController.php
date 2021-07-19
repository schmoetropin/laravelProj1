<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Topic;
use App\Models\User;

class LikeController extends Controller
{
    public function likeButton($topicId){
        if(auth()->user()){   
            $userId = auth()->user()->id;
            $alreadyLiked = Like::where('user','=',$userId)->where('topic','=',$topicId)->first();
            if(empty($alreadyLiked)){
                $topic = Topic::find($topicId);
                $topicLikesReceived = $topic->likes;
                $topicLikesReceived++;
                $top = Topic::where('id','=',$topicId)->update([
                    'likes'=>$topicLikesReceived
                ]);
                $user = User::find($topic->created_by);
                $userLikesReceived = $user->likes_received;
                $userLikesReceived++;
                $us = User::where('id','=',$user->id)->update([
                    'likes_received'=>$userLikesReceived
                ]);
                $like = Like::create([
                    'user'=>$userId,
                    'topic'=>$topicId,
                    'type'=>'like'
                ]);
                return redirect('/show/'.$topicId);
            }else{
                $likeType = $alreadyLiked->type;
                if($likeType === 'like'){
                    $alreadyLiked->delete();
                    $topic = Topic::find($topicId);
                    $topicLikesReceived = $topic->likes;
                    $topicLikesReceived--;
                    $top = Topic::where('id','=',$topicId)->update([
                        'likes'=>$topicLikesReceived
                    ]);
                    $user = User::find($topic->created_by);
                    $userLikesReceived = $user->likes_received;
                    $userLikesReceived--;
                    $us = User::where('id','=',$user->id)->update([
                        'likes_received'=>$userLikesReceived
                    ]);
                    return redirect('/show/'.$topicId);         
                }
                if($likeType === 'dislike'){
                    $alreadyLiked->delete();
                    $topic = Topic::find($topicId);
                    $topicLikesReceived = $topic->likes;
                    $topicLikesReceived = $topicLikesReceived+2;
                    $top = Topic::where('id','=',$topicId)->update([
                        'likes'=>$topicLikesReceived
                    ]);
                    $user = User::find($topic->created_by);
                    $userLikesReceived = $user->likes_received;
                    $userLikesReceived = $userLikesReceived+2;
                    $us = User::where('id','=',$user->id)->update([
                        'likes_received'=>$userLikesReceived
                    ]); 
                    $like = Like::create([
                        'user'=>$userId,
                        'topic'=>$topicId,
                        'type'=>'like'
                    ]);
                    return redirect('/show/'.$topicId);        
                }
            }
        }
        return redirect('/show/'.$topicId);
    }

    public function dislikeButton($topicId){
        if(auth()->user()){
            $userId = auth()->user()->id;
            $alreadyLiked = Like::where('user','=',$userId)->where('topic','=',$topicId)->first();
            if(!empty($alreadyLiked)){
                $likeType = $alreadyLiked->type;
                if($likeType === 'dislike'){
                    $alreadyLiked->delete();
                    $topic = Topic::find($topicId);
                    $topicLikesReceived = $topic->likes;
                    $topicLikesReceived++;
                    $top = Topic::where('id','=',$topicId)->update([
                        'likes'=>$topicLikesReceived
                    ]);
                    $user = User::find($topic->created_by);
                    $userLikesReceived = $user->likes_received;
                    $userLikesReceived++;
                    $us = User::where('id','=',$user->id)->update([
                        'likes_received'=>$userLikesReceived
                    ]);
                    return redirect('/show/'.$topicId);         
                }
                if($likeType === 'like'){
                    $alreadyLiked->delete();
                    $topic = Topic::find($topicId);
                    $topicLikesReceived = $topic->likes;
                    $topicLikesReceived = $topicLikesReceived-2;
                    $top = Topic::where('id','=',$topicId)->update([
                        'likes'=>$topicLikesReceived
                    ]);
                    $user = User::find($topic->created_by);
                    $userLikesReceived = $user->likes_received;
                    $userLikesReceived = $userLikesReceived-2;
                    $us = User::where('id','=',$user->id)->update([
                        'likes_received'=>$userLikesReceived
                    ]); 
                    $like = Like::create([
                        'user'=>$userId,
                        'topic'=>$topicId,
                        'type'=>'dislike'
                    ]);
                    return redirect('/show/'.$topicId);        
                }
            }else{
                $topic = Topic::find($topicId);
                $topicLikesReceived = $topic->likes;
                $topicLikesReceived--;
                $top = Topic::where('id','=',$topicId)->update([
                    'likes'=>$topicLikesReceived
                ]);
                $user = User::find($topic->created_by);
                $userLikesReceived = $user->likes_received;
                $userLikesReceived--;
                $us = User::where('id','=',$user->id)->update([
                    'likes_received'=>$userLikesReceived
                ]);
                $like = Like::create([
                    'user'=>$userId,
                    'topic'=>$topicId,
                    'type'=>'dislike'
                ]);
                return redirect('/show/'.$topicId);
            }
        }
        return redirect('/show/'.$topicId);
    }
}
