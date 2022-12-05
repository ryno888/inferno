
$(function(){

    let body = $('body');
    //-----------------------------------------------------------------
    body.on('keyup change', '.form-control.is-invalid', function(){
        $(this).removeClass("is-invalid");
    });
    //-----------------------------------------------------------------

});

class form {
    //----------------------------------------------------------------
    constructor(options) {
        this.options = $.extend({
            id: null,
            action: null,
        }, (options === undefined ? {} : options));

    }
    //----------------------------------------------------------------
    process_form_response(response){

        let instance = this;

        if(response.code === 1 && response.errors){
            let popup_errors = [];

            $.each(response.errors, function(fieldName, error) {
                let field = $(instance.options.id).find('#'+fieldName);

                if(field.length){
                    field.addClass('is-invalid');
                    let invalid_feedback = field.parent().find('.invalid-feedback');
                    if (invalid_feedback) {
                        invalid_feedback.text(error);
                    }
                }else{
                    popup_errors.push(error);
                }
            });

            if(popup_errors.length){
                app.browser.alert(app.data.implode('<br>', popup_errors));
            }

        }else{
            app.ajax.process_response(response);
        }
    }
    //----------------------------------------------------------------
}