@extends ('master-shop')

@section ('title', 'Toko Kerajinan Online - Transaction Detail')

@section ('content')

  <!--================Order Details Area =================-->
  <section class="order_details section-margin--small">
    <div class="container">
      <p class="text-center billing-alert">
        @if (!isset($transaction->proof_of_payment))
            Please upload your proof of payment for verification purpose.
        @elseif(isset($transaction->proof_of_payment) && $transaction->status == 'unverified')
            Please wait until our administrator verify your purchase.
        @elseif($transaction->status == 'verified')
            Your purchase has been verified and will be sent to courier.
        @elseif($transaction->status == 'delivered')
            Your purchase has been delivered to your location.
        @elseif($transaction->status == 'success')
            Your purchase has been successful.
        @elseif($transaction->status == 'expired')
            Your purchase has been expired.
        @elseif($transaction->status == 'canceled')
            Your purchase has been canceled.
        @else
            Sorry, something went wrong.
        @endif
        </p>
      <div class="row mb-5">
        <div class="col-sm-6">
          <div class="confirmation-card">
            <h3 class="billing-title">Order Info</h3>
            <table class="order-rable">
              <tr>
                <td>Order number</td>
                <td>: {{$transaction->id}}</td>
              </tr>
              <tr>
                <td>Date</td>
                <td>: {{$transaction->date}}</td>
              </tr>
              <tr>
                <td>
                    Timeout
                    <input type="hidden" name="deadline" id="deadline" value="{{$transaction->timeout}}">
                </td>
                <td>: 
                    @if ($transaction->status == 'canceled' && !isset($transaction->proof_of_payment))
                        Canceled
                    @elseif(!isset($transaction->proof_of_payment))
                        <span id="countdown"></span>
                    @elseif($transaction->status == 'canceled')
                        Your money will be returned.
                    @else
                        Paid Off
                    @endif 
                </td>
              </tr>
              <tr>
                <td>Payment Status</td>
                <td>: {{$transaction->status}}</td>
              </tr>
            </table>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="confirmation-card">
            <h3 class="billing-title">Proof of Payment</h3>
            <table class="order-rable">
                @if (!isset($transaction->proof_of_payment) && $transaction->status == 'unverified')
              <tr>
                  <form enctype="multipart/form-data" method="post" action="{{route('user.upload_pop',$transaction->id)}}">
                    @csrf
                <td>Upload Proof of Payment</td>
              </tr>
              <tr>
                <td><input type="file" style="margin-top:3%;" id="proof_of_payment" name="proof_of_payment" accept="image/*" required></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td><input style="margin-top:2%;" type="submit" class="btn btn-sm btn-success" name="upload" value="Upload"></td>
                </form>
                <td>
                      <form action="{{route('user.cancel', $transaction->id)}}" method="post">
                        @method('put')
                        @csrf
                        <input type="submit" class="btn btn-sm btn-danger" value="Cancel Purchase" name="cancel" style="width:100%;height:100%">
                      </form>
                </td>
              </tr>
              @else
              <tr>
                  <td>
                      <a href="{{ asset('/storage/proof_of_payments/'.$transaction->proof_of_payment) }}" target="_blank">
                          <img src="{{ asset('/storage/proof_of_payments/'.$transaction->proof_of_payment) }}" height="105" alt="">
                      </a>
                  </td>
                  <td>
                      @if($transaction->status == 'delivered')
                      <form action="{{route('user.recieve', $transaction->id)}}" method="post">
                        @method('PATCH')
                        @csrf
                        <input type="submit" class="btn btn-lg btn-success" value="Recieve Package" name="recieve" style="width:100%;height:100%">
                      </form>
                      @endif
                      @if($transaction->status == 'unverified' || $transaction->status == 'verified')
                      <br><br>
                      <form action="{{route('user.cancel', $transaction->id)}}" method="post">
                        @method('put')
                        @csrf
                        <input type="submit" class="btn btn-lg btn-danger" value="Cancel Purchase" name="cancel" style="width:100%;height:100%">
                      </form>
                      @endif
                  </td>
              </tr>
              @endif
            </table>
          </div>
        </div>

        <div class="col-md-12" style="margin-top:2%;">
          <div class="confirmation-card">
            <h3 class="billing-title">Shipping Address</h3>
            <table class="order-rable">
              <tr>
                <td>Address</td>
                <td>: {{$transaction->address}}</td>
              </tr>
              <tr>
                <td>Kabupaten/Kota</td>
                <td>: {{$city[$transaction->regency-1]['city_name']}}</td>
              </tr>
              <tr>
                <td>Provinsi</td>
                <td>: {{$province[$transaction->province-1]['province']}}</td>
              </tr>
              <tr>
                <td>Postcode</td>
                <td>: {{$city[$transaction->regency-1]['postal_code']}}</td>
              </tr>
              <tr>
                <td>Courier</td>
                <td>: {{$transaction->courier->courier}}</td>
              </tr>
            </table>
          </div>
        </div>

      </div>
      <div class="order_details_table">
        <h2>Order Details</h2>
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
    </div>
  </section>
  <!--================End Order Details Area =================-->
@endsection