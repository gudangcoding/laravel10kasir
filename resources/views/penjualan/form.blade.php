@extends('layouts.master')

@section('title')
    Transaksi Penjualan
@endsection

@push('css')
<style>
    .tampil-bayar {
        font-size: 5em;
        text-align: center;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }

    .table-penjualan tbody tr:last-child {
        display: none;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
</style>
@endpush

@section('breadcrumb')
    @parent
    <li class="active">Transaksi Penjaualn</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">
                    
               
                <h2>Detail Barang</h2>
                <table class="table table-stiped table-bordered table-penjualan">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th width="15%">Jumlah</th>
                        <th>Diskon</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody>
                       <tr>
                        @foreach($detail as $p)

                        <td width="5%">{{$p->id_penjualan_detail}}</td>
                        <td>{{$p->id_penjualan}}</td>
                        <td>{{$p->nama_produk}}</td>
                        <td>{{$p->harga_jual}}</td>
                        <td width="15%">{{$p->jumlah}}</td>
                        <td>{{$p->diskon}}</td>
                        <td>{{$p->subtotal}}</td>                       
                        @endforeach

                    </tr>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="tampil-bayar bg-primary"></div>
                        <div class="tampil-terbilang"></div>
                    </div>
                    <div class="col-lg-4">
                        <form action="{{ route('transaksi.ubah') }}" class="form-penjualan" method="post">
                            @csrf
                            <input type="hidden" name="id_penjualan" value="{{$jual->id_penjualan}}">
                            <input type="hidden" name="total" id="total" value="{{$jual->total_harga}}">
                            <input type="hidden" name="total_item" id="total_item" value="{{$jual->total_item}}">
                            <input type="hidden" name="bayar" id="bayar" value="{{$jual->bayar}}">
                            <input type="hidden" name="id_member" id="id_member" value="{{$jual->id_member}}">

                            <div class="form-group row">
                                <label for="totalrp" class="col-lg-2 control-label">Total</label>
                                <div class="col-lg-8">
                                    <input type="text" id="totalrp" class="form-control" value="{{$jual->total_harga}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_member" class="col-lg-2 control-label">Member</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="kode_member" value="{{$jual->id_member}}" readonly>
                                
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="diskon" class="col-lg-2 control-label">Diskon</label>
                                <div class="col-lg-8">
                                    <input type="number" name="diskon" id="diskon" class="form-control" 
                                    value="{{$jual->diskon}}"
                                        >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-lg-2 control-label">Status</label>
                                <div class="col-lg-8">
                                    <select name="status" id="status" class="form-control">
                                        <option value="Pending" @if ($jual->status=='Pending') selected="selected" @endif >Pending</option>
                                        <option value="Dibayar" @if ($jual->status=='Dibayar') selected="selected" @endif >Dibayar</option>
                                        <option value="Dikirim" @if ($jual->status=='Dikirim') selected="selected" @endif >Dikirim</option>
                                        <option value="Diterima" @if ($jual->status=='Diterima') selected="selected" @endif >Diterima</option>
                                        <option value="Selesai" @if ($jual->status=='Selesai')selected="selected" @endif >Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bayar" class="col-lg-2 control-label">Bayar</label>
                                <div class="col-lg-8">
                                    <input type="text" id="bayarrp" class="form-control" value="{{$jual->bayar}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="diterima" class="col-lg-2 control-label">Diterima</label>
                                <div class="col-lg-8">
                                    <input type="number" id="diterima" class="form-control" name="diterima" value="{{ $jual->diterima ?? 0 }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kembali" class="col-lg-2 control-label">Kembali</label>
                                <div class="col-lg-8">
                                    <input type="text" id="kembali" name="kembali" class="form-control" value="{{$jual->diterima-$jual->bayar}}" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-floppy-o"></i> Simpan Transaksi</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

@endpush


