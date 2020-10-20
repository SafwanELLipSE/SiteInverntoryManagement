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
                                <li><span class="bread-blod">All Orders List</span>
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
                          <h1>All <span class="table-project-n">Orders</span> List</h1>
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
                                      <th data-field="state" data-checkbox="true"></th>
                                      <th class="text-center" data-field="id">ID</th>
                                      <th class="text-center" data-field="invoice id" data-editable="true">Invoice ID</th>
                                      <th class="text-center" data-field="customer" data-editable="true">Customer</th>
                                      <th class="text-center" data-field="vat" data-editable="true">Vat</th>
                                      <th class="text-center" data-field="total amount" data-editable="true">Total Amount</th>
                                      <th class="text-center" data-field="created at" data-editable="true">Created At</th>
                                      <th class="text-center" data-field="action">Check</th>
                                      <th class="text-center" data-field="View">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($orders as $item)
                                  <tr>
                                    <td></td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->ref_number }}</td>
                                    <td>{{ $item->customer->name }}</td>
                                    <td>{{ $item->vat }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>{{ $item->created_at->format('d.m.Y') }}</td>
                                    <td class="datatable-ct"><i class="fa fa-check"></i></td>
                                    <td>
                                      <form  action="{{ route('sell.delete') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$item->id}}">
                                        <a href="{{ route('sell.invoice_main',$item->id) }}" class="btn btn-primary btn-xs" style="color:#FFFFFF !important; margin-right: .2rem"><i class="fa fa-info-circle edu-informatio"></i> view</a><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash edu-informatio"></i> Delete</button>
                                      </form>
                                      <form  action="{{ route('sell.invoice_pdf') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-success btn-xs" style="margin-left:.2rem; margin-top:.2rem;"><i class="fa fa-cloud-download edu-informatio"></i> Convert To PDF </button>
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


@endsection
