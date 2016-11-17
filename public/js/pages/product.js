/**
 * Created by Faisal Abdul Hamid on 01/10/2016.
 */
Inputmask.extendAliases({
    'kode': {
        regex: "^[a-zA-Z0-9]+$"
    }
});
Inputmask.extendAliases({
    rupiah: {
        prefix: "Rp",
        groupSeparator: ".",
        alias: "numeric",
        placeholder: "0",
        autoGroup: !0,
        digits: 2,
        digitsOptional: !1,
        clearMaskOnLostFocus: !1
    }
});
var table = $("#table").DataTable({
    "paging": true,
    "deferRender": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "pageLength": 30,
    "ajax": {
        "url" : "/product/data-product",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "kode"},
        {"data": "nama"},
        {"data": "harga"},
        {"data": "stok"},
        {"data": "category"},
        {"data": "unit"},
        {"data": "action"}
    ]
});

var form = "" +
    "<form class='form-horizontal'>"+
    "<div class='modal-body'>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Kode / Barcode</label>"+
    "<div class='col-sm-9'>"+
    "<input class='form-control' placeholder='Barcode/Kode' name='kode'>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Nama</label>"+
    "<div class='col-sm-9'>"+
    "<input class='form-control' placeholder='Nama' name='nama'>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Harga</label>"+
    "<div class='col-sm-9'>"+
    "<input class='form-control' placeholder='ex:10.000' name='harga'>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Kategori</label>"+
    "<div class='col-sm-9'>"+
    "<select class='selectpicker form-control' data-live-search='true' name='kategori'>"+
    "</select>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Satuan</label>"+
    "<div class='col-sm-9'>"+
    "<select class='selectpicker form-control' data-live-search='true' name='satuan'>"+
    "</select>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Deskripsi</label>"+
    "<div class='col-sm-9'>"+
    "<textarea class='form-control' name='deskripsi' style='resize: none; height: 200px'></textarea>"+
    "</div>"+
    "</div>"+
    "</div>"+
    "<div class='modal-footer'>"+
    "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>"+
    "<button type='button' class='btn btn-default' id='btnSimpan'>Simpan</button>"+
    "</div>"+
    "</form>";

var formdelete = "" +
    "<div class='modal-body'>"+
    "<input type='hidden' name='id'>"+
    "<input type='hidden' name='nama'>"+
    "<input type='hidden' name='kode'>"+
    "<table class='table table-bordered'>"+
    "<thead>"+
    "<tr>"+
    "<td>kode / Barcode</td>"+
    "<td>nama</td>"+
    "<td>Harga</td>"+
    "</tr>"+
    "</thead>"+
    "<tbody>"+
    "<tr>"+
    "<td data='kode'></td>"+
    "<td data='nama'></td>"+
    "<td data='harga'></td>"+
    "</tr>"+
    "</tbody>"+
    "</table>"+
    "</div>"+
    "<div class='modal-footer'>"+
    "<input type='hidden' name='kode'>"+
    "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>"+
    "<button type='button' class='btn btn-default' id='btnSimpan'>Hapus</button>"+
    "</div>";

