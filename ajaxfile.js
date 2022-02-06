
	$(document).ready(function(){ 
	$("#country").on('change',function(){
		var countryId=$(this).val();
		$.ajax({
			method:"POST",
			url:"double.php", 
			data:{id:countryId},
			success:function(data){
				$("#state").html(data);
			}
		});
	});
	$("#state").on('change',function(){
		var stateId=$(this).val();
		$.ajax({
			method:"POST",
			url:"double.php",
			data:{stateId:stateId},
			success:function(data){
				$("#city").html(data);
			}
		});
	});
	$("#city").on('change',function(){
		var cityId=$(this).val();
		$.ajax({
			method:"POST",
			url:"double.php",
			data:{cityId:cityId},
			success:function(data){
				$("#area").html(data);
			}
		});
	});

	// $("#company").on('change',function(){
	// 	var companyId=$(this).val();
	// 	$.ajax({
	// 		method:"POST",
	// 		url:"double.php",
	// 		data:{companyId:companyId},
			
	// 		success:function(data){
	// 			$("#category").html(data);
	// 		}
	// 	});
	// });
	// $("#category").on('change',function(){
	// 	var categoryId=$(this).val();
	// 	$.ajax({
	// 		method:"POST",
	// 		url:"double.php",
	// 		data:{categoryId:categoryId},
			
	// 		success:function(data){
	// 			$("#dept").html(data);
	// 		}
	// 	});
	// });
		
		$("#dept").on('change',function(){
		var dept=$(this).val();
		$.ajax({
			method:"POST",
			url:"double.php",
			data:{dept:dept},
			success:function(data){
				$("#contact").html(data);
			}
		});
	});	
		$("#submitSummary").click(function(event){
			// event.preventDefault();
			var data = {
				user:$("#s-user-id").val(),
				intern:$("#s-intern-id").val(),
				summary:$("#s-summary").val() || 0,	
			};
			if (!data.summary) {
				alert('Please enter summary!')
				return
			}
			$.ajax({
				type:"POST",
				url:'http://localhost/start/double.php',
				data: data, 
			}).done(function (res) {
				if (res.trim() == 'success') {
					$('#contact-modal').modal('hide')
					alert('Summary added successfully!!')
					return
				}
				alert('Unable to add summary!!')
		});     
		});
		$("#submitdata").click(function(event){
			var data={
				intern_id:$("#b-intern-id").val(),
				user_id:$("#b-user-id").val(),
				company_name:$("#b-company-name").val(),
				internship_name:$("#b-intern-name").val(),
				intern_start_date:$("#b-start-date").val(),
				intern_end_date:$("#b-end-date").val(),
				intern_duration:$("#b-calculate").val(),
				week:$("#UserWeek").val(),
				intern_work_des:$("#text").val() || 0,			
			};
				if(!data.intern_work_des) {
					alert('Please enter your internship work description!');
				return
			}
			$.ajax({
				type:"POST",
				url:'http://localhost/start/double.php',
				data: data,
			}).done(function (res) {
				if (res.trim() == 'success') {
					alert('Data added successfully!!');
					return
				}
			
					alert('Data added successfully!!');
		});     
		});
		$("#submitbtn").click(function(event){
			// event.preventDefault();
			var data = {
				weekdetails:$("#week_name").val(),
				intern:$("#w-intern-id").val(),
				iduser:$("#w-user-id").val() || 0,	
			};
			if (!data.weekdetails) {
				alert('Please enter week!')
				return
			}
			$.ajax({
				type:"POST",
				url:'http://localhost/start/double.php',
				data: data,
			}).done(function (res) {
				if (res.trim() == 'success') {
					$('#exampleModal').modal('hide')
					alert('week added successfully!!')
					return
				}
				alert('Unable to add week!!')
		});     
		});	
		$("#college").on('change',function(){
			var value =$(this).val();
			$.ajax(
			{
				url:'double.php',
				type:'POST',
				data:'request='+value,
				beforeSend:function(){
					$(".table").html("<span>Working....</span>");
				},
				success:function(data){
					$(".table").html(data);
				}

			});
		})
	// 	$("#submit_form").on("submit", function (e) {
	// 		e.preventDefault();
	// 		var formData = new FormData(this);
	

	// 	$.ajax({
	// 		url: "double.php",
	// 		type: "POST",
	// 		data: formData,
	// 		processData: false,
	// 		success: function (data) {
	// 			$("#preview").show();
	// 			$("#image_preview").html(data);
	// 			$("#image").val('');
	// 		}
	// 	});
	// });

	});