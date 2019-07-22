@extends('layouts.app')
@extends('layouts.sidebar')

<style>
    .tr-border{
        border: 1px solid !important;
        border-color: transparent transparent #ddd transparent  !important;
    }
    .tr-border:hover{
        background: rgba(31, 59, 212, 0.07);
    }


    .list-enter-active, .list-leave-active {
        transition: all 1s;
    }
    .list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
        opacity: 0;
        transform: translateY(30px);
    }

</style>



@section('content')




    <div class="body" >
        <categori supplier_id="{{Auth::user()->user_id}}"></categori>


    </div>

@endsection
