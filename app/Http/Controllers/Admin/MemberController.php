<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Session;
use Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page','members');
        $members = Member::where('status', 1)->get();
        return view('admin/members/members')->with(compact('members'));

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
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function addEdit(Request $request, $id=null)
    {
        if($id==null){
            $title ="Add Member";
            $member = new Member();
            $message ='Member added successfully';
        }else{
            $title ="Edit Member Details";
            $member = Member::find($id);
            $message ='Member details updated successfully';
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data); die; 

            if($id==""){
                

                $memberCount = Member::where('email',$data['email'])->count();
                if($memberCount>0){
                   // echo "test"; die; 
                    return redirect()->back()->with('error_message','Member already exists');

                }
            }
            $rules=['name'=>'required',
                    'mobile'=>'required|numeric',
                    'image'=>'image',
        ];

            $custom_messages=['name.required'=>'provide name',
                                'image.image'=> 'Valid image is required'    
        
        ];

            $this->validate($request,$rules,$custom_messages);

           //Upload sub admin image
           if($request->hasFile('image')){
            $img_tmp = $request->file('image');
            if($img_tmp->isValid()){
                 $extension = $img_tmp->getClientOriginalExtension(); 
                  
                 $imageName = rand(111,9999).'.'.$extension; 
                 $imagePath = 'admin/img/photos/'.$imageName; 
                Image::make($img_tmp)->save($imagePath);
            }
           }else if(!empty($data['current_image'])){
            $imageName = $data['current_image'];
           }else
           { $imageName ="";
           }


            
            $member->name = $data['name'];
            $member->email = $data['email'];
            $member->mobile = $data['mobile'];
            $member->county_city = $data['county_city'];
            $member->nationality = $data['nationality'];
            $member->employment_type = $data['employment_type'];
            $member->password = Hash::make($data['password']);
            $member->id_passport_number = $data['id_passport_number'];
            $member->status = 1;
            $member->image = $imageName;
            

            $member->save();

           // return redirect()->back()->with('success_message',$message);
           return redirect ('admin/members')->with('success_message',$message);
        }


         return view('admin.members.addeditmember')->with(compact('title','member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateMemberStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if ($data['loan_status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Member::where('id',$data['member_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'member_id'=>$data['member_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Member::where('id',$id)->delete();
        return redirect()->back()->with('success_message','member deleted successfuly');
    }
}
