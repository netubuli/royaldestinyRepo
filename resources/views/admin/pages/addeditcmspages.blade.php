@extends('admin.layout.layout')
 @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cms Pages</h1>
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
              <form name="cmsForm" id="cmsForm"  action="{{ url('admin/add-edit-cms-page')}}" method="post">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="Title">Title*</label>
                    <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Title" value="{{$cmsPage['title']}}">
                  </div>
                  <div class="form-group">
                    <label for="url">URL*</label>
                    <input type="text" class="form-control" id="url" name="url" required placeholder="url">
                  </div>
                    <!-- textarea -->
                  <div class="form-group">
                        <label for="description">Description*</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required placeholder="Enter ..."></textarea>
                 </div>
                 <div class="form-group">
                    <label for="metatitle">Meta Title</label>
                    <input type="text" class="form-control" name="metatitle" id="MetaTitle" placeholder="Enter Meta Title">
                  </div>
                  <div class="form-group">
                    <label for="metakeywords">Title</label>
                    <input type="text" class="form-control" name="metakeywords" id="metakeywords" placeholder="Enter ...">
                  </div>
                  <div class="form-group">
                    <label for="metadescription">Meta Description</label>
                    <input type="text" class="form-control" name="metadescription" id="metadescription" placeholder="Enter ...">
                  </div>
                 <!--  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div> -->
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