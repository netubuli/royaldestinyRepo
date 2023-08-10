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
              <li class="breadcrumb-item active">Loans</li>
            </ol>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Loans</h3>
                <a href="{{ url('admin/add-edit-loan')}}" style="max-width:150px; float:right; display:inline-block;" class="btn btn-block btn-primary">Add Loan</a>
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
                  <th>Member Number</th>
                    <th>Name</th>
                    <th>Loan Type</th>
                    <th>Amount</th>
                    <th>Repayment period</th>
                    <th>Balance</th>
                    <th>Applied on</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($loans as $loan)
                  
                  <tr>
                    <td>{{ $loan['member_number'] }}</td>
                    <td>{{$loan['name']}}</td>
                    <td>{{$loan['loan_type']}}</td>
                    <td>{{$loan['amount'] }}</td>
                    <td>{{$loan['repayment_period'] }}</td>
                    <td>{{$loan['balance']}}</td>

                    <td>{{Carbon\Carbon::parse(strtotime($loan['created_at']))->format('F j, Y, g:i A')}}</td>
                    <td>
                     @if($loan['status']==1)
                    <a style="color='#3f6ed3;'" class="updateLoanStatus" id="loan-{{$loan->id}}" member-id ="{{$loan->id}}"  href="javascript:void(0)"> <i class="fas fa-toggle-on" status="Active"></i></a>
                    @elseif($loan['status']==0)
                    <a  class="updateLoanStatus" id="loan-{{$loan->id}}" loan-id ="{{$loan->id}}" style="color:grey" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="Inactive"></i></a>
                    @endif
                    &nbsp;&nbsp;
                    <a style="color='#3f6ed3;'" href="{{url('admin/add-edit-loan/'.$loan->id)}}"><i class="fas fa-edit"></i></a>
                    &nbsp;&nbsp;
                    
                    <!--below line works well sweetalet2 confirm delete-->
                  <a style="color='#3f6ed3;'" class="confirmDelete" name="loans" title="Delete Loans"  href="javascript:void(0)" record="loan" recordid="{{$loan->id}}" ><i class="fas fa-trash"></i></a> 
                  <a style="color='#3f6ed3;'" href="{{url('admin/update-loan-role/'.$loan->id)}}"><i class="fas fa-unlock"></i></a>
                    &nbsp;&nbsp;
                  </td>
                  </tr>
                    
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Member Number</th>
                    <th>Name</th>
                    <th>Loan Type</th>
                    <th>Amount</th>
                    <th>Repayment period</th>
                    <th>Balance</th>
                    <th>Applied on</th>
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