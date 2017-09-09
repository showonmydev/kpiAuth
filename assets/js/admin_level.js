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
//Here is the js for adding comments
function add_comment(id, resp, proj, setting, path, role) {
    if (proj == "") {
        proj = "0";
    }
    event.preventDefault();
    if (id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: path,
            data: 'id=' + id + '&setting_id=' + setting,
            success: function(res) {
                //get current month and year
                var d = new Date();
                var month = d.getMonth();
                var year = d.getUTCFullYear();

                $('#comment_message').text("");
                $('#formhidden_field').text("");
                var all_hidden_field;
                if (res == null || res == "") {
                    //$('#comment_message').append("<h3>There is No Message</h3>");
                }
                data = jQuery.parseJSON(res);
                jQuery.each(data.comment, function(key, val) {
                    var all_comment = "<li><label><i>By " + role + " </i></label>&nbsp at " + val.created_at + "<p>" + val.comments + "</p></li>";
                    $('#comment_message').append(all_comment);
                });

                var no = 1;
                var all_comment = '';
                $('#question_message').text("");
                jQuery.each(data.points, function(key, val) {
                    all_comment += '<div class="col-md-8">' + no + '. &nbsp&nbsp<label>' + val.text + '</label></div><div class="col-md-3"><input type="range" value="0" max="5" min="0" name="no[' + val.id + ']" required class="form-control1" onchange="updateTextInput(this.value,' + val.id + ');">';
                    all_comment += '</div><div class="col-md-1"><label id="' + val.id + '">0</label></div></div>';
                    no++;
                });


                if (data.status[0] == "disable" || data.status[0] == "overdue") {
                    $('.final_comment').hide();
                    $('.log_comment_box').show();
                } else {
                    $('.log_comment_box').hide();
                    $('.final_comment').show();
                    all_comment += "<input type='hidden' name='total_point' value='" + data.total_point['0'] + "'>";
                    all_comment += "<input type='hidden' name='user_id' value='" + id + "'>";
                    all_comment += "<input type='hidden' name='settings_id' value='" + setting + "'>";
                    all_comment += "<input type='hidden' name='year' value='" + year + "'>";
                    all_comment += "<input type='hidden' name='month' value='" + month + "'>";
                    all_comment += "<input type='hidden' name='responsible_id' value='" + resp + "'>";
                    all_comment += "<input type='hidden' name='project_id' value='" + proj + "'>";
                    $('#question_message').append(all_comment);
                }

                //this is created for submit comment hidden fields
                all_hidden_field = "<input type='hidden' name='user_id' value='" + id + "'><input type='hidden' name='responsible_id' value='" + resp + "'><input type='hidden' name='project_id' value='" + proj + "'><input type='hidden' name='settings_id' value='" + setting + "'><input type='hidden' name='month' value='" + month + "'><input type='hidden' name='year' value='" + year + "'>";
                $('#formhidden_field').append(all_hidden_field);
                $('#show').click();
            }
        });
    }
}

//post_comment ajax
$('#post_comment').click(function(e) {
    e.preventDefault();
    var data = $("#comment_form").serialize();
    var validator = $("#comment_form").validate();
    var check = validator.form();
    var path = $('#path').text();
    var path_redirect = $('#path_redirect').text();
    if (check) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: path,
            data: data,
            success: function(res) {
                document.getElementById("final_submit").reset();
                swal({
                    title: "Success!",
                    text: "Comment Submit Successfully",
                    type: "success",
                    //timer: 1000,
                    //showConfirmButton: false
                });
                var all_comment = "<li><label><i></i></label>&nbspJust Now<p>" + res.comments + "</p></li>";
                $('#comment_message').append(all_comment);
                //add_comment(data.user_id,data.responsible_id,data.project_id,data.settings_id,path_redirect);
            }
        });
    }
});


//post question final submit
$('#final_question_submit').click(function(e) {
    e.preventDefault();
    var data = $("#final_submit").serialize();
    var validator = $("#final_submit").validate();
    var check = validator.form();
    var path = $('#path3').text();
    if (check) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: path,
            data: data,
            success: function(res) {
                document.getElementById("comment_form").reset();
                swal({
                    title: "Success!",
                    text: "Comment Submit Successfully",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false
                });

                window.setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        });
    }
});

//this function for update point value in comment section
function updateTextInput(val, id) {
    $('#' + id).html(val);
}