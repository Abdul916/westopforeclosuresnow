jQuery( document ).ready(function() {
    
    jQuery('.min_set_date').datepicker({
        dateFormat: "yy-mm-dd"
    });
    jQuery('body').on('change', '.min_type', function() {
        change_minval();
    });
    jQuery('body').on('change', '.min_current_type', function() {
        change_minval();
    });
    jQuery('body').on('change', '.min_current', function() {
        change_minval();
    });
    jQuery('body').on('change', '.min_current_days', function() {
        change_minval();
    });
    jQuery('body').on('change', '.min_set_date', function() {
        change_minval();
    });
    jQuery('body').on('change', '.min_field_name', function() {
        change_minval();
    });

    function change_minval(){
        var min_type = jQuery('.min_type').val();
        if(min_type=='set_date'){
            jQuery('.min_set_date_upper').show();
            jQuery('.min_current_upper').hide();
            jQuery('.min_field_name_upper').hide();
            var myval = 'set_date';
            if(jQuery('.min_set_date').val()!=''){
                myval = myval+'|'+jQuery('.min_set_date').val();
            }
            jQuery('.min_val').val(myval);

        }else if(min_type=='current'){
            jQuery('.min_set_date_upper').hide();
            jQuery('.min_current_upper').show();
            jQuery('.min_field_name_upper').hide();
            var myval = 'current';
            if(jQuery('.min_current_type').val()!=''){
                myval = myval+'|'+jQuery('.min_current_type').val();
            }
            if(jQuery('.min_current').val()!=''){
                myval = myval+'|'+jQuery('.min_current').val();
            }
            if(jQuery('.min_current_days').val()!=''){
                myval = myval+'|'+jQuery('.min_current_days').val();
            }
            jQuery('.min_val').val(myval);
        }else if(min_type=='field_name'){
            jQuery('.min_set_date_upper').hide();
            jQuery('.min_current_upper').hide();
            jQuery('.min_field_name_upper').show();
            var myval = 'field_name';
            if(jQuery('.min_field_name').val()!=''){
                myval = myval+'|'+jQuery('.min_field_name').val();
            }
            jQuery('.min_val').val(myval);
        }else{
            jQuery('.min_set_date_upper').hide();
            jQuery('.min_current_upper').hide();
            jQuery('.min_field_name_upper').hide();
            jQuery('.min_val').val("no_limit");
        }
        jQuery('.min_val').trigger("change");
    }

    jQuery('.max_set_date').datepicker({
        dateFormat: "yy-mm-dd"
    });
    jQuery('body').on('change', '.max_type', function() {
        change_maxval();
    });
    jQuery('body').on('change', '.max_current_type', function() {
        change_maxval();
    });
    jQuery('body').on('change', '.max_current', function() {
        change_maxval();
    });
    jQuery('body').on('change', '.max_current_days', function() {
        change_maxval();
    });
    jQuery('body').on('change', '.max_set_date', function() {
        change_maxval();
    });
    jQuery('body').on('change', '.max_field_name', function() {
        change_maxval();
    });

    function change_maxval(){
        var max_type = jQuery('.max_type').val();
        if(max_type=='set_date'){
            jQuery('.max_set_date_upper').show();
            jQuery('.max_current_upper').hide();
            jQuery('.max_field_name_upper').hide();
            var myval = 'set_date';
            if(jQuery('.max_set_date').val()!=''){
                myval = myval+'|'+jQuery('.max_set_date').val();
            }
            jQuery('.max_val').val(myval);

        }else if(max_type=='current'){
            jQuery('.max_set_date_upper').hide();
            jQuery('.max_current_upper').show();
            jQuery('.min_field_name_upper').hide();
            var myval = 'current';
            if(jQuery('.max_current_type').val()!=''){
                myval = myval+'|'+jQuery('.max_current_type').val();
            }
            if(jQuery('.max_current').val()!=''){
                myval = myval+'|'+jQuery('.max_current').val();
            }
            if(jQuery('.max_current_days').val()!=''){
                myval = myval+'|'+jQuery('.max_current_days').val();
            }
            jQuery('.max_val').val(myval);
        }else if(max_type=='field_name'){
            jQuery('.max_set_date_upper').hide();
            jQuery('.max_current_upper').hide();
            jQuery('.max_field_name_upper').show();
            var myval = 'field_name';
            if(jQuery('.max_field_name').val()!=''){
                myval = myval+'|'+jQuery('.max_field_name').val();
            }
            jQuery('.max_val').val(myval);
        }else{
            jQuery('.max_set_date_upper').hide();
            jQuery('.max_current_upper').hide();
            jQuery('.max_field_name_upper').hide();
            jQuery('.max_val').val("no_limit");
        }
        jQuery('.max_val').trigger("change");
    }
});