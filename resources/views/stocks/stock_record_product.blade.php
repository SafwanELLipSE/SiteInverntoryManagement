@extends('layouts.app')
  <!-- x-editor CSS  ============================================ -->
  <link rel="stylesheet" href="{{ asset('css/editor/select2.css') }}">
  <link rel="stylesheet" href="{{ asset('css/editor/datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/editor/bootstrap-editable.css') }}">
  <link rel="stylesheet" href="{{ asset('css/editor/x-editor-style.css') }}">
  <!-- normalize CSS  ============================================ -->
  <link rel="stylesheet" href="{{ asset('css/data-table/bootstrap-table.css') }}">
  <link rel="stylesheet" href="{{ asset('css/data-table/bootstrap-editable.css') }}">

@section('additional_headers')

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
                                <li><span class="bread-blod">Stocks List of {{ $productName }}</span>
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
      <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="sparkline13-list">
                  <div class="sparkline13-hd">
                      <div class="main-sparkline13-hd">
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <h1>{{ $productName }}<span class="table-project-n"> Stock</span> List</h1>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <a href="{{ route('stock.excel_report',$id) }}" class="btn btn-primary" style="float:right !important;"><i class="fa fa-print"></i> Print</a>
                           </div>
                        </div>
                      </div>
                  </div>
                  <div class="sparkline13-graph">
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
                                      <th class="text-center" data-field="id">ID</th>
                                      <th class="text-center">Product Name</th>
                                      <th class="text-center" data-field="current quantity" data-editable="true">Current Quantity</th>
                                      <th class="text-center" data-field="current amount" data-editable="true">Current Amount</th>
                                      <th class="text-center" data-field="withdraw quantity" data-editable="true">Withdraw Quantity</th>
                                      <th class="text-center" data-field="withdraw amount" data-editable="true">Withdraw Amount</th>
                                      <th class="text-center" data-field="restock quantity" data-editable="true">ReStock Quantity</th>
                                      <th class="text-center" data-field="status" data-editable="true">Status</th>
                                      <th class="text-center" data-field="created by" data-editable="true">Created By</th>
                                      <th class="text-center" data-field="created at" data-editable="true">Created At</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($stock_records as $item)
                                  <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->stock->product->name}}</td>
                                    <td>{{$item->current_quantity }}</td>
                                    <td>{{$item->current_amount}}</td>
                                    <td>{{$item->withdraw_quantity}}</td>
                                    <td>{{$item->withdraw_amount}}</td>
                                    <td>{{$item->restock_quantity}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>{!! Auth::user($item->created_by)->name !!}</td>
                                    <td>{{ $item->created_at->format('d.m.Y') }}</td>
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

@endsection
