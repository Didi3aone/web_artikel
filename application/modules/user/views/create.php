<?php
    $id = isset($item['user_id']) ? $item['user_id'] : "";
    $name = isset($item['name']) ? $item['name'] : "";
    $username = isset($item['username']) ? $item['username'] : "";
    $email    = isset($item['email']) ? $item['email'] : "";
    $photo    = isset($item['photo']) ? $item['photo'] : "";

    $btn_msg  = ($id == 0) ? "Create" : "Update";
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
							
							<form id="form" class="smart-form" method="POST" action="<?php echo site_url('admin/user/process_form') ?>"  enctype="multipart/form-data">
								<?php if($id != '' ) :?>
									<input type="hidden" name="id" value="<?= $id ?>">
								<?php endif;?>
								<fieldset>
									<div class="row">
										<section class="col col-9">
											<label class="label">Full Name</label>
											<label class="input"> 
												<input type="text" name="name" value="<?= $name ?>" placeholder="Full Name">
											</label>
										</section>
										
										<section class="col col-9">
											<label class="label">Username</label>
											<label class="input"> 
												<input type="text" name="username" value="<?= $username ?>" placeholder="Username">
											</label>
										</section>
                                        <?php if($id == 0): ?>
										<section class="col col-9">
											<label class="label">Password</label>
											<label class="input"> 
												<input type="password" name="password" id="password" value="" placeholder="Password">
											</label>
										</section>

										<section class="col col-9">
											<label class="label">Confirm Password</label>
											<label class="input"> 
												<input type="password" name="conf_password" value="" placeholder="Confirm Password">
											</label>
										</section>
                                        <?php else : ?>

                                        <section class="col col-9">
											<label class="label">New Password</label>
											<label class="input"> 
												<input type="password" id="new_password" name="password" value="" placeholder="New Password">
											</label>
										</section>

										<section class="col col-9">
											<label class="label">Confirm New Password</label>
											<label class="input"> 
												<input type="password" name="conf_new_password" value="" placeholder="Confirm New Password">
											</label>
										</section>
										<?php endif; ?>

										<section class="col col-9">
											<label class="label">Email</label>
											<label class="input"> 
												<input type="email" name="email" value="<?= $email ?>" placeholder="Email">
											</label>
										</section>

										<section class="col col-9">
											<label class="label">Photo</label>
											<label class="input"> 
												<input type="file" name="photo">
											</label>
										</section>

										<section class="col col-9">
											<label class="label">User Level</label>
											<label class="select">
												<select name="role_id" id="role"></select>
											</label>
											<div class="note">Klik tombol plus untuk menambah user level, jika diperlukan</div>
											<br>
											<a data-toggle="modal" href="#myModal" class="btn btn-info btn-lg pull-left header-btn hidden-mobile" title="Add User Level"><i class="fa fa-plus"></i></a>
										</section>

									</div>

									<footer>
										<button type="submit" class="btn btn-submit btn-primary"> <i class="fa fa-save"></i>
											<?= $btn_msg ?>
										</button>
										<a href="<?= site_url() ?>admin/user" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h1>
					<?= $title_page ?> level
				</h1>
			</div>
			<div class="modal-body no-padding">

				<form id="level-form" method="post" action="<?= site_url('admin/user/process_form_level') ?>" class="smart-form">
                    <input type="hidden" name="id">
					<fieldset>
						<section>
							<div class="row">
								<label class="label col col-2">Level Name</label>
								<div class="col col-9">
									<label class="input"> 
										<input type="text" name="name">
									</label>
								</div>
							</div>
						</section>

						<section>
							<div class="row">
								<label class="label col col-2">Description</label>
								<div class="col col-10">
									<label class="input">
										<textarea name="desc" id="" cols="45"></textarea>
									</label>
								</div>
							</div>
						</section>

					</fieldset>
							
					<footer>
						<button type="submit" class="btn btn-primary btn-submit">
							<i class="fa fa-save"></i>Save
						</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Cancel
						</button>

					</footer>
				</form>						

			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->