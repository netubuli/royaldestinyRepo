<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminsRole;
use Auth;
use Validator;
use Hash;
use Image;
use Session;


class AdminController extends Controller
{
    public function dashboard(){
        //echo "<pre>";print_r(Auth::guard('admin')->user());
        Session::put('page','dashboard');
        return view('admin.dashboard');
    }
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data); die;

            $rules = [
                'email' => 'required|email|max:255',
                'password'=>'required|max:30',
            ];
            $custom_messsages= [

                'email.required'=> 'Email is required',
                'email.email' => 'Valid email is required',
                'password.required' => 'Pasword is required',
            ];

            $this->validate($request,$rules,$custom_messsages);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                if(isset($data['remember'])&&!empty($data['remember'])){
                    setcookie("email",$data['email'], time()+3600);
                    setcookie("password",$data['password'], time()+3600);
                }else{
                    setcookie("email","");
                    setcookie("password","");
                }
                return redirect("admin/dashboard");
            }
            else{
                return redirect()->back()->with("error_message","Invalid email or password");
                //return view('admin.login')->with("error_message","Invalid email or password");

            }
        }
       return view('admin.login');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
       // return view('admin.login');
    }
    public function updatePassword(Request $request){
        Session::put('page','updatepassword');
        if($request->isMethod('post')){
            $data = $request->all();
            if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
                if($data['new_pwd']==$data['confirm_pwd']){
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                return redirect()->back()->with('success_message','password updated successfuly');
                }else{
                    return redirect()->back()->with('error_message','new and confirm password mismatch');
                }

            }else{
                return redirect()->back()->with('error_message','Your current password is incorrect');
            }
            
            

        }

        return view('admin.updatepassword');
    }
    public function checkCurentPassword(Request $request){
        $data = $request->all();
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            return true;
        }
        else{
            return false;
        }
    }

    public function updateDetails(Request $request){
        Session::put('page','updatedetails');
        if($request->isMethod('post')){
             $data = $request->all();
           // echo "<pre>";print_r($data); die;

           $rules = [
           
            'admin_mobile' => 'required|numeric|digits:10',
            'admin_name' => 'required',
            'admin_image' => 'image',
           ];
           /*if custoom message is not added, laravel loads default inbuilt custom messages depending on the rules above*/
           $custom_messsages = [
            'admin_mobile.required' => 'mobile is required',
            'admin_mobile.numeric' => 'mobile number is invalid',
            'admin_mobile.digits' => 'mobile number must be 10 digits',
            'admin_name.required' => 'name is required',
            'admin_image.image' => 'Valid image is required',
            //'' => 'valid mobile is required',
           ];
           $this->validate($request, $rules,$custom_messsages);

           //Upload admin image
           if($request->hasFile('admin_image')){
            $img_tmp = $request->file('admin_image');
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
           //update admin details
           Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['admin_name'],'mobile'=>$data['admin_mobile'],'image'=>$imageName]);
           return redirect()->back()->with('success_message','Details updated successfuly');
                }/* else{
                    return redirect()->back()->with('error_message','some error');
                } */
       
        return view('admin.updatedetails');
    }

    public function subadmins(){
       Session::put('page','subadmins');
       $subadmins = Admin::where('type','subadmin')->get();
       return view('admin.subadmins.subadmins')->with(compact('subadmins'));
    }

    public function updateSubadminStatus(Request $request){  
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if ($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Admin::where('id',$data['subadmin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'subadmin_id'=>$data['subadmin_id']]);
        }
    }
    public function addEditSubadmin(Request $request, $id=null){

        if($id==""){
            $title ="Add Subadmin";
            $subadmindata = new Admin;
            $message = "Subadmin added successfully!";
        }else{
            $title ="Edit Subadmin";
            $subadmindata = Admin::find($id);
            $message = "Subadmin updated successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data); die; 

            if($id==""){
                

                $subadminCount = Admin::where('email',$data['email'])->count();
                if($subadminCount>0){
                   // echo "test"; die; 
                    return redirect()->back()->with('error_message','SubAdmin already exists');

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


            
            $subadmindata->name = $data['name'];
            $subadmindata->email = $data['email'];
            $subadmindata->mobile = $data['mobile'];
            $subadmindata->password =Hash::make($data['password']);
            $subadmindata->status = 1;
            $subadmindata->type = 'subadmin';
            $subadmindata->image = $imageName;
            

            $subadmindata->save();

           // return redirect()->back()->with('success_message',$message);
           return redirect ('admin/subadmins/subadmins')->with('success_message',$message);
        }


         return view('admin/subadmins/addeditsubadmin')->with(compact('title','subadmindata'));

    }

    public function UpdateSubadminRole($id,Request $request ){
        $title = "Update Subadmin Roles/Permissions"; 
        if($request->isMethod('post')){
            $data = $request->all();
         //echo "<pre>";print_r($data); die; 

         //delete all earlier roles for subadmin
         AdminsRole::where('subadmin_id',$id)->delete();

         //add new roles for sub admin statitcally ( access role for cms Pages module)
        /* if(isset($data['cmspages']['view_access'])){
            $cms_pages_view_access = $data['cmspages']['view_access'];
         }else { $cms_pages_view_access =0; }
         if(isset($data['cmspages']['edit_access'])){
            $cms_pages_edit_access= $data['cmspages']['edit_access'];
         } else { $cms_pages_edit_access =0;}
         if(isset($data['cmspages']['full_access'])){
            $cms_pages_full_access = $data['cmspages']['full_access'];
         } else {$cms_pages_full_access =0;}
         $role = new AdminsRole();
         $role->subadmin_id = $id;
         $role->module = 'cms_pages';
         $role->view_access = $cms_pages_view_access;
         $role->edit_access = $cms_pages_edit_access;
         $role->full_access = $cms_pages_full_access;
         $role->save();
         */


         //add subadmin roles to modules dynamically
         foreach($data as $key => $value){
            if(isset($value['view_access'])){ 
                $view_access = $value['view_access'];
            }else{
                $view_access =0;
            }
            if(isset($value['edit_access'])){ 
                $edit_access = $value['edit_access'];
            }else{
                $edit_access=0;
            }
            if(isset($value['full_access'])){ 
                $full_access = $value['full_access'];
            }else{
                $full_access = 0;
            }
         }
         $role = new AdminsRole();
         $role->subadmin_id = $id;
         $role->module = $key;
         $role->view_access = $view_access;
         $role->edit_access = $edit_access;
         $role->full_access = $full_access;
         $role->save();

         $message = "Sub admin roles updated successfully";
         return redirect()->back()->with('success_message',$message);
        }
        //to return the existing roles
        $subadminRoles = AdminsRole::where('subadmin_id',$id)->get()->toArray();

        //gget firstaname of the subadmin
        $subAdminDetails = Admin::where('id',$id)->first()->toArray();
        $title = "Update ".$subAdminDetails['name']." SubAdmin Roles/Permissions";
        return view('admin.subadmins.update-sub-admin-role')->with(compact('title','id','subadminRoles'));
    }
    public function destroySubadmin($id){
            //delete Sub admin
        Admin::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Subadmin deleted successfuly');
    }
}
 