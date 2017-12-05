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
        $( '.select2' ).select2();

        // Data table.
        var oTable = $( '#attendees_table' ).dataTable({
            'processing' : true,
            'bJQueryUI' : true,
            'bProcessing' : true,
            'sPaginationType' : 'full_numbers',
            'bServerSide' : true,
            'bDeferRender': true,
            'sAjaxSource' : baseUrl + '/admin/get-report-data',
            'fnServerData': function ( sSource, aoData, fnCallback ) {
                // Set custom filter data.
                aoData.push(
                    { "name" : "name", "value" : $( '#name' ).val() },
                    { "name" : "church", "value" : $( '#church' ).val() },
                    { "name" : "gender", "value" : $( '#gender' ).val() },
                    { "name" : "age_from", "value" : $( '#age_from' ).val() },
                    { "name" : "age_to", "value" : $( '#age_to' ).val() },
                    { "name" : "day", "value" : $( '#day' ).val() },
                    { "name" : "time", "value" : $( '#time' ).val() }
                );

                $.ajax( {
                    'dataType' : 'json',
                    'type' : 'POST',
                    'url' : sSource,
                    'data' : aoData,
                    'success' :fnCallback
                });
            },
            columns: [
                { data: "id", "name": "registration.id" },
                { data: "name", "name": "registration.name" },
                { data: "church", "name": "registration.church" },
                { data: "age", "name": "registration.age" },
                { data: "gender", "name": "registration.gender" },
                { data: "accommodation", "name": "registration.accommodation" }
            ],
            "columnDefs": [{
                'orderable': false,
                'targets': [1,2,4,5]
            }],
        });

        // Refresh attendee list on filter.
        $( '.attendee-filter' ).on( 'change', function () {
            oTable.fnReloadAjax();
        });
    });
});
