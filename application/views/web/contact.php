<div class="col-md-9 technology-left">
			<div class="contact-section">
				<h2 class="w3">CONTACT</h2>
					
				
					<div class="contact-grids">
						<div class="col-md-8 contact-grid">
							
							<p>Kritik dan masukan sangat berarti bagi kami , sebagai bahan motivasi dan berbuat bertanggung jawab lebih baik lagi</p>
							<form action="<?php echo site_url('contact/kirim_Pesan') ?>" method="post">
								<input type="text" name="nama" value="" required="">
								<input type="email" name="email" value="" required="">
								<textarea type="text" name="pesan" required=""></textarea>
								<input type="submit" value="">
							</form>
						</div>
						<div class="col-md-4 contact-grid1">
							<h4>Address</h4>
							<div class="contact-top">
								
								
								<div class="clearfix"></div>
							</div>
							<ul>
									<!-- <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> Office : 0041-456-3692</li> -->
									<li><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Mobile : 08979392113</li>
									<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> <a href="#"></a><a href="mailto:info@example.com">pejuangsubuh17@gmail.com</a></li>
									<!-- <li><i class="glyphicon glyphicon-print" aria-hidden="true"></i> Fax : 0091-789-456100</li> -->
								</ul>

						</div>
						<div class="clearfix"></div>
					</div>
					<div class="google-map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.23179082745!2d107.8753029502983!3d-6.364040864004798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6948be1504a405%3A0x222ecc7156310d83!2sJl.+Pusakanegara+-+Subang%2C+Compreng%2C+Kabupaten+Subang%2C+Jawa+Barat+41258!5e0!3m2!1sid!2sid!4v1507045378969" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				
			</div>
		</div>
		<?php $this->load->view('web/popular_post')?>