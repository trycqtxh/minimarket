{{csrf_field()}}
<div id="modalTambah" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Customer</h4>
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
                        <label class="col-sm-3 control-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            {{Form::select('jenis_kelamin', array(''=>'Pilih Jenis Kelamin', 'L' => 'Laki-laki', 'P' => 'Perempuan'), '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Telepon</label>
                        <div class="col-sm-9">
                            {{Form::text('telepon', '', ['class' => 'form-control', "placeholder"=>"Telepon"])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alamat</label>
                        <div class="col-sm-9">
                            {{Form::text('alamat', '', ['class' => 'form-control', "placeholder"=>"Alamat"])}}
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
                <h4 class="modal-title">Edit Customer</h4>
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
                        <label class="col-sm-3 control-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            {{Form::select('jenis_kelamin', array(''=>'Pilih Jenis Kelamin', 'L' => 'Laki-laki', 'P' => 'Perempuan'), '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Telepon</label>
                        <div class="col-sm-9">
                            {{Form::text('telepon', '', ['class' => 'form-control', "placeholder"=>"Telepon"])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alamat</label>
                        <div class="col-sm-9">
                            {{Form::text('alamat', '', ['class' => 'form-control', "placeholder"=>"Alamat"])}}
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
                <h4 class="modal-title">Hapus Customer</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Nama</td>
                        <td>Telepon</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td data="nama"></td>
                        <td data="telepon"></td>
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