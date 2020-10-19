@extends('layouts.app')

@section('additional_headers')
      <!-- forms CSS ============================================ -->
      <link rel="stylesheet" href="{{ asset('css/form/all-type-forms.css') }}">
      <!-- dropzone CSS  ============================================ -->
      <link rel="stylesheet" href="{{ asset('css/dropzone/dropzone.css') }}">
      <!-- tabs CSS  ============================================ -->
      <link rel="stylesheet" href="{{ asset('css/tabs.css') }}">
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
                                  <a href="{{route('manager.all_managers')}}" class="bread-blod">All managers List</a> <span class="bread-slash">/</span>
                                </li>
                                <li>
                                  <span class="bread-blod">Edit Manager Information</span>
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
<div class="admintab-area mg-b-15">
      <div class="container-fluid">
            <div class="row">

                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                </div>
                <form action="{{ route('manager.save_edit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                  <div class="alert-title">
                      <h2>Edit Manager Information</h2>
                  </div>
                    <div class="admintab-wrap edu-tab1 mg-t-30">
                        <ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1 tab-menu-right">
                            <li>
                              <a data-toggle="tab" href="#TabDetails2"><span class="edu-icon edu-analytics-arrow tab-custon-ic"></span>Email & Password</a>
                            </li>
                            <li>
                              <a data-toggle="tab" href="#TabProject2"><span class="edu-icon edu-analytics-bridge tab-custon-ic"></span>Manager Credentials</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="TabProject2" class="tab-pane in active animated flipInY custon-tab-style1">
                              <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <div class="form-group">
                                      <input type="hidden" name="manager_id" value="{{ $manager->id }}">
                                      <input name="name" value="{{ $manager->user->name }}" type="text" class="form-control" placeholder="Name of manager">
                                  </div>
                                  <div class="form-group">
                                      <input name="address" value="{{ $manager->address }}" type="text" class="form-control" placeholder="Address">
                                  </div>
                                  <div class="form-group">
                                      <input name="mobile" value="{{ $manager->user->mobile_no }}" type="number" class="form-control" maxlength="16" placeholder="Mobile Number">
                                  </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
                                  <div class="form-group">
                                      <select name="gender" class="form-control">
                                        <option value="{{ $manager->user->gender }}" selected>{!! App\Site_manager::getGender($manager->gender) !!}</option>
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <input name="city" value="{{ $manager->city }}" id="city" type="text" class="form-control" placeholder="City">
                                  </div>
                                  <div class="form-group">
                                      <input name="nid" value="{{ $manager->nid_number }}" type="number" class="form-control" maxlength="24" placeholder="National ID">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group-inner">
                                <div class="row">
                                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                          @if($manager->photo == "")
                                          <img src="{{ asset('img/user_icon/no-image.jpg')}}" alt="Editable Image" style="width: 70px; height: 70px; margin-left: 4rem">
                                          @else
                                            <img src="/manager_image/{{ $manager->photo }}" alt="Editable Image" style="width: 70px; height: 70px; margin-left: 4rem">
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
                                        <a data-toggle="tab" href="#TabDetails2" class="btn btn-success" style="color: #fff;">Next <i class="fa fa-arrow-right"></i></a>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div id="TabDetails2" class="tab-pane animated flipInY custon-tab-style1">
                              <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="devit-card-custom">
                                      <div class="form-group">
                                          <input type="text" value="{{ $manager->user->email }}" class="form-control" name="email" placeholder="Email">
                                      </div>

                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-12">
                                    <div class="payment-adress">
                                      <a data-toggle="tab" href="#TabProject2" class="btn btn-danger" style="color: #fff;"><i class="fa fa-arrow-left"></i> Previous</a>
                                      <button type="submit" class="btn btn-success" style="margin-top: 3px;">submit</button>
                                    </div>
                                </div>
                              </div>
                            </div>

                          </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                </div>
              </form>
            </div>
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
    <script src="{{ asset('js/tab.js')}}"></script>

@endsection
