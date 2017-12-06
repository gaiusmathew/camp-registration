/**
 * Attendees list page
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
    $( function () {

        // Base url.
        var baseUrl = $( '#base_url' ).val();

        // Initialize select2.
        $( '.select2' ).select2({
            width: '100%'
        });

        // Data table.
        var oTable = $( '#attendees_table' ).dataTable({
            //'dom': 'Blrtip',
            //'buttons': ['print'],
            'processing': true,
            'serverSide': true,
            'searching': false,
            'ajax': {
                'url': baseUrl + '/admin/get-report-data',
                'type': 'POST',
                'data' : function ( data ) {
                    data.at_name = $( '#name' ).val();
                    data.at_church = $( '#church' ).val();
                    data.at_gender = $( '#gender' ).val();
                    data.at_age_from = $( '#age_from' ).val();
                    data.at_age_to = $( '#age_to' ).val();
                    data.at_day = $( '#day' ).val();
                    data.at_time = $( '#time' ).val();
                }
            },
            "columnDefs": [{
                'orderable': false,
                'targets': [1,4,5]
            }],
        });

        // Refresh attendee list on filter.
        $( '.attendee-filter' ).on( 'change', function () {
            oTable.fnReloadAjax();
        });
    });
});
