@extends('layouts.app')

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
                                <li><span class="bread-blod">All Employees List</span>
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

<div class="contacts-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
          @foreach($employees as $item)
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <div class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30">
                  <div class="panel-body custom-panel-jw">
                      <div class="social-media-in">
                          <a href="{{ route('employee.details',$item->id) }}"><i class="fa fa-info-circle"></i></a>
                      </div>
                      <img alt="logo" class="img-circle m-b" style="height:76px; width:76px;" src="/employee_image/{{$item->photo}}">
                      <h3><a href="">{{$item->user->name}}</a></h3>
                      <p class="all-pro-ad">{{$item->address}}, {{$item->city}}</p>
                      <p>
                        <div class="row">
                          <div class="col-md-3 col-sm-3">
                            <h5 class="text-primary">Mobile:</h5>
                          </div>
                          <div class="col-md-9 col-sm-9">
                            <h5 class="text-muted">{{$item->user->mobile_no}}</h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3 col-sm-3">
                            <h5 class="text-primary">Gender:</h5>
                          </div>
                          <div class="col-md-9 col-sm-9">
                            <h5 class="text-muted">{!! App\Employee::getGender($item->user->gender) !!}</h5>
                          </div>
                        </div>
                        <div class="collapse" id="collapseExample{{$item->id}}">
                          <div class="row">
                            <div class="col-md-3 col-sm-3">
                              <h5 class="text-primary">Email:</h5>
                            </div>
                            <div class="col-md-9 col-sm-9">
                              <h5 class="text-muted">{{ $item->user->email }}</h5>
                            </div>
                          </div>
                        </div>
                      </p>
                  </div>
                  <div class="panel-footer contact-footer">
                      <div class="row">
                        <div class="col-md-3 col-sm-3">
                          <button type="submit" class="btn btn-xs" data-toggle="collapse" data-target="#collapseExample{{$item->id}}" aria-expanded="false" aria-controls="collapseExample" style="background: #827be9; color:white; margin-right: .5rem;"><i class="fa fa-at"> Email</i></button>
                        </div>
                        <div class="col-md-3 col-sm-3">
                          <a href="{{ route('employee.edit',$item->id) }}" class="btn btn-xs btn-success" style="margin-left: 1.7rem;"><i class="fa fa-pencil-square-o"></i></a>
                        </div>
                        <div class="col-md-3 col-sm-3">
                          <form  action="{{ route('employee.delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="employee_id" value="{{$item->id}}">
                            <button type="submit" class="btn btn-xs btn-danger" style="margin-left: 1.5rem;"><i class="fa fa-trash"> Delete</i></button>
                          </form>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
        </div>
    </div>
</div>
<!-- Main Ends -->
@endsection

@section('additional_scripts')



@endsection
