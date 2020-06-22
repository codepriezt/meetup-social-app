@extends('layout.auth')
@section('page-content')
@include('main.home.components.header')
<section class="messages-page">
    <div class="container">
        <div class="messages-sec">
<chat-app :user="{{auth()->user()}}"></chat-app>	
</div>
</div>
</section>
@include('main.home.components.footer')
@endsection


