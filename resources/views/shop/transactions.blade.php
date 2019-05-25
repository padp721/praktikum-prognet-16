@extends ('master-shop')

@section ('title', 'Toko Kerajinan Online - Transactions')

@section ('content')
  <!--================Cart Area =================-->
  <section class="cart_area" id="checkout">
      <div class="container">
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">ID Transaksi</th>
                              <th scope="col">Tanggal</th>
                              <th scope="col">Kurir</th>
                              <th scope="col">Biaya</th>
                              <th scope="col">Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($transactions as $transaction)
                          <tr class="clickable-row" onMouseOver="this.style.backgroundColor='lightblue'" onMouseOut="this.style.backgroundColor='white'"  data-href="{{route('user.transaction_detail',$transaction->id)}}">
                              <td>
                                  {{$transaction->id}}
                              </td>
                              <td>
                                 {{$transaction->date}}
                              </td>
                              <td>
                                 {{$transaction->courier->courier}}
                              </td>
                              <td>
                                  Rp {{number_format($transaction->sub_total)}}
                              </td>
                              <td>
                                   {{$transaction->status}}
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </section>
  <!--================End Cart Area =================-->
  @endsection