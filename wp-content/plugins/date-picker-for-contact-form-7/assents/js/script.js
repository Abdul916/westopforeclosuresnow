jQuery( document ).ready(function() {

    jQuery(".gmdpcf_datepicker").each(function() {
        var currentel = jQuery(this);
        const configdat = {};
        if(jQuery(this).attr("format")!=''){
            configdat.dateFormat = jQuery(this).attr("format");
        }
        if(jQuery(this).attr("min_val")!=''){
            var  min_val = jQuery(this).attr("min_val");
            var min_val_arr = min_val.split("|");
            console.log(min_val_arr);
            if(min_val_arr[0]=="set_date"){
                configdat.minDate = min_val_arr[1];
            }
            if(min_val_arr[0]=="current"){
                if(min_val_arr[3]=='days'){
                    daysis = min_val_arr[2];
                }else if(min_val_arr[3]=='year'){
                    daysis = min_val_arr[2]*365;
                }else if(min_val_arr[3]=='weeks'){
                    daysis = min_val_arr[2]*7;
                }else if(min_val_arr[3]=='months'){
                    daysis = min_val_arr[2]*30;
                }
                if(min_val_arr[1]=='minus'){
                    configdat.minDate = -daysis;
                }else{
                    configdat.minDate = daysis;
                }
            }
            if(min_val_arr[0]=="field_name"){
                console.log(min_val_arr[1]+" " +jQuery("input[name="+min_val_arr[1]+"]").val());
                jQuery("input[name="+min_val_arr[1]+"]").datepicker("option", "onSelect",  function(selectedDate) { 
                    console.log(currentel.attr("name")); 
                    //console.log("gggg"); 
                    console.log(currentel.datepicker('option', 'dateFormat')); 
                    var arrivalDate = jQuery.datepicker.parseDate(currentel.datepicker('option', 'dateFormat'), selectedDate);
                    var checkoutMinDate = new Date(arrivalDate.getTime() + 60000); 
                    checkoutMinDate.setDate(checkoutMinDate.getDate() + 1);
                    jQuery("input[name="+currentel.attr("name")+"]").datepicker("option", "minDate", checkoutMinDate);
                });
            }
            
        }
        if(jQuery(this).attr("max_val")!=''){
            var  max_val = jQuery(this).attr("max_val");
            var max_val_arr = max_val.split("|");
            console.log(max_val_arr);
            if(max_val_arr[0]=="set_date"){
                configdat.maxDate = max_val_arr[1];
            }
            if(max_val_arr[0]=="current"){
                if(max_val_arr[3]=='days'){
                    daysis = max_val_arr[2];
                }else if(max_val_arr[3]=='year'){
                    daysis = max_val_arr[2]*365;
                }else if(max_val_arr[3]=='weeks'){
                    daysis = max_val_arr[2]*7;
                }else if(max_val_arr[3]=='months'){
                    daysis = max_val_arr[2]*30;
                }
                if(max_val_arr[1]=='minus'){
                    configdat.maxDate = -daysis;
                }else{
                    configdat.maxDate = daysis;
                }
                
            }
            if(max_val_arr[0]=="field_name"){
                console.log(max_val_arr[1]+" " +jQuery("input[name="+max_val_arr[1]+"]").val());
                jQuery("input[name="+max_val_arr[1]+"]").datepicker("option", "onSelect",  function(selectedDate) { 
                    console.log(currentel.attr("name")); 
                    var arrivalDate = jQuery.datepicker.parseDate(currentel.datepicker('option', 'dateFormat'), selectedDate);
                    var checkoutMinDate = new Date(arrivalDate.getTime() + 60000); 
                    checkoutMinDate.setDate(checkoutMinDate.getDate() + 1);
                    jQuery("input[name="+currentel.attr("name")+"]").datepicker("option", "maxDate", checkoutMinDate);
                });
            }
            
        }
        if(jQuery(this).attr("disable_weekdays")!=''){
            console.log(configdat);
            //var passDayArray = ["2023-07-25", "2023-07-28", "2023-08-02"]; 
            var passDayArray = jQuery(this).attr("disable_weekdays").split("|");
            configdat.beforeShowDay = function(date) {
                return disablecusyomdays(date, passDayArray);
            };
        }
        //configdat.beforeShowDay = disablecusyomdays;
        jQuery(this).datepicker(configdat);
    });

    function disablecusyomdays(date) {
        return [(date.getDay() != 5)]; // 0 = Sunday, 1 = Monday, ..., 5 = Friday, 6 = Saturday
    }
    function disablecusyomdays(date, passDayArray) {
         var dayOfWeek = date.getDay();
        var dayName = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        var dayNameLowerCase = dayName[dayOfWeek].toLowerCase();
        var isPassDay = jQuery.inArray(dayNameLowerCase, passDayArray) !== -1;
        return [!isPassDay];
    }
});