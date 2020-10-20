@extends('layouts.app')

@section('additional_headers')
  <!-- x-editor CSS  ============================================ -->
  <link rel="stylesheet" href="{{ asset('css/editor/select2.css') }}">
  <link rel="stylesheet" href="{{ asset('css/editor/datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/editor/bootstrap-editable.css') }}">
  <link rel="stylesheet" href="{{ asset('css/editor/x-editor-style.css') }}">
  <!-- normalize CSS  ============================================ -->
  <link rel="stylesheet" href="{{ asset('css/data-table/bootstrap-table.css') }}">
  <link rel="stylesheet" href="{{ asset('css/data-table/bootstrap-editable.css') }}">
  <!-- dropzone CSS  ============================================ -->
  <link rel="stylesheet" href="{{ asset('css/dropzone/dropzone.css') }}">
  <!-- chosen CSS  ============================================ -->
  <link rel="stylesheet" href="{{ asset('css/chosen/bootstrap-chosen.css') }}">

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
                                  <span class="bread-blod">Create New Cart</span>
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

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
  <div class="container-fluid">
    <div class="sparkline13-list">
        <div class="sparkline13-hd">
            <div class="main-sparkline13-hd">
                <h1>Create <span class="table-project-n">New</span> Cart</h1>
            </div>
        </div>
        <div class="sparkline13-graph">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="hpanel shadow-inner responsive-mg-b-30">
                  <div class="panel-header">
                  </div>
                  <div class="panel-body">
                      <div class="table-responsive wd-tb-cr">
                          <table class="table table-striped">
                              <thead class="bg-primary">
                                  <tr>
                                      <th>Name</th>
                                      <th>Quantity</th>
                                      <th>Amount</th>
                                      <th>Total Amount</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              @php
                                    $cartProducts = Cart::content();
                              @endphp
                              <tbody>
                                @foreach($cartProducts as $item)
                                  <tr>
                                      <td class="wp-50">
                                          <span class="text-success font-bold">{{ $item->name }}</span>
                                      </td>
                                      <td>
                                      <form action="{{ route('sell.update') }}" method="post">
                                        @csrf
                                          <input type="number" name="qty" value="{{ $item->qty }}" style="width: 60px;">
                                      </td>
                                      <td>{{ $item->price }} TK</td>
                                      <td>{{ $item->price*$item->qty }} TK</td>
                                      <td>
                                          <input type="hidden" name="id" value="{{ $item->rowId }}">
                                          <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                          <a href="{{ route('sell.remove', $item->rowId) }}" class="btn btn-danger btn-xs" style="color:#FFFFFF !important; margin-top: -4px;"><i class="fa fa-trash"></i></a>
                                        </form>
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
                  <div class="panel-footer">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <p class="text-center" style="font-size: 19px;">
                            <b>Quantity: </b>{{ Cart::count() }}
                        </p>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <p class="text-center" style="font-size: 19px;">
                            <b>Sub Total: </b>{{ Cart::subtotal() }} Tk
                        </p>
                      </div>
                    </div>
                    <hr style="margin-top: -6px;">
                    <div class="row">
                        <p class="text-center" style="font-size: 19px;">
                          <b>Total: </b>
                        </p>
                    </div>
                    <div class="row" style="margin-top: -15px;">
                        <p class="text-center" style="font-size: 32px;">
                                  {{ Cart::subtotal() }} Tk
                        </p>
                    </div>
                    <div class="row text-center">
                      <form action="{{route('sell.invoice')}}" method="post">
                        @csrf
                        <div class="row">
                            <p class="text-center" style="font-size: 19px;">
                              <b>Amount of Vat: </b> <input type="number" name="vat_amount" value="0" placeholder="0%" style="width: 60px;">
                            </p>
                        </div>
                        <div class="chosen-select-single mg-b-20">
                           <label><b>Select Customer</b></label>
                           <select name="customer_id" data-placeholder="Choose a Customer" class="chosen-select" tabindex="-1">
                               <option value="none" selected="" disabled="">Choose a Customer</option>
                               @foreach($customers as $cus)
                                  <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                               @endforeach
                           </select>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Create Invoice</button>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="datatable-dashv1-list custom-datatable-overright">
                  <div id="toolbar">
                      <select class="form-control dt-tb">
                        <option value="">Export Basic</option>
                        <option value="all">Export All</option>
                        <option value="selected">Export Selected</option>
                      </select>
                  </div>
                  <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                      data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                      <thead>
                          <tr>
                              <th class="text-center" data-field="name" data-editable="true">Name</th>
                              <th class="text-center" data-field="code" data-editable="true">Code</th>
                              <th class="text-center" data-field="selling price" data-editable="true">Selling Price</th>
                              <th class="text-center" data-field="expire date" data-editable="true">Expire Date</th>
                              <th class="text-center" data-field="add">Add</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($products as $row)
                          <tr>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->code }}</td>
                              <td>{{ $row->selling_price }}</td>
                              <td>{{ $row->expire_date }}</td>
                              <td>
                                <form action="{{ route('sell.save_created') }}" method="post">
                                  @csrf
                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                    <input type="hidden" name="name" value="{{ $row->name }}">
                                    <input type="hidden" name="qty" value="1">
                                    <input type="hidden" name="price" value="{{ $row->selling_price }}">
                                      <button type="submit" class="btn btn-primary btn-xs">
                                        <i class="fa fa-plus-square"></i>
                                      </button>
                                </form>
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<!-- Static Table End -->


@endsection

@section('additional_scripts')
<!-- data table JS ============================================ -->
  <script src="{{ asset('js/data-table/bootstrap-table.js')}}"></script>
  <script src="{{ asset('js/data-table/tableExport.js')}}"></script>
  <script src="{{ asset('js/data-table/data-table-active.js')}}"></script>
  <script src="{{ asset('js/data-table/bootstrap-table-editable.js')}}"></script>
  <script src="{{ asset('js/data-table/bootstrap-editable.js')}}"></script>
  <script src="{{ asset('js/data-table/bootstrap-table-resizable.js')}}"></script>
  <script src="{{ asset('js/data-table/colResizable-1.5.source.js')}}"></script>
  <script src="{{ asset('js/data-table/bootstrap-table-export.js')}}"></script>
<!--  editable JS  ============================================ -->
  <script src="{{ asset('js/editable/jquery.mockjax.js')}}"></script>
  <script src="{{ asset('js/editable/mock-active.js')}}"></script>
  <script src="{{ asset('js/editable/select2.js')}}"></script>
  <script src="{{ asset('js/editable/moment.min.js')}}"></script>
  <script src="{{ asset('js/editable/bootstrap-datetimepicker.js')}}"></script>
  <script src="{{ asset('js/editable/bootstrap-editable.js')}}"></script>
  <script src="{{ asset('js/editable/xediable-active.js')}}"></script>
<!-- Chart JS		============================================ -->
  <script src="{{ asset('js/chart/jquery.peity.min.js')}}"></script>
  <script src="{{ asset('js/peity/peity-active.js')}}"></script>
<!-- tab JS  ============================================ -->
  <script src="{{ asset('js/tab.js')}}"></script>
<!-- plugins JS  ============================================ -->
  <script src="{{ asset('js/plugins.js')}}"></script>

<!-- chosen JS  ============================================ -->
 <script src="{{ asset('js/chosen/chosen.jquery.js')}}"></script>
 <script src="{{ asset('js/chosen/chosen-active.js')}}"></script>


@endsection
