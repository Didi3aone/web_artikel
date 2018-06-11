<?php 
	$id              = isset($jadwal['jadwal_id']) ? $jadwal['jadwal_id'] : "";
	$Judul 		     = isset($jadwal['jadwal_name']) ? $jadwal['jadwal_name'] : "";
	$lokasi  		 = isset($jadwal['jadwal_location'])  ? $jadwal['jadwal_location'] : "";
	$content     	 = isset($jadwal['jadwal_description']) ? $jadwal['jadwal_description'] : "";
	$start     		 = isset($jadwal['jadwal_start']) ? $jadwal['jadwal_start'] : "";
	$end     		 = isset($jadwal['jadwal_end']) ? $jadwal['jadwal_end'] : "";
	$image       	 = isset($jadwal['jadwal_photo']) ? $jadwal['jadwal_photo'] : "";
	$jadwal_kategori_id = isset($jadwal['jadwal_kategori_id']) ? $jadwal['jadwal_kategori_id'] : "";
	$kategori 			= isset($jadwal['kategori_name']) ? $jadwal['kategori_name'] : "";
	$btn_msg     		= ($id == null) ? "Upload" : "Change"; 
	// pr($Judul);exit;
    
?>
<!-- START ROW -->
<div id="content">
	<section id="widget-grid" class="">
		<div class="row">

			<!-- NEW COL START -->
			<article class="col-sm-12 col-md-12 col-lg-12">
				
				<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-custombutton="false">
					<header>
						<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
						<h2><?php echo $title_page ?> </h2>				
						
					</header>

					<!-- widget div-->
					<div>
						<!-- widget content -->
						<div class="widget-body no-padding">
							
							<form id="form" class="smart-form" method="POST" action="<?php echo site_url('manager/jadwal/process_form') ?>">
								<?php if($id != ""): ?>
									<input type="hidden" name="jadwal_id" value="<?= $id ?> ">
								<?php endif; ?>
								<fieldset>
									<div class="row">
										<section class="col col-6">
											<label class="label">Nama Jadwal <sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="jadwal_name" value="<?= $Judul; ?>" placeholder="Nama Jadwal">
											</label>
										</section>
										<section class="col col-6">
											<label class="label">Lokasi  <sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="jadwal_location" value="<?= $lokasi ?>" placeholder="Lokasi">
											</label>
										</section>
									</div>

									<div class="row">
										<section class="col col-6">
											<label class="label"> Jadwal Start Date <sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="jadwal_start_date" class="" id="periode_start" value="<?= $start; ?>" placeholder="Jadwal Start Date">
											</label>
										</section>

										<section class="col col-6">
											<label class="label">Jadwal End Date  <sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="jadwal_end_date" value="<?= $end ?>" class="" id="periode_end" placeholder="Jadwal End Date">
											</label>
										</section>
									</div>
								    
									<div class="row">
		                                <div class="col-xs-12">
		                                    <div id="image_preview_primary" class="add-image-preview"></div>
		                                </div>
										<section class="col col-6">
											<label class="label">Upload Foto Jadwal</label>
												<?php if(!empty($image)) :?>
													<a href="<?php echo base_url($image) ?>"  data-lightbox="roadtrip">
														<img src="<?php echo base_url($image) ?>" alt="" height=100 width=100></a>
												<?php endif; ?> &nbsp;
												<button type="button" id="addimage" data-maxsize="<?= MAX_UPLOAD_IMAGE_SIZE ?>" data-maxwords="<?= WORDS_MAX_UPLOAD_IMAGE_SIZE ?>" data-edit="0" class="btn btn-primary"><?= $btn_msg ?></button>
											 <div class="note"> Klik Button (add image) Foto Sesuaikan dengan jadwal terkait</div>
										</section>
										<section class="col col-6">
											<label class="select">Kategori</label>
											<label class="select">
												<?php if($jadwal_kategori_id != "") : ?>
												<select name="jadwal_kategori_id" id="kategori" style="width: 100%;">
													<option selected value="<?= $jadwal_kategori_id ?>"><?= $kategori ?></option>
												</select>
												<?php else: ?>
												<select name="jadwal_kategori_id" id="kategori" style="width: 100%;"></select>
												<?php endif; ?>
											</label>
											<div class="note">#Tags sesuaikan dengan jadwal terkait</div>
										</section>
									</div>


		                            <div class="row">
										<section class="col col-lg-12">
											<label class="textarea"> 										
												<textarea name="jadwal_description" class="tinymce"><?= $content ?></textarea> 
											</label>
										</section>
									</div>

									<footer>
										<button type="submit" class="btn  btn-submit btn-primary"> <i class="fa fa-save"></i>
											Save
										</button>
										<a href="<?= site_url() ?>manager/jadwal" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
									</footer>
								</fieldset>
							</form>
						</div>
						<!-- end widget content -->
					</div>
					<!-- end widget div -->
				</div>
				<!-- end widget -->
			</article>
			<!-- END COL -->	
		</div>
		<!-- END ROW -->
	</section>
</div>