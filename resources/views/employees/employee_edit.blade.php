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
                                <li>
                                  <a href="{{route('employee.all_employees')}}" class="bread-blod">All Employees List</a> <span class="bread-slash">/</span>
                                </li>
                                <li>
                                  <span class="bread-blod">Edit Employee Details</span>
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


<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">
                    <ul id="myTabedu1" class="tab-review-design">
                        <li class="active"><a href="#description">Basic Information Update</a></li>
                        <li><a href="#reviews">Personal Information Update</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad">
                                            <!-- <form action="/upload" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload"> -->
                                              <form action="{{ route('employee.save_edit') }}" method="POST" enctype="multipart/form-data" class="dropzone dropzone-custom needsclick add-professors" >
                                              		@csrf
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                          	<input type="hidden" name="employee_id" value="{{$employee->id}}">
                                                            <input type="hidden" name="user_id" value="{{$employee->user_id}}">
                                                            <input name="name" type="text" class="form-control" value="{{ $employee->user->name }}" placeholder="Name of Employee">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="address" type="text" class="form-control" value="{{ $employee->address }}" placeholder="Address">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="mobile" type="number" class="form-control" value="{{ $employee->user->mobile_no }}" maxlength="16" placeholder="Mobile Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <select name="gender" class="form-control">
                                                              <option value="0" @isset($employee){{ $employee->user->gender == 0 ? 'selected': '' }} @endisset>Male</option>
                                                              <option value="1" @isset($employee){{ $employee->user->gender == 1 ? 'selected': '' }} @endisset>Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="city" id="city" type="text" value="{{ $employee->city }}" class="form-control" placeholder="City">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="nid" type="number" class="form-control" value="{{ $employee->nid_number }}" maxlength="24" placeholder="National ID">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                  @if($employee->photo == "")
                                                                    <img src="{{ asset('img/user_icon/no-image.jpg')}}" alt="Editable Image" style="width: 70px; height: 70px; margin-left: 4rem">
                                                                  @else
                                                                    <img src="/employee_image/{{ $employee->photo }}" alt="Editable Image" style="width: 70px; height: 70px; margin-left: 4rem">
                                                                  @endif
                                                                </div>
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                    <label class="login2 pull-right pull-right-pro">File Upload Image</label>
                                                                </div>
                                                            </div>
                                                          </div>
                                                          <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                              <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                                  <div class="input append-small-btn" style="margin-top: 10px;">
                                                                      <input type="file" name="photo" id="append-small-btn" placeholder="no file selected">
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="payment-adress">
                                                          <h6 class="text-danger">P.s. : Please go to Personal Information Update</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade" id="reviews">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                              <div class="devit-card-custom">
                                                  <div class="form-group">
                                                      <input type="text" class="form-control" value="{{ $employee->user->email }}" name="email" placeholder="Email">
                                                  </div>
                                                  <div class="form-group">
                                                      <select name="type_employee" class="form-control">
                                                        <option value="{{ $employee->access_level }}" selected>{{ $employee->access_level }}</option>
                                                        <option value="Supplier">Supplier</option>
                                                        <option value="Account">Account</option>
                                                      </select>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="payment-adress">
                                                    <h6 class="text-danger">P.s. : Please go to Basic Information Update</h6>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">submit</a>
                                                </div>
                                            </div>
                                        </div>
                                      </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
  <script src="{{ asset('js/tab.js')}}"></script>
  <!-- pwstrength JS
		============================================ -->
    <script src="{{ asset('js/password-meter/pwstrength-bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/password-meter/zxcvbn.js')}}"></script>
    <script src="{{ asset('js/password-meter/password-meter-active.js')}}"></script>
@endsection
