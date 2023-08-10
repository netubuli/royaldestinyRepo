@extends('admin.layout.layout')
 @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Loans</h1>
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
              <form name="loanTypeForm" id="loanTypeForm"   <?php if(empty($loantype['id'])){?>action="{{ url('admin/add-edit-loan-type')}}" <?php } else {?> action="{{ url('admin/add-edit-loan-type/'.$loantype['id'])}}" <?php } ?> method="post">@csrf
                <div class="card-body">
                  
                @if(empty($loantype['id']))
                  <div class="form-group">
                    <label for="loan_type">Name of Loan*</label>
                    <input type="text" class="form-control" name="loan_type" id="loan_type" value="">
                  </div>
                  <div class="form-group">
                 <label for="repayment_period">Repayment Period*</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="repayment_period" id="repayment_period" required >
                    <option selected="">Select repayment period</option>
                    <option value="6">6 Months</option>
                    <option value="12">12 Months</option>
                    <option value="24">24 Months</option>
                    <option value="36">36 Months</option>
                    <option value="48">48 Months</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="interest_rate">Interest Rate</label>
                    <input type="text" class="form-control" name="interest_rate" id="interest_rate" value="">
                  </div>
                  @else 
                  <div class="form-group">
                    <label for="loan_type">Loan Type Name*</label>
                    <input type="text" class="form-control" name="loan_type" id="loan_type" value="{{$loantype['type']}}" readonly >
                  </div>
                  <div class="form-group">
                <label for="repayment_period">Repayment Period</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="repayment_period" id="repayment_period" required>
                  
                  <option selected="{{$loantype['repayment_period']}}">{{$loantype['repayment_period']}} months</option>
                  
                  <option value="12">12 months</option>
                    <option value="24">24 months</option>
                    <option value="36">36 months</option>
                   </select>
                </div>
                <div class="form-group">
                    <label for="interest_rate">Interest Rate</label>
                    <input type="text" class="form-control" name="interest_rate" id="interest_rate" value="{{$loantype['interest_rate']}}">
                  </div>
                @endif

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