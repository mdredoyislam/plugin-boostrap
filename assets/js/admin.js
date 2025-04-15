;(function($) {

    $('table.wp-list-table.contacts').on('click', 'a.submitdelete', function(e) {
        e.preventDefault();

        if (!confirm(PixotenAddons.confirm)) {
            return;
        }

        var self = $(this),
            id = self.data('id');

        // wp.ajax.send('pa-pixoten-delete-contact', {
        //     data: {
        //         id: id,
        //         _wpnonce: PixotenAddons.nonce
        //     }
        // })
        wp.ajax.post('pa-pixoten-delete-contact', {
            id: id,
            _wpnonce: PixotenAddons.nonce
        })
        .done(function(response) {

            self.closest('tr')
                .css('background-color', 'red')
                .hide(400, function() {
                    $(this).remove();
                });

        })
        .fail(function() {
            alert(PixotenAddons.error);
        });
    });

})(jQuery);