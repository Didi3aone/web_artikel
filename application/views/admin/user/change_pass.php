<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
			<h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
		</div>
	</div>

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <div class="row">
            <!-- NEW WIDGET ROW START -->
            <article class="col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil-square-o"></i> </span>
                        <h2>Change Password</h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <form class="smart-form" id="form" action="<?= site_url() ?>admin/user/change_password_process" method="post">
                            <fieldset>
                                 <section>
                                    <label class="label">Old Password <sup class="color-red">*</sup></label>
                                    <label class="input">
                                        <input type="password" name="password">
                                    </label>
                                </section>

                                <section>
                                    <label class="label">New Password <sup class="color-red">*</sup></label>
                                    <label class="input">
                                        <input name="new_password" id="new_password" type="password" />
                                    </label>
                                </section>

                                <section>
                                    <label class="label">Confirm Password <sup class="color-red">*</sup></label>
                                    <label class="input">
                                        <input name="confirm_password" id="confirm_password" type="password" />
                                    </label>
                                </section>

                            </fieldset>

                            <footer>
								<button type="submit" class="btn btn-primary btn-submit">
									<i class="fa fa-save"></i>Save
								</button>
								<a href="<?= site_url() ?>admin/user" class="btn btn-danger"><i class="fa fa-arrow-left"></i>Cancel</a>
							</footer>
                        </form>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </article>
        </div>
    </section> <!-- end widget grid -->
</div> <!-- END MAIN CONTENT -->
