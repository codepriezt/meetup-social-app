<div class="notfication-details">
    <div class="noty-user-img">
        <img src="{{ asset('folder/images/resources/ny-img1.png')}}" alt="">
    </div>
    <div class="notification-info">
        <span>2 min ago</span>
    <a href="{{route('singlePost',['id'=>$notification->data['post']['id']])}}"><h3>{{$notification->data['user']['first_name']}} commented on your post.</h3></a> 
    </div>
    <!--notification-info -->
</div>