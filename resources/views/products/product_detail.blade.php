@extends('layouts.app')

@section('additional_headers')
  <!-- forms CSS  ============================================ -->
  <link rel="stylesheet" href="{{ asset('css/form/all-type-forms.css') }}">
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
                                <li><a href="{{route('home')}}">Home</a> <span class="bread-slash">/</span>
                                </li>
                                <li>
                                  <a href="{{route('product.all_products')}}" class="bread-blod">All Products List</a> <span class="bread-slash">/</span>
                                </li>
                                <li>
                                  <span class="bread-blod">Product Detail</span>
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

    <div class="single-product-tab-area mg-t-15 mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <div id="myTabContent1" class="tab-content">
                        <div class="product-tab-list tab-pane fade active in" id="single-tab1">
                            <img src="/product_image/{{ $product->image }}" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="single-product-details res-pro-tb">
                        <h1>{{ $product->name }}</h1>
                        <span class="single-pro-star">{{ $product->code }}</span>
                        <div class="single-pro-price">
                          <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <dd><b>Selling Price:</b><span style="margin-left: .5rem;"> {{ $product->selling_price }} Taka</span></dd>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <dd><b>Buying Price:</b><span style="margin-left: .5rem;"> {{ $product->buying_price }} Taka</span></dd>
                              </div>
                          </div>
                        </div>
                        <div class="single-pro-price">
                          <dl>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <dd><b>Category:</b><span style="margin-left: .5rem;"> {{ $product->category->cat_name }} </span></dd>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <dd><b>Brand:</b><span style="margin-left: .5rem;"> {{ $product->brand->name }} </span></dd>
                                </div>
                            </div>
                          </dl>
                        </div>
                        <div class="single-pro-price">
                          <dl>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <dd><b>Supplier Name:</b><span style="margin-left: .5rem;"> {{ $product->supplier->name }} </span></dd>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <dd><b>Supplier Store:</b><span style="margin-left: .5rem;"> {{ $product->supplier->shop_name }} </span></dd>
                                </div>
                            </div>
                          </dl>
                        </div>
                        <div class="color-quality-pro">
                            <dl>
                              <div class="row">
                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <dd><b>Purchade Date:</b><span style="margin-left: .5rem;"> {{ $product->buy_date }} </span></dd>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <dd><b>Expire Price:</b><span style="margin-left: .5rem;"> {{ $product->expire_date }} </span></dd>
                                  </div>
                              </div>
                            </dl>

                            <div class="clear"></div>
                            <div class="single-pro-button">
                                <div class="pro-button">
                                    <a href="#">ADD TO Cart</a>
                                </div>
                                <div class="pro-viwer">
                                    <a href="{{ route('product.edit',$product->id) }}"><i class="fa fa-pencil"></i></a>
                                    <a href="#"><i class="fa fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="single-social-area">
                                <h3>share this on</h3>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-feed"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="single-pro-cn">
                            <h3>OVERVIEW</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additional_scripts')


@endsection
