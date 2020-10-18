@extends('layouts.app')

@section('additional_headers')
      <!-- forms CSS ============================================ -->
      <link rel="stylesheet" href="{{ asset('css/form/all-type-forms.css') }}">
      <!-- dropzone CSS  ============================================ -->
      <link rel="stylesheet" href="{{ asset('css/dropzone/dropzone.css') }}">
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
                                <li><span class="bread-blod">Add New Category</span>
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

<div class="row">
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
    </div>
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
      <div class="sparkline10-list mg-tb-30 responsive-mg-t-0 table-mg-t-pro-n dk-res-t-pro-0 nk-ds-n-pro-t-0">
        <div class="sparkline10-hd">
           <div class="main-sparkline10-hd">
               <h1>Add New Category</h1>
           </div>
       </div>
    <form action="{{ route('category.save_created') }}" method="POST">
      @csrf
       <div class="sparkline10-graph">
           <div class="input-knob-dial-wrap">
               <div class="row">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <div class="form-group">
                         <label>Name Of Category</label>
                         <input name="category" type="text" class="form-control" placeholder="Add New Category">
                     </div>
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="payment-adress">
                               <button type="submit" class="btn btn-primary">submit</button>
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

@endsection

@section('additional_scripts')

    <!-- maskedinput JS    ============================================ -->
    <script src="{{ asset('js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{ asset('js/masking-active.js')}}"></script>
    <!-- datepicker JS    ============================================ -->
    <script src="{{ asset('js/datepicker/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('js/datepicker/datepicker-active.js')}}"></script>
    <!-- form validate JS	============================================ -->
    <script src="{{ asset('js/form-validation/jquery.form.min.js')}}"></script>
    <script src="{{ asset('js/form-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/form-validation/form-active.js')}}"></script>

@endsection
