@extends ('master-shop')

@section ('title', 'Toko Kerajinan Online - Cart')

@section ('content')
  <!--================Cart Area =================-->
  <section class="cart_area">
      <div class="container">
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Product</th>
                              <th scope="col">Price</th>
                              <th scope="col">Discount</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Total</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>
                          <form action="{{route('user.checkout')}}" id="checkout" method="POST">@csrf</form>
                          {{$i = 0}}
                          @foreach ($cart as $item)
                              <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/cart/cart1.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>{{$item->product->product_name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>Rp {{number_format($item->product->price)}}</h5>
                                </td>
                                <td>
                                    <h5>{{$item->product->discount}}%</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input form="checkout" type="number" name="qty_{{$i}}" id="sst" maxlength="12" value="{{$item->qty}}" max="{{$item->product->stock}}" min="1" class="input-text qty">
                                    </div>
                                </td>
                                <td>
                                    <h5>Rp {{number_format($item->product->price*$item->qty-(($item->product->price*$item->qty)*$item->product->discount/100))}}</h5>
                                </td>
                                <td>
                                    <form action="{{route('user.delete_cart',$item->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type="submit" name="delete" class="btn btn-danger" value="Delete">
                                    </form>
                                </td>
                            </tr>
                            {{$i++}}
                          @endforeach 
                          <tr class="out_button_area">
                              <td class="d-none-l">

                              </td>
                              <td class="">

                              </td>
                              <td>

                              </td>
                              <td>
                                  <div class="checkout_btn_inner d-flex align-items-center">
                                      <a class="gray_btn" href="{{route('user.product_list')}}">Continue Shopping</a>
                                      <input form="checkout" type="submit" value="Proceed to checkout" class="primary-btn ml-2">
                                  </div>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </section>
  <!--================End Cart Area =================-->
@endsection