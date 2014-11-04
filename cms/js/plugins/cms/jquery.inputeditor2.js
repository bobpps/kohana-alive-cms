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
             *  applyBtnIcon    {string}    Классы для иконки к кнопке "Применить"
             *  editingColor    {string}    Цвет редактируемого поля
             */
            defaults = {
                applyBtnClass: '',
                applyBtnIcon: 'glyphicon glyphicon-ok-sign',
                editingColor: 'blue'
            };

    // конструктор плагина
    function InputEditor2(element, options) {
        var me = this;
        
        me.element = element;

        me.options = $.extend({}, defaults, options);

        me._defaults = defaults;
        me._name = pluginName;
        
        me.wrapper = null;
        me.span = null;

        me.init();
    }
    
    InputEditor2.prototype.init = function() {
        // Тут пишем код самого плагина

        var me = this,
            el = $(me.element),
            o = me.options,
            applyBtnClass = o.applyBtnClass === ''
                ? '' 
                : ' ' + o.applyBtnClass;

        // Создаем дополнительную разметку
        el.wrap($('<div/>', {
            class: 'wrapper-inputeditor'
        }));

        var wrapperDiv = el.parents('.wrapper-inputeditor');
        
        var span = $('<span/>', {
            class: "input-group-btn"
        }).insertAfter(el).hide();

        var applyBtn = $('<button/>', {
            title: 'Применить',
            class: 'btn btn-default' + applyBtnClass,
            type: 'button'
        }).appendTo(span);

        $('<span/>', {
            class: o.applyBtnIcon
        }).appendTo(applyBtn);

        el.focus(function() {
            me.showBtn(el.val() != el.attr('value'));
        });

        el.blur(function() {
            setTimeout(function() {
                if (!applyBtn.is(':focus')) {
                    me.showBtn(false);
                }
            }, 150);
        });

        applyBtn.click(function() {
            // Костыль для NUMBER TYPE
            if (el.val() === '' && el.is('input[type=number]')) {
                el.val(el.attr('value'));
            }

            //applyChanges
            if(typeof o.applyChanges == 'function' && el.val() != el.attr('value')){
                o.applyChanges.call(me, el);
                el.attr('value', el.val());
            }

            me.showBtn(false);
        });

        applyBtn.blur(function() {
            me.showBtn(false);
        });

        el.change(function() {
            // Если изменили значение поля NUMBER с помощью стандартных кнопок, отправляем данные на сервер
            if(typeof o.applyChanges == 'function' && el.is('input[type=number]') && el.val() != el.attr('value')){
                //o.applyChanges.call(me, el);
                me.changeNumber(el.val());
            } 
            else{
                me.showBtn(el.val() != el.attr('value'));
            }
        });

        el.keyup(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code == 13) {
                e.preventDefault();
                applyBtn.focus();
                applyBtn.click();                
            }
            else {
                me.showBtn(el.val() != el.attr('value'));
            }
        });
        
        me.wrapper = wrapperDiv;
        me.span = span;        
    };
    
    InputEditor2.prototype.showBtn = function(isChanged) {
        var me = this,
            el = $(me.element),
            o = me.options;
        
        if (isChanged) {
            $(me.wrapper).addClass('input-group');
            me.span.css('display', 'table-cell');
            el.css('color', o.editingColor);
        }
        else {
            me.wrapper.removeClass('input-group');
            me.span.hide();
            el.css('color', '');
            el.val(el.attr('value'));
        }
    };  
    
    InputEditor2.prototype.changeNumber = function(val) {
        var me = this,
            el = $(me.element),
            o = me.options;
    
        setTimeout(function(){
            if(val === el.val()){
                o.applyChanges.call(me, el);
            }            
        }, 500);
    };

    // Простой декоратор конструктора,
    // предотвращающий дублирование плагинов
    $.fn[pluginName] = function(options) {
        return this.each(function() {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                        new InputEditor2(this, options));
            }
        });
    };
})(jQuery, window, document);
