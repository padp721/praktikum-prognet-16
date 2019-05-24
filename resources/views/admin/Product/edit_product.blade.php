@extends ('master-dashboard')

@section ('title', 'Edit Product')

@section ('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-home"></i>
                </li>
                <li><span>Product</span></li>
                <li><span>Edit</span></li>
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
                    <h2 class="panel-title">Edit Product</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" enctype="multipart/form-data" method="post" id="add_product" action="{{route('product.update',$product->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="product_name">Nama Produk</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="product_name" name="product_name" value="{{$product->product_name}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="price">Harga</label>
                            <div class="col-md-8">
                                <div class="input-group mb-md">
                                    <span class="input-group-addon">Rp</span>
                                    <input type="text" class="form-control" id="price" name="price" maxlength="7" value="{{$product->price}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kategori</label>
                            <div class="col-md-8">
                                <select class="form-control" name="categories[]" multiple="multiple" data-plugin-multiselect="" id="ms_example0" style="display: none;">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}"@foreach ($product->categories as $product_category) @if ($product_category->id == $category->id) selected @endif @endforeach>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="description">Deskripsi</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="description" rows="4">{{$product->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="stock">Stok</label>
                            <div class="col-md-3">
                                <input type="number" class="form-control" id="stock" name="stock" min="1" value="{{$product->stock}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="discount">Diskon</label>
                            <div class="col-md-3">
                                <div class="input-group mb-md">
                                    <input type="number" class="form-control" id="discount" name="discount" value="{{$product->discount}}" min="0" required>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="weight">Gambar Produk</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" id="image_name" name="image_name[]" accept="image/*" multiple>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="product_name"></label>
                            <div class="col-md-5">
                                <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit">
                                <a href="{{ route('admin.product') }}" class="btn btn-default" >Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        
        <div class="col-md-5">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Product Images</h2>
                </header>
                <div class="panel-body">
                    @foreach ($product->product_images as $image)
                        <div class="col-sm-6">
                            <center>
                                <form action="{{route('product.imageDelete',$image->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="item spaced">
                                        <a href="{{ asset('/storage/product_image/'.$image->image_name) }}">
                                            <img class="img-thumbnail" src="{{ asset('/storage/product_image/'.$image->image_name) }}" alt="">
                                        </a>
                                    </div>
                                    <input type="submit" class="btn btn-danger" style="margin-top:3%;margin-bottom:15%;" value="Delete">
                                </form>
                            </center>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</section>
<script>
</script>
@endsection