var toastrPersonalized = function () {
    return {
        toastr: function (title, message, type, timeout) {
            timeout = (timeout) ? timeout : '5000';

            var options = {
                'closeButton':       true,
                'debug':             false,
                'positionClass':     'toast-top-right',
                'onclick':           false,
                'showDuration':      '300',
                'hideDuration':      '300',
                'timeOut':           timeout,
                'extendedTimeOut':   '5000',
                'showEasing':        'swing',
                'hideEasing':        'linear',
                'showMethod':        'show',
                'hideMethod':        'hide',
                "progressBar":       true,
                'preventDuplicates': true
            };
            if (type === 'success') {
                toastr.success(message, title, options);
            }

            if (type === 'error') {
                toastr.error(message, title, options);
            }

            if (type === 'warning') {
                toastr.warning(message, title, options);
            }
            if (type === 'info') {
                toastr.info(message, title, options);
            }

        }
    }
}();