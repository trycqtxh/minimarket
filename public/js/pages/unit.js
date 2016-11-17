/**
 * Created by Faisal Abdul Hamid on 01/10/2016.
 */
var table = $("#table").DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "ajax": {
        "url" : "/product/unit/data-unit",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "nama"},
        {"data": "keterangan"},
        {"data": "action"}
    ]
});

var form = "" +
    "<form class='form-horizontal'>"+
    "<div class='modal-body'>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Nama</label>"+
    "<div class='col-sm-9'>"+
    "<input class='form-control' placeholder='Nama' name='nama'>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Keterangan</label>"+
    "<div class='col-sm-9'>"+
    "<input class='form-control' placeholder='Satuan' name='keterangan'>"+
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
    "<table class='table table-bordered'>"+
    "<thead>"+
    "<tr>"+
    "<td>Nama</td>"+
    "<td>Keterangan</td>"+
    "</tr>"+
    "</thead>"+
    "<tbody>"+
    "<tr>"+
    "<td data='nama'></td>"+
    "<td data='keterangan'></td>"+
    "</tr>"+
    "</tbody>"+
    "</table>"+
    "</div>"+
    "<div class='modal-footer'>"+
    "<input type='hidden' name='id'>"+
    "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>"+
    "<button type='button' class='btn btn-default' id='btnSimpan'>Hapus</button>"+
    "</div>";

$(function(){
    //Tambah
    $("#btn-tambah").on("click", function(e){
        e.preventDefault();
        $('body').append(modal);
        $('.modal-title').text("Tambah Satuan");
        $('.modal-content').append(form);
        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#btnSimpan").on('click', function(e){
            e.preventDefault();
            $.ajax({
                type     : 'POST',
                url      : "/product/unit/tambah",
                dataType : 'json',
                cache    : false,
                data: {
                    '_token'     : $("input[name='_token']").val(),
                    'nama'       : $('input[name="nama"]').val(),
                    'keterangan' : $('input[name="keterangan"]').val(),
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
    //Edit
    $("#table tbody").on("click", "tr td button#btn-edit", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var keterangan = $(this).data('keterangan');

        $('body').append(modal);
        $('.modal-title').text("Edit Satuan");
        $('.modal-content').append(form);
        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#modal").find("form.form-horizontal").append('<input type="hidden" name="id">');

        $("#modal").find("input[name=id]").val(id);
        $("#modal").find("input[name=nama]").val(nama);
        $("#modal").find("input[name=keterangan]").val(keterangan);

        $("#modal").on('click', '#btnSimpan', function (e) {
            $.ajax({
                type     : 'POST',
                url      : "/product/unit/edit",
                dataType : 'json',
                cache    : false,
                data: {
                    '_token'     : $("input[name='_token']").val(),
                    'id'         : $('input[name="id"]').val(),
                    'nama'       : $('input[name="nama"]').val(),
                    'keterangan' : $('input[name="keterangan"]').val(),
                },
                complete: function () {
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
        var nama = $(this).data('nama');
        var keterangan = $(this).data('keterangan');

        $('body').append(modal);
        $('.modal-title').text("Hapus Pelanggan");
        $('.modal-content').append(formdelete);

        $("#modal").find("input[name=id]").val(id);
        $("#modal").find("input[name=nama]").val(nama);
        $("#modal").find("td[data=nama]").text(nama);
        $("#modal").find("td[data=keterangan]").text(keterangan);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $('#modal').on('click', '#btnSimpan', function(e){
            $.ajax({
                type: 'post',
                url : "/product/unit/hapus",
                dataType: 'json',
                cache: false,
                data: {
                    '_token' : $("input[name='_token']").val(),
                    'id'     : $('input[name="id"]').val(),
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
