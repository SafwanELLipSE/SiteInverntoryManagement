@extends('layouts.app')

@section('additional_headers')
      <!-- forms CSS ============================================ -->
      <link rel="stylesheet" href="{{ asset('css/form/all-type-forms.css') }}">
      <!-- dropzone CSS  ============================================ -->
      <link rel="stylesheet" href="{{ asset('css/dropzone/dropzone.css') }}">
      <!-- chosen CSS  ============================================ -->
      <link rel="stylesheet" href="{{ asset('css/chosen/bootstrap-chosen.css') }}">
      <!-- datapicker CSS  ============================================ -->
      <link rel="stylesheet" href="{{ asset('css/datapicker/datepicker3.css') }}">
@endsection

@section('content')

<!-- Header starts -->
<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <form role="search" class="sr-input-func">
                                    <input type="text" placeholder="Search..." class="search-int form-control">
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu">
                                <li>
                                  <a href="{{route('home')}}">Home</a> <span class="bread-slash">/</span>
                                </li>
                                <li>
                                    <a href="{{route('product.all_products')}}">All Products List</a> <span class="bread-slash">/</span>
                                </li>
                                <li>
                                    <a href="{{route('product.details',$product->id)}}">Product Detail</a> <span class="bread-slash">/</span>
                                </li>
                                <li>
                                  <span class="bread-blod">Edit Product</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header Ends -->

</div><!-- dont delete this -->

