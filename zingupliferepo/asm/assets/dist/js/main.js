
var base_url;
function showError(data)
{
    if(data == "" || data == undefined)
    {
        return false;
    }

    if(data.message == undefined)
    {
    //show ci validation errors
        //make sure that we are able to detect array
        if( typeof data === "object")
        {
            for(i=0; i<data.length; i++)
                {
                if(data[i].message != undefined)
                {
                    alertify.error(data[i].message);
                }
            }
        }
        else
            {
            alertify.error(data);
            }
        }
    else
    {
        alertify.error(data.message);
    }
}



function showSuccess(data)
{

    if(data == "" || data == undefined)
    {
        return false;
    }

    if(data.message == undefined)
    {
        alertify.success(data);
    }
    else
    {
        alertify.success(data.message);
    }
}

function confirm_dialog(data)
{

 
   alertify.confirm(data,function(e){
        if(e) {
             return true;
        } else {
            return false;
        }

    });

}

function render_dropdown_class(data,elem)
{
            var appenddata="<option  value=''>Select</option>";
            $.each(data, function (key, value) {
             appenddata += "<option value ='"+key+"'>"+value+"</option>";                        
            });
            $('.'+elem).html(appenddata);
} 

 
function render_dropdown(data,elem)
{   
    
            var appenddata="";
            if(elem!='predefine_quesiton'){
            var appenddata="<option value=''>Select</option>";
            }
            $.each(data, function (key, value) {
             appenddata += "<option value ='"+key+"'>"+value+"</option>";                        
            });
            $('#'+elem).html(appenddata);

            
} 

function render_dropdow_selected(data,elem,sel)
{           
 

            var appenddata="<option value=''>Select</option>";
            var selected_item="";

            $.each(data, function (key, value) {
              
            if(sel!='' && sel==key) { selected_item = "selected=selected"; }    
               appenddata += "<option "+selected_item+" value ='"+key+"'>" + value + " </option>";                        
               selected_item="";
            });

           
            $('#'+elem).html(appenddata);
} 

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function form_cancel()
{
     window.history.back();
}

function float_validation(event, value){
    if(event.which < 45 || event.which > 58 || event.which == 47 ) {
          return false;
            event.preventDefault();
        } // prevent if not number/dot

        if(event.which == 46 && value.indexOf('.') != -1) {
            return false;
            event.preventDefault();
        } // prevent if already dot

            if(event.which == 45 && value.indexOf('-') != -1) {
                return false;
            event.preventDefault();
        } // prevent if already dot

        if(event.which == 45 && value.length>0) {
            event.preventDefault();
        } // prevent if already -

    return true;

};