
class panel {
    //----------------------------------------------------------------
    constructor(options) {

        this.options = $.extend({
            id: null,
            url: null,
        }, (options === undefined ? {} : options));

        this.url_arr = [];
        this.id = this.options.id;
        this.urlCurrent = this.options.url;
        this.url_arr.push(this.urlCurrent);
    }
    //----------------------------------------------------------------
    requestUpdate(url, options){

        let id = this.id;

        options = $.extend({
            method: 'GET',
            success:function(response){
                $('#'+id).html(response);
            },
        }, (options === undefined ? {} : options));

        url = app.http.appendURL(url, 'p=' + id);

        app.ajax.request(url, options);

        this.url_arr.push(url);
        this.urlCurrent = url;

    }
    //----------------------------------------------------------------
    refresh(options){
        this.requestUpdate(this.urlCurrent, options);
    }
    //----------------------------------------------------------------
    popup(url, options){
        app.browser.popup(url, options);
    }
    //----------------------------------------------------------------
    requestRefresh(url, options){

        let instance = this;

        options = $.extend({
            success: function(response){
                instance.refresh(options);
            },
        }, (options === undefined ? {} : options));

        app.ajax.request(url, options);
    }
    //----------------------------------------------------------------
    back(options){

        if(this.url_arr.length > 1){
            this.url_arr.pop();
            this.urlCurrent = this.url_arr[this.url_arr.length-1];

            this.requestUpdate(this.urlCurrent, options);
        }
    }
    //----------------------------------------------------------------
    setHtml(html, options){
        document.getElementById(this.id).innerHTML = html;
    }
    //----------------------------------------------------------------
}