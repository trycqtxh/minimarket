{{-- MODAL TAMBAH --}}
{{csrf_field()}}
<div id="modalTambah" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Supplier</h4>
            </div>
            <form class="form-horizontal">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>

                        <div class="col-sm-10">
                            <input class="form-control" placeholder="Nama" type="text" name="nama">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telepon</label>

                        <div class="col-sm-10">
                            <input class="form-control" placeholder="Telepon" type="text" name="telepon" data-inputmask='"mask": "999999999999"' data-mask>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>

                        <div class="col-sm-10">
                            <input class="form-control" placeholder="Alamat" type="text" name="alamat">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deskripsi</label>

                        <div class="col-sm-10">
                            {{Form::text('deskripsi', '', ['class' => 'form-control', "placeholder"=>"Deskripsi"])}}
                            {{-- }}
                            <input class="form-control" placeholder="Deskripsi" type="text" name="form-control">
                            --}}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" id="btnSimpan">Simpan</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>

{{-- MODAL Edit --}}
<div id="modalEdit" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Supplier</h4>
            </div>
            <form class="form-horizontal">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>

                        <div class="col-sm-10">
                            <input class="form-control" placeholder="Nama" type="text" name="nama">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telepon</label>

                        <div class="col-sm-10">
                            <input class="form-control" placeholder="Telepon" type="text" name="telepon">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>

                        <div class="col-sm-10">
                            <input class="form-control" placeholder="Alamat" type="text" name="alamat">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deskripsi</label>

                        <div class="col-sm-10">
                            <input class="form-control" placeholder="Deskripsi" type="text" name="deskripsi">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" id="btnSimpan">Simpan</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>

{{-- MODAL Hapus --}}
<div id="modalHapus" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hapus Supplier</h4>
            </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>Nama</td>
                            <td>Deskripsi</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td data="nama"></td>
                            <td data="deskripsi"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" id="btnSimpan">Hapus</button>
                </div>
        </div>
    </div>
</div>