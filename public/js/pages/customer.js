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
        "url" : "/customer/data-customer",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "nama"},
        {"data": "jenis_kelamin"},
        {"data": "telepon"},
        {"data": "alamat"},
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
    "<label class='col-sm-3 control-label'>Jenis Kelamin</label>"+
    "<div class='col-sm-9'>"+
    "<select name='jenis_kelamin' class='form-control'>"+
    "<option value=''>Pilih Jenis Kelamin</option>"+
    "<option value='L'>Laki-laki</option>"+
    "<option value='P'>Perempuan</option>"+
    "</select>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Telepon</label>"+
    "<div class='col-sm-9'>"+
    "<input class='form-control' placeholder='Telepon' name='telepon'>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Alamat</label>"+
    "<div class='col-sm-9'>"+
    "<textarea class='form-control' name='alamat'>"+
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
    "<td>Telepon</td>"+
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
    //TAMBAH
    $("#btn-tambah").on("click", function(e){

        e.preventDefault();
        $('body').append(modal);
        $('.modal-title').text("Tambah Pelanggan");
        $('.modal-content').append(form);
        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#btnSimpan").on('click', function(e){
            e.preventDefault();
            $.ajax({
                type     : 'POST',
                url      : "/customer/tambah",
                dataType : 'json',
                cache    : false,
                data: {
                    '_token'        : $("input[name='_token']").val(),
                    'nama'          : $('input[name="nama"]').val(),
                    'jenis_kelamin' : $('select[name="jenis_kelamin"]').val(),
                    'telepon'       : $('input[name="telepon"]').val(),
                    'alamat'        : $('textarea[name="alamat"]').val(),
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
    $('#table tbody').on('click', 'tr td button#btn-edit', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var jk = $(this).data('jk');
        var tlp = $(this).data('tlp');
        var alamat  = $(this).data('alamat');

        $('body').append(modal);
        $('.modal-title').text("Edit Pelanggan");
        $('.modal-content').append(form);
        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#modal").find("form.form-horizontal").append('<input type="hidden" name="id">');

        $("#modal").find("input[name=id]").val(id);
        $("#modal").find("input[name=nama]").val(nama);
        $("#modal").find("select[name=jenis_kelamin]").val(jk);
        $("#modal").find("input[name=telepon]").val(tlp);
        $("#modal").find("input[name=alamat]").val(alamat);

        $("#modal").on('click', '#btnSimpan', function (e) {
            $.ajax({
                type     : 'POST',
                url      : "/customer/edit",
                dataType : 'json',
                cache    : false,
                data: {
                    '_token'        : $("input[name='_token']").val(),
                    'id'            : $('input[name="id"]').val(),
                    'nama'          : $('input[name="nama"]').val(),
                    'jenis_kelamin' : $('select[name="jenis_kelamin"]').val(),
                    'telepon'       : $('input[name="telepon"]').val(),
                    'alamat'        : $('textarea[name="alamat"]').val(),
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
    //HAPUS
    $('#table tbody').on('click', 'tr td button#btn-delete', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var tlp = $(this).data('tlp');

        $('body').append(modal);
        $('.modal-title').text("Hapus Pelanggan");
        $('.modal-content').append(formdelete);

        $("#modal").find("input[name=id]").val(id);
        $("#modal").find("td[data=nama]").text(nama);
        $("#modal").find("td[data=telepon]").text(tlp);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $('#modal').on('click', '#btnSimpan', function(e){
            $.ajax({
                type: 'post',
                url : "/customer/hapus",
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