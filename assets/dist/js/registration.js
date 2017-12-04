/**
 * Registration form page
 */
$( function ( $ ) {
    'use strict';

    /**
     * All of the code for our registration JavaScript source
     * should reside in this file.
     *
     * Note that this assume you're going to use jQuery, so it prepares
     * the $ function reference to be used within the scope of this
     * function.
     *
     * From here, we are able to define handlers for when the DOM is
     * ready:
     *
     * $(function() {
     *
     * });
     *
     * Or when the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and so on.
     */
    $(function () {

        // Initialize iCheck.
        $( 'input' ).iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue',
        });

        // On day check.
        $( '.day' ).on( 'ifToggled', function() {
            // Id of the checked date.
            var id = $( this ).attr( 'id' ),
                // class if children timings.
                children = $( '.' + id + '' );

            // If date was checked, then auto check timings.
            if ( $( this ).prop( 'checked' ) ) {
                children.iCheck( 'enable' );
                children.iCheck( 'check' );
            } else {
                children.iCheck( 'uncheck' );
                children.iCheck( 'disable' );
            }
        });

        // Shortcut to select all dates and timing.
        $( '#all_days' ).on( 'ifChecked', function() {
            $( '.day' ).iCheck( 'check' );
        });
    });
});
