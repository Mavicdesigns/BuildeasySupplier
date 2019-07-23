@extends('layouts.app')

<style type="text/css">

</style>

@section('content')
    <div class=" body" style="padding:0;">

        <categories user_id="{{$user->user_id}}"></categories>


    </div>

@endsection