var opt_satuan = {
    ajax   : {
        url      : "product/select-satuan",
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

var opt_kategori = {
    ajax   : {
        url    : "product/select-kategori",
        type   : "POST",
        dataType : "json",
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

$(function(){
    $("input[name=harga]").inputmask({ alias : "rupiah" });

    //TAMBAH
    $("#btn-tambah").on("click", function(e){
        e.preventDefault();

        $('body').append(modal);
        $('.modal-title').text("Tambah Produk");
        $('.modal-content').append(form);

        $('select[name=satuan].selectpicker').selectpicker().ajaxSelectPicker(opt_satuan);
        $('select[name=kategori].selectpicker').selectpicker().ajaxSelectPicker(opt_kategori);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#btnSimpan").on('click', function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url : "/product/tambah",
                dataType: 'json',
                cache: false,
                data: {
                    '_token'    : $("input[name='_token']").val(),
                    'kode'      : $('input[name="kode"]').val(),
                    'nama'      : $('input[name="nama"]').val(),
                    'harga'     : $('input[name="harga"]').val(),
                    'deskripsi' : $('textarea[name="deskripsi"]').val(),
                    'kategori'  : $('select[name="kategori"]').val(),
                    'satuan'    : $('select[name="satuan"]').val(),
                },
                complete: function(){
                    table.ajax.reload();
                }
            });
        });

        $("#modal").on('hidden.bs.modal', function(e){
            $('.modal').remove();
        });
    });

    //EDIT
    $("#table tbody").on("click", "tr td button#btn-edit", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
        var deskripsi = $(this).data('deskripsi');
        var kategori = $(this).data('kategori');
        var satuan = $(this).data('satuan');

        $('body').append(modal);
        $('.modal-title').text("Edit Produk");
        $('.modal-content').append(form);

        $('select[name=kategori]').parents('div.form-group').css('margin-bottom', '0px');
        $('select[name=kategori]').parents('div.col-sm-9').append('<span class="help-block"><small>Kosongkan Apabila tidak diubah</small></span>');

        $('select[name=satuan]').parents('div.form-group').css('margin-bottom', '0px');
        $('select[name=satuan]').parents('div.col-sm-9').append('<span class="help-block"><small>Kosongkan Apabila tidak diubah</small></span>');

        $('select[name=satuan].selectpicker').selectpicker().ajaxSelectPicker(opt_satuan);
        $('select[name=kategori].selectpicker').selectpicker().ajaxSelectPicker(opt_kategori);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#modal").find("form.form-horizontal").append('<input type="hidden" name="id">');

        $("#modal").find("input[name=id]").val(id);
        $("#modal").find("input[name=kode]").val(kode);
        $("#modal").find("input[name=nama]").val(nama);
        $("#modal").find("input[name=harga]").val(harga);
        $("#modal").find("input[name=deskripsi]").val(deskripsi);
        $("#modal").find("select[name=kategori]").val(kategori);
        $("#modal").find("select[name=satuan]").val(satuan);

        $("#modal").on('click', '#btnSimpan', function(e){
            $.ajax({
                type: 'POST',
                url : "/product/edit",
                dataType: 'json',
                cache: false,
                data: {
                    '_token'    : $("input[name='_token']").val(),
                    'id'        : $("input[name='id']").val(),
                    'kode'      : $('input[name="kode"]').val(),
                    'nama'      : $('input[name="nama"]').val(),
                    'harga'     : $('input[name="harga"]').val(),
                    'deskripsi' : $('textarea[name="deskripsi"]').val(),
                    'kategori'  : $('select[name="kategori"]').val(),
                    'satuan'    : $('select[name="satuan"]').val(),
                },
                complete: function(){
                    table.ajax.reload();
                }
            });
        });


        $("#modal").on('hidden.bs.modal', function(e){
            $('.modal').remove();
        });
    });
    //DELETE
    $("#table tbody").on("click", "tr td button#btn-delete", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');

        $('body').append(modal);
        $('.modal-title').text("Hapus Produk");
        $('.modal-content').append(formdelete);

        $("#modal").find("input[name=id]").val(id);
        $("#modal").find("input[name=kode]").val(kode);
        $("#modal").find("input[name=nama]").val(nama);
        $("#modal").find("td[data=kode]").text(kode);
        $("#modal").find("td[data=nama]").text(nama);
        $("#modal").find("td[data=harga]").text(harga);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $('#modal').on('click', '#btnSimpan', function(e){
            $.ajax({
                type     : 'post',
                url      : "/product/hapus",
                dataType : 'json',
                cache    : false,
                data     : {
                    '_token' : $("input[name='_token']").val(),
                    'id'     : $('input[name="id"]').val(),
                    'kode'   : $('input[name="kode"]').val(),
                    'nama'   : $('input[name="nama"]').val()
                },
                complete: function(){
                    table.ajax.reload();
                }
            });
        });

        $("#modal").on('hidden.bs.modal', function(e){
            $('.modal').remove();
        });
    });
});
