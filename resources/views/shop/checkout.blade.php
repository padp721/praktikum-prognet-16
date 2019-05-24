@extends ('master-shop-checkout')

@section ('title', 'Toko Kerajinan Online - Cart')

@section ('content')

  <!--================Cart Area =================-->
  <section class="cart_area" id="checkout">
      <div class="container">
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Provinsi</th>
                              <th scope="col">Kabupaten</th>
                              <th scope="col">Alamat</th>
                              <th scope="col">Kurir</th>
                          </tr>
                      </thead>
                      <tbody>
                          <form action="{{route('user.bayar')}}" method="post">
                              @csrf
                          <tr>
                              <td>
                                  <input list="province" name="province" class="form-control" required>
                                  <datalist id="province">
                                    @for ($i = 0; $i < sizeof($province); $i++)
                                        <option value="{{$province[$i]['province_id']}}">{{$province[$i]['province']}}</option>
                                    @endfor
                                </datalist>
                              </td>
                              <td>
                                <input list="regency" name="regency" class="form-control" required>
                                  <datalist id="regency">
                                </datalist>
                              </td>
                              <td>
                                  <textarea name="address" id="address" class="form-control" cols="20" rows="5" required></textarea>
                              </td>
                              <td>
                                  <select class="shipping_select" name="courier_id" required>
                                      @foreach ($couriers as $courier)
                                        <option value="{{$courier->id}}">{{$courier->courier}}</option>
                                      @endforeach
                                </select>
                              </td>
                          </tr>
                          <tr class="out_button_area">
                              <td class="d-none-l">

                              </td>
                              <td class="">

                              </td>
                              <td>

                              </td>
                              <td>
                                  <div class="checkout_btn_inner d-flex align-items-center">
                                      <a class="gray_btn" href="{{route('user.view_cart')}}">Batal</a>
                                      <input type="submit" value="Bayar" class="primary-btn ml-2">
                                      </form>
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