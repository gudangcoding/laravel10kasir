<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form class="form-horizontal" data-toggle="validator" method="post">
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"> &times; </span> </button>

                </div>

                <div class="modal-body">

                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode" class=" control-label">Kode Produk</label>

                                <input id="kode" type="text" class="form-control" name="kode" autofocus
                                    required>
                                <span class="help-block with-errors"></span>

                            </div>

                            <div class="form-group">
                                <label for="nama" class=" control-label">Nama Produk</label>
                                <input id="nama" type="text" class="form-control" name="nama" required>
                                <span class="help-block with-errors"></span>
                            </div>

                            <div class="form-group">
                                <label for="kategori" class=" control-label">Kategori</label>
                                <select id="kategori" class="form-control" name="kategori" required>
                                    <option value=""> -- Pilih Kategori-- </option>
                                    @foreach ($kategori as $list)
                                        <option value="{{ $list->id_kategori }}">{{ $list->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>

                            <div class="form-group">
                                <label for="merk" class=" control-label">Merk</label>
                                <input id="merk" type="text" class="form-control" name="merk" required>
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="merk" class=" control-label">Foto</label>
                                <input type="file" id="foto" class="form-control" name="foto">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga_beli" class=" control-label">Harga Beli</label>
                                <input id="harga_beli" type="text" class="form-control" name="harga_beli" required>
                                <span class="help-block with-errors"></span>

                            </div>

                            <div class="form-group">
                                <label for="diskon" class=" control-label">Diskon</label>
                                <input id="diskon" type="text" class="form-control" name="diskon" required>
                                <span class="help-block with-errors"></span>

                            </div>

                            <div class="form-group">
                                <label for="harga_jual" class=" control-label">Harga Jual</label>
                                <input id="harga_jual" type="text" class="form-control" name="harga_jual" required>
                                <span class="help-block with-errors"></span>

                            </div>

                            <div class="form-group">
                                <label for="stok" class=" control-label">Stok</label>
                                <input id="stok" type="text" class="form-control" name="stok" required>
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="stok" class=" control-label">Satuan</label>
                                <select name="satuan" id="satuan" class="form-control">
                                    <option value="">Pilih Satuan</option>
                                    <option value="dus">Dus</option>
                                    <option value="pcs">Pcs</option>
                                    <option value="pak">Pak</option>
                                    <option value="rcg">Renceng</option>
                                    <option value="ktg">Kantong</option>
                                    <option value="kg">Kilogram</option>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i
                            class="fa fa-arrow-circle-left"></i> Batal</button>
                    <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
