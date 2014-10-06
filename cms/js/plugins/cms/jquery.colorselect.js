// See http://habrahabr.ru/post/158235/
// See http://habrahabr.ru/post/166109/


/*!
 * паттерн простого плагина jQuery See http://habrahabr.ru/sandbox/39442/
 */

;(function ( $, window, document, undefined ) {
    // определяем необходимые параметры по умолчанию
    var pluginName = 'colorselect',
        defaults = { };

    // конструктор плагина
    function ColorSelect( element, options ) {
        this.element = element;
        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    ColorSelect.prototype.init = function () {
        // Тут пишем код самого плагина
        var el = $(this.element);

        el.css('color', el.val().toLowerCase());
        
        el.find('option').css('color', function(){
            return $(this).text().toLowerCase();
        });
        
        el.change(function(){
            $(this).css('color', $(this).val().toLowerCase());
        });
    };

    // Простой декоратор конструктора,
    // предотвращающий дублирование плагинов
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                new ColorSelect( this, options ));
            }
        });
    }

})( jQuery, window, document );
