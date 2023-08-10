@extends('admin.layout.layout')
 @section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Admin Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- general form elements -->
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Admin Password</h3>
              </div>
              <!-- /.card-header -->
              @if(Session::has('error_message'))
          <!--nli copied from https://getbootstrap.com/docs/5.3/components/alerts/-->
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!:</strong> {{ Session::get('error_message')}}"
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <!--end of nli copied-->
          @endif
          @if(Session::has('success_message'))
          <!--nli copied from https://getbootstrap.com/docs/5.3/components/alerts/-->
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!:</strong> {{ Session::get('success_message')}}"
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <!--end of nli copied-->
          @endif
              <!-- form start -->
              <form method="post" action= "{{ url('admin/update-password')}}">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input class="form-control" id="exampleInputEmail1" value="{{Auth::guard('admin')->user()->email}}" readonly="" style="background-color:#666;">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Current Password</label>
                    <input type="password" class="form-control" id="current_pwd" name="current_pwd" placeholder="Password">
                    <span verifyCurrentPwd></span>
                  </div>
                  <div class="form-group">
                    <label for="new_pwd">New Password</label>
                    <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="new_pwd">
                  </div>
                  <div class="form-group">
                    <label for="confirm_pwd">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_pwd"  name="confirm_pwd" placeholder="Password">
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>      
              </form>
            </div>
            <!-- /.card -->

  </div>
  <!-- /.content-wrapper -->
  @endsection