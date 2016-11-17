
<div id="?????" class="modal" role="dialog" tabindex="-1" aria-labelledby="???" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">??????????</h4>
            </div>
            <form class="form-horizontal">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            {{Form::text('nama', '', ['class' => 'form-control', "placeholder"=>"Nama"])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-9">
                            {{Form::text('keterangan', '', ['class' => 'form-control', "placeholder"=>"Produk Kategori"])}}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" id="btnSimpanTambah">Simpan</button>
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
                <h4 class="modal-title">Edit Kategori</h4>
            </div>
            <form class="form-horizontal">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            {{Form::text('nama', '', ['class' => 'form-control', "placeholder"=>"Nama"])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-9">
                            {{Form::text('keterangan', '', ['class' => 'form-control', "placeholder"=>"Produk Kategori"])}}
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
                <h4 class="modal-title">Hapus Kategori</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Nama</td>
                        <td>Keterangan</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td data="nama"></td>
                        <td data="keterangan"></td>
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