window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
    require('metismenu');
    require('summernote');
    require('bootbox');
} catch (e) {}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

(function() {

    $(function(){

        $('.input-editor').summernote({
            height: 300,
            toolbar: [
                ['fontstyle', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['insert', ['picture', 'link', 'table']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['misc', ['codeview']],
                ['view', ['fullscreen']]
            ]
        });

        $('table').on('click', 'tr[data-href] td', function()
        {
            if ( ! $(this).hasClass('links') ) {
                var url = $(this).closest('tr').data('href');
                window.location.href = url;
            }
        });

        $('form.sort select').change(function()
        {
            var select = $(this);
            var form = select.closest('form');

            form[0].submit();
        });

        $('[data-submit]').on('click', function(e) {
            var button = $(this);
            var form = button.closest('form');

            var label = button.data('submit') || 'Saving';

            button.addClass('disabled').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> ' + label);

            form[0].submit();
        });

        $('input[data-confirm-action], button[data-confirm-action]').on('click', function(e) {
            var button = $(this);
            var form = button.closest('form');

            var title = button.data('confirmAction');

            e.preventDefault();
            bootbox.confirm('Are you sure you want to '+title+'?', function(result){
                if ( result ) {
                    form.submit();
                }
            });

            return false;
        });

        $('input[data-confirm-delete], button[data-confirm-delete]').on('click', function(e) {
            var button = $(this);
            var form = button.closest('form');

            var title = button.data('confirmDelete');

            e.preventDefault();
            bootbox.confirm('Are you sure you want to delete '+title+'?', function(result){
                if ( result ) {
                    form.submit();
                }
            });

            return false;
        });

        $('#side-menu').metisMenu();

        $(window).bind("load resize", function() {
            topOffset = 50;
            width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
            if (width < 768) {
                $('div.navbar-collapse').addClass('collapse');
                topOffset = 100; // 2-row-menu
            } else {
                $('div.navbar-collapse').removeClass('collapse');
            }

            height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
            height = height - topOffset;
            if (height < 1) height = 1;
            if (height > topOffset) {
                $("#page-wrapper").css("min-height", (height) + "px");
            }
        });

        var url = window.location;
        var element = $('ul.nav a').filter(function() {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }).addClass('active').parent().parent().addClass('in').parent();
        if (element.is('li')) {
            element.addClass('active');
        }

    });

})();

