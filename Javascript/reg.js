$(document).ready(function(){
	$('#RegisterButton').click(function(){
		var first_name=$('#FirstName').val();
		var last_name=$('#LastName').val();
		var email=$('#Email').val();
		var password=$('#Password').val();
		var password1=$('#PasswordConfirm').val();
		var lang=$('#Language').val();
		var url=$('#Url').val();
		var title=$('#Title').val();
		var descr=$('#Description').val();
		var pic=$('#PreviewPicture').val();
		$('#returnmessage').empty();
		
		if(first_name =='', email=='', password=='', password1=='', lang=='',url=='', title=='', descr=='')
				{
				   alert("Please Fill Required Fields");
				}
				
		$.ajax({
			type: "POST",
			url: "PHP/reg.php",
			data: 
					"first_name="+first_name+
					"&last_name="+last_name+
					"&email="+email+
					"&password="+password+
					"&password1="+password1+
					"&lang="+lang+
					"&url="+url+
					"&title="+title+
					"&descr="+descr+
					"&pic="+pic ,
			success: function(data){
				$('#returnmessage').append(data);

				
				if(data=="Your Query has been received, We will contact you soon."){
					$('#RegisterForm')[0].reset();//To reset form fields on success
				}
			}
		});
		return false;
		
	});
});