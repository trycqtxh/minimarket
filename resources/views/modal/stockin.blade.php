<div id="modalCariItem" class="modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cari Item</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="info-item">
                    <thead>
                    <tr>
                        <td>Kode</td>
                        <td>Nama</td>
                        <td>Harga</td>
                        <td>Stok</td>
                        <td>action</td>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-danger" id="modal-kode-kosong" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Maaf ...!</h4>
            </div>
            <div class="modal-body">
                <p>Kode Item Tidak Ada Dalam DataBase</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>