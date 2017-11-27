/**
 * Registration form page
 */
$(function ($) {
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

        $( ".day" ).change( function() {
            if ( this.checked ) {
                $( '.' + this.attr( 'id' ) + '_children' ).toggle();
            }
        });
    });

})(jQuery);
