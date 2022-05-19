$(document).ready(function() {
    
    "use strict";
    $('#zero-conf').DataTable();
    $('#zero-conf2').DataTable();
    $("#zero-conf3").DataTable();
    $("#zero-conf4").DataTable();
    $("#zero-conf5").DataTable();
    $("#zero-conf6").DataTable();
    $("#zero-conf7").DataTable();
    $("#zero-conf8").DataTable();
    $("#zero-conf9").DataTable();
    $("#zero-conf10").DataTable();
    $("#zero-conf11").DataTable();
    $("#zero-conf12").DataTable();
    $("#zero-conf13").DataTable();
    $("#zero-conf14").DataTable();
    $("#zero-conf15").DataTable();
    $("#zero-conf16").DataTable();
    $("#zero-conf17").DataTable();
    $("#zero-conf18").DataTable();
    $("#zero-conf19").DataTable();
    $("#zero-conf20").DataTable();

    $('#complex-header').DataTable();

    var groupColumn = 2;
    var table = $('#row-grouping').DataTable({
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "order": [[ groupColumn, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
    $('#row-grouping tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
            table.order( [ groupColumn, 'desc' ] ).draw();
        }
        else {
            table.order( [ groupColumn, 'asc' ] ).draw();
        }
    } );
    
    var t = $('#add-row').DataTable();
    var counter = 1;
 
    $('#addRow').on( 'click', function (e) {
        t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3',
            counter +'.4',
            counter +'.5'
        ] ).draw( false );
        counter++;
        e.preventDefault();
    } );
 
    // Automatically add a first row of data
    $('#addRow').click();
});