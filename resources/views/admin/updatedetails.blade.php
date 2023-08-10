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
              <li class="breadcrumb-item active">Update Admin Details</li>
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

              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
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
              <form method="post" action= "{{ url('admin/update-details')}}" enctype="multipart/form-data">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input class="form-control" id="exampleInputEmail1" value="{{Auth::guard('admin')->user()->email}}" readonly="" style="background-color:#666;">
                  </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" id="admin_name" name="admin_name" value="{{Auth::guard('admin')->user()->name}}">
                  </div>
                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="mobile" class="form-control" id="admin_mobile" name="admin_mobile" value="{{Auth::guard('admin')->user()->mobile}}">
                  </div>
                  <div class="form-group">
                    <label for="admin_image">Image</label>
                    <input type="file" class="form-control" id="admin_image" name="admin_image" >
                    @if(!empty(Auth::guard('admin')->user()->image))
                    <a target ="_blank" href ="{{url('admin/img/photos/'.Auth::guard('admin')->user()->image)}}">View Photo</a>
                    <input type="hidden"  name="current_image" value="Auth::guard('admin')->user()->image">
                    @endif
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