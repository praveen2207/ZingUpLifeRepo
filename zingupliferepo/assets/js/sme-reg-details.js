
function selectState(country_id){
	if(country_id!="-1"){
		loadData('state',country_id);
		$("#city_dropdown").html("<option value='-1'>Select city</option>");	
	}else{
		$("#state_dropdown").html("<option value='-1'>Select state</option>");
		$("#city_dropdown").html("<option value='-1'>Select city</option>");		
	}
}
  
function selectCity(state_id){
	if(state_id!="-1"){
		loadData('city',state_id);
	}else{
		$("#city_dropdown").html("<option value='-1'>Select city</option>");		
	}
}

function loadData(loadType,loadId){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	$("#"+loadType+"_loader").show();
	$("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="'+baseUrl+'/assets/images/loading.gif" />');
	
	$.ajax({
		type: "POST",
		url: baseUrl + "utilitiesController/loadData",
		data: dataString,
		cache: false,
		success: function(result){
			
			$("#"+loadType+"_loader").hide();
			$("#"+loadType+"_dropdown").html("<option value='-1'>Select "+loadType+"</option>");  
			$("#"+loadType+"_dropdown").append(result);  
		}
	});
}

function displayExpertise(expertise)
{
  var selectedText = expertise.options[expertise.selectedIndex].innerHTML;
  if(selectedText == "Others"){
		  document.getElementById('otherExpertise').style.visibility = "visible";
  }
}

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
