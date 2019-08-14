<div class="col-lg-6 col-md-8 no-pd">

    <div class="main-ws-sec">
        <div class="post-topbar">
            <div class="user-picy">
                <img src="{{asset('folder/images/resources/user-pic.png')}}" alt="">
            </div>
            <div class="post-st">
                <ul>
                    {{-- <li><a class="post_project" href="#" title="">Post a image</a></li> --}}
                    <li><a class="post-jb active" href="#" title="">Make a post</a></li>
                </ul>
            </div>
            <!--post-st end-->
        </div>
        <!--post-topbar end-->
       @if(!$post->count())
         <h3>You dont have any post lately</h3>
        <div class="posts-section">
             @else
             @foreach($post as $post)
            <div class="post-bar">
                   
                <div class="post_topbar">
                    <div class="usy-dt">
                    <a href="{{route('profile',['username'=>$post->user->username])}}"><img src="{{asset('folder/images/resources/us-pic.png')}}" alt=""></a>
                        <div class="usy-name">
                        <a href="{{route('profile' , ['username'=>$post->user->username])}}"><h3>{{$post->user->getfullNameOrUsername()}}</a></h3>
                        <span><img src="{{asset('folder/images/clock.png')}}" alt="">{{$post->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                    <div class="ed-opts">
                        <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                        <ul class="ed-options">
                            @if(Auth::user() == $post->user)
                        <li><a href="" title=""data-toggle = "modal" data-target="#editpost">Edit Post</a></li>
                            <li><a href="{{route('delete.post' ,['postId'=>$post->id])}}" title="">Delete</a></li>
                            @else
                            <li><a>Tag</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="epi-sec">
                    <ul class="bk-links">
                        <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                        <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                    </ul>
                </div>
                <div class="job_descp">
                   
                <p>{{$post->body}}</p>
                    
                </div>
                <div class="job-status-bar">
                    <ul class="like-com">
                        
                        <li>
                        <a href="{{route('post.like' , ['postId'=>$post->id])}}"><i class="la la-heart"></i> Like</a>
                        
                        <li>
                            <img src="{{asset('folder/images/liked-img.png')}}" alt="">
                        <span>{{$post->likes->count()}} {{str_plural('like',$post->likes->count())}}</span>
                        </li>
                    <li><a href="#" title="" class="com"> Comment {{$post->comments->count()}}</a></li>
                    </ul>
                    <a><i class="la la-eye"></i>Views 50</a>
                </div>
            </div>
            <!--post-bar end-->

                    
            
                <div class="comment-section">
                    <div class="plus-ic">
                        <i class="la la-plus"></i>
                    </div>
                    @foreach($post->comments as $comment)
                    <div class="comment-sec">
                        <ul>
                            <li>
                                <div class="comment-list">
                                    <div class="bg-img">
                                        
                                        <img src="{{asset('folder/images/resources/bg-img1.png')}}" alt="">
                                    </div>
                                    <div class="comment">
                                    <h3>{{$comment->user->getfullnameOrUsername()}}</h3>
                                    <span><img src="{{asset('folder/images/clock.png')}}" alt="">{{$comment->created_at->diffForHumans()}}</span>
                                    <p>{{$comment->body}}</p>
                                        <a href="#" title="" class="reply"><i class="fa fa-reply-all"></i>Reply</a>
                                      
                                    {{-- <a href="{{route('comment.like' ,['commentId'=>$post->id])}}"> like</a> --}}
                                        
                                        <ul>
                                        {{-- <li>{{$comment->likes->count()}} {{str_plural('like', $comment->likes->count())}}</li> --}}
                                        @if(Auth::user() == $comment->user)
                                        <li><a href="" data-toggle="modal" data-target="#editcomment" title="">Edit</a></li>
                                        <li><a href="{{route('delete.comment',['commentId'=>$comment->id])}}" title="">Delete</a></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <div class="reply-box hidden">
                                    <form method="post" action="{{route('reply.comment' ,$comment->id)}}">
                                        <input type="text" name="description" placholder="post a comment">
                                        @inputError(['errors'=>$errors,'field'=>'description'])@endinputError
                                        <button type= "submit">send</button>
                                        @csrf
                                    </form>
                                    </div>
                                </div>
                                <!--comment-list end-->
                                <ul>
                                    <li>
                                        <div class="comment-list">
                                            <div class="bg-img">
                                                {{-- <img src="{{asset('folder/images/resources/bg-img2.png')}}" alt=""> --}}
                                            </div>
                                            <div class="comment">
                                            @foreach($comment->comments as $reply)
                                            <h3>{{$reply->user->getfullName()}}</h3>
                                            <span><img src="{{asset('folder/images/clock.png')}}" alt="">{{$reply->created_at->diffForHumans()}}</span>
                                                <p>{{$reply->body}} </p>
                                                @if(Auth::user() == $reply->user)
                                            <a href="{{route('delete.reply', ['commentId'=>$reply->id])}}" title="">Delete</a>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <!--comment-list end-->
                                    </li>
                                </ul>
                            </li>
                            <li>
                               
                                <!--comment-list end-->
                            </li>
                        </ul>
                    @endforeach
                    </div>
                    <!--comment-sec end-->
                    <div class="post-comment">
                        <div class="cm_img">
                            <img src="{{asset('folder/images/resources/bg-img4.png')}}" alt="">
                        </div>
                        <form method="post" action="{{route('comment.post', $post->id)}}">
                        <div class="comment_box">
                                <input type="text" name="description" placeholder="Post a comment">
                                @inputError(['errors'=>$errors ,'field'=>'description'])@endinputError
                                <button type="submit">Send</button>
                                @csrf
                        </div>
                            </form>
                        </div>
                        
                    </div>
                     <!--post-comment end-->
                   

                <div class="modal fade" id="editpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <form method="POST" action="{{route('edit.post' ,['postId'=>$post->id])}}" id="editpost">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Message:</label>
                                        <textarea name="description" placeholder="" class="form-control"
                                            id="description">{{$post->body}}</textarea>
                                        @inputError(['errors' => $errors, 'field' => 'description'])@endinputError
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">update</button>
                                    @csrf
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

              @foreach($post->comments as $comment)
            <div class="modal fade" id="editcomment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="POST" action="{{route('edit.comment' ,$comment->id)}}" id="editcomment">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Message:</label>
                                    <textarea name="description" placeholder="" class="form-control"
                                        id="description">{{$comment->body}}</textarea>
                                    @inputError(['errors' => $errors, 'field' => 'description'])@endinputError
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">update</button>
                                @csrf
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

                </div>
                <!--comment-section end-->
                @endforeach
                @endif
                


               
              
    
                
       <!--posts-section end-->
    </div>
</div>
    <!--main-ws-sec end-->
</div>



