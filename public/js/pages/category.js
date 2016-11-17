var form = '' +
    '<form class="form-horizontal">'+
    '<div class="modal-body">'+
    '<div class="form-group">'+
    '<label class="col-sm-3 control-label">Nama</label>'+
    '<div class="col-sm-9">' +
    '<input type="text" name="nama" class="form-control" placeholder="Nama">'+
    '</div>'+
    '</div>'+
    '<div class="form-group">'+
    '<label class="col-sm-3 control-label">Keterangan</label>'+
    '<div class="col-sm-9">'+
    '<input type="text" class="form-control" placeholder="Kategori" name="keterangan">'+
    '</div>'+
    '</div>'+
    '</div>'+
    '<div class="modal-footer">'+
    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
    '<button type="button" class="btn btn-default" id="btnSimpan">Simpan</button>'+
    '</div>'+
    '</form>';
var formdelete = '' +
    '<div class="modal-body">'+
    '<input type="hidden" name="id">'+
    '<table class="table table-bordered">'+
    '<thead>'+
    '<tr>'+
    '<td>Nama</td>'+
    '<td>Keterangan</td>'+
    '</tr>'+
    '</thead>'+
    '<tbody>'+
    '<tr>'+
    '<td data="nama"></td>'+
    '<td data="keterangan"></td>'+
    '</tr>'+
    '</tbody>'+
    '</table>'+
    '</div>'+
    '<div class="modal-footer">'+
    '<input type="hidden" name="id">'+
    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
    '<button type="button" class="btn btn-default" id="btnSimpan">Hapus</button>'+
    '</div>';

var table = $("#table").DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "ajax": {
        "url" : "/product/category/data-category",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "nama"},
        {"data": "keterangan"},
        {"data": "action"}
    ]
});

$(function(){
    //TAMBAH
    $('#btn-tambah').on('click', function(e){
        e.preventDefault();

        $('body').append(modal);
        $('.modal-title').text("Tambah Kategori");
        $('.modal-content').append(form);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#btnSimpan").on('click', function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url : "/product/category/tambah",
                dataType: 'json',
                cache: false,
                data: {
                    '_token'    : $("input[name='_token']").val(),
                    'nama'      : $('input[name="nama"]').val(),
                    'keterangan': $('input[name="keterangan"]').val(),
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
    $('#table tbody').on('click', 'tr td button#btn-edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var ket = $(this).data('ket');

        $('body').append(modal);
        $('.modal-title').text("Edit Kategori");
        $('.modal-content').append(form);
        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#modal").find("form.form-horizontal").append('<input type="hidden" name="id">');

        $("#modal").find("input[name=id]").val(id);
        $("#modal").find("input[name=nama]").val(nama);
        $("#modal").find("input[name=keterangan]").val(ket);

        $("#modal").on('click', '#btnSimpan', function(e){
            $.ajax({
                type: 'POST',
                url : "/product/category/edit",
                dataType: 'json',
                cache: false,
                data: {
                    '_token'    : $("input[name='_token']").val(),
                    'id'        : $("input[name='id']").val(),
                    'nama'      : $('input[name="nama"]').val(),
                    'keterangan': $('input[name="keterangan"]').val(),
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
    $('#table tbody').on('click', 'tr td button#btn-delete', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var ket = $(this).data('ket');
        $('body').append(modal);
        $('.modal-title').text("Hapus Kategori");
        $('.modal-content').append(formdelete);

        $("#modal").find("input[name=id]").val(id);
        $("#modal").find("td[data=nama]").text(nama);
        $("#modal").find("td[data=keterangan]").text(ket);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $('#modal').on('click', '#btnSimpan', function(e){
            $.ajax({
                type: 'post',
                url : "/product/category/hapus",
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