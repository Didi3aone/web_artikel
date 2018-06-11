<?php 
    $id          = isset($artikel['artikel_video_id']) ? $artikel['artikel_video_id'] : "";
    $content     = isset($artikel['kontent']) ? $artikel['kontent'] : "";
    $url         = isset($artikel['url']) ? $artikel['url'] : "";
    $sumber      = isset($artikel['sumber']) ? $artikel['sumber'] : "";
    $pretty_url  = isset($artikel['pretty_url']) ? $artikel['pretty_url'] : "";
    $judul       = isset($artikel['judul']) ? $artikel['judul'] : "";
    $konten      = isset($artikel['konten']) ? $artikel['konten'] : "";
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
						<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
						<h2><?php echo $title_page ?> </h2>				
						
					</header>

					<!-- widget div-->
					<div>
						<!-- widget content -->
						<div class="widget-body no-padding">
							
							<form id="form" class="smart-form" method="POST" action="<?php echo site_url('admin/artikel_video/process_form') ?>">
								<?php if($id != '' ) :?>
									<input type="hidden" name="id" value="<?= $id ?>">
								<?php endif;?>
								<fieldset>
									<div class="row">
										<section class="col col-6">
											<label class="label">Judul<sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="judul" value="<?= $judul; ?>" placeholder="Judu Video">
											</label>
										</section>

										<section class="col col-6">
											<label class="label">Sumber</label>
											<label class="input"> 
												<input type="text" name="sumber" value="<?= $sumber; ?>" placeholder="Sumber Video">
											</label>
											<div class="note"> Jika video bukan milik sendiri mohon sertakan sumber pemilik asli.</div>
										</section>

										<section class="col col-6">
											<label class="label">Pretty URL (META SEO) <sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="pretty_url" value="<?= $pretty_url; ?>" placeholder="Pretty URL (Meta SEO)">
											</label>
											<div class="note">Seo title Auto generate(-)</div>
										</section>

										<section class="col col-6">
											<label class="label">URL video (source)<sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="url" value="<?= $url; ?>" placeholder="URL VIDEO">
											</label>
											<div class="note"> Link video. example: https:://youtube.com/asdadsadas (auto generate [embed])</div>

											<?php if(!empty($url)) :?>
												<iframe src="<?= $url; ?>" height="100%" scrolling="yes" width="100%" frameborder="0"></iframe>
											<?php endif;?>
										</section>
                                    </div>

		                            <div class="row">
										<section class="col col-lg-12">
											<label class="textarea"> 										
												<textarea id="mymarkdown" name="content" class="custom-scroll" style="max-height:180px;"><?= $konten  ?></textarea>
											</label>
										</section>
									</div>

									<footer>
										<button type="submit" class="btn  btn-submit btn-primary"> <i class="fa fa-save"></i>
											Save
										</button>
										<a href="<?= site_url() ?>admin/article-video" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
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