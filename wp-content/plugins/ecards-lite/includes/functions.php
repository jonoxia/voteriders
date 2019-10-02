<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function ecards_save($sender, $receiver) {
    global $wpdb;

    $ecards_stats_table = $wpdb->prefix . 'ecards_stats';
    $ecards_stats_now = date('Y-m-d');
    $cards_sent = 0;

    $wpdb->query("INSERT INTO $ecards_stats_table (date, sent) VALUES ('$ecards_stats_now', $cards_sent) ON DUPLICATE KEY UPDATE sent = sent + 1");

    $ecard_counter = get_option('ecard_counter');
    update_option('ecard_counter', ($ecard_counter + 1));

    $address_table = $wpdb->prefix . 'ecards_address_book';

    $wpdb->query("INSERT INTO $address_table (address, last_sent, sent_count, received_count)
                  VALUES ('$sender', '$ecards_stats_now', 1, 0)
                  ON DUPLICATE KEY UPDATE sent_count = sent_count + 1");
    $wpdb->query("INSERT INTO $address_table (address, last_sent, sent_count, received_count)
                  VALUES ('$receiver', '$ecards_stats_now', 0, 1)
                  ON DUPLICATE KEY UPDATE received_count = received_count + 1");
}

function ecards_return_image_sizes() {
    global $_wp_additional_image_sizes;

    $image_sizes = array();
    foreach(get_intermediate_image_sizes() as $size) {
        $image_sizes[$size] = array(0, 0);
        if(in_array($size, array('thumbnail', 'medium', 'large'))) {
            $image_sizes[$size][0] = get_option($size . '_size_w');
            $image_sizes[$size][1] = get_option($size . '_size_h');
        }
        else 
            if(isset($_wp_additional_image_sizes) && isset($_wp_additional_image_sizes[$size]))
                $image_sizes[$size] = array($_wp_additional_image_sizes[$size]['width'], $_wp_additional_image_sizes[$size]['height']);
    }
    return $image_sizes;
}

function ecards_shortcode_fix() {
    add_filter('the_content', 'do_shortcode', 9);
}

function ecards_set_content_type($content_type) {
    return 'text/html';
}

function ecard_checkSpam($content) {
	// innocent until proven guilty
	$isSpam = FALSE;
	$content = (array)$content;

	if(function_exists('akismet_init') && get_option('ecard_use_akismet') == 'true') {
		$wpcom_api_key = get_option('wordpress_api_key');

		if(!empty($wpcom_api_key)) {
			global $akismet_api_host, $akismet_api_port;

			// set remaining required values for akismet api
			$content['user_ip'] = preg_replace('/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR']);
			$content['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			$content['referrer'] = $_SERVER['HTTP_REFERER'];
			$content['blog'] = get_option('home');

			if(empty($content['referrer'])) {
				$content['referrer'] = get_permalink();
			}

			$queryString = '';

			foreach($content as $key => $data) {
				if(!empty($data)) {
					$queryString .= $key . '=' . urlencode(stripslashes($data)) . '&';
				}
			}

			$response = Akismet::http_post($queryString, 'comment-check');

			if($response[1] == 'true') {
				update_option('akismet_spam_count', get_option('akismet_spam_count') + 1);
				$isSpam = TRUE;
			}
		}
	}
	return $isSpam;
}

function eCardsGetVersion() {
    $eCardsPluginPath = plugin_dir_path(__DIR__);
    $eCardsData = get_plugin_data($eCardsPluginPath . 'ecards-lite.php');

    return (string) $eCardsData['Version'];
}

function eCardsExportCsv() {
    // Create CSV download of email addresses stored in the database
    global $wpdb;

    $table_name = $wpdb->prefix . 'ecards_address_book';

    $sql = "SELECT DISTINCT(address) FROM " . $table_name . ";";
    
    $results =  $wpdb->get_results($sql);
    $addresses = array();
    foreach( $results as $row) {
        if (strpos($row->address, '@') == false) {
            continue;
        }
        $addresses[] = $row->address;
    }
    $content = "email_address\n" . join("\n", $addresses);

    ob_clean(); // we have already  generated part of the admin page by the time this
    // function has been called, so that admin page text would be part of the output file.
    // ob_clean forcibly deletes what's already in the output buffer to prevent this.
    // It's inelegant but it works.
    header('Pragma: no-cache');
    header('Expires: 0');
    header('Content-Type: application/csv'); 
    // header("Content-length: " . filesize($NewFile)); 
    header('Content-Disposition: attachment; filename="ecard_email_address_archive.csv"');

    $fp = fopen("php://output", "w");
    fputs($fp, $content);
    fclose($fp);
    // Be sure to call exit; after this so that the page's closing tags don't go into the
    // csv download stream.
}
