/* [ ---- Beoro Admin - wizard ---- ] */

    $(document).ready(function() {
        //* wizard
        beoro_wizard.w_basic();
        beoro_wizard.w_vertical();
        beoro_wizard.w_validation();
    });

    //* wizard
    beoro_wizard = {
        w_basic: function() {
            if($('#wizard-basic').length) { 
                $('#wizard-basic').smartWizard();
            }
        },
        w_vertical: function() {
            if($('#wizard-vertical').length) { 
                $('#wizard-vertical').smartWizard({
                    transitionEffect: 'slide',
                    hideButtonsOnDisabled: true
                });
            }
        },
        w_validation: function() {
            if($('#wizard-validation').length) { 
                $('#wizard-validation-form').validate({
                    onkeyup: false,
                    onfocusout: false,
                    highlight: function(element) {
                        $(element).closest('div.control-group').addClass("f-error");
                    },
                    unhighlight: function(element) {
                        $(element).closest('div.control-group').removeClass("f-error");
                    },
                    errorPlacement: function(error, element) {
                        $(element).closest('div').append(error);
                    },
                    rules: {
                        'v_username'    : {
                            required    : true,
                            minlength   : 3
                        },
                        'v_email'       : 'email',
                        'v_newsletter'  : 'required',
                        'v_password'    : 'required',
                        'v_city'        : 'required',
                        'v_country'     : 'required'
                    }, messages: {
                        'v_username'    : { required:  'Username field is required!' },
                        'v_email'       : { email   :  'Invalid e-mail!' },
                        'v_newsletter'  : { required:  'Newsletter field is required!' },
                        'v_password'    : { required:  'Password field is requerid!' },
                        'v_city'        : { required:  'City field is requerid!' },
                        'v_country'     : { required:  'Country field is requerid!' }
                    },
                    ignore              : ':hidden'
                });
                
                $('#wizard-validation').smartWizard({
                    onLeaveStep: function(obj,context) {
                        var isValid = $('#wizard-validation-form').valid();
                        if(isValid) {
                            $('#wizard-validation').smartWizard('setError',{stepnum:context.fromStep,iserror:false});
                            return true;
                        } else {
                            adjustStepHeight();
                            return false;
                        }
                    },
                    hideButtonsOnDisabled: true,
                    labelFinish: 'Save'
                });

                function adjustStepHeight() {
                    var thisFormWrapper = $('#wizard-validation').find('.stepContainer');
                    var actStep = thisFormWrapper.children('.content').filter(':visible');
                    thisFormWrapper.height(actStep.height());
                }
            }
        }
    };