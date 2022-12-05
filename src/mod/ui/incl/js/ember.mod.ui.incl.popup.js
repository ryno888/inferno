
class popup{
	//--------------------------------------------------------------------------------
	constructor(options){

		// options
		this.options = $.extend({
			class: '',
			width: 'auto',
			id: app.data.generate_unique_id('modal'),
			title: 'Alert',
			closable: true,
			hide_header: false,
			hide_footer: false,
			body_content: '',
			height_class: '',
			footer_content: '',
			backdrop: 'static',
			on_show: function(){},
			on_hide: function(){},
			on_hidden: function(){},
		}, (options == undefined ? {} : options));

		this.aria_labelledby = this.options.id + 'Label';

	}
	//--------------------------------------------------------------------------------
	set_title(title){
		this.options.title = title;
	}
	//--------------------------------------------------------------------------------
	set_body_content(content){
		this.options.body_content = content;
	}
	//--------------------------------------------------------------------------------
	set_footer_content(content){
		this.options.footer_content = content;
	}
	//--------------------------------------------------------------------------------
	on_show(f){
		this.options.on_show = f;
	}
	//--------------------------------------------------------------------------------
	on_hide(f){
		this.options.on_hide = f;
	}
	//--------------------------------------------------------------------------------
	on_hidden(f){
		this.options.on_hidden = f;
	}
	//--------------------------------------------------------------------------------
	set_loading_content(){
		this.set_body_content(
			'<div class="panel-loader d-flex align-items-center justify-content-center mh-40">' +
				'<div class="spinner-grow spinner-grow-sm text-muted"></div>' +
				'<div class="spinner-grow spinner-grow-sm text-primary"></div>' +
				'<div class="spinner-grow spinner-grow-sm text-success"></div>' +
				'<div class="spinner-grow spinner-grow-sm text-info"></div>' +
				'<div class="spinner-grow spinner-grow-sm text-warning"></div>' +
				'<div class="spinner-grow spinner-grow-sm text-danger"></div>' +
				'<div class="spinner-grow spinner-grow-sm text-secondary"></div>' +
				'<div class="spinner-grow spinner-grow-sm text-muted"></div>' +
			'</div>'
		);
	}
	//--------------------------------------------------------------------------------
	build(){

		let builder = this;

		var $popup = $(
			'<div class="modal fade animated '+this.options.class+'" id="'+this.options.id+'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="'+this.aria_labelledby+'" aria-hidden="true">'+
				'<div class="modal-dialog '+this.options.width+'">'+
					'<div class="modal-content">'+
						'<div class="modal-header '+(this.options.hide_header ? "d-none" : "")+' ">'+
							'<h5 class="modal-title" id="'+this.aria_labelledby+'">'+this.options.title+'</h5>'+
							'<button type="button" class="close '+(!this.options.closable ? 'd-none' : '')+'" data-dismiss="modal" aria-label="Close">'+
								'<span aria-hidden="true">&times;</span>'+
							'</button>'+
						'</div>'+
						'<div class="modal-body '+this.options.height_class+'">'+
							this.options.body_content+
						'</div>'+
						'<div class="modal-footer '+(this.options.hide_footer ? "d-none" : "")+'">'+
							this.options.footer_content+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>')
			.on('show.bs.modal', function (event) {

				if($('.modal-backdrop').length) $('.modal-backdrop').css('z-index', '1029');
				if($('.modal').length) $('.modal').css('z-index', '1039');

				// clear focus from buttons
				$('button:focus').blur();
				$('body').focus().hover();

			})
			.on('shown.bs.modal', function (event) {
				var $this = $(this);

				builder.options.on_show.apply(this, [builder.options]);

				$this.find('button[commodal-btn=ok]').focus();

				app.browser.popup_id_arr.push(builder.options.id);

				app.overlay.hide();
			})
			.on('hide.bs.modal', function(e) {
				builder.options.on_hide.apply(this, [builder.options]);

				if($('.modal-backdrop').length) $('.modal-backdrop').css('z-index', '1039');
				if($('.modal').length) $('.modal').css('z-index', '1049');

            })
			.on('hidden.bs.modal', function() {
				var $this = $(this);

				builder.options.on_hidden.apply(this, [builder.options]);

				$this.remove();

				app.browser.popup_id_arr.pop();
				if (app.browser.popup_id_arr.length) {
					$('body').addClass('modal-open');
				}
			})
			.modal({
				backdrop: this.options.backdrop,
				attentionAnimation : ''
			});

		return $popup;
	}
}