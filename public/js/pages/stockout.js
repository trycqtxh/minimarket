/**
 * Created by Faisal Abdul Hamid on 01/10/2016.
 */
Inputmask.extendAliases({
    'numeric': {
        allowPlus: false,
        allowMinus: false
    }
});
var table = $("#table").DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "ajax": {
        "url" : "/stock/out/data",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "tanggal"},
        {"data": "kode"},
        {"data": "nama"},
        {"data": "detail"},
        {"data": "stok"},
    ]
});
var form = "" +
    "<form class='form-horizontal'>"+
    "<div class='modal-body'>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Kode / Barcode</label>"+
    "<div class='col-sm-9'>"+
    "<div class='input-group'>"+
    "<input class='form-control' name='kode' type='text'>"+
    "<span class='input-group-btn'>"+
    "<button type='button' class='btn btn-info btn-flat' id='cari-item'><i class='fa fa-search'></i></button>"+
    "</span>"+
    "</div>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Detail Item</label>"+
    "<div class='col-sm-9'>"+
    "<select class='selectpicker form-control' data-live-search='true' name='detailitem'>"+
    "</select>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Jumlah Stok</label>"+
    "<div class='col-sm-9'>"+
    "<input type='text' class='form-control' name='stok'>"+
    "</div>"+
    "</div>"+
    "</div>"+
    "<div class='modal-footer'>"+
    "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>"+
    "<button type='button' class='btn btn-default' id='btnSimpan'>Simpan</button>"+
    "</div>"+
    "</form>";

var infoitemtable =  $('#info-item').DataTable({
    "processing"    : true,
    "deferRender"   : true,
    "paging"        : true,
    "lengthChange"  : false,
    "searching"     : true,
    "ordering"      : false,
    "info"          : true,
    "autoWidth"     : true,
    "ajax": {
        "url" : "/product/product-pilih",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "kode"},
        {"data": "nama"},
        {"data": "harga"},
        {"data": "stok"},
        {"data": "pilih"}
    ]
});

var opt_detailitem = {
    ajax   : {
        url      : "/stock/out/select-detailitem",
        type     : "POST",
        dataType : "json",
        dataSrc  : "data",
        data     : {
            '_token' : $("input[name='_token']").val(),
            q        : "{{{q}}}"
        }
    },
    locale : {
        emptyTitle : 'Select and Begin Typing'
    },
    log: 3,
    preprocessData: function (data) {
        var i, l = data.length, array = [];
        if (l) {
            for(i = 0; i < l; i++){
                array.push($.extend(true, data[i], {
                    text: data[i].nama,
                    value: data[i].id,
                    data: {
                        subtext: data[i].keterangan
                    }
                }));
            }
        }
        return array;
    }
}

function _caribarang(){
    if(!$('input[name=kode]').val()){//empty
        caribarang();
    }else{//not empty
        carikode();
        //console.log('NOT EMPTY');
    }
}

function cari(){
    $('#modalCariItem').modal({keyboard: false, backdrop: 'static'});
}

function pilih(kode, nama, harga, stok){
    $("#modalCariItem").modal('hide');
    $('input[name=kode]').val(kode);
    carikode();
}

function carikode(){
    $.ajax({
        type: 'post',
        url : "/product/cari-item",
        dataType: 'json',
        cache: false,
        data: {
            '_token'    : $('input[name=_token]').val(),
            'kode'      : $('input[name=kode]').val()
        }
    })
}

$(function(){
    $("#btn-tambah").on("click", function(e){
        e.preventDefault();
        console.log('BZTN TAMBAH CLIDK');
        $('div#tambah-modal-query').prepend(modal);

        $('.modal-title').text("Tambah Stok Masuk");
        $('#modal .modal-content').append(form);

        $('input[name=stok]').inputmask({ alias : "numeric" });

        $('select[name=detailitem].selectpicker').selectpicker().ajaxSelectPicker(opt_detailitem);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $('input[name=kode]').on('keyup', function(e){
            e.preventDefault();
            cari();
        });

        $("button#cari-item").click(function(e){
            e.preventDefault();
            cari();
        });


        $("#modal").on('hidden.bs.modal', function(e){
            $('.modal').remove();
        });
    });
});
