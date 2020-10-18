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
  <!-- modals CSS  ============================================ -->
  <link rel="stylesheet" href="{{ asset('css/modals.css') }}">
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
                                  <span class="bread-blod">All Stocks List</span>
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
                          <h1>All <span class="table-project-n">Stocks</span> List</h1>
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
                                      <th class="text-center">Product Name</th>
                                      <th class="text-center" data-field="price" data-editable="true">Price</th>
                                      <th class="text-center" data-field="reserve stock" data-editable="true">Reserve Stock</th>
                                      <th class="text-center" data-field="amount" data-editable="true">Amount</th>
                                      <th class="text-center" data-field="previous stock" data-editable="true">Previous Stock</th>
                                      <th class="text-center" data-field="re-supply" data-editable="true">Re-Supply</th>
                                      <th class="text-center" data-field="created by" data-editable="true">Created By</th>
                                      <th class="text-center" data-field="created at" data-editable="true">Created At</th>
                                      <th class="text-center" data-field="action">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($stocks as $item)
                                  <tr>
                                    <td></td>
                                    <td>{{$item->id}}</td>
                                    <td>
                                      @if($item->is_active == 1)
                                        <span class="label-success label"> {{$item->product->name}} </span>
                                      @elseif($item->is_active == 0)
                                        <span class="label-danger label"> {{$item->product->name}} </span>
                                      @endif
                                    </td>
                                    <td>{{$item->product->selling_price }}</td>
                                    <td>{{$item->reserve_number}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{$item->previous_stock}}</td>
                                    <td>{{$item->restock}}</td>
                                    <td>{!! Auth::user($item->created_by)->name !!}</td>
                                    <td>{{ $item->created_at->format('d.m.Y') }}</td>
                                    <td>
                                      <a data-stockid="{{ $item->id }}" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#WarningModalhdbgcl" style="color:#FFFFFF !important; margin-right: .2rem"><i class="fa fa-pencil-square"></i></a>
                                      <a data-stockid="{{ $item->id }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#PrimaryModalhdbgcl" style="color:#FFFFFF !important; margin-right: .2rem"><i class="fa fa-cloud-upload"></i></a>
                                      <a data-stockid="{{ $item->id }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#PrimaryModalhdbgclSupply" style="color:#FFFFFF !important; margin-right: .2rem"><i class="fa fa-plus-square"></i></a>
                                      @if($item->is_active == 1)
                                        <a data-stockid="{{ $item->id }}" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#InformationproModalhdbgclActive" style="color:#FFFFFF !important; margin-right: .2rem"><i class="fa fa-check-square"></i></a>
                                      @elseif($item->is_active == 0)
                                        <a data-stockid="{{ $item->id }}" class="btn btn-success btn-xs" data-toggle="modal" data-target="#InformationproModalhdbgclInactive" style="color:#FFFFFF !important; margin-right: .2rem"><i class="fa fa-check-square"></i></a>
                                      @endif
                                      <a href="{{ route('stock.record',$item->id) }}" class="btn btn-primary btn-xs" style="color:#FFFFFF !important;"><i class="fa fa-info-circle"></i></a>
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


<!-- Model Start -->
<!-- Edit -->
<div id="WarningModalhdbgcl" class="modal modal-edu-general Customwidth-popup-WarningModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-3">
                <h4 class="modal-title">Edit Stock</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="modal-body">
              <form action="{{ route('stock.save_edit') }}" method="POST">
                @csrf
                  <div class="sparkline10-graph">
                      <div class="input-knob-dial-wrap">
                          <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="chosen-select-single mg-b-20">
                                   <label><b>Select Product</b></label>
                                   <select name="product" data-placeholder="Choose a Category" class="chosen-select" tabindex="-1">
                                       <option value="none" selected="" disabled="">Choose a Product</option>
                                       @foreach($products as $item)
                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="form-group">
                                    <label>Amount to Stock</label>
                                    <input type="hidden" name="stock_id" id="stock_id" value="">
                                    <input name="stock_number" type="text" class="form-control" placeholder="Number Of Product to Stock">
                                </div>
                              </div>
                          </div>
                       </div>
                   </div>
            </div>
            <div class="modal-footer warning-md">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- Update -->
<div id="PrimaryModalhdbgcl" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title">Withdraw from Stock</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="modal-body">
              <form action="{{ route('stock.save_update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Amount to Withdraw</label>
                    <input type="hidden" name="stock_id" id="stock_id" value="">
                    <input name="withdraw_number" type="text" class="form-control" placeholder="Number Of Product withdraw from Stock">
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-primary">Withdraw</button>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Re-Supply -->
<div id="PrimaryModalhdbgclSupply" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title">Re-Supply from Stock</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="modal-body">
              <form action="{{ route('stock.save_restock') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Amount to Re-Stock</label>
                    <input type="hidden" name="stock_id" id="stock_id" value="">
                    <input name="restock_number" type="text" class="form-control" placeholder="Number Of Product Re-Supply from Stock">
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-info">Cancel</button>
                <button type="submit" class="btn btn-info">Re-Stock</button>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Active -->
<div id="InformationproModalhdbgclInactive" class="modal modal-edu-general fullwidth-popup-InformationproModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-2">
                <h4 class="modal-title">Active Stock</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="modal-body">
              <form action="{{ route('stock.save_status') }}" method="POST">
                @csrf
                <input type="hidden" name="stock_id" id="stock_id" value="">
                <input type="hidden" name="stock_status" value="1">
                <span class="educate-icon educate-info modal-check-pro information-icon-pro"> </span>
                <h2>Active This Stock!</h2>
                <p>Please, Press The Process Button!!!</p>
            </div>
            <div class="modal-footer info-md">
                  <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                  <button type="submit" class="btn btn-primary">Process</button>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Inactive -->
<div id="InformationproModalhdbgclActive" class="modal modal-edu-general fullwidth-popup-InformationproModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-2">
                <h4 class="modal-title">Inactive Stock</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="modal-body">
              <form action="{{ route('stock.save_status') }}" method="POST">
                @csrf
                  <input type="hidden" name="stock_id" id="stock_id" value="">
                  <input type="hidden" name="stock_status" value="0">
                  <span class="educate-icon educate-info modal-check-pro information-icon-pro"> </span>
                  <h2>Inactive This Stock!</h2>
                  <p>Please, Press The Process Button!!!</p>
            </div>
            <div class="modal-footer info-md">
                  <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                  <button type="submit" class="btn btn-primary">Process</button>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Model End -->

@endsection

@section('additional_scripts')
<script type="text/javascript">
    $('#WarningModalhdbgcl').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var stock_id = button.data('stockid')
        var modal = $(this)
        modal.find('.modal-body #stock_id').val(stock_id);
    })

    $('#PrimaryModalhdbgcl').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var stock_id = button.data('stockid')
        var modal = $(this)
        modal.find('.modal-body #stock_id').val(stock_id);
    })

    $('#PrimaryModalhdbgclSupply').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var stock_id = button.data('stockid')
        var modal = $(this)
        modal.find('.modal-body #stock_id').val(stock_id);
    })

    $('#InformationproModalhdbgclActive').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var stock_id = button.data('stockid')
        var modal = $(this)
        modal.find('.modal-body #stock_id').val(stock_id);
    })

    $('#InformationproModalhdbgclInactive').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var stock_id = button.data('stockid')
        var modal = $(this)
        modal.find('.modal-body #stock_id').val(stock_id);
    })
</script>
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
