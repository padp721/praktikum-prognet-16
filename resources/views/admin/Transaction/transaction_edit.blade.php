@extends ('master-dashboard')

@section ('title', 'Transaction Detail')

@section ('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Transaction Detail</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-home"></i>
                </li>
                <li><span>Transaction</span></li>
                <li><span>Detail</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('fail'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('fail') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-7">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Order Info</h2>
                </header>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="order_number">Order Number</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="order_number" name="order_number" value="{{$transaction->id}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="date">Date</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="date" name="date" value="{{$transaction->date}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Timeout</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="timeout" name="timeout" value="{{$transaction->timeout}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="status">Payment Status</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="status" name="status" value="{{$transaction->status}}" disabled>
                            </div>
                        </div>
                </div>
            </section>
        </div>
        
        <div class="col-md-5">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Proof of Payment</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            @if (!isset($transaction->proof_of_payment))
                                No Proof of Payment Uploaded.
                            @else
                                <a href="{{ asset('/storage/proof_of_payments/'.$transaction->proof_of_payment) }}" target="_blank">
                                    <img src="{{ asset('/storage/proof_of_payments/'.$transaction->proof_of_payment) }}" width="180" alt="">
                                </a>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <form action="{{route('transaction.update',$transaction->id)}}" method="post">
                                @method('PATCH')
                                @csrf
                                @if (!isset($transaction->proof_of_payment))
                                    Can't verify without Proof of Payment.
                                @elseif(isset($transaction->proof_of_payment) && $transaction->status == 'unverified')
                                    <input type="submit" class="btn btn-lg btn-success" value="Verify" name="verify" style="width:100%;height:100%">
                                    <br><br>
                                    <input type="submit" class="btn btn-lg btn-danger" value="Cancel Transaction" name="cancel" style="width:100%;height:100%">
                                @elseif($transaction->status == 'verified')
                                    <input type="submit" class="btn btn-lg btn-success" value="Deliver" name="deliver" style="width:100%;height:100%">
                                    <br><br>
                                    <input type="submit" class="btn btn-lg btn-danger" value="Cancel Transaction" name="cancel" style="width:100%;height:100%">
                                @elseif($transaction->status == 'delivered')
                                    Waiting until customer recieved the package.
                                @elseif($transaction->status == 'success')
                                    Package has been successfully delivered.
                                @elseif($transaction->status == 'expired')
                                    Your purchase has been expired.
                                @elseif($transaction->status == 'canceled')
                                    The purchase has been cancelled.
                                @else
                                    Sorry, something went wrong.
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
        </section>
        </div>

        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Shipping Address</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="order_number">Mr./Mrs./Ms.</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{$transaction->user->name}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="order_number">Address</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="address" name="address" value="{{$transaction->address}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="order_number">Regency</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="regency" name="regency" value="{{$city[$transaction->regency-1]['city_name']}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="order_number">Province</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="province" name="province" value="{{$province[$transaction->province-1]['province']}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="order_number">Postcode</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="postcode" name="postcode" value="{{$city[$transaction->regency-1]['postal_code']}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="order_number">Courier</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="courier" name="courier" value="{{$transaction->courier->courier}}" disabled>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Order Detail</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction->products as $transaction_detail)
                            <tr>
                                <td>
                                <p>{{$transaction_detail->product_name}}</p>
                                </td>
                                <td>
                                <p>Rp {{number_format($transaction_detail->price)}}</p>
                                </td>
                                <td>
                                <h5>{{$transaction_detail->pivot->qty}}</h5>
                                </td>
                                <td>
                                <h5>@if ($transaction_detail->discount == 0)
                                    -
                                @else
                                    {{$transaction_detail->discount}}%
                                @endif</h5>
                                </td>
                                <td>
                                <p>Rp {{number_format($transaction_detail->pivot->selling_price)}}</p>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                            <td>
                            <h4>Subtotal</h4>
                            </td>
                            <td>
                            <h5></h5>
                            </td>
                            <td>
                            <h5></h5>
                            </td>
                            <td>
                            <h5></h5>
                            </td>
                            <td>
                            <p>Rp {{number_format($transaction->total)}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <h4>Shipping</h4>
                            </td>
                            <td>
                            <h5></h5>
                            </td>
                            <td>
                            <h5></h5>
                            </td>
                            <td>
                            <h5></h5>
                            </td>
                            <td>
                            <p>Rp {{number_format($transaction->shipping_cost)}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <h4>Total</h4>
                            </td>
                            <td>
                            <h5></h5>
                            </td>
                            <td>
                            <h5></h5>
                            </td>
                            <td>
                            <h5></h5>
                            </td>
                            <td>
                            <h4>Rp {{number_format($transaction->sub_total)}}</h4>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
        </section>
    </div>

    </div>
</div>
</section>
<script>
</script>
@endsection