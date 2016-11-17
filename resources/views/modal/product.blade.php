{{csrf_field()}}
<div id="modalTambah" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Item</h4>
            </div>
            <form class="form-horizontal">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode / Barcode</label>
                        <div class="col-sm-9">
                            {{Form::text('kode', '', ['class' => 'form-control', "placeholder"=>"Barcode"])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            {{Form::text('nama', '', ['class' => 'form-control', "placeholder"=>"Nama"])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga</label>
                        <div class="col-sm-9">
                            {{Form::text('harga', '', ['class' => 'form-control', "placeholder"=>"ex:10.000"])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kategori</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="kategori">
                                <option value="">Pilih</option>
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Satuan</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="satuan">
                                <option value="">Pilih</option>
                                @foreach($satuans as $s)
                                    <option value="{{$s->id}}">{{$s->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="deskripsi" style="resize: none; height: 200px"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" id="btnSimpan">Simpan</button>
                </div>
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
                <h4 class="modal-title">Edit Item</h4>
            </div>
            <form class="form-horizontal">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode / Barcode</label>
                        <div class="col-sm-9">
                            {{Form::text('kode', '', ['class' => 'form-control', "placeholder"=>"Barcode"])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            {{Form::text('nama', '', ['class' => 'form-control', "placeholder"=>"Nama"])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga</label>
                        <div class="col-sm-9">
                            {{Form::text('harga', '', ['class' => 'form-control', "placeholder"=>"ex:10.000"])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Satuan</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="satuan">
                                <option value="">Pilih</option>
                                @foreach($satuans as $s)
                                    <option value="{{$s->id}}">{{$s->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kategori</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="kategori">
                                <option value="">Pilih</option>
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="deskripsi" style="resize: none; height: 200px"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" id="btnSimpan">Simpan</button>
                </div>
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
                <h4 class="modal-title">Hapus Item</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <input type="hidden" name="nama">
                <input type="hidden" name="kode">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>kode / Barcode</td>
                        <td>nama</td>
                        <td>Harga</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td data="kode"></td>
                        <td data="nama"></td>
                        <td data="harga"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="kode">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" id="btnSimpan">Hapus</button>
            </div>
        </div>
    </div>
</div>