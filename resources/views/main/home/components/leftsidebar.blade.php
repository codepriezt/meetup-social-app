<main>
    <div class="main-section">
        <div class="container">
            <div class="main-section-data">
                <div class="row">
                    <div class="col-lg-3 col-md-4 pd-left-none no-pd">
                        <div class="main-left-sidebar no-margin">
                            <div class="user-data full-width">
                                <div class="user-profile">
                                    <div class="username-dt">
                                        <div class="usr-pic">
                                            <img src="{{Auth::user()->photo ? Auth::user()->photo : asset('folder/images/resources/user-pic.png')}}" alt="">
                                        </div>
                                    </div>
                                    <!--username-dt end-->
                                    <div class="user-specs">
                                        <h3>{{ucfirst(Auth::user()->getFullName())}}</h3>
                                    </div>
                                </div>
                                <!--user-profile end-->
                                <ul class="user-fw-status">
                                    <li>
                                        <h4>Friends</h4>
                                        <span>{{Auth::user()->friends()->count()}}</span>
                                    </li>
                                    <li>
                                        <a href="{{route('profile', ['username'=>Auth::user()->username])}}" title="">View Profile</a>
                                    </li>
                                </ul>
                            </div>
                            @if(session('error'))
                            @alert([
                            'type' => 'info',
                            'title' => 'User!',
                            'message' => session('error')
                            ])
                            @endalert
                            @endif
                            @if(session('info'))
                            @alert([
                            'type' => 'info',
                            'title' => 'User!',
                            'message' => session('info')
                            ])
                            @endalert
                            @endif
                            <!--user-data end-->
                            <div class="suggestions full-width">
                                <div class="sd-title">
                                    <h3> Friend Request</h3>
                                    <i class="la la-ellipsis-v"></i>
                                </div>
                                <!--sd-title end-->
                                <div class="suggestions-list">
                                @if(!$request->count() > 0)
                                <p> You dont have any friend request
                                @endif
                                @foreach($request as $user)
                                @if(Auth::user()->hasFriendRequestRecieved($user))
                                <li>{{$user->getfullNameOrUsername()}}</li>
                                <a href="{{route('acceptRequest' , ['username' => $user->username])}}" title="" class="btn btn-primary">Accept
                                    request</a>
                                <a href="{{route('declineRequest' , ['username' => $user->username])}}" title="" class="btn btn-primary">decline
                                    request</a>
                                @elseif(Auth::user()->hasFriendRequestPending($user))
                                <p> {{$user->getfullNameOrUsername()}} is yet to accept your friend request</p>
                               
                                    @endif
                                 @endforeach
                                
                                </div>
                                <!--suggestions-list end-->
                            </div>
                            <!--suggestions end-->
                        </div>
                        <!--main-left-sidebar end-->
                    </div>


                                   
                  