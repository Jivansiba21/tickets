@extends('layout.app')

@section('content')

    @if (session('message'))
        <div class="text-success">
            {{ session('message') }} 
        </div>       
    @endif
    
    <h2> HOME PAGE</h2>
    {{-- <p> thhhhhhhhhhhhhhhhhhhhhhhhhhhhjeeeeeeeeeeeeeeeeeeeeeeeeeeeeeernh
        wqeeeeeeeeeeeeeeeeeeeeeeeecccccccccccccccccccccccccccrrrrrrrrr
    </p> --}}
@endsection

@section('title')
    home
@endsection


    
