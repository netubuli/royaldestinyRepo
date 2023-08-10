 $(document).ready(function(){
    //check admn pwd is correct or wrong
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        alert(current_pwd);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-password',
            data:{current_pwd:current_pwd},
            success:function(resp){
                if (resp=="false"){
                    $("#verifyCurrentPwd").html("Current pwd incorrect")
                }else if (resp=="true"){
                    $("#verifyCurrentPwd").html("Current pwd Correct")
                }
            },error:function(){
                alert("Error");
            }
            
        })
    });
     //update cms page status
     $(document).on("click",".updateCmsPageStatus", function(){
        var status = $(this).children("i").attr("status");
        var page_id = $(this).attr("page-id");
        //alert(status);
        //alert(page_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-cms-page-status',
            data:{status:status,page_id:page_id},
            success:function(resp){
                 if(resp['status']==0){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                 }else if(resp['status']==1){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-on' style='color:blue' status='active'></i>");

                 }
            },error:function(){
                alert("Error");
            }
            
        })
    });

     //update sub admin status
     $(document).on("click",".updateSubadminStatus", function(){
        var status = $(this).children("i").attr("status");
        var subadmin_id = $(this).attr("subadmin-id");
        //alert(status);
        //alert(page_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-subadmin-status',
            data:{status:status,subadmin_id:subadmin_id},
            success:function(resp){
                 if(resp['status']==0){
                    $("#subadmin-"+subadmin_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                 }else if(resp['status']==1){
                    $("#subadmin-"+subadmin_id).html("<i class='fas fa-toggle-on' style='color:blue' status='active'></i>");

                 }
            },error:function(){
                alert("Error");
            }
            
        })
    });

     //update membership status
     $(document).on("click",".updateMemberStatus", function(){
        var status = $(this).children("i").attr("status");
        var member_id = $(this).attr("member-id");
        //alert(status);
        //alert(page_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-member-status',
            data:{status:status,member_id:member_id},
            success:function(resp){
                 if(resp['status']==0){
                    $("#member-"+member_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                 }else if(resp['status']==1){
                    $("#member-"+member_id).html("<i class='fas fa-toggle-on' style='color:blue' status='active'></i>");

                 }
            },error:function(){
                alert("Error");
            }
            
        })
    });
    //update Loan status
    $(document).on("click",".updateLoanStatus", function(){
        var status = $(this).children("i").attr("status");
        var loan_id = $(this).attr("loan-id");
        //alert(status);
        //alert(page_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-loan-status',
            data:{status:status,loan_id:loan_id},
            success:function(resp){
                 if(resp['status']==0){
                    $("#loan-"+loan_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                 }else if(resp['status']==1){
                    $("#loan-"+loan_id).html("<i class='fas fa-toggle-on' style='color:blue' status='active'></i>");

                 }
            },error:function(){
                alert("Error");
            }
            
        })
    });

    //Confirm deletion of cms page
    /*  $(document).on("click",".confirmDelete", function(){
       //  alert('test');
        //return false; 
        var name = $(this).attr('name');
        if(confirm('Are you sure to delete '+name+'?')){
            return true;
        }else{
            return false;
        }
    });  */

    //confirm deletion with sweetalert2
    $(document).on("click",".confirmDelete", function(){
        var record = $(this).attr('record');
        var recordid =$(this).attr('recordid');

    // this is copied from sweetalert2.github.io

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              //nli added
              window.location.href = "/admin/delete-"+record+"/"+recordid;
            }
          })
     }); 


});
 