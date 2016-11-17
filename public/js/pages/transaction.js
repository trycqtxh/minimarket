/**
 * Created by Faisal Abdul Hamid on 02/10/2016.
 */
var kode_transaksi = $("input[name=kode_transaksi]");
var tanggal_transaksi = $("input[name=tanggal_transaksi]");

var kode = $("input[name=kode]");
var nama_item = $("input[name=nama_item]");
var harga_item = $("input[name=harga_item]");
var qty_item = $("input[name=qty_item]");
var total_harga_item = $("input[name=total_harga_item]");
var v_token = $("input[name=_token]");

var tagihan = $("input[name=tagihan]");
var bayar = $("input[name=bayar]");
var kembalian = $("input[name=kembalian]");

var modalCariItem = $('#modalCariItem');
var modalStokKosong = $('#modal-stok-kosong');
var modalkodeKosong = $('#modal-kode-kosong');

Inputmask.extendAliases({
    'kode': {
        regex: "^[a-zA-Z0-9]+$"
    }
});
Inputmask.extendAliases({
    rupiah: {
        groupSeparator: ".",
        alias: "numeric",
        placeholder: "0",
        autoGroup: !0,
        digits: 2,
        digitsOptional: !1,
        clearMaskOnLostFocus: !1
    }
});

function nota_tgl(){
    $.getJSON('/transaction/nota-tgl', function(response){
        kode_transaksi.val(response.kode);
        tanggal_transaksi.val(response.tgl);
    });
}

var callbackDataTable = function(setting, json){
    $.getJSON('/transaction/totalbayar', function(data){
        $("#tagihan").text("Rp."+data);
        tagihan.val(data);
    });
};

var infoitemtable =  $('#info-item').DataTable({
    processing: true,
    "deferRender": true,
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": true,
    "pageLength": 10,
    "ajax": {
        "url" : "/product/product-pilih",
        "dataSrc" : "data",
    },
    "columns" : [
        {"data": "kode"},
        {"data": "nama"},
        {"data": "harga"},
        {"data": "stok"},
        {"data": "pilih"}
    ]
});

var carttable = $('#table-cart').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "ajax": {
        "url" : "/transaction/data-cart",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "kode"},
        {"data": "nama"},
        {"data": "qty"},
        {"data": "harga"},
        {"data": "subharga"},
        {"data": "action"}
    ],
    "initComplete": callbackDataTable
});

//button cari
function _caribarang(){
    if(!kode.val()){//empty
        caribarang();
    }else{//not empty
        carikode();
        //console.log('NOT EMPTY');
    }
}

function caribarang(){
    modalCariItem.modal({keyboard: false, backdrop: 'static'});
}

function pilih(kode_item, nama, harga, stok){
    if(!parseInt(stok)){
        var notif = {
            type: "error",
            title: "Stok Barang Kosong",
            text: ""
        }
        show_stack_context('error', true, notif);
    }else{
        kode.val(kode_item);
        modalCariItem.modal('hide');
    }
}

function carikode(){
    $.ajax({
        type: 'post',
        url : "/transaction/cari-id",
        dataType: 'json',
        cache: false,
        data: {
            '_token'    : v_token.val(),
            'kode'      : kode.val()
        },
        success: function(request) {
            var notif = {
                type  : 'success',
                title : '',
                text  : "Kode : "+request.data.kode+" Nama : "+request.data.nama+" Harga : "+request.data.harga
            }
            nama_item.val(request.data.nama);
            harga_item.val(request.data.harga);
            total_harga_item.val(parseInt(request.data.harga) * parseInt(qty_item.val()));
            show_notif(notif);
            $('#btnaddcart').prop("disabled", false);
        },
        error: function(request){
            if(typeof request.status == 422){
                show_notif(request);
            }
            var errors = request.responseJSON;
            validate(errors);
        }
    })
}

