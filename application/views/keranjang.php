<div class="form-horizontal">
<?php echo form_open('kasir/updatecart'); ?>
  <input type="hidden" name="rowid" id="rowid" class="form-control">
  <div class="form-group">
     <label class="control-label col-md-3" for="id_barang">Kode Barang :</label>
      <div class="col-md-5">
        <input type="text" class="form-control" 
        placeholder="ex:B0002" name="id_barang" id="kd_barang_modal" readonly="readonly">
      </div>
  </div>
  <div id="barang_modal"></div>
  <div class="form-group">
        <label class="control-label col-md-3" for="qty_modal">Quantity :</label>
      <div class="col-md-4">
       <input type="number" class="form-control reset" 
          autocomplete="off"  id="qty_modal" min="0" 
         name="qty" placeholder="Isi qty...">
      </div>
   </div>
 <button type="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save">Update</i></button>
<?php echo form_close();?>
</div>

