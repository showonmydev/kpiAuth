

function delete_user(id)
{

  swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then(function () {
 
 $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
      $.ajax({
             type:'GET',
             url:'delete_record1/'+id,
             success:function(res){

      location.reload();
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

function delete_role(id)
{

  swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then(function () {
     
 
 $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
      $.ajax({
             type:'GET',
             url:'delete_record2/'+id,
             success:function(res){

      location.reload();
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

 $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
