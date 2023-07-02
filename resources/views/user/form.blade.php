<div class="modal fade" id="modal-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" data-toggle="validator" method="post">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <h4 class="modal-title">

                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group col-md-6">
                        <label for="nama" class="col-md-3 control-label">Nama User</label>
                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control" name="nama" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password1" class="col-md-3 control-label">Ulang Password</label>
                        <div class="col-md-6">
                            <input id="password1" type="password" class="form-control" data-match="#password"
                                name="password1" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i
                            class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
