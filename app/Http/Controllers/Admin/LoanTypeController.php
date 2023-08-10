<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanType;
use Session;

class LoanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page','loantypes');
        $loantypes =  LoanType::get();
        return view('admin/loans/loantypes')->with(compact('loantypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function addEdit(Request $request, $id=null)
    {
        if($id==null){
            $title ="Add Loan Type";
            $loantype = new LoanType();
            $message ='Loan Type added successfully';
        }else{
            $title ="Edit Loan Type ";
            $loantype = LoanType::find($id);
           // $member_name = LoanType::find($loan['member_number']);
            $message ='Loan Type  updated successfully';
        }
        if($request->isMethod('post')){
            $data = $request->all();
           // echo "<pre>";print_r($data); die; 

            if($id==""){
                
                /*https://www.itsolutionstuff.com/post/laravel-multiple-where-condition-exampleexample.html*/
                $loanTypeCount = LoanType::where([['type',$data['loan_type']],['repayment_period',$data['repayment_period']]])->count();
                if($loanTypeCount>0){
                   // echo "test"; die; 
                    return redirect()->back()->with('error_message','This loan type and period already exists');

                }
            }
            $rules=['repayment_period'=>'required',
                    'loan_type'=>'required'
                ];

            $custom_messages=['repayment_period.required'=>'provide repayment_period'];                 
        
              $this->validate($request,$rules,$custom_messages);

            $loantype->type = $data['loan_type'];
            $loantype->repayment_period = $data['repayment_period'];
            $loantype->interest_rate = $data['interest_rate'];
           
            $loantype->save();

           // return redirect()->back()->with('success_message',$message);
           return redirect ('admin/loan_types')->with('success_message',$message);
        }

         return view('admin.loans.addeditloantype')->with(compact('title','loantype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
    }
}