function plusqty(){
    var qty = qty_item.val();
    var qty_ =  parseInt(qty)+1;
    qty_item.val(qty_);
    total_harga();
}

function minusqty(){
    var qty = qty_item.val();
    var qty_ =  parseInt(qty)-1;
    if(qty_ < 1) qty_ = 1;
    qty_item.val(qty_);
    total_harga();
}

function addcart(){
    harga_item.inputmask("remove");
    total_harga_item.inputmask("remove");
    $.ajax({
        type: 'post',
        url : "/transaction/add-cart",
        dataType: 'json',
        cache: false,
        data: {
            '_token'    : v_token.val(),
            'kode'      : kode.val(),
            'nama'      : nama_item.val(),
            'harga'     : harga_item.val(),
            'qty'       : qty_item.val(),
            'total'     : total_harga_item.val()
        },
        success: function(request) {
            show_notif(request);
            carttable.ajax.reload(callbackDataTable);
            harga_item.inputmask({alias: "rupiah"});
            total_harga_item.inputmask({alias: "rupiah"});
            resetform();
        },
        error: function(request){
            if(typeof request.status == 422){
                show_notif(request);
            }
            var errors = request.responseJSON;
            validate(errors);
            harga_item.inputmask({alias: "rupiah"});
            total_harga_item.inputmask({alias: "rupiah"});
        }
    });
}

function resetcart(){
    $.ajax({
        type: 'post',
        url : "/transaction/delete-cart",
        dataType: 'json',
        cache: false,
        data: {
            '_token'    : v_token.val(),
        },
        success: function(request) {
            show_notif(request);
            $("input[name=tagihan]").val(0);
            $("[name=bayar]").val(0);
            $("[name=kembalian]").val(0);
            carttable.ajax.reload(callbackDataTable);
        },
        error: function(request){
            show_notif(request);
        }
    });
    resetform();
}

function removeitem(rowId, nama){
    $.ajax({
        type: 'post',
        url : "/transaction/remove-item",
        dataType: 'json',
        cache: false,
        data: {
            '_token'    : v_token.val(),
            'rowId'     : rowId,
            'nama'     : nama,
        },
        success: function(request) {
            show_notif(request);
            carttable.ajax.reload(callbackDataTable);
        },
        error: function(){
            show_notif(request);
        }
    });
}

function resetform(){
    $("input[type][name!=_token][name!=qty_produk][name!=tanggal_transaksi][name!=kode_transaksi][name!=tagihan][name!=bayar][name!=kembalian]").val("");
    qty_item.val(1);
    $("#btnaddcart").attr('disabled', 'disabled');

}

$(function(){
    //inisialisasi
    nota_tgl();
    kode.focus();
    qty_item.val(1);
    qty_item.inputmask({ alias : "numeric" });
    harga_item.inputmask({ alias : "rupiah" });
    total_harga_item.inputmask({ alias : "rupiah" });
    tagihan.inputmask({ alias : "rupiah" });
    bayar.inputmask({ alias : "rupiah" });
    kembalian.inputmask({ alias : "rupiah" });

    //Form-Kode-Item
    kode.on('keydown', function(e) {
        if (e.which == 13) {//kode enter
            e.preventDefault();
            if(!$(this).val()){//empty
                caribarang();
            }else{//not empty
                carikode();
            }
        }
    });//Form-Nama
    nama_item.on('change', function(e) {
        if(this.value.length == 0){
            $("#btnaddcart").attr('disabled');
        }else{
            $('#btnaddcart').prop("disabled", false);
        }
    });
    qty_item.on('keydown', function(e) {
        if(e.which == 107){
            e.preventDefault();
            plusqty();
        }else if(e.which == 109){
            e.preventDefault();
            minusqty();
        }
    });
    kode.on('keyup',function() {
        if(this.value.length == 0){
            nama_item.val("");
            qty_item.val(1);
            harga_item.val(0);
            total_harga_item.val(0);
        }
    });

    bayar.on('keyup',function(e) {
        e.preventDefault();
        var _tagihan = tagihan.val().replace(',', '').replace('.00', '');//parseInt();
        var _bayar = bayar.val().replace(',', '').replace('.00', '');//;parseFloat();
        kembalian.val(parseInt(_bayar) - parseInt(_tagihan));
        //console.log(_bayar);
        if(_bayar > _tagihan){
            $('#info').children('div.box-body').removeClass('bg-yellow');
            $('#info').children('div.box-body').addClass('bg-green');
            $('#tagihan').text("Rp."+kembalian.val());
        }else{
            $('#info').children('div.box-body').removeClass('bg-green');
            $('#info').children('div.box-body').addClass('bg-yellow');
            $('#tagihan').text("Rp."+tagihan.val());
        }
    });

    //info-item
    modalCariItem.on('show.bs.modal', function(){
        //console.log($('#modalCariItem input'));
    });
    modalCariItem.on('hidden.bs.modal', function(){
        kode.focus();
    });

    $("input[name=qty_item]").on('change', function(){
        total_harga();
    });


});

