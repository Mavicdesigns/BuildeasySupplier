@extends('layouts.app')
@extends('layouts.sidebar')


@section('content')
    <div class=" body" >

        @extends('layouts.alert')

        @foreach($order as $orders)

            <div class="vue-misc row container">
                <h2 class="display-5 my-3">{{$orders['title']}}</h2>


            </div>
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel panel-item">
                        <div class="panel-body">
                            <span>Buyer :</span><span>{{$orders['buyer']}}</span><br>
                            <span>Address :</span><span> {{$orders['destination']}}</span><br>
                            <span>Quantity :</span><span> {{$orders['quantity'].$orders['valuation']}}</span><br>
                            <span>Token :</span><span> {{$orders['token']}}</span><br>
                            <span>Time of delivery :</span><span>
                                  <div class="rs-select2--light rs-select2--md">
                                      <select class="js-select2" name="property">
                                          <option selected="selected">2 days  </option>
                                          <option value=""> 3 days</option>
                                          <option value="">4 days</option>
                                      </select>
                                      <div class="dropDownSelect2"></div>
                                  </div>
                              </span>
                        </div>
                    </div>

                </div>


            </div>




            <div class="top-campaign" style="background: transparent">
                <div class="table-responsive">
                    <table class="table table-top-campaign">
                        <tbody>
                        <tr>
                            <td> {{$orders['title']}}</td>
                            <td>${{$orders['price']}}</td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td>$6,399.22</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>${{$orders['price'] +  6399.22}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>
                </div>

                @if($orders['status'] == 1)<!-- 1 meaning order has not yet been confirmed by user but confirmed by supplier -->
                    <span>Order is not yet verified by Customer please Wait</span>

                <div class="" align="right">
                    <a href="{{url('Orders/processOrders/'.$orders['order_id'])}}" class="btn btn-success" >Deliver</a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#smallmodal">Cancel</button>
                </div>
                @elseif($orders['status'] == 2) <!-- 2 means order has also been confirmed by customer -->

                    <form action="{{url('Orders/verify/'.$orders['order_id'])}}" method="get">
                        <div class="form-group">
                            <label for="vat" class=" form-control-label">Please Type in  the order token given to customer to complete delivery</label>
                            <input type="text" id="vat" name="token" placeholder="Press enter after typing" class="form-control">
                            <small style="color: red;font-weight: 600"><?= $error = session('error') ?? ' ' ?></small>
                        </div>
                    </form>


                @endif




                <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background: rgb(234, 19, 19)">
                                <h5 class="modal-title" style="color: #fff;display: inline-block" id="smallmodalLabel">Small Modal</h5>
                                <button style="color: #fff;display: inline-block" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Are you sure you want to reject this order
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a href="{{url('Orders/delete/'.$orders['order_id'])}}" type="button" class="btn btn-primary">Confirm</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>







        @endforeach

    </div>

@endsection