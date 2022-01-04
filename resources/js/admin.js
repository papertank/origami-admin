window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    window.csrfToken = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

(function() {

    $(function(){

        $('[data-toggle="sidebar"]').on('click', function () {
            $('#sidebar').toggleClass('open');
            $('.sidebar-backdrop').toggleClass('show');
        });

        $('.sidebar-backdrop').on('click', function() {
            $('#sidebar').toggleClass('open');
            $('.sidebar-backdrop').toggleClass('show');
        });

        $('a[data-method]').on('click', function(e) {
            e.preventDefault();
            var link = $(this);
            var csrf = $('<input>', {
                'name': '_token',
                'value': window.csrfToken,
                'type': 'hidden'
            })
            var form = $('<form>', {
                'action': link.attr('href'),
                'method': link.data('method'),
                'target': '_top'
            }).append(csrf);
            form.appendTo(document.body).submit();
        });

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

        $('table').on('click', 'tr[data-href] td, tr[data-href] th', function()
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
            if ( confirm('Are you sure you want to '+title+'?') ) {
                form[0].submit();
            }

            return false;
        });

        $('input[data-confirm-delete], button[data-confirm-delete]').on('click', function(e) {
            var button = $(this);
            var form = button.closest('form');

            var title = button.data('confirmDelete');

            e.preventDefault();
            if ( confirm('Are you sure you want to delete '+title+'?') ) {
                form[0].submit();
            }

            return false;
        });

    });

})();

