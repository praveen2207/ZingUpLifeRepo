toggleNotificationBlock = function(isLoggedIn){
    if($('#notifications_block').is(':visible') === true){
        $('#notifications_block').hide();
    }
    else{
        $('#notifications_block').show();
    }
}; 

getNotiicationForLoggedInUser = function(){
    var notificationsHTML = '';
    var isNotificationPresent = parseInt($('#notification_content').val());
    if(!isNotificationPresent){
     $.ajax({
                type: 'POST',
                url: baseURL + 'users/notifications',
                dataType: "json",
                success: function (notificationsData) {
                    $('#notifications_block .ajax-loader').hide();
                    if(notificationsData.length > 0){
                        $.each(notificationsData, function(key,notificationData){
                            notificationsHTML += '<a href="'+notificationData.url+'" target = "_blank">'+'<div class="notify">'+notificationData.notification+'</div></a>';
                        });
                        
                        $('#notification_count').html(notificationsData.length).show();
                    }
                    else{
                        notificationsHTML = '<div class="txt_center" style="margin-top:20px;">No new notification for you.</div>';
                        //$('#notification_count').html(notificationsData.length).hide();
                    }
                    $('#notifications_area').html(notificationsHTML);
                    $('#notification_content').val(1);

                }
       }); 
    }
};




var mouse_is_inside = false;

$(document).ready(function()
{
	if(isLoggedIn){
	    getNotiicationForLoggedInUser();    
	}
	else{
	    $('#notifications_block .ajax-loader').hide();
	    var notificationsHTML = '<div class="txt_center" style="margin-top:20px;">Please <a style="color: #337ab7;" href="'+baseURL+'login">Sign in</a> to view notifications</div>';
	    $('#notifications_area').html(notificationsHTML);
	}
	
    $('#notifications_block').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").mouseup(function(){ 
        if(! mouse_is_inside) $('#notifications_block').hide();
    });
});