<div class="modal fade" id="modal-form">
   <div class="modal-dialog">
       <div class="modal-content">
     
   <form class="form-horizontal" data-toggle="validator" method="post">
   {{ csrf_field() }} {{ method_field('POST') }}
   
   <div class="modal-header">
      <h4 class="modal-title"> </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
            
<div class="modal-body">
   
   <input type="hidden" id="id" name="id">
   <div class="form-group col-md-12">
      <label for="nama" class="control-label">Nama Kategori</label>
     
         <input id="nama" type="text" class="form-control" name="nama" autofocus required>
         <span class="help-block with-errors"></span>
      
   </div>
   
</div>
   
   <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
      <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan </button>   
   </div>
      
   </form>

         </div>
      </div>
   </div>
