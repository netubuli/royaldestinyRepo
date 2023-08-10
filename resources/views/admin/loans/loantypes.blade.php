@extends('admin.layout.layout')
 @section('content')
 <div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Loans</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Loan Types</li>
            </ol>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Loan typess</h3>
                <a href="{{ url('admin/add-edit-loan-type')}}" style="max-width:150px; float:right; display:inline-block;" class="btn btn-block btn-primary">Add Loan Type</a>
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
              <div class="card-body">
                <table id="loans" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Loan Type</th>
                    <th>Repayment period</th>
                    <th>Interest Rate</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($loantypes as $loan)
                  
                  <tr>
                    
                    <td>{{$loan['type']}}</td>
                    <td>{{$loan['repayment_period'] }}</td>
                    <td>{{$loan['interest_rate']}}</td>
                    <td>
                    <a style="color='#3f6ed3;'" href="{{url('admin/add-edit-loan-type/'.$loan->id)}}"><i class="fas fa-edit"></i></a>
                    &nbsp;&nbsp;
                    
                    <!--below line works well sweetalet2 confirm delete-->
                  <a style="color='#3f6ed3;'" class="confirmDelete" name="loantypes" title="Delete LoanType"  href="javascript:void(0)" record="loantypes" recordid="{{$loan->id}}" ><i class="fas fa-trash"></i></a> 
                  
                  </td>
                  </tr>
                    
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Loan Type</th>
                    <th>Repayment period</th>
                    <th>Interest Rate</th>
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