/**
 * 
 * @param {string} action       - Имя экшена в контролере Ajax
 * @param {json} data           - Параметры запроса
 * @param {func} handler        - Callback функции 
 * @param {func} options        - Пользовательские параметры, передаваемые в callback функции
 * @returns {undefined}
 */
var ajax = function(action, data, handler, options) {
    $.ajax({
        url: '/' + cmsUrlPrefix + '/ajax/' + action + '/',
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function(data) {
            if (!data.success) {
                ajaxErrorHandler(data.errormessage);
                return;
            }

            if (handler.success)
                handler.success(data, options);
        },
        beforeSend: function(jqXHR) {
            if (handler.beforeSend)
                handler.beforeSend(jqXHR, options);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (handler.error) {
                handler.error(jqXHR, textStatus, errorThrown, options);
                return;
            }

            ajaxErrorHandler('Ошибка!!!');
        },
        complete: function(jqXHR, textStatus) {
            if (handler.complete)
                handler.complete(jqXHR, textStatus, options);
        }
    });

    /**
     * @param {string} message      - сообщение об ошибке
     */
    var ajaxErrorHandler = function(message) {
        alert(message);
    };
};