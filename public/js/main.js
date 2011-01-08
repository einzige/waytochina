$(document).ready(function(){
    $('#left_side .menu').cornerz({radius: 6});
    $.tools.validator.localize("ru", {
	':email'  		: 'Укажите верный e-mail адрес',
	':number' 		: 'Поле должно быть числом',
	'[max]'	 		: 'Должно быть не больше, чем $1',
	'[min]'	 		: 'Должно быть не меньше, чем $1',
	'[required]' 	        : 'Это поле обязательно для заполнения'
    });

    $.tools.validator.localize("cn", {
	':email'  		: 'Укажите верный e-mail адрес',
	':number' 		: 'Поле должно быть числом',
	'[max]'	 		: 'Должно быть не больше, чем $1',
	'[min]'	 		: 'Должно быть не меньше, чем $1',
	'[required]' 	        : '此字段是必需的'
    });

    $("form.ajax").each(function(i, form){
        var messager = $(form).find('.message');
        $(form).ajaxForm({
          dataType : 'json',
          success  : function(msg) {
            messager.fadeOut('fast', function(){messager.fadeIn();});
            messager.attr('class', msg.class);
            messager.empty();
            messager.append(msg.message);
          }
        });
    });
});
