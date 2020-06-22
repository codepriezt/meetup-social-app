<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\User;
use Auth;
use App\Notifications\ReplyToPost;

class CommentController extends Controller
{
    public function addPostComment(Request $request ,Post $post)
    {
           

                $comment = new comment();
                $comment->user_id = Auth::user()->id;
                $comment->body= $request->description;
                

                $post->comments()->save($comment);

                auth()->user()->notify(new ReplyToPost($post));

                if(!$post){
                    return back()->with('error' , "unable to get update comment");
                }

                return back()->with('info' , 'comment succesful');
            }



             public function editComment(Request $request , Comment $comment){


                        
                            $user_id = Auth::user()->id;
                            $body = $request->description;

                            $editcomment = $comment->update([
                                'user_id' => $user_id,
                                'body' => $body,
                            ]);

                            if (!$editcomment) {
                                return back()->with('error', "unable to update post");
                            }
                            return  back()->with('info', "comment updated");
                     } 





                     public function deleteComment($commentId){
                         $com = Comment::where('id' ,$commentId )->first();

                         if(!$com){
                             return back()->with('error' , "Unable to deleten comment at the moment");
                         }

                         $com->delete();
                         return back()->with('info', "comment successfully deleted");
                     }




                     public function replyComment(Request $request, Comment $comment)
                     {
                            $reply = new Comment();
                             $reply->user_id = Auth::user()->id;
                             $reply->body = $request->description;

                             $comment->comments()->save($reply);

                            if(!$comment){
                                return back()->with('error' , 'unable to replt to comment');
                            }
                                return back()->with('info' , "reply created");
                     }




                     public function editReply(Request $request , Comment $comment)
                     {
                                    $user_id = Auth::user()->id;
                                    $body = $request->description;

                                    $editreply = $comment->update([
                                        'user_id' => $user_id,
                                        'body' => $body,
                                    ]);

                                    if (!$editreply) {
                                        return back()->with('error', "unable to update post");
                                    }
                                    return  back()->with('info', "reply editted");
                                  
                     }



                    public function deleteReply($commentId)
                    {
                        $com = Comment::where('id', $commentId)->first();

                        if (!$com) {
                            return back()->with('error', "Unable to deleten comment at the moment");
                        }

                        $com->delete();
                        return back()->with('info', "comment successfully deleted");
                    }



    public function getlikes($commentId)
    {
        
        $post = Comment::where('id' ,$commentId)->first();

        if (!$post) {
            return back()->with('error', 'unable to get post');
        }

        // if (!Auth::user()->isFriendWith($post->user)) {
        //     return back()->with('info', 'sorry, you cant like this post.. not a friend to the post author');
        // }

        if (Auth::user()->hasLikedComment($post)) {
            return back()->with('info', 'Cant like this comment more than once');
        }

        $like = $post->likes()->create([
            'user_id' => Auth::user()->id
        ]);

        Auth::user()->likes()->save($like);

        return back()->with('info', 'comment successfully liked');
    }

    
}
