@extends('layouts.app')

@section('title')
    Daftar Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('kategori.index') }}">Kategori</a></li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{-- {{ ucwords(Request::segment(1)) }} --}}
            <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
        </div>
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="30">No</th>
                        <th>Nama Kategori</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
    </div>

    @include('kategori.form')



    <script type="text/javascript">
        var table, save_method;
        $(function() {

            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         alert("Form successful submitted!");
            //     }
            // });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //untuk delete
            $('body').on('click', '.delete', function() {
                if (confirm("Delete Record?") == true) {
                    var id = $(this).data('id');
                    // ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('kategori') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            var oTable = $('.table').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            });

            table = $('.table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{!! route('kategori.index') !!}',
                columns: [{
                        data: 'id_kategori',
                        name: 'id_kategori'
                    },
                    {
                        data: 'nama_kategori',
                        name: 'nama_kategori'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#modal-form form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == "add") url = "{{ route('kategori.store') }}";
                    else url = "kategori/" + id;

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form form').serialize(),
                        success: function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
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
            $('.modal-title').text('Tambah Kategori');
        }

        function editForm(id) {
            save_method = "edit";
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "kategori/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Kategori');

                    $('#id').val(data.id_kategori);
                    $('#nama').val(data.nama_kategori);

                },
                error: function() {
                    alert("Tidak dapat menampilkan data!");
                }
            });
        }

        function deleteData(id) {
            if (confirm("Apakah yakin data akan dihapus?")) {
                $.ajax({
                    url: "kategori/" + id,
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
    </script>
@endsection