<!-- Main Starts -->
<div class="row">
  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
  </div>
  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
    <div class="admin-pro-accordion-wrap shadow-inner">
          <div class="alert-title">
              <h2>Edit Product Information</h2>
          </div>
        <form action="{{ route('product.save_edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="panel-group edu-custon-design" id="accordion2">
              <div class="panel panel-default">
                  <div class="panel-heading accordion-head">
                      <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion2" href="#collapse4">Product Detail 1</a>
                      </h4>
                  </div>
                  <div id="collapse4" class="panel-collapse panel-ic collapse in">
                      <div class="panel-body admin-panel-content animated flash">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <div class="chosen-select-single mg-b-20">
                                <label>Product Name</label>
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input name="name" type="text" value="{{ $product->name }}" class="form-control" placeholder="Name of Product">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <div class="chosen-select-single mg-b-20">
                                <label>Product Code</label>
                                <input name="code" type="text" value="{{ $product->code }}" class="form-control" placeholder="Product Code">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="chosen-select-single mg-b-20">
                                 <label>Select Category</label>
                                 <select id="category" name="category" data-placeholder="Choose a Category" class="form-control" tabindex="-1" required>
                                     <option value="{{ $product->category_id }}" selected>{{ $product->category->cat_name }}</option>
                                     @foreach($categories as $category)
                                        <option data-department="{{$category->id}}" value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                     @endforeach
                                 </select>
                               </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <div class="chosen-select-single mg-b-20">
                                 <label>Select Supplier</label>
                                 <select name="supplier" data-placeholder="Choose a Product" class="chosen-select" tabindex="-1">
                                     <option value="{{ $product->supplier_id }}">{{ $product->supplier->name }}</option>
                                     @foreach($suppliers as $sup)
                                        <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                     @endforeach
                                 </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="chosen-select-single mg-b-20">
                                 <label>Select Brand</label>
                                 <select id="brand" name="brand" data-placeholder="Choose a Brand" class="form-control" tabindex="-1" required>
                                     <option value="{{ $product->brand_id }}" selected>{{ $product->brand->name }}</option>
                                     @foreach($categories as $cat)
                                        @foreach($cat->productBrands as $item)
                                          <option data-department="{{$item->category_id}}" value="{{$item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endforeach
                                 </select>
                               </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group-inner">
                          <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
                              <div class="row">
                                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    @if($product->image == "")
                                    <img src="{{ asset('img/user_icon/no-image.jpg')}}" alt="Editable Image" style="width: 70px; height: 70px; margin-left: 4rem">
                                    @else
                                      <img src="/product_image/{{ $product->image }}" alt="Editable Image" style="width: 70px; height: 70px; margin-left: 4rem">
                                    @endif
                                  </div>
                                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                      <label class="login2 pull-right pull-right-pro">File Upload Image</label>
                                  </div>
                              </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
                                <div class="file-upload-inner file-upload-inner-right ts-forms">
                                    <div class="input append-small-btn" style="margin-top: 10px;">
                                        <input type="file" name="image" id="append-small-btn" placeholder="no file selected">
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-adress">
                                  <a data-toggle="collapse" data-parent="#accordion2" href="#collapse5" class="btn btn-success" style="color: #fff;">Next <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="panel panel-default">
                  <div class="panel-heading accordion-head">
                      <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion2" href="#collapse5">Product Detail 2</a>
                      </h4>
                  </div>
                  <div id="collapse5" class="panel-collapse panel-ic collapse">
                      <div class="panel-body admin-panel-content animated flash">
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <div class="chosen-select-single mg-b-20">
                                <label>Product Garage</label>
                                <input name="garage" type="text" value="{{ $product->garage }}" class="form-control" placeholder="Name of Product">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <div class="chosen-select-single mg-b-20">
                                <label>Product Route</label>
                                <input name="route" type="text" value="{{ $product->route }}" class="form-control" placeholder="Which Route">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="sparkline16-graph">
                              <div class="date-picker-inner">
                                <div class="form-group data-custon-pick" id="data_3">
                                    <label>Purchase Date</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input name="buy_date" type="text" value="{{ $product->buy_date }}" class="form-control" value="10/11/2013">
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="sparkline16-graph">
                              <div class="date-picker-inner">
                                <div class="form-group data-custon-pick" id="data_3">
                                    <label>Expire Date</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input name="expire_date" type="text" value="{{ $product->expire_date }}" class="form-control" value="10/11/2013">
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <div class="chosen-select-single mg-b-20">
                                <label>Buying Price</label>
                                <input name="buying_price" type="number" value="{{ $product->buying_price }}"  class="form-control" placeholder="Buying Price Of Product">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <div class="chosen-select-single mg-b-20">
                                <label>Selling Price</label>
                                <input name="selling_price" value="{{ $product->selling_price }}" type="number" class="form-control" placeholder="Selling Price Of Product">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-adress">
                                  <a data-toggle="collapse" data-parent="#accordion2" href="#collapse4" class="btn btn-danger" style="color: #fff;"><i class="fa fa-arrow-left"></i> Previous</a>
                                  <button type="submit" class="btn btn-success" style="margin-top: 14px;">submit</button>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        </form>
      </div>
  </div>
  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
  </div>
</div>

<!-- Main Ends -->

@endsection

@section('additional_scripts')
  <!-- maskedinput JS
		============================================ -->
    <script src="{{ asset('js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{ asset('js/masking-active.js')}}"></script>
    <!-- datepicker JS
		============================================ -->
    <script src="{{ asset('js/datepicker/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('js/datepicker/datepicker-active.js')}}"></script>
    <!-- form validate JS	============================================ -->
    <script src="{{ asset('js/form-validation/jquery.form.min.js')}}"></script>
    <script src="{{ asset('js/form-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/form-validation/form-active.js')}}"></script>

    <!-- tab JS
    ============================================ -->
    <script src="{{ asset('js/tab.js') }}"></script>

    <!-- chosen JS  ============================================ -->
    <script src="{{ asset('js/chosen/chosen.jquery.js') }}"></script>
    <script src="{{ asset('js/chosen/chosen-active.js') }}"></script>

    <!-- datapicker JS 	============================================ -->
    <script src="{{ asset('js/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/datapicker/datepicker-active.js') }}"></script>

    <script src="{{ asset('personal/js/product.js') }}"></script>

@endsection
