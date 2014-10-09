// See http://habrahabr.ru/post/158235/
// See http://habrahabr.ru/post/166109/
// See http://habrahabr.ru/sandbox/39442/

/*!
 * паттерн простого плагина jQuery  See http://habrahabr.ru/sandbox/39442/
 * автор: @ajpiano
 * дополнения: @addyosmani
 * лицензия MIT
 */

;(function ( $, window, document, undefined ) {

    // определяем необходимые параметры по умолчанию
    var pluginName = 'inputeditor2',
    
        /*
         *  applyBtnClass   {string}    Дополнительные классы для кнопки "Применить"
         *  cancelBtnClass  {string}    Дополнительные классы для кнопки "Отменить"  
         *  applyBtnIcon    {string}    Классы для иконки к кнопке "Применить"
         *  cancelBtnIcon   {string}    Классы для иконки к кнопке "Отменить"
         *  applyChanges    {function}  Вызывается при нажатии кнопки "Применить"
         *                              В параметре "el" возвращается текущий jQuery элемент
         */
        defaults = {
            applyBtnClass: '',
            //cancelBtnClass: '',
            applyBtnIcon: 'glyphicon glyphicon-ok-sign',
            //cancelBtnIcon: 'glyphicon glyphicon-remove-sign',
            applyChanges: function(el) { 
                console.log('Apply changes. Value: ' + el.val());
            },
            // TODO: Get rid of this shit. Make parameters which set color.
            setInputColor: function(el, isChanged){
                el.css('color', isChanged ? '' : 'blue');
            }
        };

    // конструктор плагина
    function InputEditor2( element, options ) {
        this.element = element;

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    InputEditor2.prototype.init = function () {
        // Тут пишем код самого плагина
        
        var el = $(this.element);
        var o = this.options;

        //var disabledBtn = el.val() === el.attr('value');

        var applyBtnClass = o.applyBtnClass === ''
                ? '' : ' ' + o.applyBtnClass;
//        var cancelBtnClass = o.cancelBtnClass === ''
//                ? '' : ' ' + o.cancelBtnClass;            

        // Создаем дополнительную разметку
        el.wrap($('<div/>', {
            class: 'wrapper-inputeditor'
        }));
        
        var wrapperDiv = el.parents('.wrapper-inputeditor');

        //o.setInputColor(el, disabledBtn);

        var span = $('<span/>', {
            class: "input-group-btn"
        }).insertAfter(el).hide();

        var applyBtn = $('<button/>', {
            title: 'Применить',
            class: 'btn btn-default' + applyBtnClass,
            type: 'button',
            //disabled: disabledBtn
        }).appendTo(span);

        var applyBtnIcon = $('<span/>', {
            class: o.applyBtnIcon
        }).appendTo(applyBtn);
        

        
        var showBtn = function(isChanged){
            if(isChanged){
                $(wrapperDiv).addClass('input-group');
                span.css('display', 'table-cell');
                o.setInputColor(el, false);
                //el.focus();
                //console.log('show');
            }
            else{
                wrapperDiv.removeClass('input-group');
                span.hide();
                o.setInputColor(el, true);   
                el.val(el.attr('value'));
                //console.log('hide');
            }
        };
       
        el.focus(function(){
            showBtn(el.val() != el.attr('value'));
        });
        
        el.blur(function(){
            setTimeout(function(){
                if(!applyBtn.is(':focus')) {
                    showBtn(false);
                }
            },150);
        });  
        
        applyBtn.click(function(){
            //TODO save it
            // Костыль для NUMBER TYPE
            if(el.val() === '' && el.is('input[type=number]')){
                el.val(el.attr('value'));
                //showBtn(false);
                //return;
            }
            else{
                el.attr('value', el.val());
            }
            
            
            showBtn(false);
        });
        
        applyBtn.blur(function(){
            showBtn(false);
        });        
        
        el.keyup(function(e) {
            //alert("up");
            var code = (e.keyCode ? e.keyCode : e.which);
            //if (code==13) {
                e.preventDefault();
            //}

            if (code == 32 || code == 13 || code == 188 || code == 186) {
                applyBtn.focus();
                applyBtn.click();
            }
            else{
                showBtn(el.val() != el.attr('value'));
            }
        });        

//        var cancelBtn = $('<button/>', {
//            title: 'Отменить',
//            class: 'btn btn-default' + cancelBtnClass,
//            type: 'button',
//            disabled: disabledBtn
//        }).appendTo(span);
//
//        var cancelBtnIcon = $('<span/>', {
//            class: o.cancelBtnIcon
//        }).appendTo(cancelBtn);

//        var disableButtons = function(disabled) {
//            applyBtn.attr('disabled', disabled);
//            cancelBtn.attr('disabled', disabled);
//            
//            span.css('display', disabled ? 'none' : '');
//            //cancelBtn.css('display', disabled ? 'none' : '');
//
//            o.setInputColor(el, disabled);
//        };
//
//        // Если текст не совпадает с исходним - дизеблим кнопки
//        el.keypress(function() {
//            setTimeout(function() {
//                disableButtons(el.val() === el.attr('value'));
//            }, 100);
//        });
//
//        el.change(function() {
//            setTimeout(function() {
//                disableButtons(el.val() === el.attr('value'));
//            }, 100);
//        });
//
//        // При нажатии Cancel восстанавливаем все в исходное положение
//        cancelBtn.click(function() {
//            el.val(el.attr('value'));
//            disableButtons(true);
//        });
//
//        // При нажатии Apply вызываем функцию из options
//        applyBtn.click(function() {
//            // Костыль для NUMBER TYPE
//            if(el.val() === '' && el.is('input[type=number]')){
//                el.val(el.attr('value'));
//                disableButtons(true);
//                return;
//            }
//
//            el.attr('value', el.val());
//
//            o.applyChanges(el);
//
//            disableButtons(true);
//        });          
    };

    // Простой декоратор конструктора,
    // предотвращающий дублирование плагинов
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                new InputEditor2( this, options ));
            }
        });
    };
})( jQuery, window, document );