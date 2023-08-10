<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanType;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page','loans');
        $loans = Loan::where('loans.status', 1)
        ->join('members', 'loans.member_number', '=', 'members.id')->get();
        return view('admin/loans/loans')->with(compact('loans'));
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
    public function show(Loans $loans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function addEdit(Request $request, $id=null)
    {
        if($id==null){
            $title ="Add Loan";
            $loan = new Loan();
            $message ='Loan added successfully';
        }else{
            $title ="Edit Loan Details";
            $loan = Loan::find($id);
            $member_name = Member::find($loan['member_number']);
            $message ='Loan details updated successfully';
        }
        if($request->isMethod('post')){
            $data = $request->all();
           // echo "<pre>";print_r($data); die; 

            if($id==""){
                
                /*https://www.itsolutionstuff.com/post/laravel-multiple-where-condition-exampleexample.html*/
                $loanCount = Loan::where([['member_number',$data['member_number']],['loan_type',$data['loan_type']],['status','1']])->count();
                if($loanCount>0){
                   // echo "test"; die; 
                    return redirect()->back()->with('error_message','This loan already exists');

                }
            }
            $rules=['member_number'=>'required',
                    'loan_amount'=>'required'
                ];

            $custom_messages=['member_number.required'=>'provide member_number'];                 
        
        

            $this->validate($request,$rules,$custom_messages);

                     
            $loan->member_number = $data['member_number'];/**use data table selector */
            $loan->loan_type = $data['loan_type'];
            $loan->amount = $data['loan_amount'];
            $loan->balance = $data['loan_amount'];
            $loan->repayment_period = $data['repayment_period'];
            $loan->interest_rate = '13';
            $loan->repayment_status = 'pending';
            $loan->status = 1;
                     

            $loan->save();

           // return redirect()->back()->with('success_message',$message);
           return redirect ('admin/loans')->with('success_message',$message);
        }

        $members = Member::where('status', 1)->get();
         return view('admin.loans.addeditloan')->with(compact('title','loan','members','member_name'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateLoanStatus(Request $request)
    {
        if($request->ajax()){
            $data =$request->all();
            echo "<pre>";print_r($data); die; 


            if ($data["status"]=="active"){
                $status = 0;
            }else{
              $status =1;   
            }
           
            Loan::where('id',$data['loan_id'])->update('status',$status);

            return response()->json(['status'=>$status,'loan_id'=>$data['loan_id'] ]);


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loans $loans)
    {
        //
    }
}
