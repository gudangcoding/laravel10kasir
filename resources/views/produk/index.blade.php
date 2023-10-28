@extends('layouts.app')

@section('title')
    Daftar Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('produk.index') }}">Produk</a></li>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
            <a onclick="deleteAll()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
            <a onclick="printBarcode()" class="btn btn-info"><i class="fa fa-barcode"></i> Cetak Barcode</a>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-th"></i>
                </button>

            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-produk">
                {{ csrf_field() }}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="20"><input type="checkbox" value="1" id="select-all"></th>
                            <th width="20">No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Merk</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Diskon</th>
                            <th>Stok</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </form>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    @include('produk.form')



    <script type="text/javascript">
        var table, save_method;
        $(function() {
            table = $('.table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{!! route('produk.index') !!}',
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    {
                        data: 'nomor',
                        name: 'nomor'
                    },
                   
                    {
                        data: 'kode_produk',
                        name: 'kode_produk'
                    },
                    {
                        data: 'nama_produk',
                        name: 'nama_produk'
                    },
                    {
                        data: 'nama_kategori',
                        name: 'nama_kategori'
                    },
                    {
                        data: 'merk',
                        name: 'merk'
                    },
                    {
                        data: 'harga_beli',
                        name: 'harga_beli'
                    },
                    {
                        data: 'harga_jual',
                        name: 'harga_jual'
                    },
                    {
                        data: 'diskon',
                        name: 'diskon'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#select-all').click(function() {
                $('input[type="checkbox"]').prop('checked', this.checked);
            });

            $('#modal-form form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    let formData = new FormData(this);
                    var id = $('#id').val();
                    if (save_method == "add") url = "{{ route('produk.store') }}";
                    else url = "produk/" + id;
console.log($('#modal-form form').serialize());
                    $.ajax({
                        url: url,
                        type: "POST",
                        // data: $('#modal-form form').serialize(),
                        data: formData,
                        // dataType: 'JSON',
                        success: function(data) {
                            console.log(data);
                            if (data.msg == "error") {
                                alert('Kode produk sudah digunakan!');
                                $('#kode').focus().select();
                            } else {
                                $('#modal-form').modal('hide');
                                table.ajax.reload();
                            }
                        },
                        error: function() {
                            alert("Tidak dapat menyimpan data!");
                        }
                    });
                    return false;
                }
            });
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah Produk');
            $('#kode').attr('readonly', false);
        }

        function editForm(id) {
            save_method = "edit";
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "produk/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Produk');

                    $('#id').val(data.id_produk);
                    $('#kode').val(data.kode_produk).attr('readonly', true);
                    $('#nama').val(data.nama_produk);
                    $('#kategori').val(data.id_kategori);
                    $('#merk').val(data.merk);
                    $('#harga_beli').val(data.harga_beli);
                    $('#diskon').val(data.diskon);
                    $('#harga_jual').val(data.harga_jual);
                    $('#stok').val(data.stok);

                },
                error: function() {
                    alert("Tidak dapat menampilkan data!");
                }
            });
        }

        function deleteData(id) {
            if (confirm("Apakah yakin data akan dihapus?")) {
                $.ajax({
                    url: "produk/" + id,
                    type: "POST",
                    data: {
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    },
                    success: function(data) {
                        table.ajax.reload();
                    },
                    error: function() {
                        alert("Tidak dapat menghapus data!");
                    }
                });
            }
        }

        function deleteAll() {
            if ($('input:checked').length < 1) {
                alert('Pilih data yang akan dihapus!');
            } else if (confirm("Apakah yakin akan menghapus semua data terpilih?")) {
                $.ajax({
                    url: "produk/hapus",
                    type: "POST",
                    data: $('#form-produk').serialize(),
                    success: function(data) {
                        table.ajax.reload();
                    },
                    error: function() {
                        alert("Tidak dapat menghapus data!");
                    }
                });
            }
        }

        function printBarcode() {
            if ($('input:checked').length < 1) {
                alert('Pilih data yang akan dicetak!');
            } else {
                $('#form-produk').attr('target', '_blank').attr('action', "produk/cetak").submit();
            }
        }
    </script>
@endsection
