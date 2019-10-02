<?php
if(!defined('ABSPATH')) exit; // Exit if accessed directly

function ecard_options_page() {
    global $ecard_version;

	$ecard_counter = get_option('ecard_counter');

    if (isset($_POST['download_email_addresses'])) {
      eCardsExportCsv();
      exit;
    }
	if(isset($_POST['info_settings_update'])) {
		update_option('ecard_label', sanitize_text_field($_POST['ecard_label']));

        update_option('ecard_image_size', sanitize_text_field($_POST['ecard_image_size']));
        update_option('ecard_shortcode_fix', sanitize_text_field($_POST['ecard_shortcode_fix']));
        update_option('ecard_html_fix', sanitize_text_field($_POST['ecard_html_fix']));

		update_option('ecard_use_akismet', sanitize_text_field($_POST['ecard_use_akismet']));

        echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Options updated successfully!', 'ecards-lite') . '</p></div>';
	}
	if(isset($_POST['info_payment_update'])) {
		update_option('ecard_restrictions', sanitize_text_field($_POST['ecard_restrictions']));
		update_option('ecard_restrictions_message', sanitize_text_field($_POST['ecard_restrictions_message']));

        echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Options updated successfully!', 'ecards-lite') . '</p></div>';
	}
	if(isset($_POST['info_email_update'])) {
		update_option('ecard_noreply', sanitize_email($_POST['ecard_noreply']));
		update_option('ecard_behaviour', sanitize_text_field($_POST['ecard_behaviour']));
		update_option('ecard_link_anchor', sanitize_text_field($_POST['ecard_link_anchor']));

		update_option('ecard_title', $_POST['ecard_title']);
		update_option('ecard_body_additional', esc_html($_POST['ecard_body_additional']));
		update_option('ecard_body_footer', sanitize_text_field($_POST['ecard_body_footer']));

		update_option('ecard_body_toggle', sanitize_text_field($_POST['ecard_body_toggle']));

		update_option('ecard_send_behaviour', sanitize_text_field($_POST['ecard_send_behaviour']));
		update_option('ecard_hardcoded_email', sanitize_email($_POST['ecard_hardcoded_email']));

        echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Options updated successfully!', 'ecards-lite') . '</p></div>';
	}
	if(isset($_POST['info_labels_update'])) {
	    update_option('ecard_label_name_own', stripslashes(sanitize_text_field($_POST['ecard_label_name_own'])));
	    update_option('ecard_label_email_own', stripslashes(sanitize_text_field($_POST['ecard_label_email_own'])));
	    update_option('ecard_label_email_friend', stripslashes(sanitize_text_field($_POST['ecard_label_email_friend'])));
	    update_option('ecard_label_message', stripslashes(sanitize_text_field($_POST['ecard_label_message'])));
	    update_option('ecard_label_success', sanitize_text_field($_POST['ecard_label_success']));
		update_option('ecard_submit', stripslashes(sanitize_text_field($_POST['ecard_submit'])));

        echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Options updated successfully!', 'ecards-lite') . '</p></div>';
	}
	if(isset($_POST['info_debug_update'])) {
		$headers = '';
		$headers[] = "Content-Type: text/html;";
        if(!empty($_POST['ecard_test_email']) && wp_mail($_POST['ecard_test_email'], 'eCards test email', 'Testing eCards plugin...', $headers)) {
            echo '<div id="message" class="updated notice is-dismissible"><p>Mail sent successfully. Check your inbox.</p></div>';
        } else {
            echo '<div id="message" class="updated notice notice-error is-dismissible"><p>Mail not sent. Check your server configuration.</p></div>';
        }

		echo '<div id="message" class="updated notice is-dismissible"><p>Options updated successfully!</p></div>';
	}
	?>
	<div class="wrap">
		<h2>eCards Lite</h2>

		<?php
        $ecard_noreply = get_option('ecard_noreply');
        if(empty($ecard_noreply)) {
            echo '<div id="message" class="error notice is-dismissible"><p>' . __('You have not set a dedicated email address for eCards! <a href="' . admin_url('options-general.php?page=ecards&tab=ecards_email') . '">Click here</a> to set it.', 'ecards-lite') . '</p></div>';
        }

		$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'ecards_dashboard';
		if(isset($_GET['tab']))
			$active_tab = $_GET['tab'];
		?>
		<h2 class="nav-tab-wrapper">
			<a href="?page=ecards&amp;tab=ecards_dashboard" class="nav-tab <?php echo $active_tab === 'ecards_dashboard' ? 'nav-tab-active' : ''; ?>"><?php _e('Dashboard', 'ecards-lite'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_settings" class="nav-tab <?php echo $active_tab === 'ecards_settings' ? 'nav-tab-active' : ''; ?>"><?php _e('Settings', 'ecards-lite'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_email" class="nav-tab <?php echo $active_tab === 'ecards_email' ? 'nav-tab-active' : ''; ?>"><?php _e('Email Options', 'ecards-lite'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_payment" class="nav-tab <?php echo $active_tab === 'ecards_payment' ? 'nav-tab-active' : ''; ?>"><?php _e('Restrictions &amp; Payment', 'ecards-lite'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_labels" class="nav-tab <?php echo $active_tab === 'ecards_labels' ? 'nav-tab-active' : ''; ?>"><?php _e('Labels', 'ecards-lite'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_diagnostics" class="nav-tab <?php echo $active_tab === 'ecards_diagnostics' ? 'nav-tab-active' : ''; ?>"><?php _e('Diagnostics', 'ecards-lite'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_pro" class="nav-tab <?php echo $active_tab === 'ecards_pro' ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-star-filled dashicons-ecards-pro"></span> <?php _e('Get PRO Version', 'ecards-lite'); ?></a>
		</h2>
		<?php if($active_tab === 'ecards_dashboard') { ?>
            <?php
            echo '<div id="gb-ad">
                <h3 class="gb-handle"><span class="dashicons dashicons-heart"></span> Thank you for using eCards!</h3>
                <div id="gb-ad-content">
                    <div class="inside">
                        <img src="' . plugins_url('img/gb-logo-white-512.png', dirname(__FILE__)) . '" alt="getButterfly">

                        <hr>
                        <p>If you enjoy this plugin, do not forget to rate it on CodeCanyon! We work hard to update it, fix bugs, add new features and make it compatible with the latest web technologies.</p>
                    </div>
                    <div class="gb-footer">
                        <p>For support, feature requests and bug reporting, please visit the <a href="https://getbutterfly.com/wordpress-plugins/wordpress-ecards-plugin/" rel="external">official website</a>. <a href="https://getbutterfly.com/members/documentation/ecards/" class="gb-documentation">eCards Documentation</a>.<br>&copy;' . date('Y') . ' <a href="https://getbutterfly.com/" rel="external"><strong>getButterfly</strong>.com</a> &middot; <small>Code wrangling since 2005</small></p>
                    </div>
                </div>
            </div>';
            ?>

            <div id="poststuff">
                <div class="postbox">
                    <h2>About WordPress eCards</h2>
                    <div class="inside">
                        <p>
                            You are using <b>eCards</b> version <b><?php echo eCardsGetVersion(); ?></b> <span class="ecards-lite-icon">LITE</span> with <b><?php bloginfo('charset'); ?></b> charset.<br>
                            <small>You are using PHP version <?php echo PHP_VERSION; ?> and MySQL version <?php global $wpdb; echo $wpdb->db_version(); ?>.</small><br>
                            <b><?php echo $ecard_counter; ?></b> total eCards sent!
                        </p>

						<h3>Summary and usage examples (shortcodes and template tags)</h3>
                        <p>eCards plugin uses one shortcode: <code>[ecard]</code> for all image types (JPG, PNG, GIF). Adding eCards to a post or a page is accomplished by uploading one or more images for the <code>[ecard]</code> shortcode. Images should be uploaded directly to the post or page, not from the <b>Media Library</b>. Inserting the images is not necessary, as the plugin creates the eCard automatically.</p>

                        <p>
                            <small>1.</small> Add the <code>[ecard]</code> shortcode to a post or a page or call the function from a template file:<br>
                            <code>&lt;?php if(function_exists('display_ecardMe')) echo display_ecardMe(); ?&gt;</code>
                        </p>
                        <p>
                            <small>2.</small> Use the <code>[ecard_counter]</code> shortcode to display the number of eCards sent or call the function from a template file (example: <code>[ecard_counter]</code> eCards sent so far!):<br>
                            <code>&lt;?php if(function_exists('display_ecardCounter')) echo display_ecardCounter(); ?&gt;</code>
                        </p>
                        <p><small>3.</small> Use <code>noselect</code> as ALT text for attached images you do not want included as eCards.</p>

                        <h3>Styling examples (CSS classes)</h3>
						<p>Use <code>.ecard-confirmation</code> class to style the confirmation message, use <code>.ecard-error</code> class to style the error message.</p>

						<p>Use <code>.ecards</code> class as a selector for lightbox plugins. Based on your plugin configuration, you can also use <code>.ecard a</code> as a selector.</p>
					</div>
                    <div>
                      <form method="post" action="">
                        <input type="hidden" name="download_email_addresses">
                        <input type="submit" value="Download Email Addresses (CSV)">
                      </form>
				</div>
			</div>
        <?php } if($active_tab === 'ecards_pro') { ?>
            <div id="poststuff">
                <div class="postbox">
                    <div class="inside">
                        <p>You are using <b>eCards</b> version <b><?php echo eCardsGetVersion(); ?></b> <span class="ecards-lite-icon">LITE</span> with <b><?php bloginfo('charset'); ?></b> charset, PHP version <?php echo PHP_VERSION; ?> and MySQL version <?php global $wpdb; echo $wpdb->db_version(); ?>.</p>

                        <h2 class="gbad-pro-title">Get the <span class="ecards-pro-icon">PRO</span> version of eCards Lite and get access to many new and useful features!</h2>

                        <ul class="gbad-pro-list">
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> <b>6 months support</b></li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> <b>PayPal&trade; payment integration</b></li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> <b>User uploads</b></li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> <b>Dropbox upload integration</b></li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> <b>eCard designer</b></li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> <b>Advaned display options (carousel/Masonry)</b></li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> Redirection (send users to a special "Thank You" page after sending an eCard)</li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> eCard users (create user after sending an eCard)</li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> Include post/page content (useful if you have a certain eCard "story" or message you want to convey)</li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> Allow the sender to CC self</li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> eCard scheduling</li>
                            <li><span class="dashicons dashicons-yes dashicons-ecards-pro"></span> eCard CPT (developers only)</li>
                        </ul>

                        <p>
                            <a href="https://codecanyon.net/item/wordpress-ecards/1051966" rel="external" class="button button-primary button-hero">Get it!</a> &nbsp;
                            <a href="https://getbutterfly.com/wordpress-plugins/wordpress-ecards-plugin/" rel="external">More information</a>
                        </p>

                        <p>Note that all your current settings will be preserved.</p>
                    </div>
                </div>
            </div>
        <?php } if($active_tab === 'ecards_settings') { ?>
			<form method="post" action="">
    			<h3 class="title"><?php _e('eCards Settings', 'ecards-lite'); ?></h3>

    		    <table class="form-table">
    		        <tbody>
    		            <tr>
    		                <th scope="row"><label for="ecard_label">eCard behaviour</label></th>
    		                <td>
								<select name="ecard_label" id="ecard_label" class="regular-text">
									<option value="0"<?php if(get_option('ecard_label') == 0) echo ' selected'; ?>>Use source (large image) for eCard thumbnail</option>
									<option value="1"<?php if(get_option('ecard_label') == 1) echo ' selected'; ?>>Use label behaviour for eCard thumbnail</option>
								</select>
                                <br><small>Choose what happens when users click on eCards.</small>
    		                </td>
    		            </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_use_akismet">Akismet settings</label></th>
    		                <td>
								<select name="ecard_use_akismet" id="ecard_use_akismet" class="regular-text">
									<option value="true"<?php if(get_option('ecard_use_akismet') === 'true') echo ' selected'; ?>>Use Akismet (recommended)</option>
									<option value="false"<?php if(get_option('ecard_use_akismet') === 'false') echo ' selected'; ?>>Do not use Akismet</option>
								</select>
    							<?php
    							if(function_exists('akismet_init')) {
    								$wpcom_api_key = get_option('wordpress_api_key');
    
    								if(!empty($wpcom_api_key)) {
    									echo '<p><small>Your Akismet plugin is installed and working properly. Your API key is <code>' . $wpcom_api_key . '</code>.</small></p>';
    								}
    								else {
    									echo '<p><small>Your Akismet plugin is installed but no API key is present. Please fix it.</small></p>';
    								}
    							}
    							else {
    								echo '<p><small>You need Akismet in order to send eCards. Please install/activate it.</small></p>';
    							}
    							?>
    		                </td>
    		            </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_image_size">eCard image size<br><small>(default/recommended is <b>thumbnail</b>)</small></label></th>
    		                <td>
                                <?php $image_sizes = get_intermediate_image_sizes(); ?>
                                <select name="ecard_image_size" id="ecard_image_size">
                                    <option value="<?php echo get_option('ecard_image_size'); ?>"><?php echo get_option('ecard_image_size'); ?></option>
                                    <?php
                                    $options = get_option('ecard_image_size');
                                    $thumbsize = isset($options['thumb_size_box_select']) ? esc_attr( $options['thumb_size_box_select']) : '';
                                    $image_sizes = ecards_return_image_sizes();
                                    foreach($image_sizes as $size => $atts) { ?>
                                        <option value="<?php echo $size ;?>" <?php selected($thumbsize, $size); ?>><?php echo $size . ' - ' . implode('x', $atts); ?></option>
                                    <?php } ?>
                                </select>
                                <br><small>Add more image sizes using third-party plugins.</small>
                                <br><small><b>Note that adding custom sizes may require thumbnail regeneration.</b> We recommend the <a href="https://wordpress.org/plugins/force-regenerate-thumbnails/">Force Regenerate Thumbnails</a> plugin (free).</small>
    		                </td>
    		            </tr>
                        <tr><td colspan="2"><hr></td></tr>
    		            <tr>
    		                <th scope="row"><label>Debugging<br><small>(developers only)</small></label></th>
    		                <td>
                                <p>
                                    <input name="ecard_shortcode_fix" id="ecard_shortcode_fix" type="checkbox"<?php if(get_option('ecard_shortcode_fix') === 'on') echo ' checked'; ?>> <label for="ecard_shortcode_fix">Apply content shortcode fix</label>
                                    <br><small>Only use this option if your WordPress version is old, or you have a buggy theme and the shortcode is not working.</small>
                                </p>
                                <p>
                                    <input name="ecard_html_fix" id="ecard_html_fix" type="checkbox"<?php if(get_option('ecard_html_fix') === 'on') echo ' checked'; ?>> <label for="ecard_html_fix">Apply HTML content type fix</label>
                                    <br><small>Only use this option if your emails are missing formatting and line breaks.</small>
                                </p>
    		                </td>
    		            </tr>
    		        </tbody>
    		    </table>

                <hr>
                <p><input type="submit" name="info_settings_update" class="button button-primary" value="Save Changes"></p>
			</form>
		<?php } if($active_tab === 'ecards_payment') { ?>
			<form method="post" action="">
    			<h3 class="title"><?php _e('eCards Restrictions and Payment', 'ecards-lite'); ?></h3>
                <p>Restricting access to members only does not require payment. It only requires a user to be logged into your WordPress site.</p>
    		    <table class="form-table">
    		        <tbody>
    		            <tr>
    		                <th scope="row"><label for="ecard_restrictions">Member restrictions</label></th>
    		                <td>
								<select name="ecard_restrictions">
									<option value="0"<?php if(get_option('ecard_restrictions') === '0') echo ' selected'; ?>>Do not restrict access to eCard form</option>
									<option value="1"<?php if(get_option('ecard_restrictions') === '1') echo ' selected'; ?>>Restrict access to members only</option>
								</select> <label for="ecard_restrictions_message">Add a guest message below, if you restrict access to members only.</label>

								<?php wp_editor(get_option('ecard_restrictions_message'), 'ecard_restrictions_message', array('teeny' => true, 'textarea_rows' => 5, 'media_buttons' => false)); ?>
    		                </td>
    		            </tr>
    		        </tbody>
    		    </table>

                <hr>
				<p><input type="submit" name="info_payment_update" class="button button-primary" value="Save Changes"></p>
			</form>
		<?php } if($active_tab === 'ecards_email') { ?>
    		<form method="post" action="">
    			<h3 class="title"><?php _e('Email Settings', 'ecards-lite'); ?></h3>
                <p><b>Note:</b> To avoid your email adress being marked as spam, it is highly recommended that your "from" domain match your website. Some hosts may require that your "from" address be a legitimate address. Use a plugin to set custom <b>From Name</b> and <b>From Email</b> headers. We recommend <a href="https://wordpress.org/plugins/wp-mailfrom-ii/" rel="external">WP Mail From II</a>.</p>

                <p>Sometimes emails end up in your spam (or junk) folder. Sometimes they don't arrive at all. While the latter may indicate a server issue, the former may easily be fixed by setting up an email address (ecards@yourdomain.com or noreply@yourdomain.com) and use a third-party plugin to override email options (<b>From Name</b> and <b>From Email</b>).</p>

                <p>If your host blocks the <code>mail()</code> function, or if you notice errors or restrictions, configure your WordPress site to use SMTP. We recommend <a href="https://wordpress.org/plugins/post-smtp/" rel="external">Post SMTP Mailer/Email Log</a>.</p>
                <div class="postbox">
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th scope="row"><label for="ecard_noreply">Dedicated email address</label></th>
                                    <td>
                                        <input name="ecard_noreply" id="ecard_noreply" type="email" class="regular-text" value="<?php echo get_option('ecard_noreply'); ?>">
                                        <br><small>Create a dedicated email address to use for sending eCards and prevent your messages landing in Spam/Junk folders.<br>Use <code>noreply@yourdomain.com</code>, <code>ecards@yourdomain.com</code> or something similar.</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <table class="form-table">
    		        <tbody>
    		            <tr>
    		                <th scope="row"><label for="ecard_behaviour">Email behaviour</label></th>
    		                <td>
                                <select name="ecard_behaviour" class="regular-text">
                                    <option value="1"<?php if(get_option('ecard_behaviour') === '1') echo ' selected'; ?>>Show eCard inside email message (show link to source) (recommended)</option>
								    <option value="5"<?php if(get_option('ecard_behaviour') === '5') echo ' selected'; ?>>Show eCard inside email message (hide link to source)</option>
								    <option value="0"<?php if(get_option('ecard_behaviour') === '0') echo ' selected'; ?>>Hide eCard inside email message (show link to source)</option>
                                    <option value="2"<?php if(get_option('ecard_behaviour') === '2') echo ' selected'; ?>>Hide both eCard and link to source</option>
                                </select>
				            </td>
				        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_send_behaviour">Sending behaviour</label></th>
    		                <td>
                                <select name="ecard_send_behaviour" class="regular-text">
									<option value="1"<?php if(get_option('ecard_send_behaviour') === '1') echo ' selected'; ?>>Require recipient email address</option>
									<option value="0"<?php if(get_option('ecard_send_behaviour') === '0') echo ' selected'; ?>>Hide recipient and send all eCards to the following email address</option>
								</select>
                                <br>&lfloor; <input name="ecard_hardcoded_email" type="email" class="regular-text" value="<?php echo get_option('ecard_hardcoded_email'); ?>">
								<br><small>If you want to send all eCards to a universal email address, select the option above and fill in the email address.</small>
				            </td>
				        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_title">Email subject</label></th>
    		                <td>
								<input name="ecard_title" id="ecard_title" type="text" class="regular-text" value="<?php echo get_option('ecard_title'); ?>">
								<br><small>This is the subject of the eCard email.</small>
				            </td>
				        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_body_additional">Email body</label></th>
    		                <td>
                                <?php wp_editor(get_option('ecard_body_additional'), 'ecard_body_additional', array('teeny' => true, 'textarea_rows' => 10, 'media_buttons' => false)); ?>
                                <br><small>This content will appear below the eCard image. Use it to promote your web site or to add custom links.</small>
				            </td>
				        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_body_toggle">Message area</label></th>
    		                <td>
                                <select name="ecard_body_toggle" id="ecard_body_toggle" class="regular-text">
									<option value="1"<?php if(get_option('ecard_body_toggle') === '1') echo ' selected'; ?>>Show message area (default)</option>
									<option value="0"<?php if(get_option('ecard_body_toggle') === '0') echo ' selected'; ?>>Hide message area</option>
								</select>
								<br><small>Show or hide the message textarea. Use it for &quot;Tip a friend&quot; type email message.</small>
				            </td>
				        </tr>
				    </tbody>
				</table>

                <hr>
    			<p><input type="submit" name="info_email_update" class="button button-primary" value="Save Changes"></p>
			</form>
		<?php } if($active_tab === 'ecards_labels') { ?>
			<form method="post" action="">
    			<h3 class="title"><?php _e('Labels', 'ecards-lite'); ?></h3>
    			<p>Use the labels to personalize or translate your eCards form.</p>
    		    <table class="form-table">
    		        <tbody>
    		            <tr>
    		                <th scope="row"><label for="ecard_label_name_own">Your name<br><small>(input label)</small></label></th>
    		                <td>
                                <input name="ecard_label_name_own" id="ecard_label_name_own" type="text" class="regular-text" value="<?php echo get_option('ecard_label_name_own'); ?>">
                                <br><small>Default is "Your name"</small>
                            </td>
                        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_label_email_own">Your email address<br><small>(input label)</small></label></th>
    		                <td>
                                <input name="ecard_label_email_own" id="ecard_label_email_own" type="text" class="regular-text" value="<?php echo get_option('ecard_label_email_own'); ?>">
                                <br><small>Default is "Your email address"</small>
                            </td>
                        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_label_email_friend">Your friend's email address<br><small>(input label)</small></label></th>
    		                <td>
                                <input name="ecard_label_email_friend" id="ecard_label_email_friend" type="text" class="regular-text" value="<?php echo get_option('ecard_label_email_friend'); ?>">
                                <br><small>Default is "Your friend's email address"</small>
                            </td>
                        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_label_message">eCard message<br><small>(textarea label)</small></label></th>
    		                <td>
                                <input name="ecard_label_message" id="ecard_label_message" type="text" class="regular-text" value="<?php echo get_option('ecard_label_message'); ?>">
                                <br><small>Default is "eCard message"</small>
                            </td>
                        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_label_success">Success message<br><small>(paragraph)</small></label></th>
    		                <td>
                                <input name="ecard_label_success" id="ecard_label_success" type="text" class="regular-text" value="<?php echo get_option('ecard_label_success'); ?>">
                                <br><small>Default is "eCard sent successfully!"</small>
                            </td>
                        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_submit">eCard submit<br><small>(button label)</small></label></th>
    		                <td>
                                <input id="ecard_submit"name=" ecard_submit" type="text" class="regular-text" value="<?php echo get_option('ecard_submit'); ?>">
                            </td>
                        </tr>
                    </tbody>
                </table>

				<hr>
				<p><input type="submit" name="info_labels_update" class="button button-primary" value="Save Changes"></p>
			</form>
		<?php } if($active_tab === 'ecards_diagnostics') { ?>
			<form method="post" action="">
    			<h3 class="title"><?php _e('Diagnostics', 'ecards-lite'); ?></h3>
                <p>Try using <a href="https://wordpress.org/plugins/wp-mail-smtp/" rel="external">WP Mail SMTP</a> plugin (free) if <code>wp_mail()</code> is not working.</p>
    		    <table class="form-table">
    		        <tbody>
    		            <tr>
    		                <th scope="row"><label for="ecard_test_email">Test <code>wp_mail()</code> function</label></th>
    		                <td>
                                <input name="ecard_test_email" id="ecard_test_email" type="email" class="regular-text" value="<?php echo get_option('admin_email'); ?>">
                                <br><small>Use this address to send a test email message.</small>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <p><input type="submit" name="info_debug_update" class="button button-primary" value="Test/Save Changes"></p>
			</form>
		<?php } ?>
	</div>
<?php }
