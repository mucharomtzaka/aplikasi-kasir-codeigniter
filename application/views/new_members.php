<section class="content">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-header">
				<h1 class="alert alert-info"> <?=$title;?></h1>
			</div>
			<div class="panel-body text-center form-horizontal">
                  <?php echo form_open('members/save');?>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Kode Pelanggan</label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="kode_pelanggan" class="form-control" value="<?=$kode_pelanggan;?>" readonly>
                 	 </div>
                  </div>
                   <div class="form-group">
                 	 <label class="col-md-2 control-label">Nama Pelanggan</label>
                 	 <div class="col-md-7">
                 	 	<input type="text" name="nama_pelanggan" class="form-control" value="" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Tanggal Pendaftaran</label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="tgl_register" class="form-control" value="<?=$tgl_register;?>" readonly>
                 	 </div>
                  </div>
                   <div class="form-group">
                 	 <label class="col-md-2 control-label">Tanggal Lahir</label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="tgl_lahir" class="form-control" id="tgl" value="" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Email</label>
                 	 <div class="col-md-7">
                 	 	<input type="email" name="email"  value="" class="form-control" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">jenis Kelamin</label>
                 	 <div class="col-md-4">
                 	 	<select name="jk" class="form-control" required="required">
                 	 		<option value=""> Pilih Jenis Kelamin</option>
                 	 		<option value="Laki-laki"> Laki - laki </option>
                 	 		<option value="Perempuan"> Perempuan </option>
                 	 	</select>
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Kontak </label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="kontak" id="kontak" value="" class="form-control" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Alamat</label>
                 	 <div class="col-md-7">
                 	 	<textarea name="alamat" class="form-control" required="required"></textarea>
                 	 </div>
                  </div>
                  <div class="pull-right">
                     <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save">Save</i></button>
                    <button type="reset" class="btn btn-primary btn-lg" ><i class="fa fa-close">Reset</i></button>
                  </div>
                    <?php echo form_close();?>
                </div>    
		</div>
	</div>
</section>