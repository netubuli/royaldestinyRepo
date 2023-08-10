<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\AdminsRole;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page','cmspages');
        $cmsPages = CmsPage::get()->toArray();
       // dd($cmsPage);

        //  Set Admin/Subadmin permissions for CMS pages
       $cmsPagesModuleCount = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'cmspages'])->count();
       $pagesModule = array();   

       if (Auth::guard('admin')->user()->type=="admin"){
        $pagesModule['view_access']=1;
        $pagesModule['edit_access']=1;
        $pagesModule['full_access']=1;
       }
      else if ($cmsPagesModuleCount == 0){
        $message = "features in this page are restricted";
        return redirect('admin/dashboard')->with('error_message',$message);
        }
        else {
            $pagesModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=> 'cmspages'])->first()->toarray();
        }
       return view ('admin.pages.cmspages')->with(compact('cmsPages','pagesModule'));
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
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id=null)
    {
        
        if($id==null){
            $title ="Add Cms Page";
            $cmsPage = new CmsPage();
            $message ='CMs page added successfully';
        }else{
            $title ="Edit Cms Page";
            $cmsPage = CmsPage::find($id);
            $message ='CMs page added successfully';
        }
        if($request->isMethod('post')){
            $data = $request->all();
            /* echo "<pre>";print_r($data); die; */
            $rules=['title'=>'required'];
            $custom_messages=['title.required'=>'provide title'];

            $this->validate($request,$rules,$custom_messages);
            
            $cmsPage->title = $data['title'];
            $cmsPage->description = $data['description'];
            $cmsPage->url = $data['url'];
            $cmsPage->meta_title = $data['metatitle'];
            $cmsPage->meta_description = $data['metadescription'];
            $cmsPage->meta_keywords = $data['metakeywords'];

            $cmsPage->save();

           // return redirect()->back()->with('success_message',$message);
           return redirect ('admin/cms-pages')->with('success_message',$message);
        }
       //  dd($cmsPage);
       //  echo "<pre>"; print_r($cmsPage); die;
        return view ('admin.pages.addeditcmspages')->with(compact('title','cmsPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       // echo "test";
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if ($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            CmsPage::where('id',$data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'page_id'=>$data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //delete Cms Page
        CmsPage::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Cms Page deleted successfuly');
    }
}