function total_harga(){
    var _qty = parseInt(qty_item.val());
    harga_item.inputmask("remove");
    var _harga = (parseInt(harga_item.val())) ? parseInt(harga_item.val()) : 0 ;
    harga_item.inputmask({alias: "rupiah"});
    total_harga_item.val(_qty*_harga);
}

function bayarTunai(){
    bayar.inputmask('remove');
    kembalian.inputmask('remove');
    $.ajax({
        type: "post",
        url: "transaction/bayar",
        dataType: 'json',
        data: {
            '_token'    : v_token.val(),
            'kode_transaksi' : kode_transaksi.val(),
            'bayar'     : bayar.val(),
            'kembalian' : kembalian.val(),
        },
        success: function(request) {
            show_notif(request);
            nota_tgl();
            carttable.ajax.reload(callbackDataTable);

            $("[name=bayar]").val(0);
            $("[name=kembalian]").val(0);
            bayar.inputmask({alias: 'rupiah'});
            kembalian.inputmask({alias: 'rupiah'});
            $('#info').children('div.box-body').removeClass('bg-green');
            $('#info').children('div.box-body').addClass('bg-yellow');
        },
        error: function(request){
            show_notif(request);
            bayar.inputmask({alias: 'rupiah'});
            kembalian.inputmask({alias: 'rupiah'});
        }
    });
}

function show_stack_context(type, modal, notif) {
    if (typeof stack_context === "undefined") stack_context = {
        "dir1": "down",
        "dir2": "left",
        "context": $("#modalCariItem")
    };
    if (typeof stack_context_modal === "undefined") stack_context_modal = {
        "dir1": "down",
        "dir2": "left",
        "context": $("#modalCariItem"),
        "modal": true,
        "overlay_close": true
    };
    var opts = {
        type: notif.type,
        title: notif.title,
        text: notif.text,
        stack: modal ? stack_context_modal : stack_context,
        addclass: modal ? "stack-modal" : ""
    };
    new PNotify(opts);
}

function validate(errors){
    if (typeof errors !== 'undefined') {
        $.each(errors, function(key, val){
            var opts = {
                type: "error",
                title: "",
                text: val
            };
            show_notif(opts);
        });
    }
}




function bayarRfid(event){
    // $('body').append(modal);
    // $('.modal-title').text("Tambah Kategori");
    // $('.modal-content').append(rfidform);

    // $('#modal').modal({keyboard: false, backdrop: 'static'});
    RFID.Request({
        context : {
            event   : event,
            context : 'rfid',
            title   : "Bayar RFID"
        },
        title   : "Simpan",
        async   : true,
        //url     : '/asd',
        waktu   : 5000,
        berhasil: function (data) {
            console.log(data);
        },
        selalu  : function(event){
            console.log("SELALU ========+++++++++++++++++++++");
            console.log(event);
        }
    });
}