@extends('layouts.app')

<style type="text/css">

</style>

@section('content')
    <div class=" body" style="padding:0;">

        <categories User_id="{{\Illuminate\Support\Facades\Auth::user()->user_id}}"></categories>


    </div>

@endsection
