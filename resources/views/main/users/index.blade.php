@extends('layout.auth')
@section('page-content')
@include('main.home.components.header')
<section class="companies-info">
    <div class="container">
        <div class="company-title">
            <h3>People You May Know</h3>
        </div>
        <!--company-title end-->
        
        <div class="companies-list">
            <div class="row">

                

                @foreach($not_friends as $user)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="company_profile_info">
                        <div class="company-up-info" >
                        <a href ="{{route('profile' , ['username'=>$user->username])}}"><img src="{{$user->photo ? $user->photo : asset('folder/images/resources/cmp-icon1.png')}}" alt="">
                          <h3>{{$user->getfullName()}}</h3>
                            <h4>Establish Feb, 2004</h4>
                            <ul>
                            @if(Auth::user()->hasFriendRequestPending( $user) || $user->hasFriendRequestPending(Auth::user()))
                           <a href="{{route('profile' , ['username'=>$user->username])}}" title="" class="view-more-pro">View Profile</a>
                          @elseif(Auth::user()->isFriendwith($user) || $user->isFriendwith(Auth::user()))
                          <a href="{{route('profile' , ['username'=>$user->username])}}" title="" class="view-more-pro">View Profile</a>
                          @else
                            <li><a href="{{route('addRequest' , ['id'=>$user->id])}}" title="" class="follow">Add Friend</a></li>
                                <li><a href="#" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>
                            @endif
                            </ul>
                        </div>
                    <a href="{{route('profile' , ['username'=>$user->username])}}" title="" class="view-more-pro">View Profile</a>  
                    </div>  
                </div> 
                @endforeach 
                     <!--company_profile_info end-->
            </div>
        </div>           
        <div class="process-comm">
            <a href="#" title=""><img src="{{asset('folder/images/process-icon.png')}}" alt=""></a>
        </div>
    </div>  
</section>
<!--companies-info end-->


</div>
<!--theme-layout end-->
@endsection