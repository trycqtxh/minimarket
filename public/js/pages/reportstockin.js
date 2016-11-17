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
        "url" : "/report/stockin/data-report",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "tanggal"},
        {"data": "kode"},
        {"data": "nama"},
        {"data": "detail"},
        {"data": "stok"},
        {"data": "supplier"},
    ]
});

$(function(){
    //var date = moment().format()
    $('input[name=tanggal]').daterangepicker({
        "autoUpdateInput" : false,
        "startDate"       : moment().subtract(1, 'month'),
        "endDate"         : moment(),
        "maxDate"         : moment(),
        locale: {
            format: 'YYYY/MM/DD',
            cancelLabel: 'Clear'
        }
    });

    $('input[name="tanggal"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="tanggal"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $("#btn-search").on("click", function(e){
        e.preventDefault();
        console.log($('input[name=tanggal]').val());
    });
});