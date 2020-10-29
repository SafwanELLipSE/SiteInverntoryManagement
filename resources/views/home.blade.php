@extends('layouts.app')

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
                                <li><a href="">Home</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Dashboard</span>
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

<div class="income-order-visit-user-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="income-dashone-total reso-mg-b-30" style="box-shadow: 1px 1px 1px 1.5px #888888;">
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-edu-rate">
                                <h3><span><i class="fa fa-product-hunt"></i> </span> <span class="counter">{{ $getProductCount }}</span></h3>
                            </div>
                        </div>
                        <div class="income-range">
                            <p>Total Products</p>
                            <span class="income-percentange bg-green"><span class="counter">95</span>% <i class="fa fa-bolt"></i>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="income-dashone-total" style="box-shadow: 1px 1px 1px 1.5px #888888;">
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-edu-rate">
                                <h3><span><i class="fa fa-glass"></i></span> <span class="counter"></span>{{ $getBrandCount }}</h3>
                            </div>
                        </div>
                        <div class="income-range order-cl">
                            <p>Total Brands</p>
                            <span class="income-percentange bg-red"><span class="counter">65</span>% <i class="fa fa-level-up"></i>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="income-dashone-total res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30" style="box-shadow: 1px 1px 1px 1.5px #888888;">
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-edu-rate">
                                <h3><span><i class="fa fa-cutlery"></i></span> <span class="counter"></span>{{ $getCategoryCount }}</h3>
                            </div>
                        </div>
                        <div class="income-range visitor-cl">
                            <p>Total Categories</p>
                            <span class="income-percentange bg-blue"><span class="counter">75</span>% <i class="fa fa-level-up"></i>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="income-dashone-total res-mg-t-30 dk-res-t-pro-30" style="box-shadow: 1px 1px 1px 1.5px #888888;">
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-edu-rate">
                                <h3><span><i class="fa fa-user-plus"></i></span> <span class="counter"></span>{{ $getSupplierCount }}</h3>
                            </div>
                        </div>
                        <div class="income-range low-value-cl">
                            <p>Total Suppliers</p>
                            <span class="income-percentange bg-purple"><span class="counter">35</span>% <i class="fa fa-level-down"></i>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="income-order-visit-user-area" style="margin-top:1rem;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <div class="income-dashone-total" style="box-shadow: 1px 1px 1px 1.5px #888888;">
                  <div class="income-dashone-pro">
                      <div class="income-rate-total">
                          <div class="price-edu-rate">
                              <h3><span><i class="fa fa-money"></i></span> <span class="counter"></span>{{ $getAccountCount }}</h3>
                          </div>
                      </div>
                      <div class="income-range order-cl">
                          <p>Total Accounts</p>
                          <span class="income-percentange bg-green"><span class="counter">65</span>% <i class="fa fa-level-up"></i>
                          </span>
                      </div>
                      <div class="clear"></div>
                  </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="income-dashone-total" style="box-shadow: 1px 1px 1px 1.5px #888888;">
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-edu-rate">
                                <h3><span><i class="fa fa-user-circle-o"></i></span> <span class="counter"></span>{{ $getEmployeeCount }}</h3>
                            </div>
                        </div>
                        <div class="income-range order-cl">
                            <p>Total Employees</p>
                            <span class="income-percentange bg-red"><span class="counter">65</span>% <i class="fa fa-level-up"></i>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="income-dashone-total res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30" style="box-shadow: 1px 1px 1px 1.5px #888888;">
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-edu-rate">
                                <h3><span><i class="fa fa-users"></i></span> <span class="counter"></span>{{ $getSiteManagerCount }}</h3>
                            </div>
                        </div>
                        <div class="income-range visitor-cl">
                            <p>Total Site Manager</p>
                            <span class="income-percentange bg-blue"><span class="counter">75</span>% <i class="fa fa-level-up"></i>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <div class="income-dashone-total res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30" style="box-shadow: 1px 1px 1px 1.5px #888888;">
                  <div class="income-dashone-pro">
                      <div class="income-rate-total">
                          <div class="price-edu-rate">
                              <h3><span><i class="fa fa-shopping-cart"></i></span> <span class="counter"></span>{{ $getOrderCount }}</h3>
                          </div>
                      </div>
                      <div class="income-range visitor-cl">
                          <p>Total Order</p>
                          <span class="income-percentange bg-purple"><span class="counter">75</span>% <i class="fa fa-level-up"></i>
                          </span>
                      </div>
                      <div class="clear"></div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->isMasterAdmin() ||  Auth::user()->isSiteManager())
<div class="product-sales-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="product-sales-chart" style="box-shadow: 1px 1px 1px 1.5px #888888;">
                    <div class="portlet-title">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="caption pro-sl-hd">
                                    <span class="caption-subject"><b>Daily Order History Graph</b></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="actions graph-rp graph-rp-dl">
                                    <p>All Earnings are in million $</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="height: 356px;">

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="social-media-edu  mg-b-10 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n" style="box-shadow: 1px 1px 1px 1.5px #888888; margin-bottom: 1.1rem;">
                    <i class="fa fa-balance-scale"></i>
                    <div class="social-edu-ctn">
                        <h3>{{ $today }} Orders</h3>
                        <p>Today's Orders</p>
                    </div>
                </div>
                <div class="social-media-edu twitter-clmg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n" style="box-shadow: 1px 1px 1px 1.5px #888888; margin-bottom: 1.1rem;">
                    <i style="color: darkgreen" class="fa fa-balance-scale"></i>
                    <div class="social-edu-ctn">
                        <h3 style="color: darkgreen">{{ $yesterday }} Orders</h3>
                        <p>Yesterday's Orders</p>
                    </div>
                </div>
                <div class="social-media-edu linkedin-cl  mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n" style="box-shadow: 1px 1px 1px 1.5px #888888; margin-bottom: 1.1rem;">
                    <i class="fa fa-balance-scale"></i>
                    <div class="social-edu-ctn">
                        <h3>{{ $lastWeek }} Orders</h3>
                        <p>Last Week's Orders</p>
                    </div>
                </div>
                <div class="social-media-edu youtube-cl table-dis-n-pro tb-sm-res-d-n dk-res-t-d-n" style="box-shadow: 1px 1px 1px 1.5px #888888; margin-bottom: 1.1rem;">
                    <i class="fa fa-balance-scale"></i>
                    <div class="social-edu-ctn">
                        <h3>{{ $lastYear }} Orders</h3>
                        <p>Last Year's Orders</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


@endsection
