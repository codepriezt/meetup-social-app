@extends('layout.auth')
@section('page-content')

<h4> Your search  for "{{  Request::query('input') }}"</h4>


        @if(!$users->count())

        <p> No results found , sorry</p>
        @else
         <div class ="row">
            <div class ="col-lg-12">
                @foreach($users as $user)
                <div class = "media">
                  <a class = "pull-left"  href = "{{route('profile' , ['username'=>$user->username])}}">
                    <img class ="media-object" alt="" src ="{{asset('folder/images/resources/user.png')}}">
                 </a>
                <div class = "media-body">
                <h4 class ="media-heading"><a href ="{{route('profile' , ['username'=>$user->username])}}"</a>{{$user->getfullNameOrUsername()}}</h4>
                    </div>  
                </div>
                @endforeach
            </div> 
        </div>
        @endif

@endsection