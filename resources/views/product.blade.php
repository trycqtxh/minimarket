@extends('layouts.template')

@push('css')
{{ Html::style('plugins/datatables/dataTables.bootstrap.css') }}
{{ Html::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css') }}
{{ Html::style('plugins/select-ajax/css/ajax-bootstrap-select.css') }}
@endpush

@push('js')
{{ Html::script('plugins/datatables/jquery.dataTables.min.js') }}
{{ Html::script('plugins/datatables/dataTables.bootstrap.min.js') }}
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js') }}
{{ Html::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js') }}
{{ Html::script('plugins/select-ajax/js/ajax-bootstrap-select.min.js') }}
{{ Html::script('js/pages/product.js') }}
@endpush

@section('title', 'Data Produk')

@section('content-header')
    <h1>
        Data Produk
        <small> </small>
    </h1>
@endsection

@section('content')
    <section class="content">
        {{ csrf_field() }}

        <div class="box box-widget ">
            <div class="box-header">
                <button class="btn btn-flat bg-aqua" id="btn-tambah">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered" id="table">
                    <thead>
                    <tr>
                        <th>Kode/Barcode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
@endsection