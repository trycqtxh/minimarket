/**
 * Created by Faisal Abdul Hamid on 01/10/2016.
 */
var tabel = $("#table").DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "ajax": {
        "url" : "/supplier/data-supplier",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "nama"},
        {"data": "alamat"},
        {"data": "telepon"},
        {"data": "deskripsi"},
        {"data": "action"}
    ]
});

var form = "" +
    "<form class='form-horizontal'>"+
    "<div class='modal-body'>"+
    "<div class='form-group'>"+
    "<label class='col-sm-2 control-label'>Nama</label>"+
    "<div class='col-sm-10'>"+
    "<input class='form-control' placeholder='Nama' type='text' name='nama'>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-2 control-label'>Telepon</label>"+
    "<div class='col-sm-10'>"+
    "<input class='form-control' placeholder='Telepon' type='text' name='telepon'>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label for='inputPassword3' class='col-sm-2 control-label'>Alamat</label>"+
    "<div class='col-sm-10'>"+
    "<input class='form-control' placeholder='Alamat' type='text' name='alamat'>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-2 control-label'>Deskripsi</label>"+
    "<div class='col-sm-10'>"+
    "<textarea class='form-control' name='deskripsi'>"+
    "</textarea>"+
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
    "<table class='table table-bordered'>"+
    "<thead>"+
    "<tr>"+
    "<td>Nama</td>"+
    "<td>Deskripsi</td>"+
    "</tr>"+
    "</thead>"+
    "<tbody>"+
    "<tr>"+
    "<td data='nama'></td>"+
    "<td data='telepon'></td>"+
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
    $('input[name=telepon]').inputmask({mask: "9999-9999-9999"});

    //TAMBAH
    $("#btn-tambah").on("click", function(e){
        e.preventDefault();

        $('body').append(modal);
        $('.modal-title').text("Tambah Supplier");
        $('.modal-content').append(form);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#btnSimpan").on('click', function(e){
            e.preventDefault();
            $.ajax({
                type     : 'post',
                url      : "/supplier/tambah",
                dataType : 'json',
                cache    : false,
                data     : {
                    '_token'    : $("input[name='_token']").val(),
                    'nama'      : $('input[name="nama"]').val(),
                    'alamat'    : $('input[name="alamat"]').val(),
                    'telepon'   : $('input[name="telepon"]').val(),
                    'deskripsi' : $('textarea[name="deskripsi"]').val(),
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
        var nama = $(this).data('nama');
        var alamat = $(this).data('alamat');
        var telepon = $(this).data('telepon');
        var deskripsi = $(this).data('deskripsi');

        $('body').append(modal);
        $('.modal-title').text("Edit Supplier");
        $('.modal-content').append(form);
        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#modal").find("form.form-horizontal").append('<input type="hidden" name="id">');

        $("#modal").find("input[name=id]").val(id);
        $("#modal").find("input[name=nama]").val(nama);
        $("#modal").find("input[name=alamat]").val(alamat);
        $("#modal").find("input[name=telepon]").val(telepon);
        $("#modal").find("textarea[name=deskripsi]").val(deskripsi);

        $("#modal").on('click', '#btnSimpan', function(e){
            $.ajax({
                type: 'POST',
                url : "/supplier/edit",
                dataType: 'json',
                cache: false,
                data: {
                    '_token'    : $("input[name='_token']").val(),
                    'id'        : $("input[name='id']").val(),
                    'nama'      : $('input[name="nama"]').val(),
                    'alamat'    : $('input[name="alamat"]').val(),
                    'telepon'   : $('input[name="telepon"]').val(),
                    'deskripsi' : $('textarea[name="deskripsi"]').val(),
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
    //HAPUS
    $("#table tbody").on("click", "tr td button#btn-delete", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var telepon = $(this).data('telepon');

        $('body').append(modal);
        $('.modal-title').text("Hapus Supplier");
        $('.modal-content').append(formdelete);

        $("#modal").find("input[name=id]").val(id);
        $("#modal").find("input[name=nama]").val(nama);
        $("#modal").find("td[data=nama]").text(nama);
        $("#modal").find("td[data=telepon]").text(telepon);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $('#modal').on('click', '#btnSimpan', function(e){
            $.ajax({
                type: 'post',
                url : "/supplier/hapus",
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
