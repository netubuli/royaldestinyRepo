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
              <li class="breadcrumb-item active">Sub Admins</li>
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
              <form name="subAdminForm" id="subAdminForm"  action="{{ url('admin/update-sub-admin-role/'.$id)}}" method="post" enctype="multipart/forta">@csrf
                <div class="card-body">

                  <div class="form-group col-md-6">
                    <!-- <label for="email">EmailL*</label>
                    <input type="text" class="form-control" id="email" name="email"  <?php if(!empty($subadmindata['email'])){?> value="{{$subadmindata['email']}}" <?php } ?> required placeholder="email"> -->
                  </div>
                  <input type="hidden"  name="subadmin_id" value="{{ $id }}"   required >
                  @if(!empty($subadminRoles)) 
                    @foreach($subadminRoles as $roles)
                        @if($roles['module']=='cms_pages')
                            @if($roles['view_access']==1)
                              @php $viewCmsPages = "checked" @endphp
                            @else @php $viewCmsPages = "" @endphp
                            @endif
                            @if($roles['edit_access']==1)
                              @php $editCmsPages = "checked" @endphp
                            @else @php $editCmsPages = "" @endphp
                            @endif
                            @if($roles['full_access']==1)
                              @php $fullCmsPages = "checked" @endphp
                            @else @php $fullCmsPages = "" @endphp
                            @endif
                        @endif
                    @endforeach
                @endif
                    
                  

                  <div class="form-group col-md-6">
                    <label for="cms_pages">CMS Pages &nbsp;&nbsp;</label>
                    <input type="checkbox"  name="cmspages[view_access]" value="1" @if(isset($viewCmsPages)){{ $viewCmsPages}} @endif>&nbsp;&nbsp;View Access &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="cmspages[edit_access]" value="1" @if(isset($editCmsPages)){{ $editCmsPages}} @endif>&nbsp;&nbsp;Edit Access &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox"  name="cmspages[full_access]" value="1" @if(isset($fullCmsPages)){{ $fullCmsPages}} @endif>&nbsp;&nbsp;Full Access &nbsp;&nbsp;&nbsp;&nbsp;

                  </div>
               
                   
                  </div> 


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