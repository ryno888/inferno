/**
 * Class components
 * @package
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

var modal_panel;
var app = {
    //==================================================================================
    ajax: {
        request:function(url, options){

            var options = $.extend({
                update: false,
                data: false,
                form: false,
                confirm: false,
                method: 'POST',
                datatype: 'json',
                beforeSend: false,
                success: false,
                complete: false,
                no_overlay: false,
                screen_overlay: true,
                cancel_confirm: false,
                ok_confirm: false,
                csrf: $('.security-token').data("token"),
            }, (options == undefined ? {} : options));

            // confirm
            if (options.confirm === true) {
                options.confirm = 'Are you sure you want to continue?';
            }

            // function
            var $ajax = {
                done: function () { /* support for done method return */
                }
            };
            var do_ajax_request = function () {
                // overlay
                if (!options.no_overlay && options.update) {
                    app.overlay.show(options.update);
                }

                // post data
                var data_arr = [];
                if (options.form) data_arr.push($(options.form).serialize());
                if (typeof options.data === 'object') {
                    for (var prop in options.data) {
                        data_arr.push(encodeURIComponent(prop) + '=' + encodeURIComponent(options.data[prop]));
                    }
                    options.data = false;
                }
                if (options.data) data_arr.push(options.data);
                if (options.csrf && options.method != 'GET' && !options.form) data_arr.push('_csrf=' + encodeURIComponent(options.csrf));
                if (data_arr.length > 0) options.data = data_arr.join('&');

                // request
                $ajax = $.ajax(url, {
                	dataType: options.datatype,
                    async: options.async,
                    type: options.method,
                    data: options.data,
                    beforeSend: function () {

                        if (options.beforeSend) options.beforeSend.apply(this, [options]);

                        // overlay
                        if (!options.no_overlay && options.update) {
                            if (options.screen_overlay) {
                                if (!options.no_overlay) app.overlay.show(options.update);
                            } else {
                                $(options.update).html('<div class="text-center panel-loader"><div class="min-vh-15"></div><div class="spinner-grow text-muted"></div><div class="spinner-grow text-primary"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-info"></div><div class="spinner-grow text-warning"></div><div class="spinner-grow text-danger"></div><div class="spinner-grow text-secondary"></div><div class="spinner-grow text-muted"></div><div class="min-vh-15"></div></div>');
                            }
                        }
                    },
                    success: function (data) {
                        // check for structured response

                        if (typeof data == 'string' && (/^##JSON##/).test(data)) {
                            // extract structure
                            data = $.parseJSON(data.replace(/^##JSON##/, ''));

                            // execute action
                            switch (data.type) {
                                case 'alert' :
                                    app.browser.alert(data.message, data.title);
                                    $('button').button('reset');
                                    break;
                            }
                            return;
                        }

                        // check response for message signature
                        if (typeof data == 'string' && (/##MESSAGE##/).test(data)) {
                            // split message string and data
                            var message_index = data.search(/##MESSAGE##/);
                            var message = data.substr(message_index);
                            data = data.substr(0, message_index);

                            // show message
                            var message_arr = eval(message.replace('##MESSAGE##', ''));
                            app.message.show_notice(message_arr);
                        }

                        if (options.success) {
                            switch (typeof options.success) {
                                case 'string' :
                                    eval(options.success + '(data, options);');
                                    break;
                                case 'function' :
                                    options.success.apply(this, [data, options]);
                                    break;
                            }
                        } else {
                            if (options.update && options.update !== "false") {

                                if ($(options.update).closest('.modal').length) options.autoscroll = false;

                                $(options.update).find('object.swfupload').each(function () {
                                    swfobject.removeSWF($(this)[0].id);
                                });

                                $('body .tooltip').remove();

                                if (options.hidden_update) {
                                    $(options.update).parent().css({'height': ($(options.update).parent().outerHeight())});
                                    $(options.update)
                                        .hide()
                                        .html(data)
                                        .show();
                                    $(options.update).parent().css({'height': ''});
                                } else {

                                    if (options.loader_html) {
                                        setTimeout(function () {
                                            $(options.update).html(data);
                                            if (options.autoscroll) browser.scrollTo(options.update, {offset: options.autoscroll_offset});

                                        }, 500)
                                    } else {
                                        $(options.update).html(data);
                                        if (options.autoscroll) browser.scrollTo(options.update, {offset: options.autoscroll_offset});
                                    }
                                }
                            }
                        }
                    },
                    complete: function (d) {

                        let data = d.responseJSON;

                        if (!options.no_overlay && options.update) app.overlay.hide();

                        if (options.complete) options.complete.apply(this, [options, data]);
                    }
                });
            }

            // confirm dialog
            if (options.confirm) {
                app.browser.confirm(options.confirm, function () {
                    if (options.ok_confirm) options.ok_confirm();
                    do_ajax_request();
                }, options.cancel_confirm);
            } else do_ajax_request();

            // return;
            return $ajax;

        },
		//--------------------------------------------------------------------------------
		request_function: function(url, func, options) {
	    	// options
	    	var options = $.extend({
				success: func
	    	}, (options == undefined ? {} : options));

	    	// ajax
    		return app.ajax.request(url, options)
		},
		//------------------------------------------------------------------------------
		process_response:function(response, oncomplete){

			if(response.js) eval(response.js);
			if(response.alert) app.browser.alert(response.alert, (response.title ? response.title : "Alert"), {ok_callback : new Function(response.ok_callback)});
			if(response.message) app.browser.alert(response.message, (response.title ? response.title : "Alert"), {ok_callback : new Function(response.ok_callback), class:'custom'});
			if(response.notice) app.message.show_notice(response.notice, false, {color:(response.notice_color ? response.notice_color : 'primary')});
			if(response.redirect){ app.overlay.show(); document.location=response.redirect;}
			if(response.refresh) document.location.reload();
			// if(response.popup) app.browser.popup(response.popup);

			var oncomplete = (oncomplete === undefined ? function(){} : oncomplete);

			setTimeout(function () {
				oncomplete();
			}, 100)

		}
    },
    //==================================================================================
	html:{
    	//------------------------------------------------------------------------------
    	btn_arr:[],
		//------------------------------------------------------------------------------
    	set_btn_loading:function(el){
    		el = $(el).first();

    		//set target
    		let target = app.str.generate_id();
    		el.attr('data-el-id', target);

    		//store original html
    		app.html.btn_arr[target] = el.html();

    		//set to loading
    		el.html('test 2');
		},
		//------------------------------------------------------------------------------
		unset_btn_loading:function(el){
    		el = $(el).first();

    		//get target
    		let target = el.attr("data-el-id");

    		//get original html
    		let original = app.html.btn_arr[target];

    		//replace
			el.html(original);
			el.removeAttr("data-el-id");

		},
		//------------------------------------------------------------------------------
	},
    //==================================================================================
	form: {

	},
    //==================================================================================
    browser: {
        window_count: 0,
        popup_count: 0,
        popup_id_arr: [],
        //------------------------------------------------------------------------------
		popup:function(url, options){

        	options = $.extend({
				title: '',
				width: 'modal-lg',
				id: app.str.generate_id(),
				popup_id: 'modal_panel',
				closable: true,
				backdrop: "static",
				height_class: "mh-40",
				data: {},
				ok_callback: function(){},
			}, (options === undefined ? {} : options));

        	url = app.http.appendURL(url, 'mid=' + options.id);

        	let p = new popup(options);
			p.set_title(options.title);
			p.set_loading_content();
			p.on_show(function(e){

				$('#' + options.id + ' .modal-body').html('<div id="'+options.popup_id+'"></div>')

				modal_panel = new panel({
					id:options.popup_id,
					url:url
				});
                modal_panel.refresh();

			});

			return p.build({
				backdrop:options.backdrop,
			});

		},
        //------------------------------------------------------------------------------
		alert: function(message, title, options) {

			options = $.extend({
				width: 'modal-md',
				closable: false,
				ok_callback: function(){},
			}, (options === undefined ? {} : options));

			if(!title) title = "Alert";

			let alert = new popup(options);
			alert.set_title(title);
			alert.set_body_content(message);
			alert.set_footer_content('<button type="button" class="btn btn-primary" commodal-btn="ok" data-dismiss="modal">Ok</button>');

			var $popup = alert.build();

			$popup.on('shown.bs.modal', function (event) {
				var $this = $(this);
				$this.find('button[commodal-btn=ok]')
					.click(function() {
						if (options.ok_callback !== undefined) options.ok_callback.apply(this, []);
					}).focus();
				app.overlay.hide();
			});

			return $popup;

		},
		//--------------------------------------------------------------------------------
		confirm: function(message, ok_callback, cancel_callback, options) {

			var options = $.extend({
				width: 'modal-md',
				title: 'Confirm',
			}, (options == undefined ? {} : options));

			var title = options.title;
			var ok_callback = (ok_callback == undefined ? function() {} : ok_callback);
			var cancel_callback = (cancel_callback == undefined ? function() {} : cancel_callback);

			let alert = new popup(options);
			alert.set_title(title);
			alert.set_body_content(message);
			alert.set_footer_content('<button class="btn btn-primary" commodal-btn="ok" data-dismiss="modal">Ok</button><button class="btn btn-secondary" commodal-btn="cancel" data-dismiss="modal">Cancel</button>');
			alert.on_show(function(){
				var $this = $(this);
				$this.find('button[commodal-btn=ok]')
					.click(function() {
						if (ok_callback) ok_callback.apply(this, []);
					}).focus();

				$this.find('button[commodal-btn=cancel]').click(function() {
					if (cancel_callback) cancel_callback.apply(this, []);
				});
			});
			return alert.build();
		},
		display_on_load_elements:function(){
        	$('.remove-on-load').removeClass('remove-on-load');
		},
    },
    //==================================================================================
	util:{
    	//-------------------------------------------------------------------------
        id_generator: function () {
            var S4 = function () {
                return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
            };
            return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
        },
    	//-------------------------------------------------------------------------
        copy_text_to_clipboard: function (text, options) {
            app.util.copy_text(text, options);
        },
        //-------------------------------------------------------------------------
        copy_to_clipboard: function (element) {
            app.util.copy_text(element.text());
        },
        //-------------------------------------------------------------------------
        copy_text: function (text, options) {

            var options = $.extend({
                br2nl: false,
            }, (options == undefined ? {} : options));

            if (options.br2nl) {
                var brRegex = /<br\s*[\/]?>/gi;
                text = text.replace(brRegex, "\r\n");
            }

            let body = $('body');
            let id = app.util.id_generator();

            let $temp = $("<input>");
            $temp.attr("id", id);
            $temp.css({position: 'absolute', left: '-5000px'});
            $temp.val(text);

            if (body.hasClass('modal-open')) {
                $('.modal.show').append($temp);
                $temp.select();
            } else {
                $("body").append($temp);
                $temp.select();
            }

            setTimeout(function () {
                document.execCommand("copy");
                app.message.show_notice("Text copied to clipboard");
                $temp.remove();
            }, 100);

        },
	},
    //==================================================================================
    data: {
		//------------------------------------------------------------------------------
		implode:function(seperator, data){
			if(!seperator) seperator = ",";
			return data.join(seperator)
		},
		//------------------------------------------------------------------------------
		explode:function(seperator, data){
			if(!seperator) seperator = ",";
			return data.split(seperator);
		},
		//------------------------------------------------------------------------------
		generate_unique_id:function(prefix){

			let rand = Math.round(new Date().getTime() + (Math.random() * 100));

			if(prefix) return prefix + "_" +rand;

			return rand;
		},
		//------------------------------------------------------------------------------
		serialize_object : function(params) {
			return jQuery.param( params );
		},
		//------------------------------------------------------------------------------
		form_to_json: function (selector) {
			var ary = $(selector).serializeArray();
			var obj = {};
			for (var a = 0; a < ary.length; a++)
				obj[ary[a].name] = ary[a].value;
			return obj;
		},
		//------------------------------------------------------------------------------
		json_to_arr: function (json_data) {
			var result = [];
			for(var i in json_data)
				result.push([i, json_data [i]]);

			return result;
		},

    },
    //==================================================================================
    ui: {
		//------------------------------------------------------------------------------
		is_mobile:function(){
			if( /Android|webOS|iPhone|iPad|Mac|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )return true;
			return false;
		},
		//--------------------------------------------------------------------------------
		set_button_loading:function(target){

			if(!app.workspace.loading_button){
				app.workspace.loading_button = [];
			}

			$(target).each(function(){
				let el = $(this);

				if(el.hasClass('loading')) {
					return;
				}

				let accessor = app.data.generate_unique_id();
				app.workspace.loading_button.push({
					accessor : accessor,
					html : el.html(),
				});
				el.html('Loading... <i class=\'fas fa-spinner fa-spin\'></i>');
				el.prop('disabled', true);
				el.attr('data-accessor', accessor);
				el.addClass("loading");
			});
		},
		//--------------------------------------------------------------------------------
		unset_button_loading:function(target){

			if(!app.workspace.loading_button){
				app.workspace.loading_button = [];
			}

			$(target).each(function(){
				let el = $(this);
				let accessor = el.data('accessor');

				let result = app.workspace.loading_button.filter(x => x.accessor === accessor);

				$.each( result, function( key, value ) {
					el.html(value.html);
					el.prop('disabled', false);
					el.removeAttr('data-accessor');
					el.removeClass("loading");
				});
			});
		},

    },
    //==================================================================================
	str: {
		//------------------------------------------------------------------------------
		extension: function (filename) {
			return filename.substr((filename.lastIndexOf('.') + 1));
		},
		//------------------------------------------------------------------------------
		clean_filename: function (filename) {
			var extension = util.extension(filename);
			var s = filename.substr(0, filename.lastIndexOf('.')) || filename;
			return s.replace(/[^a-z0-9]/gi, '_').toLowerCase() + '.' + extension;
		},
		//------------------------------------------------------------------------------
		generate_id : function(options) {
			options = $.extend({
				prepend: '',
				length: 5,
				lowercase: true,
				glue: "_",
			}, (options === undefined ? {} : options));

			let result = '';
			let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			let charactersLength = characters.length;

			for (let i = 0; i < options.length; i++) {
				result += characters.charAt(Math.floor(Math.random() * charactersLength));
			}

			if(options.lowercase) result = result.toLowerCase();
			if(options.prepend !== '') result = options.prepend + options.glue + result;

			return result;
		},
	},
    //==================================================================================
    num: {
		//------------------------------------------------------------------------------
		round: function round(value, precision) {
			if(precision === undefined) precision = 2;
			var aPrecision = Math.pow(10, precision);
			return Math.round(value*aPrecision)/aPrecision;
		},
		//------------------------------------------------------------------------------
		currency:function(number, symbol) {
			var neg = false;
			if(number < 0) {
				neg = true;
				number = Math.abs(number);
			}

			if(!symbol) symbol = "R";

			return (neg ? "-"+symbol+" " : symbol+' ') + parseFloat(number, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
		},
	},
	//==================================================================================
	http: {
    	//------------------------------------------------------------------------------
    	URLHasGet:function(url){
    		return url.includes('?');
		},
		//------------------------------------------------------------------------------
		appendURL:function(url, append){

    		if(url.includes(append))
    			return url;

    		if(app.http.URLHasGet(url)){
				return url + '&' + append;
			}else{
				return url + '?' + append;
			}
		}
		//------------------------------------------------------------------------------
	},
	//==================================================================================
    overlay:{
        hide:function(){
        	setTimeout(function(){
				$('.page-loader-overlay').fadeOut();
				$('.page-loader-wrapper').fadeOut();

				app.browser.display_on_load_elements();

			}, 200);
		},
        show:function(){
        	$('.page-loader-overlay').show();
			$('.page-loader-wrapper').show();
		},
    },
    //==================================================================================
	message: {
		//------------------------------------------------------------------------------
		is_notice_created: false,
		is_static_created: false,
		//------------------------------------------------------------------------------
		show_notice: function(message_arr, delay, options) {
			// options
			var options = $.extend({
				title: false,
				color: "bg-info",
				tiny: true,
			}, (options == undefined ? {} : options));

			// params
			var message_arr = ($.isArray(message_arr) ? message_arr : [message_arr]);

			// toast wrapper
			var dom_toast = $('#ui_toast');
			if (!dom_toast.length) {
				$('<div>', {
					'id': 'ui_toast',
					'class': 'ui-toast d-flex flex-column',
					'aria-live' : 'polite',
					'aria-atomic' : 'true'
				}).prependTo('body');
			}

			// build message
			var message = '';
			$.each(message_arr, function(index, item) {
				message += item + '<br />';
			});

			// close button
			var dom_close_button = $('<button>', {
				'type': 'button',
				'class' : 'close text-white shadow-none ml-auto',
				'data-dismiss' : 'toast',
				'aria-label' : 'Close',
				'html' : '<span aria-hidden="true">&times;</span>',
			})[0];

			// show message
			$('<div>', {
				'class': 'toast ml-auto '+options.color,
				'role': 'alert',
				'aria-live': 'assertive',
				'aria-atomic': 'true',
				'data-delay': delay ? delay : 2000
			})
			.html($(
				'<div class="toast-header '+(options.tiny ? 'tiny' : '')+'">' + (options.tiny ? message : options.title) + dom_close_button.outerHTML + '</div>'
				+ '<div class="toast-body '+(options.tiny ? 'd-none' : '')+' "><small>' + message + '</small></div>'
			))
			.appendTo('#ui_toast')

			.on('hidden.bs.toast', function () {
				$(this).remove();
			})
			.toast('show');
		}
		//------------------------------------------------------------------------------
	},
	//==================================================================================
	workspace: {
	},
	//==================================================================================
	session: {
	},

}
