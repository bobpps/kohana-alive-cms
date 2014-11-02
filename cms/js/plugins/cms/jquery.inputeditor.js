// See http://habrahabr.ru/post/158235/
// See http://habrahabr.ru/post/166109/
// See http://habrahabr.ru/sandbox/39442/

/*!
 * паттерн простого плагина jQuery  See http://habrahabr.ru/sandbox/39442/
 */

;(function ( $, window, document, undefined ) {

    // определяем необходимые параметры по умолчанию
    var pluginName = 'inputeditor',
    
        /*
         *  applyBtnClass   {string}    Дополнительные классы для кнопки "Применить"
         *  cancelBtnClass  {string}    Дополнительные классы для кнопки "Отменить"  
         *  applyBtnIcon    {string}    Классы для иконки к кнопке "Применить"
         *  cancelBtnIcon   {string}    Классы для иконки к кнопке "Отменить"
         *  editingColor    {string}    Цвет редактируемого поля
         */
        defaults = {
            applyBtnClass: '',
            cancelBtnClass: '',
            applyBtnIcon: 'glyphicon glyphicon-ok-sign',
            cancelBtnIcon: 'glyphicon glyphicon-remove-sign',
            editingColor: 'black'
        };

    // конструктор плагина
    function InputEditor( element, options ) {
        this.element = element;

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    InputEditor.prototype.init = function () {
        // Тут пишем код самого плагина
        var me = this;
        
        var el = $(me.element);
        var o = me.options;

        var disabledBtn = el.val() === el.attr('value');

        var applyBtnClass = o.applyBtnClass === ''
                ? '' : ' ' + o.applyBtnClass;
        var cancelBtnClass = o.cancelBtnClass === ''
                ? '' : ' ' + o.cancelBtnClass;            

        // Создаем дополнительную разметку
        el.wrap($('<div/>', {
            class: 'input-group'
        }));

        el.css('color', disabledBtn ? '' : o.editingColor);

        var span = $('<span/>', {
            class: "input-group-btn"
        }).insertAfter(el);

        var applyBtn = $('<button/>', {
            title: 'Применить',
            class: 'btn btn-default' + applyBtnClass,
            type: 'button',
            disabled: disabledBtn
        }).appendTo(span);

        var applyBtnIcon = $('<span/>', {
            class: o.applyBtnIcon
        }).appendTo(applyBtn);

        var cancelBtn = $('<button/>', {
            title: 'Отменить',
            class: 'btn btn-default' + cancelBtnClass,
            type: 'button',
            disabled: disabledBtn
        }).appendTo(span);

        var cancelBtnIcon = $('<span/>', {
            class: o.cancelBtnIcon
        }).appendTo(cancelBtn);

        var disableButtons = function(disabled) {
            applyBtn.attr('disabled', disabled);
            cancelBtn.attr('disabled', disabled);

            el.css('color', disabledBtn ? '' : o.editingColor);
        };

        // Если текст не совпадает с исходним - дизеблим кнопки
        el.keypress(function() {
            setTimeout(function() {
                disableButtons(el.val() === el.attr('value'));
            }, 100);
        });

        el.change(function() {
            setTimeout(function() {
                disableButtons(el.val() === el.attr('value'));
            }, 100);
        });

        // При нажатии Cancel восстанавливаем все в исходное положение
        cancelBtn.click(function() {
            el.val(el.attr('value'));
            disableButtons(true);
        });

        // При нажатии Apply вызываем функцию из options
        applyBtn.click(function() {
            // Костыль для NUMBER TYPE
            if(el.val() === '' && el.is('input[type=number]')){
                el.val(el.attr('value'));
                disableButtons(true);
                return;
            }

            el.attr('value', el.val());

            if(typeof o.applyChanges == 'function'){
                o.applyChanges.call(me, el);
            }            

            disableButtons(true);
        });          
    };

    // Простой декоратор конструктора,
    // предотвращающий дублирование плагинов
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                new InputEditor( this, options ));
            }
        });
    };
})( jQuery, window, document );
