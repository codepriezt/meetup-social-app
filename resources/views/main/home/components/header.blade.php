<div class="wrapper">



    <header>
        <div class="container">
            <div class="header-data">
                <div class="logo">
                    <a href="{{route('dashboard')}}" title=""><img src="{{asset('folder/images/logo.png')}}" alt=""></a>
                </div>
                <!--logo end-->
                <div class="search-bar">
                    <form action="{{route('search.result')}}">
                        <input type="text" name="query" placeholder="Search...">
                        <button type="submit"><i class="la la-search"></i></button>
                    </form>
                </div>
                <!--search-bar end-->
                <nav>
                    <ul>
                        <li>
                            <a href="{{route('dashboard')}}" title="">
                                <span><img src="{{asset('folder/images/icon1.png')}}" alt=""></span>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{route('people')}}" title="">
                                <span><img src="{{asset('folder/images/icon2.png')}}" alt=""></span>
                                People
                            </a>
                        </li>
                        <li>
                            <a href="" title="">
                                <span><img src="{{asset('folder/images/icon4.png')}}" alt=""></span>
                                Profiles
                            </a>
                            <ul>
                                <li><a href="{{route('profile' , ['username'=>Auth::user()->username])}}" title="">User
                                        Profile</a></li>
                                <li><a href="my-profile-feed.html" title="">my-profile-feed</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" title="" class="not-box-open">
                                <span><img src="{{asset('folder/images/icon6.png')}}" alt=""></span>
                                Messages
                            </a>
                            <div class="notification-box msg">
                                <div class="nt-title">
                                    <h4>Setting</h4>
                                    <a href="#" title="">Clear all</a>
                                </div>
                                <div class="nott-list">
                                    <div class="notfication-details">
                                        <div class="noty-user-img">
                                            <img src="{{asset('folder/images/resources/ny-img1.png')}}" alt="">
                                        </div>
                                        <div class="notification-info">
                                            <h3><a href="messages.html" title="">Jassica William</a> </h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
                                            <span>2 min ago</span>
                                        </div>
                                        <!--notification-info -->
                                    </div>
                                    <div class="notfication-details">
                                        <div class="noty-user-img">
                                            <img src="{{asset('folder/images/resources/ny-img2.png')}}" alt="">
                                        </div>
                                        <div class="notification-info">
                                            <h3><a href="messages.html" title="">Jassica William</a></h3>
                                            <p>Lorem ipsum dolor sit amet.</p>
                                            <span>2 min ago</span>
                                        </div>
                                        <!--notification-info -->
                                    </div>
                                    <div class="notfication-details">
                                        <div class="noty-user-img">
                                            <img src="{{asset('folder/images/resources/ny-img3.png')}}" alt="">
                                        </div>
                                        <div id="app" class="notification-info">
                                            <h3><a href="messages.html" title="">Jassica William</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempo incididunt ut labore et dolore magna aliqua.</p>
                                            <span>2 min ago</span>
                                        </div>
                                        <!--notification-info -->
                                    </div>
                                    <div class="view-all-nots">
                                        <a href="{{route('message.chat')}}" title="">View All Messsages</a>
                                    </div>
                                </div>
                                <!--nott-list end-->
                            </div>
                            <!--notification-box end-->
                        </li>
                        <li>
                            {{-- <notification :userId="{{auth()->id()}}" :unreads="{{auth()->user()->unreadNotifications}}"></notification> --}}
                            <a href="#" title="" class="not-box-open" id="markAsRead" onclick="markNotificationAsRead()">
                                <span><img src="" alt=""></span>
                            Notification<span class="badge">{{count(auth()->user()->unreadNotifications)}}</span>
                            </a>
                            
                            <div class="notification-box">
                                <div class="nt-title">
                                    <h4>Setting</h4>
                                    <a href="#" title="">Clear all</a>
                                </div>
                                <div class="nott-list">
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                    @include('layout.notifications.'. snake_case(class_basename($notification->type)))
                                    @endforeach
                                </div>
                            
                            </div>
                        </li>
                         
                    </ul>
                </nav>
                <!--nav end-->
                <div class="menu-btn">
                    <a href="#" title=""><i class="fa fa-bars"></i></a>
                </div>
                <!--menu-btn end-->
                <div class="user-account">
                    <div class="user-info">
                        <img src="{{Auth::user()->photo ? Auth::user()->photo : asset('folder/images/resources/user.png')}}" class="img-fluid"
                            alt="" id="profile-pic">
                        <a href="#" title="">{{ucfirst(Auth::user()->username)}}</a>
                        <i class="la la-sort-down"></i>
                    </div>
                    <div class="user-account-settingss">
                        <h3>Online Status</h3>
                        <ul class="on-off-status">
                            <li>
                                <div class="fgt-sec">
                                    <input type="radio" name="cc" id="c5">
                                    <label for="c5">
                                        <span></span>
                                    </label>
                                    <small>Online</small>
                                </div>
                            </li>
                            <li>
                                <div class="fgt-sec">
                                    <input type="radio" name="cc" id="c6">
                                    <label for="c6">
                                        <span></span>
                                    </label>
                                    <small>Offline</small>
                                </div>
                            </li>
                        </ul>
                        <h3>Custom Status</h3>
                        <div class="search_form">
                            <form>
                                <input type="text" name="search">
                                <button type="submit">Ok</button>
                            </form>
                        </div>
                        <!--search_form end-->
                        <h3>Setting</h3>
                        <ul class="us-links">
                            <li><a href="{{route('userSetting')}}" title="">Account Setting</a></li>
                            <li><a href="#" title="">Privacy</a></li>
                            <li><a href="#" title="">Faqs</a></li>
                            <li><a href="#" title="">Terms & Conditions</a></li>
                        </ul>
                        <h3 class="tc"><a href="{{route('logout')}}">Logout</a></h3>
                    </div>
                    <!--user-account-settingss end-->
                </div>
            </div>
            <!--header-data end-->
        </div>
    </header>