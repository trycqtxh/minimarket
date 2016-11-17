@extends('layouts.template')

@push('css')
{{ Html::style('plugins/datatables/dataTables.bootstrap.css') }}
@endpush

@push('js')
{{ Html::script('plugins/datatables/jquery.dataTables.min.js') }}
{{ Html::script('plugins/datatables/dataTables.bootstrap.min.js') }}
{{ Html::script('js/pages/category.js') }}
@endpush

@section('title', 'Kategori')

@section('content-header')
    <h1>
        Kategori
        <small> </small>
    </h1>
@endsection

@section('content')
    <section class="content">
        {{csrf_field()}}

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
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>

@endsection