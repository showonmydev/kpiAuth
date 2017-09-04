//submit project
$('.project_submit, .project_update').click(function(e) {
    e.preventDefault();
    var data = $(".add_project_form").serialize();
    var validator = $(".add_project_form").validate();
    var check = validator.form();
    if (check) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'submit_project',
            data: data,
            success: function(res) {
              
                //This is only for Update
                if (res == "update") {
                    swal({
                        title: "Success!",
                        text: "Update Successfully",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                    window.setTimeout(function() {
                        var getUrl = window.location;
                        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                        window.location.href = baseUrl + "/view_project";
                    }, 1000);

                } else {
                    swal({
                        title: "Success!",
                        text: "Submit Successfully",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                    window.setTimeout(function() {
                        var getUrl = window.location;
                        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                        window.location.href = baseUrl + "/view_project";
                    }, 1000);
                }
            },
            error: function(error) {
                swal(
                    'Oops...',
                    'Please Make Sure All field are correct value!',
                    'error'
                )
                $('.error').css('color', 'red');
            }
        });
    }
});
    
function product_delete(id)
{
	  swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!',
  closeOnCancel: false,
  allowOutsideClick: false,
  closeOnConfirm: false,
}).then(function () {
	$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    	}
			});
		    $.ajax({
		           type:'GET',
		           url:'delete_project/'+id,
		           success:function(res){
		           	 swal({
                                title: "Success!",
                                text:  "File Has been Deleted Successfully",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            });
                        window.setTimeout(function(){
                        	location.reload();
					 } ,1000);
		           },
		           error:function(error){
				   	swal(
				  'Oops...',
				  'Please Make Sure All field are correct value!',
				  'error'
				)
				$('.error').css('color','red');
				   }
		        });
  
  swal(
    'Deleted!',
    'Your file has been deleted.',
    'success'
  )
})
}    



//datatable for project list
$(document).ready(function() {
    $('#example2').DataTable();
} );
	

//All the js below is Question Section
//question section
$('.add_question_submit, .add_question_update').click(function(e){
	e.preventDefault();
	var data=$(".question_form").serialize();
	var validator = $(".question_form").validate();
	var check=validator.form();
	if(check)
	{
		$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	}
	});
    $.ajax({
           type:'POST',
           url:'add_evaluation_point',
           data:data,
           success:function(res){
           		//This is only for Update
           		if(res=="update"){
						swal({
                                title: "Success!",
                                text:  "Update Successfully",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            });
                        window.setTimeout(function(){
                        	var getUrl = window.location;
					var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
					window.location.href = baseUrl+"/view_evaluation_point";
					 } ,1000);
				}
				else
				{
						swal({
                                title: "Success!",
                                text:  "Submit Successfully",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            });
                        window.setTimeout(function(){
                        	var getUrl = window.location;
					var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
					window.location.href = baseUrl+"/view_evaluation_point";
					 } ,1000);
				}
              
           },
           error:function(error){
				   	swal(
				  'Oops...',
				  'Please Make Sure All field are correct value!',
				  'error'
					)
				   $('.error').css('color','red');
		   }
        });
		}
    });
    

//question delete
function question_delete(id)
{
	  swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!',
   closeOnCancel: false,
  allowOutsideClick: false,
  closeOnConfirm: false,
}).then(function () {
	
	$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    	}
			});
		    $.ajax({
		           type:'GET',
		           url:'delete_evaluation_point/'+id,
		           success:function(res){
		           	
		           	swal({
                                title: "Success!",
                                text:  "File Has been Deleted Successfully",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            });
                        window.setTimeout(function(){
                        	location.reload();
					 } ,1000); 
		           },
		           error:function(error){
				   	swal(
				  'Oops...',
				  'Please Make Sure All field are correct value!',
				  'error'
				)
				$('.error').css('color','red');
				   }
		        });
  
  
})
}   