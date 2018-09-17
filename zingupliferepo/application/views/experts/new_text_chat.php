	<style>
		.red 
		{
			color:red;
		}
		.blue{
			color:blue;
		}
	</style>

	<div style='width:90%;padding:20px;border:2px solid #000;background:#ddd;'>
		<div class='messages' style='height:100px;overflow-y:scroll;'></div>
		<br/>
		<div class='input'>
			<textarea style='width:90%;' class='message' style=''></textarea>
		</div>
		<input type='hidden' name='last_chat_id' value='0' class='last_chat_id' />
		<input type='hidden' name='chat_id' value='' class='chat_id' />
		
		<?php $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data'); 
		if($data['logged_in_user_data']) { ?>
			<input type='hidden' name='type' value='user' class='type' />
			<input type='hidden' name='u_name' value='<?php echo $data['logged_in_user_data']->name; ?>' class='u_name' />
		<?php } else { ?>
			<input type='hidden' name='type' value='sme' class='type' />
			<input type='hidden' name='u_name' value='<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name'); ?>' class='u_name' />
		<?php } ?>
		
		<input type='hidden' name='type_id' value='<?php echo $data['logged_in_user_data']->user_id; ?>' class='type_id' />
		<input type='hidden' name='sme_type_id' value='<?php echo $this->session->userdata('sme_userid'); ?>' class='sme_type_id' />
	</div>

	<input type='hidden' class='main_url' value='<?php echo base_url();?>' />


	<script src="<?php echo base_url();?>assets/zing_new/js/jquery-1.11.2.js"></script>
	<script>
   
        $(document).ready(function(){
			var url2 = $('.main_url').val();
			var id = $('.type_id').val();
			var last_chat_id = $('.last_chat_id').val();
			var sme_id = $('.sme_type_id').val();
			var type =  $('.type').val();
			var userid = $('.type_id').val();
			var name= $('.u_name').val();

			//to get messages on page load
			/*$.ajax({
						type: "POST",
						url: url2 + 'experts/check_chat',
						dataType: "json",
						data: {id:id,last_chat_id:last_chat_id,sme_id:sme_id,type:type},
						success: function (data) {
							//console.log(data);
							if(data)
							{
								//$('.messages').empty();
								if(data.length !=0)
								{
									 $.each(data, function (i, item) {
										$('.chat_id').val(item.id);
										 $.each(item.messages, function (j, k) {
											 if(parseInt(last_chat_id) != k.id)
											 {
												  if(k.user_type == 'user')
												 {
													 var color = 'red';
												 }
												 else{
													 var color = 'blue';
												 }
												 $('.last_chat_id').val(k.id);
												$('.messages').append('<p><span class='+color+'>('+k.timesss+') '+k.name+' :</span>  '+k.message+'</p>');
											}
										 });
									});
									
									var d = $('.messages');
									d.scrollTop(d.prop("scrollHeight"));
								}
								
							}
						}
					});*/
			//to get messages on page load
			
			//to ping server to get messages for every 2 seconds 
			setInterval(function() {
				var last_chat_id = $('.last_chat_id').val();
				//alert(last_chat_id);
				$.ajax({
						type: "POST",
						url: url2 + 'experts/check_chat',
						dataType: "json",
						data: {id:id,last_chat_id:last_chat_id,sme_id:sme_id,type:type},
						success: function (data) {
					
							if(data)
							{
								
								if(data.length !=0)
								{
									 $.each(data, function (i, item) {
										$('.chat_id').val(item.id);
										 $.each(item.messages, function (j, k) {
											 if(k.user_type == 'user')
											 {
												 var color = 'red';
											 }
											 else{
												 var color = 'blue';
											 }
											 $('.last_chat_id').val(k.id); 
											$('.messages').append('<p><span style=color:'+color+'>('+k.timesss+') '+k.name+' :</span>  '+k.message+'</p>');
										 });
									});
									var d = $('.messages');
									d.scrollTop(d.prop("scrollHeight"));
								}
								//window.location.href = url2 + 'experts/new_chat_payment_checkout/';
							}
						}
					});
			}, 2000);
			//to ping server to get messages for every 2 seconds 
			
			
			//to add the new chat into database
			$('.message').keydown(function(e) {
				if(e.which == 13) {
					
					
					e.preventDefault();
					var last_chat_id = $('.last_chat_id').val();
					if(parseInt(last_chat_id) !=0 )
					{
						last_chat_id = parseInt(last_chat_id) +1;
						$('.last_chat_id').val(last_chat_id);
					}
					var chat = $('.chat_id').val();
					var message = $('.message').val();
					$('.message').val(' ');
					
					var dt = new Date();
					var date = dt.getFullYear()+'-'+(dt.getMonth()+1)+'-'+dt.getDate();
					var time = formatAMPM(dt);
					var time2 = format(dt);
					var daytime = date+' '+time2;
					if(type == 'user')
					 {
						 var color = 'red';
					 }
					 else{
						 var color = 'blue';
					 }
					 
					$('.messages').append('<p><span style=color:'+color+'>('+time+') '+name+' :</span>  '+message+'</p>');
					var d = $('.messages');
					d.scrollTop(d.prop("scrollHeight"));
					
					$.ajax({
							type: "POST",
							url: url2 + 'experts/update_chat',
							dataType: "json",
							data: {chat:chat,message:message,type:type,sme_id:sme_id,userid:userid,daytime:daytime},
							success: function (data) {
								if(data)
								{
									if(parseInt(last_chat_id) ==0 )
									{
										$('.last_chat_id').val(data);
									}
									//alert(data);
									//$('.last_chat_id').val(data); 
								}
								else if(data == null){
									alert('session has ended.');
								}
								
								
							}
						});
					
				}
			});
			//to add the new chat into database
			
			//to get the current time in the format Y-m-d h:i:s
			function formatAMPM(date) {
				var hours = date.getHours();
				var minutes = date.getMinutes();
				var seconds = date.getSeconds();
				var ampm = hours >= 12 ? 'PM' : 'AM';
				hours = hours % 12;
				hours = hours ? hours : 12; // the hour '0' should be '12'
				hours = hours < 10 ? '0'+hours : hours;
				minutes = minutes < 10 ? '0'+minutes : minutes;
				seconds = seconds < 10 ? '0'+seconds : seconds;
				var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm ;
				return strTime;
			}
			
			//to get the current time in the format Y-m-d H:i:s to store it in database
			function format(date) {
				var hours = date.getHours();
				var minutes = date.getMinutes();
				var seconds = date.getSeconds();
				var ampm = hours >= 12 ? 'PM' : 'AM';
				hours = hours ? hours : 12; // the hour '0' should be '12'
				minutes = minutes < 10 ? '0'+minutes : minutes;
				seconds = seconds < 10 ? '0'+seconds : seconds;
				var strTime = hours + ':' + minutes + ':' + seconds;
				return strTime;
			}
			
			
		});
		
 </script>