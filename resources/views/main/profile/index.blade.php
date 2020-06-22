@extends('layout.auth')
@section('page-content')
@include('main.home.components.header')
<section class="cover-sec">
    <img src="{{asset('folder/images/resources/cover-img.jpg')}}" alt="">
</section>


<main>

    <div class="main-section">
        <div class="container">
            <div class="main-section-data">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="main-left-sidebar">


                            <div class="user_profile" data-friendid={{$user->id}}>
                                <div class="user-pro-img">
                                    <img src="{{$user->photo ? $user->photo : asset('folder/images/resources/user-pro-img.png')}}"
                                        alt="">
                                </div>
                                <!--user-pro-img end-->

                                <div class="user_pro_status">
                                    <ul class="flw-hr">


                                        @if(Auth::user()->isfriendwith($user))
                                        <h5> You and {{$user->getfullNameOrusername() }} are friends</h5>
                                      <form action="{{route('deleteFriend' , ['username'=>$user->username])}}" method="post">
                                           <input type="submit" value="delete friend" class = "btn btn-primary" >
                                           <input type="hidden"  name="_token"  value="{{csrf_token()}}">
                                       </form>


                                        @elseif(Auth::user()->username == $user->username)

                                        <li>Welcome {{$user->username}}</li>
                                        @else
                                        <li>Welcome {{$user->username}}</li>
                                        <hr>
                                        <li> <a href="{{route('addRequest' , ['id' =>$user->id])}}"
                                                class="flww">Add as Friend</a></li>


                                        @endif
                                    </ul>
                                    <ul class="flw-status">
                                        <li>
                                            <span>Friends</span>
                                            <b>{{Auth::user()->friends()->count()}}</b>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--user_pro_status end-->


                            <!--user_profile end-->
                            <div class="suggestions full-width">
                                <div class="sd-title">
                                    <h3>{{$user->getfullNameOrUsername()}} friends</h3>
                                    <i class="la la-ellipsis-v"></i>
                                </div>
                                <!--sd-title end-->
                                <div class="suggestions-list">
                                    @if(!$friends->count())
                                    <p>You have no friends</p>
                                    @else

                                    @foreach($friends as $user)
                                    <div class="suggestions-list">
                                        <div class="suggestion-usd">
                                            <img src="{{ asset('folder/images/resources/s1.png')}}" alt="">
                                            <div class="sgt-text">
                                                <a href="{{route('profile' ,['username' =>$user->username])}}">
                                                    <h4>{{$user->getFullNameOrUsername()}}</h4>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <!--suggestions-list end-->

                            <!--suggestions end-->
                        </div>
                        <!--main-left-sidebar end-->
                    </div>



                    <div class="col-lg-6">
                        <div class="main-ws-sec">
                            <div class="user-tab-sec">
                                

                                <div class="star-descp">

                                    <ul>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-half-o"></i></li>
                                    </ul>
                                </div>
                                @if(session('info'))
                                @alert([
                                'type' => 'info',
                                'title' => 'User!',
                                'message' => session('info')
                                ])
                                @endalert
                                @endif
                                <!--star-descp end-->
                            </div>
                            <!--user-tab-sec end-->
                            <div class="product-feed-tab current" id="feed-dd">
                                <div class="posts-section">
                                    <div class="post-bar">
                                        <div class="post_topbar">
                                            <div class="usy-dt">
                                                <img src="{{asset('folder/images/resources/us-pic.png')}}" alt="">
                                                <div class="usy-name">
                                                    <h3>John Doe</h3>
                                                    <span><img src="{{asset('folder/images/clock.png')}}" alt="">3 min
                                                        ago</span>
                                                </div>
                                            </div>
                                            <div class="ed-opts">
                                                <a href="#" title="" class="ed-opts-open"><i
                                                        class="la la-ellipsis-v"></i></a>
                                                <ul class="ed-options">
                                                    <li><a href="#" title="">Edit Post</a></li>
                                                    <li><a href="#" title="">Unsaved</a></li>
                                                    <li><a href="#" title="">Unbid</a></li>
                                                    <li><a href="#" title="">Close</a></li>
                                                    <li><a href="#" title="">Hide</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="epi-sec">
                                            <ul class="descp">
                                                <li><img src="{{asset('folder/images/icon8.png')}}" alt=""><span>Epic
                                                        Coder</span></li>
                                                <li><img src="{{asset('folder/images/icon9.png')}}"
                                                        alt=""><span>India</span></li>
                                            </ul>
                                            <ul class="bk-links">
                                                <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                                                <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="job_descp">
                                            <h3>Senior Wordpress Developer</h3>
                                            <ul class="job-dt">
                                                <li><a href="#" title="">Full Time</a></li>
                                                <li><span>$30 / hr</span></li>
                                            </ul>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus
                                                hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit
                                                amet... <a href="#" title="">view more</a></p>
                                            <ul class="skill-tags">
                                                <li><a href="#" title="">HTML</a></li>
                                                <li><a href="#" title="">PHP</a></li>
                                                <li><a href="#" title="">CSS</a></li>
                                                <li><a href="#" title="">Javascript</a></li>
                                                <li><a href="#" title="">Wordpress</a></li>
                                            </ul>
                                        </div>
                                        <div class="job-status-bar">
                                            <ul class="like-com">
                                                <li>
                                                    <a href="#"><i class="la la-heart"></i> Like</a>
                                                    <img src="{{asset('folder/images/liked-img.png')}}" alt="">
                                                    <span>25</span>
                                                </li>
                                                <li><a href="#" title="" class="com"><img
                                                            src="{{asset('folder/images/com.png')}}" alt="">
                                                        Comment 15</a></li>
                                            </ul>
                                            <a><i class="la la-eye"></i>Views 50</a>
                                        </div>
                                    </div>
                                    <!--post-bar end-->

                                    <!--process-comm end-->
                                </div>
                                <!--posts-section end-->
                            </div>
                            <!--product-feed-tab end-->

                            <!--product-feed-tab end-->

                        </div>
                        <!--main-ws-sec end-->
                    </div>
                    <div class="col-lg-3">
                        <div class="right-sidebar">
                            <div class="message-btn">
                                <a href="#" title=""><i class="fa fa-envelope"></i> Message</a>
                            </div>
                            <div class="widget widget-portfolio">
                                <div class="wd-heady">
                                    <h3>Friend Request</h3>
                                    @if(Auth::user()->hasFriendRequestPending($user))
                                    <p>Waiting for{{$user->getfullNameOrUsername()}} to accept friend request </p>
                                    <img src="{{$user->photo ? $user->photo : asset('folder/images/resources/s1.png')}}"
                                        alt="">

                                    @elseif (Auth::user()->hasFriendRequestRecieved($user))
                                    <a href="{{route('acceptRequest' , ['username' => $user->username])}}" title=""
                                        class="btn btn-primary">Accept
                                        request</a>
                                        <a href="{{route('deleteRequest' , ['username' => $user->username])}}" title="" class="btn btn-primary">delete
                                            request</a>
                                    <img src="{{$user->photo ? $user->photo : asset('folder/images/resources/s1.png')}}"
                                        alt="">

                                    {{-- <a href="{{route('declineRequest' , ['username' =>$user->username])}}" title=""
                                        class="btn btn-primary">Delete friend</a> --}}

                                    @endif


                                    <!--pf-gallery end-->
                                </div>
                                <!--widget-portfolio end-->
                            </div>
                            <!--right-sidebar end-->
                        </div>
                    </div>
                </div><!-- main-section-data end-->
            </div>
        </div>
</main>


@include('main.home.components.footer')


<div class="overview-box" id="create-portfolio">
    <div class="overview-edit">
        <h3>Create Portfolio</h3>
        <form>
            <input type="text" name="pf-name" placeholder="Portfolio Name">
            <div class="file-submit">
                <input type="file" name="file">
            </div>
            <div class="pf-img">
                <img src="images/resources/np.png" alt="">
            </div>
            <input type="text" name="website-url" placeholder="htp://www.example.com">
            <button type="submit" class="save">Save</button>
            <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div>
    <!--overview-edit end-->
</div>
<!--overview-box end-->



</div>
<!--theme-layout end-->



<!--theme-layout end-->
<script type="text/javascript" src="{{asset('folder/lib/slick/slick.min.js')}}"></script>

@endsection