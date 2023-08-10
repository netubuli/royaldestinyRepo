@extends('admin.layout.layout')
 @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Admins</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
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
              @if(Session::has('success_message'))
          <!--nli copied from https://getbootstrap.com/docs/5.3/components/alerts/-->
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!:</strong> {{ Session::get('success_message')}}"
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <!--end of nli copied-->
          @endif

          @if(Session::has('error_message'))
          <!--nli copied from https://getbootstrap.com/docs/5.3/components/alerts/-->
            <div class="alert-danger alert-success alert-dismissible fade show" role="alert">
              <strong>Error!:</strong> {{ Session::get('error_message')}}"
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <!--end of nli copied-->
          @endif
              <!-- form start -->
              <form name="subAdminForm" id="subAdminForm"  <?php if(empty($subadmindata['id'])){?>action="{{ url('admin/add-edit-sub-admin')}}" <?php } else {?> action="{{ url('admin/add-edit-sub-admin/'.$subadmindata['id'])}}" <?php } ?> method="post" enctype="multipart/form-data">@csrf
                <div class="card-body">
                  <div class="form-group col-md-6">
                    <label for="name">Name*</label>
                    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter name" <?php if(!empty($subadmindata['name'])){?> value="{{$subadmindata['name']}}" <?php } ?> >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">EmailL*</label>
                    <input type="text" class="form-control" id="email" name="email"  <?php if(!empty($subadmindata['email'])){?> value="{{$subadmindata['email']}}" <?php } ?> required placeholder="email">
                  </div>
                  
                 <div class="form-group col-md-6">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control" name="mobile" id="mobile" <?php if(!empty($subadmindata['mobile'])){?> value="{{$subadmindata['mobile']}}" <?php } ?> placeholder="Enter Mobile" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"  <?php if(!empty($subadmindata['password'])){?> value="{{$subadmindata['password']}}" <?php } ?> placeholder="Enter Password">
                  </div>
                  
                   <div class="form-group col-md-6">
                    <label for="image">Photo</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if(!empty($subadmindata['image']))
                       <a target ="_blank" href="{{url('admin/img/photos/'.$subadmindata['image'])}}">View Photo</a>
                       <input type ="hidden" name="current_image" value="{{url('admin/img/photos/'..$subadmindata['image'])} }">
                       @endif
                      
                  </div>
                    
                  </div> 
                
                  <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div> -->
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

        

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
 @endsection('content')