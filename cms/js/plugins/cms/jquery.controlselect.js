// See http://habrahabr.ru/post/158235/
// See http://habrahabr.ru/post/166109/


/*!
 * паттерн простого плагина jQuery  See http://habrahabr.ru/sandbox/39442/
 * автор: @ajpiano
 * дополнения: @addyosmani
 * лицензия MIT
 */

;(function ( $, window, document, undefined ) {
    // определяем необходимые параметры по умолчанию
    var pluginName = 'controlselect',
        defaults = {
            btnClass: '',
            btnIcon: 'glyphicon glyphicon-cog',            
        };

    // конструктор плагина
    function ControlSelect( element, options ) {
        this.element = element;

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    ControlSelect.prototype.init = function () {
        // Тут пишем код самого плагина
       
        var el = $(this.element);
        var o = this.options;

        var btnClass = o.btnClass === ''
                ? '' : ' ' + o.btnClass;

        // Создаем дополнительную разметку
        el.wrap($('<div/>', {
            class: 'input-group'
        }));   
        
        var span = $('<span/>', {
            class: "input-group-btn"
        }).insertBefore(el);  
        
        var btn = $('<button/>', {
            title: 'Настройки',
            class: 'btn btn-default' + btnClass,
            type: 'button',
            disabled: el.val() == 0
        }).appendTo(span);

        var btnIcon = $('<span/>', {
            class: o.btnIcon
        }).appendTo(btn);
        
        el.change(function(){
            btn.attr('disabled', el.val() == 0)
        });
    };

    // Простой декоратор конструктора,
    // предотвращающий дублирование плагинов
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                new ControlSelect( this, options ));
            }
        });
    }

})( jQuery, window, document );
