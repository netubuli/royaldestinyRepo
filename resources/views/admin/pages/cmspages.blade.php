@extends('admin.layout.layout')
 @section('content')
 <div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CMS pages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">CMS pages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <div class="card">
    
              <div class="card-header">
                <h3 class="card-title">CMS pages</h3>
                <a href="{{ url('admin/add-edit-cms-page')}}" style="max-width:150px; float:right; display:inline-block;" class="btn btn-block btn-primary">Add Cms Page</a>
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
              <div class="card-body">
                <table id="cmspages" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Created on</th>
                    <!-- <th>Status</th> -->
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  @foreach ($cmsPages as $pages)
                  
                  <tr>
                    <td>{{ $pages['id'] }}</td>
                    <td>{{$pages['title']}}</td>
                    <td>{{$pages['url'] }}</td>
                    <td>{{Carbon\Carbon::parse(strtotime($pages['created_at']))->format('F j, Y, g:i A')}}</td>
                     <td>
                        @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                            @if($pages['status']==1)
                            <a style="color='#3f6ed3;'" class="updateCmsPageStatus" id="page-{{$pages['id']}}" page-id ="{{$pages['id']}}"  href="javascript:void(0)"> <i class="fas fa-toggle-on" status="Active"></i></a>
                            @elseif($pages['status']==0)
                            <a  class="updateCmsPageStatus" id="page-{{$pages['id']}}" page-id ="{{$pages['id']}}" style="color:grey" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="Inactive"></i></a>
                            @endif
                            &nbsp;&nbsp;
                        @endif
                        @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                            <a style="color='#3f6ed3;'" href="{{url('admin/add-edit-cms-page/'.$pages['id'])}}"><i class="fas fa-edit"></i></a>
                            &nbsp;&nbsp;
                        @endif
                        
                            <!--below line works well with default simple jquery confirm delete-->
                          <!-- <a style="color='#3f6ed3;'" class="confirmDelete" name="Cms Page" title="Delete CMS Page" href="{{url('admin/delete-cms-page/'.$pages['id'])}}"><i class="fas fa-trash"></i></a> -->
                            <!--below line works well sweetalet2 confirm delete
                           <a style="color='#3f6ed3;'" class="confirmDelete" name="Cms Page" title="Delete CMS Page" <php /*te-cms-page/'.$pages['id'])}}"*/> href="javascript:void(0)" record="cms-page" recordid="{{$pages['id']}}" ><i class="fas fa-trash"></i></a> 

                          -->
                          @if($pagesModule['full_access']==1)
                          <a style="color='#3f6ed3;'" class="confirmDelete" name="Cms Page" title="Delete CMS Page" href="javascript:void(0)" record="cms-page" recordid="{{$pages['id']}}" ><i class="fas fa-trash"></i></a> 
                          @endif
                    </td>
                  </tr>
                            
                          @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Created on</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
  <!-- /.content-wrapper -->
            

            @endsection