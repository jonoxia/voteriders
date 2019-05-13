<header id="header" class="header<?php echo esc_attr($header_type_class); ?>">

	<div class="header-top">

		<div class="row">

			<div class="large-12 columns">

				
			</div>

		</div><!--/ .row-->

	</div><!--/ .header-top-->

	<div class="header-middle">

		<div class="row">

			<div class="large-12 columns">
				<div class="header-middle-entry">

					<?php get_template_part('header', 'logo'); ?>

					<div class="account">

						<?php if (TMM::get_option('show_login_buttons') !== '0') { ?>

						<ul>
							<?php if (is_user_logged_in()) { ?>
								<li class="lock"><a href="<?php echo wp_logout_url(get_home_url()); ?>"><?php esc_html_e('Log out', 'diplomat'); ?></a></li>
							<?php } else { ?>
								<li data-login="loginDialog" class="lock"><a href="#"><?php esc_html_e('Log in', 'diplomat'); ?></a></li>
								<li data-account="accountDialog" class="user"><a href="#"><?php esc_html_e('Create Account', 'diplomat'); ?></a></li>
							<?php } ?>
						</ul>

						<?php } ?>

						<!-- - - - - - - - - - - - - Donate Button - - - - - - - - - - - - - - -->

							<?php get_template_part('header', 'donate'); ?>

						<!-- - - - - - - - - - - - - end Donate Button - - - - - - - - - - - - -->

					</div>

				</div>
			</div>

		</div><!--/ .row-->

	</div><!--/ .header-middle-->

	<div class="header-bottom">

		<div class="row">

			<div class="large-12 columns">


			</div>

		</div><!--/ .row-->

	</div><!--/ .header-bottom-->

</header><!--/ #header-->
