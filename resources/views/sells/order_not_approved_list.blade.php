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
                                <li><span class="bread-blod">Not Approved Orders List</span>
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
                          <h1>Not Approved <span class="table-project-n">Orders</span> List</h1>
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
                                      <th class="text-center" data-field="invoice id" data-editable="true">Invoice ID</th>
                                      <th class="text-center" data-field="order by" data-editable="true">Order By</th>
                                      <th class="text-center" data-field="total amount" data-editable="true">Total Amount</th>
                                      <th class="text-center" data-field="status">Status</th>
                                      <th class="text-center" data-field="created at" data-editable="true">Created At</th>
                                      <th class="text-center" data-field="View">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($orders as $item)
                                  <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->ref_number }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>
                                      @if($item->status == 1)
                                        <span class="label-success label"> {{  App\Order::getStatus($item->status) }} </span>
                                      @elseif($item->status == 0)
                                        <span class="label-danger label"> {{ App\Order::getStatus($item->status) }} </span>
                                      @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d.m.Y') }}</td>
                                    <td>
                                      <form  action="{{ route('sell.delete') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$item->id}}">
                                        <a href="{{ route('sell.invoice_main',$item->id) }}" class="btn btn-primary btn-xs" style="color:#FFFFFF !important; margin-right: .2rem"><i class="fa fa-info-circle edu-informatio"></i> view</a><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash edu-informatio"></i> Delete</button>
                                      </form>
                                      <a data-orderid="{{ $item->id }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#InformationproModalhdbgclActive" style="color:#FFFFFF !important; margin-right: .2rem; margin-top:.1rem;"><i class="fa fa-check"> Approved</i></a>
                                      <a data-orderid="{{ $item->id }}" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#InformationproModalhdbgclInactive" style="color:#FFFFFF !important; margin-right: .2rem; margin-top:.1rem;"><i class="fa fa-times"> Not Approved</i></a>
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


<!-- Model Start -->
<!-- Active -->
<div id="InformationproModalhdbgclActive" class="modal modal-edu-general fullwidth-popup-InformationproModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-2">
                <h4 class="modal-title">Active Stock</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="modal-body">
              <form action="{{ route('sell.status') }}" method="POST">
                @csrf
                <input type="hidden" name="order_id" id="order_id" value="">
                <span class="educate-icon educate-info modal-check-pro information-icon-pro"> </span>
                <h2>Approved This Order!</h2>
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
<div id="InformationproModalhdbgclInactive" class="modal modal-edu-general fullwidth-popup-InformationproModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-2">
                <h4 class="modal-title">Inactive Stock</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="modal-body">
              <form action="{{ route('sell.status') }}" method="POST">
                @csrf
                  <input type="hidden" name="order_id" id="order_id" value="">
                  <span class="educate-icon educate-info modal-check-pro information-icon-pro"> </span>
                  <h2>Not Approved This Order!</h2>
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
    $('#InformationproModalhdbgclActive').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var order_id = button.data('orderid')
        var modal = $(this)
        modal.find('.modal-body #order_id').val(order_id);
    })

    $('#InformationproModalhdbgclInactive').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var order_id = button.data('orderid')
        var modal = $(this)
        modal.find('.modal-body #order_id').val(order_id);
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


@endsection
