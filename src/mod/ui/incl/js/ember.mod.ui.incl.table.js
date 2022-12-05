
class table {
    //----------------------------------------------------------------
    constructor(options) {
        this.options = $.extend({
            id: null,
            url: null,
        }, (options === undefined ? {} : options));

        this.data = {
            page:1,
            search:"",
            orderby:"",
            ui_table:this.options.id,
        };

    }
    //----------------------------------------------------------------
    paginate(page){

        this.data.page = page;
        this.update();

    }
    //----------------------------------------------------------------
    reset(){

        this.data.page = 1;
        this.data.search = "";
        this.update();

        let reset_btn = this.get_element("reset_btn");
        if(!reset_btn.hasClass("d-none")) reset_btn.addClass('d-none');
        this.get_element("search_input").val('');

    }
    //----------------------------------------------------------------
    search(){

        this.data.search = $("#search\\\["+this.options.id+"\\\]").val();
        this.data.page = 1;

        if(this.data.search !== ""){
            this.update();

            this.get_element("reset_btn").removeClass('d-none');
        }

    }
    //----------------------------------------------------------------
    get_element(type){

        switch (type) {
            case "reset_btn":
                return $(".ui-table-wrapper[data-id="+this.options.id+"]").find('.btn-reset');

            case "search_input":
                return $("#search\\\["+this.options.id+"\\\]");
        }

    }
    //----------------------------------------------------------------
    update(){

        let instance = this;

        app.ajax.request(instance.options.url, {
            data:instance.data,
            beforeSend:function(){
                $("#"+instance.options.id).addClass('loading');
            },
            success:function(response){
                setTimeout(function(){
                    $("#"+instance.options.id).html(response);
                    $("#"+instance.options.id).removeClass('loading');
                }, 200);
            },
        });
    }
    //----------------------------------------------------------------
}