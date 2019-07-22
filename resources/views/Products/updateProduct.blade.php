@extends('layouts.app')

<style type="text/css">

</style>
@section('content')

    <div class=" body" style="padding:0;">

        <categorie product_id="{{$product_id}}" supplier_id="{{Auth::user()->user_id}}"></categorie>
    </div>

@endsection