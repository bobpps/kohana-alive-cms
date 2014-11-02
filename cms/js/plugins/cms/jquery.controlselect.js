// See http://habrahabr.ru/post/158235/
// See http://habrahabr.ru/post/166109/


/*!
 * Применяется для добавления кнопки "Настройки" к тэгу "select".
 * Данный тег должен содержать аттрибут "data-editable-controls",
 * в котором перечислены ключи элементов списка, для которых кнопка
 * должна быть активна.
 * 
 * Пример: Form::select('list', $list_controls, '', 
        array('class' => 'form-control input-sm controls', 'data-editable-items' => '["Textbox", "Other"]'))
 * 
 * паттерн простого плагина jQuery  See http://habrahabr.ru/sandbox/39442/
 */

;(function ( $, window, document, undefined ) {
    // определяем необходимые параметры по умолчанию
    var pluginName = 'controlselect',
        // TODO: Add description of params
        defaults = {
            btnClass: '',
            btnIcon: 'glyphicon glyphicon-cog'
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
       
        var me = this,
            el = $(me.element),
            o = me.options,
            editableItems = el.data('editableItems');
        
        if(editableItems && editableItems.length){

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
                disabled: $.inArray(el.val(), editableItems) === -1 //Дизеблим, если элемента нет в списке редактируемых
            }).appendTo(span);
            
            btn.click(function(){
                if(typeof o.clickButton == 'function'){
                    o.clickButton.call(me, el.val());
                }                  
            });

            var btnIcon = $('<span/>', {
                class: o.btnIcon
            }).appendTo(btn);

            el.change(function(){
                btn.attr('disabled', $.inArray(el.val(), editableItems) === -1)
            });
        }
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
