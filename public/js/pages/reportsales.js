/**
 * Created by Faisal Abdul Hamid on 08/10/2016.
 */

var table = $("#table").DataTable({
    "processing": true,
    //"serverSide": true,
    "paging": true,
    "deferRender": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "pageLength": 30,
    "ajax": {
        "url"    : "/report/sales/data-report",
        "dataSrc": "data",
        "type"   : "POST",
        "data": function (row, type, val, meta ) {
            row._token = $('input[name=_token]').val();
        }
    },
    "columns" : [
        {
            "class":          "details-control",
            "orderable":      false,
            "data":           null,
            "defaultContent": "<button class='btn btn-info btn-xs'><i class='fa fa-plus-circle'></i></button>"
        },
        {"data": "kode", "name" : "kode"},
        {"data": "tanggal", "name" : "tanggal"},
        {"data": "sub_harga", "name" : "sub_harga"},
        {"data": "pelanggan", "name" : "pelanggan"},
        {"data": "kasir", "name" : "kasir"},
        {"data": "actions"},
    ],
    buttons: [
        'copy', 'excel', 'pdf'
    ]

});

function onClickButton(){
    console.log($('input[name=tanggal]').val());
    table.destroy();
    $('#table').empty();
    table = $('#table').DataTable({
        "processing": true,
        //"serverSide": true,
        "paging": true,
        "deferRender": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "pageLength": 30,
        "ajax": {
            "url"    : "/report/sales/data-report",
            "dataSrc": "data",
            "type"   : "POST",
            "data": function (row, type, val, meta ) {
                row._token = $('input[name=_token]').val();
                row.tanggal = $('input[name=tanggal]').val();
            }
        },
        "columns" : [
            {
                "class":          "details-control",
                "orderable":      false,
                "data":           null,
                "defaultContent": "<button class='btn btn-info btn-xs'><i class='fa fa-plus-circle'></i></button>"
            },
            {"data": "kode", "name" : "kode"},
            {"data": "tanggal", "name" : "tanggal"},
            {"data": "sub_harga", "name" : "sub_harga"},
            {"data": "pelanggan", "name" : "pelanggan"},
            {"data": "kasir", "name" : "kasir"},
            {"data": "actions"},
        ],
        buttons: [
            {
                extend: 'pdf',
                text: 'Save current page',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                }
            }
        ]
    });
    $('table#table tbody tr  td.details-control').css('padding', '0px');
    var detailRows = [];
    $('#table tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );

        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            tr.find('button').removeClass('btn-danger');
            tr.find('button').addClass('btn-info');
            tr.find('i').removeClass('fa-minus-circle');
            tr.find('i').addClass('fa-plus-circle');
            row.child.hide();

            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );

            tr.find('button').removeClass('btn-info');
            tr.find('button').addClass('btn-danger');
            tr.find('i').removeClass('fa-plus-circle');
            tr.find('i').addClass('fa-minus-circle');

            row.child( format( row.data() ) ).show();

            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
            $(this).parent('tr').next('tr').children('td').css('padding', '0px');
        }
    });

    table.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );
}
function format(d){
    var items = '';
    $.each(d.items.data, function(key, val){
        //items.push("<tr><td>"+val.nama_item+"</td><td>"+val.harga_item+"</td><td>"+val.qty_item+"</td></tr>");
        items += "<tr><td>"+val.nama_item+"</td><td>"+val.harga_item+"</td><td>"+val.qty_item+"</td></tr>";
    });
    ///console.log(items);
    return '<table class="table table-hover" style="margin: 0px">' +
        '<thead><tr><th>Nama Item</th><th>Harga</th><th>QTY</th></tr></thead>' +
        '<tbody>' +
            items +
        '</tbody>' +
        '</table>';
}

$(function(){
    new $.fn.dataTable.Buttons( table, {
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    } );

    $('table#table tbody tr  td.details-control').css('padding', '0px');
    var detailRows = [];
    $('#table tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );

        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            tr.find('button').removeClass('btn-danger');
            tr.find('button').addClass('btn-info');
            tr.find('i').removeClass('fa-minus-circle');
            tr.find('i').addClass('fa-plus-circle');
            row.child.hide();

            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );

            tr.find('button').removeClass('btn-info');
            tr.find('button').addClass('btn-danger');
            tr.find('i').removeClass('fa-plus-circle');
            tr.find('i').addClass('fa-minus-circle');

            row.child( format( row.data() ) ).show();

            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
            $(this).parent('tr').next('tr').children('td').css('padding', '0px');
        }
    });

    table.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );

    //var date = moment().format()
    $('input[name=tanggal]').daterangepicker({
        "autoUpdateInput" : false,
        "startDate"       : moment().subtract(1, 'month'),
        "endDate"         : moment(),
        "maxDate"         : moment(),
        locale: {
            format: 'YYYY-MM-DD',
            cancelLabel: 'Clear'
        }
    });

    $('input[name="tanggal"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + '#' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('input[name="tanggal"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $("#btn-search").on("click", function(e){
        //e.preventDefault();
        onClickButton();
    });
});

