<div class="col-lg-6 col-md-8 no-pd">
    <div class="main-ws-sec">
        <div class="post-topbar">
            <div class="user-picy">
                <img src="{{asset('folder/images/resources/user-pic.png')}}" alt="" >
            </div>
            <div class="post-st">
                <ul>
                    <li><a class="post_project" href="#" title="">Image post</a></li>
                    <li><a class="post-jb active" href="#" title="">write something</a></li>
                </ul>
            </div>
            <!--post-st end-->
        </div>
        <!--post-topbar end-->
        <div class="posts-section">
            @if(!$post->count())
            <h3>You dont have any post lately</h3>
            @else
            @foreach($post as $post)
            <div class="post-bar " style="margin-bottom:20px">
                <div class="post_topbar">
                    <div class="usy-dt">
                        <img src="{{asset('folder/images/resources/us-pic.png')}}" alt=""></a>
                        <div class="usy-name">
                            <h3><a href="{{route('profile' , ['username'=>$post->user->username])}}">{{$post->user->getfullNameOrUsername()}}</a></h3>
                            <span><img src="{{asset('folder/images/clock.png')}}" alt="">{{$post->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                    <div class="ed-opts">
                        <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                        <ul class="ed-options">
                            @if(Auth::user() == $post->user)
                            <li><a href="" data-toggle = "modal" data-target="#editpost">Edit Post</a></li>
                            <li><a href="{{route('delete.post' ,['postId'=>$post->id])}}" title="">Delete</a></li>
                            @else
                            <li><a>Tag</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="job_descp">

                 <div class="post">
                    @if($post->image)
                    <p>{{$post->body}}</p>
                    <img src="{{$post->image}}" alt="" class=>
                    @else
                    <p>{{$post->body}}</p>
                    @endif
                </div>

                </div>
                <div class="job-status-bar">
                    <ul class="like-com">
                        <li>
                            <a href="{{route('post.like' , ['postId'=>$post->id])}}"><i class="la la-heart"></i>
                                Like</a>
                            <img src="{{asset('folder/images/liked-img.png')}}" alt="">
                            <span>{{$post->likes->count()}}</span>
                        </li>
                        <li><a href=""  class="com"><img src="{{asset('folder/images/com.png')}}" alt=""> Comment
                                {{$post->comments->count()}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="comment-section" style="margin-bottom:20px">
                <div class="plus-ic">
                    <i class="la la-plus"></i>
                </div>
                <div class="comment-sec">
                    <ul>
                        @foreach($post->comments as $comment)
                        <li>
                            <div class="comment-list">
                                <div class="bg-img">
                                    <img src="{{asset('folder/images/resources/bg-img1.png')}}" alt="">
                                </div>
                                <div class="comment">
                                    <h3>{{$comment->user->getfullnameOrUsername()}}</h3>
                                    <span><img src="{{asset('folder/images/clock.png')}}" alt="">{{$comment->created_at->diffForHumans()}}</span>
                                    <p>{{$comment->body}}</p>
                                    <ul>
                                        <div class="row">
                                            <div class="col-auto">
                                                <a href="#" class="reply">
                                                    <i class="fa fa-reply-all"></i>
                                                    Reply
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#" data-toggle="modal" data-target="#editcomment">Edit</a>
                                            </div>
                                            <div class="col-auto">
                                                <a href="{{route('delete.comment',['commentId'=>$comment->id])}}" >Delete</a>
                                            </div>
                                        </div>

                                    </ul>
                                    <div class="reply-box hidden">
                                        <form method="post" action="{{route('reply.comment' ,$comment->id)}}">
                                            <input type="text" name="description" placholder="post a comment">
                                            @inputError(['errors'=>$errors,'field'=>'description'])@endinputError
                                            <button type="submit">send</button>
                                            @csrf
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <!--comment-list end-->
                            <ul>
                                <li>
                                    <div class="comment-list">
                                        <div class="bg-img">
                                        </div>
                                        <div class="comment">
                                            @foreach($comment->comments as $reply)
                                            <h3>{{$reply->user->getfullName()}}</h3>
                                            <span><img src="{{asset('folder/images/clock.png')}}"
                                                    alt="">{{$reply->created_at->diffForHumans()}}</span>
                                            <p>{{$reply->body}} </p>
                                            @if(Auth::user() == $reply->user)
                                            <a href="{{route('delete.reply', ['commentId'=>$reply->id])}}">Delete</a>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--comment-list end-->
                                </li>
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!--comment-sec end-->
                <div class="post-comment">
                    <div class="cm_img">
                        <img src="{{asset('folder/images/resources/bg-img4.png')}}" alt="">
                    </div>

                    <div class="comment_box">
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
                <div class="modal fade" id="editcomment" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel">
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
            @endforeach
            @endif

            <!--process-comm end-->
        </div>
        <!--posts-section end-->
    </div>
    <!--main-ws-sec end-->
</div>