@extends('layouts.app')
@extends('layouts.sidebar')




@section('content')

    <Pcategorie user_id="{{$user_id}}" username="{{$username}}"
    ></Pcategorie>

@endsection