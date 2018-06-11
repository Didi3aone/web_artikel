<?php 
    $id          = isset($artikel['artikel_id']) ? $artikel['artikel_id'] : "";
    $Judul 		 = isset($artikel['artikel_judul']) ? $artikel['artikel_judul'] : "";
    $seo  		 = isset($artikel['artikel_seo_title'])  ? $artikel['artikel_seo_title'] : "";
    $create_date = isset($artikel['artikel_create_date']) ? $artikel['artikel_create_date'] : "";
    $content     = isset($artikel['artikel_isi']) ? $artikel['artikel_isi'] : "";
    $image       = isset($artikel['artikel_photo']) ? $artikel['artikel_photo'] : "";
    $kategori_id = isset($artikel['kategori_id']) ? $artikel['kategori_id'] : "";
    $kategori    = isset($artikel['nama_kategori']) ? $artikel['nama_kategori'] : ""; 
    $tag_id      = isset($artikel_detail['tag_id']) ? $artikel_detail['tag_id'] : "";
    $tag         = isset($artikel_detail['tag']) ? $artikel_detail['tag'] : "";
    // pr($artikel);exit;
    $btn_msg     = ($id == null) ? "Upload" : "Change"; 
    
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
						<span class="widget-icon"> <i class="fa fa-eye"></i> </span>
						<h2><?php echo $title_page ?> </h2>				
						
					</header>

					<!-- widget div-->
					<div>
						<!-- widget content -->
						<div class="widget-body no-padding">
							
							<form id="form" class="smart-form" method="POST" action="<?php echo site_url('admin/article/process_form') ?>">
								<?php if($id != '' ) :?>
									<input type="hidden" name="artikel_id" value="<?= $id ?>">
								<?php endif;?>
								<fieldset>
									<div class="row">
										<section class="col col-6">
											<label class="label">Artikel Judul </label>
											<label class="input"> 
												<input type="text" name="artikel_judul" value="<?= $Judul; ?>" readonly placeholder="Artikel Judul">
											</label>
										</section>
										<section class="col col-6">
											<label class="label">Artikel SEO </label>
											<label class="input"> 
												<input type="text" name="artikel_seo" value="<?= $seo ?>" readonly placeholder="SEO Artikel">
											</label>
										</section>
									</div>

									<div class="row">
										<section class="col col-6">
											<label class="select">Tag Artikel</label>
											<label class="select">
												<select name="tag[]" id="tag" multiple="multiple" style="width: 100%;" disabled="disabled">
													<option selected value="<?= $tag_id ?>"><?= $tag ?></option>
												</select>
										</section>
										
										<section class="col col-6">
											<label class="label">Kategori Artikel</label>
											<label class="input">
												<input type="text" name="kategori_id" value="<?= $kategori ?>" readonly="readonly">
											</label>
										</section>

	                                </div>
									<div class="row">
		                                <div class="col-xs-12">
		                                    <div id="image_preview_primary" class="add-image-preview"></div>
		                                </div>
										<section class="col col-6">
											<label class="label"> Foto Artikel</label>
												<?php if(!empty($image)) :?>
													<a href="<?php echo base_url($image) ?>"  data-lightbox="roadtrip">
														<img src="<?php echo base_url($image) ?>" alt="" height=100 width=100></a>
												<?php endif; ?> &nbsp;
										</section>
									</div>

		                            <div class="row">
										<section class="col col-lg-12">
											<label class="textarea"> 										
												<textarea rows="40" name="artikel_isi" disabled="disabled"><?= $content ?></textarea> 
											</label>
										</section>
									</div>

									<footer>
										<a href="javascript:askTopublish(<?= $id ?>)" data-name="<?= $Judul ?>" class="btn btn-primary"> <i class="fa fa-upload"></i>
											Publish Artikel
										</button>
										<a href="<?= site_url() ?>admin/article" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
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