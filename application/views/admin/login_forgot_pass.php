<div class="row">
	<div class="login-header">
		<div class="col-md-8">
			<div class="well no-padding">
				<form action="<?= site_url() ?>admin/auth/forgot_password" id="forgotpass-form" class="smart-form client-form" method="post">
					<header>
						Forgot Password
					</header>

					<fieldset>
						<?php if ($this->session->flashdata('message')): ?>
                        <section>
                            <div class="alert alert-danger alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <?php echo $this->session->flashdata('message'); ?>
                            </div>
                        </section>
                        <?php endif; ?>

						<section>
							<label class="label">Enter your email address</label>
							<label class="input"> <i class="icon-append fa fa-envelope"></i>
								<input type="email" name="email">
								<b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i> Please enter email address for password reset</b></label>
							</section>
							<section>
								<span class="timeline-seperator text-center text-primary"> <span class="font-sm">OR</span> 
							</section>
							<section>
								<div class="note">
									<a href="<?php echo site_url() ?>admin/auth">I remembered my password!</a>
								</div>
							</section>

						</fieldset>
						<footer>
							<button type="submit" class="btn btn-primary btn-submit">
								<i class="fa fa-refresh"></i> Reset Password
							</button>
						</footer>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>