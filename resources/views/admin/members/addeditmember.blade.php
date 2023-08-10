@extends('admin.layout.layout')
 @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Members</h1>
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
              <!-- form start -->
              <form name="memberForm" id="memberForm"   <?php if(empty($member['id'])){?>action="{{ url('admin/add-edit-member')}}" <?php } else {?> action="{{ url('admin/add-edit-member/'.$member['id'])}}" <?php } ?> method="post">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="Title">email*</label>
                    <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Email" value="{{$member['email']}}">
                  </div>
                  <div class="form-group">
                    <label for="url">Name*</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="url">
                  </div>
                    <!-- textarea -->
                  <div class="form-group">
                        <label for="description">Nationality*</label>
                        <input type="text" name="nationality" id="nationality" class="form-control"  required >
                 </div>
                 <div class="form-group">
                    <label for="mobile">Id/Passport Number</label>
                    <input type="text" class="form-control" name="id_passport_number" id="id_passport_number" placeholder="">
                  </div>
                 <div class="form-group">
                    <label for="county_city">County/City</label>
                    <input type="text" class="form-control" name="county_city" id="county_city" placeholder="Enter County/City">
                  </div>
                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="employment_type">Employment Type</label>
                    <input type="text" class="form-control" name="employment_type" id="employment_type" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="temporary-password">Password</label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="">
                  </div>
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