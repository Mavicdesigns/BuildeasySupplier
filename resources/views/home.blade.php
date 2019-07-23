@extends('layouts.app')
@extends('layouts.sidebar')



@section('content')
<div class=" body">


    @extends('layouts.alert')


    <!-- STATISTIC-->
    <section class="statistic">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">10,368</h2>
                            <span class="desc">members online</span>
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">388,688</h2>
                            <span class="desc">items sold</span>
                            <div class="icon">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">1,086</h2>
                            <span class="desc">this week</span>
                            <div class="icon">
                                <i class="zmdi zmdi-calendar-note"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">$1,060,386</h2>
                            <span class="desc">total earnings</span>
                            <div class="icon">
                                <i class="zmdi zmdi-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->

    <div style="margin: 20px 0" class="container row">

        <h3>Unverified Orders</h3>
    </div>

    @if(count($orders) > 0)

    <div class="table-responsive table-responsive-data2">

        <table class="table table-data2">

            <tbody>

            @foreach($order as $orders)

                <tr class="tr-shadow">
                    <td>
                        <label class="au-checkbox">
                            <input type="checkbox">
                            <span class="au-checkmark"></span>
                        </label>
                    </td>
                    <td>{{$order['buyer']}}</td>

                    <td class="desc">{{$order['title']}}</td>
                    <td>2018-09-27 02:12</td>
                    <td>
                        <span class="status--process">@if($order['status'] == 0) {{'Unverified'}} @endif</span>
                    </td>
                    <td>{{$order['price']}}</td>
                    <td>
                        <div class="table-data-feature">
                            <a class="item" href="{{url('MyOrders/'.$order['order_id'])}}" data-toggle="tooltip" data-placement="top" title="Send">
                                <i class="zmdi zmdi-mail-send"></i>
                            </a>
                            <a class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                            <a class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                            <a class="item" data-toggle="tooltip" data-placement="top" title="More">
                                <i class="zmdi zmdi-more"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr class="spacer"></tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div style="margin: 20px 0" class="container row">

            <h5>No new Orders</h5>
        </div>

    @endif


</div>

@endsection
