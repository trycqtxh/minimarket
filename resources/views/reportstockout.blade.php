@extends('layouts.template')

@push('css')
{{ Html::style('plugins/daterangepicker/daterangepicker.css') }}
{{ Html::style('plugins/datepicker/datepicker3.css') }}
{{ Html::style('plugins/timepicker/bootstrap-timepicker.min.css') }}
@endpush

@push('js')
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js') }}
{{ Html::script('plugins/daterangepicker/daterangepicker.js') }}
{{ Html::script('plugins/datepicker/bootstrap-datepicker.js') }}
{{ Html::script('plugins/timepicker/bootstrap-timepicker.min.js') }}
{{ Html::script('plugins/datatables/jquery.dataTables.min.js') }}
{{ Html::script('plugins/datatables/dataTables.bootstrap.min.js') }}
{{ Html::script('js/pages/reportstockout.js') }}
@endpush

@section('title', 'Laporan Item Keluar')

@section('content-header')

@endsection

@section('content')
    <section class="content">
        {{ csrf_field() }}
        <div class="box box-default box-solid collapsed-box" style="border-radius: 0; margin-bottom: 0">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan Item Masuk</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">

                <div class="col-sm-3">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-clone"></i>
                        </div>
                        <input class="form-control pull-right" type="text" name="nota">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-clone"></i>
                        </div>
                        <input class="form-control pull-right" type="text" name="pelanggan">
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-clone"></i>
                        </div>
                        <input class="form-control pull-right" type="text" name="pelanggan">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input class="form-control pull-right" type="text" name="tanggal">
                    </div>
                </div>

                <div class="col-sm-1">
                    <div class="form-group">
                        <button class="btn btn-block btn-info" id="btn-search"><i class="fa fa-search"></i> </button>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
        </div>

        <div class="box box-widget" style="border-radius: 0">
            <div class="box-body no-padding" style="display: block;">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                    <tr>
                        <td>Tanggal</td>
                        <td>Kode Item</td>
                        <td>Nama Item</td>
                        <td>Detail</td>
                        <td>Total(Stok)</td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
@endsection