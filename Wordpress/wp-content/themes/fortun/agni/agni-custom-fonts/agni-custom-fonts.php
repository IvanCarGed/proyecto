<?php
/**
 * Custom font
 *
 * @author 		AgniHD
 * @package 	fortun/agni
 * @version     1.0
 */

require_once AGNI_THEME_FILES_DIR . '/agni-custom-fonts/agni-custom-fonts-upload.php';

// add submenu page 
function agni_custom_fonts_submenu_page()
{
	add_submenu_page( 'fortun', esc_html__( 'Custom Fonts', 'fortun' ), esc_html__( 'Custom Fonts', 'fortun' ), 'edit_theme_options', 'fortun-custom-fonts', 'agni_custom_fonts' );
}
add_action( 'admin_menu', 'agni_custom_fonts_submenu_page', 100 );

// get new upload directory to upload files
function agni_get_new_upload_dir( $dir ) {

	if( !empty($_POST['text']) ){
		$text = $_POST['text'];
		$text_dir = '/'.$text;
	}
    return array(
        'path'   => $dir['basedir'] . '/agni-fonts'.$text_dir,
        'url'    => $dir['baseurl'] . '/agni-fonts'.$text_dir,
        'subdir' => '/agni-fonts'.$text_dir,
    ) + $dir;
}

// overwrite files, if already exists.
function agni_font_file_overwrite($dir, $name, $ext){
    //return $name.$ext;
    return $name;
}

// create custom directory at wp-contents/uploads
function agni_custom_font_mkdir( $dir_name = null ){
	
	if ( ! file_exists( $dir_name ) ) {
	    wp_mkdir_p( $dir_name );
	}
}

// create & display form.
function agni_custom_fonts(){
	?>

	<div class="wrap">
		<h1><?php esc_html_e( 'Custom Webfonts', 'fortun' ); ?></h1>

		<?php
		$upload_dir = wp_upload_dir();
		$custom_dirname = 'agni-fonts';
		$file_dirname = $upload_dir['basedir'].'/'.$custom_dirname;
		$file_urlname = $upload_dir['baseurl'].'/'.$custom_dirname;
		agni_custom_font_mkdir( $file_dirname );

		?>
		<form action="admin.php?page=fortun-custom-fonts" method="post" enctype="multipart/form-data">
			<div>
				<h2><?php esc_html_e( 'Enter Font Name', 'fortun' ); ?></h2>
				<input type="text" name="text" required />
			</div><br />
			<div>
				<h3><?php esc_html_e( 'Upload Webfont Files', 'fortun' ); ?></h3>
				<p><?php esc_html_e( 'Tip. you can add multiple files at once .eot, .woff, .svg, .ttf, .otf supported.', 'fortun' ); ?></p>
				<input type="file" name="files[]" multiple required/>
			</div>
			<div>
				<p class="submit">
					<input class="button button-primary button-large agni-custom-fonts-submit" type="submit" value="Add Webfont" />
				</p>
			</div>
		</form><br />

		<?php agni_custom_fonts_upload(); 

		agni_custom_font_delete(); ?>

		<div>
			<h3><?php esc_html_e( 'Font List :', 'fortun' ); ?></h3>
			<p><?php esc_html_e( 'List of fonts in Custom Fonts directory.', 'fortun' ); ?></p>
		</div>
		
		<table class="widefat">
		<thead>
			<tr>
				<?php echo '<th>'.esc_html__( 'Font', 'fortun' ).'</th><th>'.esc_html__( 'Font Family', 'fortun' ).'</th><th>'.esc_html__( 'Manage', 'fortun' ).'</th>'; 
				?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<?php echo '<th>'.esc_html__( 'Font', 'fortun' ).'</th><th>'.esc_html__( 'Font Family', 'fortun' ).'</th><th>'.esc_html__( 'Manage', 'fortun' ).'</th>'; ?>
			</tr>
		</tfoot>
		<tbody>

		<?php if ($handle = opendir($file_dirname)) {
		    $blacklist = array('.', '..', '.DS_Store');
		    while (false !== ($file = readdir($handle))) {
		        if (!in_array($file, $blacklist)) {
		            //echo '<div>'.$file.'</div>';
		            echo '<tr><td><strong>';
			
					echo $file;
					
					echo '</strong></td><td><code>';
					
					echo $file;
					
					echo '</code></td><td>'; ?>

					<form action="admin.php?page=fortun-custom-fonts" method="post" >
						<input type="hidden" name="delete" value="<?php echo $file ?>">
						<input class="button-secondary delete" type="submit" value="Delete" />
					</form>

					<?php echo '</td></tr>';

		        }
		    }
		    closedir($handle);
		} ?>
		
		</tbody>
		
		</table><br/>

		<h3><?php esc_html_e( 'Font usage :', 'fortun' ); ?></h3>
		<p><?php echo sprintf( wp_kses( __( 'Add your desire CSS codes at <a href="%s">Custom CSS</a>', 'fortun' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( admin_url() . 'admin.php?page=fortun-theme-options&tab=29' ) );
		?></p>
		<pre class="agni-custom-font-usage" style="background-color: #fff; padding: 10px;"><?php 
		echo 'p {
  font-family: "Arial", sans-serif;
  font-weight: normal;
}'; ?></pre><br/>

		<h3 id="instructions"><?php esc_html__('Instructions', 'fortun'); ?></h3>
		<ol>
			<li><?php echo wp_kses(__( 'Generate the Webfont at <a href="https://www.web-font-generator.com/" target="blank">Web Font Generator</a>.', 'fortun' ), array( 'a' => array( 'href' => array() ) ) ); ?></li>
			<li><?php esc_html_e('In case, you\'ve few variations of same font, you should upload it with different name.', 'fortun'); ?></li>
		</ol>

	</div>
	<?php
}

function agni_custom_fonts_css( $args ){
	
	$font_dir_name = $font_dir_file_name = $style = '';
		
	$upload_dir = wp_upload_dir();
	$custom_dirname = 'agni-fonts';
	$file_dirname = $upload_dir['basedir'].'/'.$custom_dirname;
	$file_urlname = $upload_dir['baseurl'].'/'.$custom_dirname;

	wp_enqueue_style( 'agni-custom-font', AGNI_THEME_FILES_URL . '/assets/css/custom.css' );
	
	if( is_dir($file_dirname) ){
		if ($handle = opendir($file_dirname) ) {
		    $blacklist = array('.', '..', '.DS_Store');
		    while (false !== ($file_dir = readdir($handle))) {
		        if (!in_array($file_dir, $blacklist)) {

		            $style .= '@font-face { font-family: "'.$file_dir.'"; ';
		            
		            if ($filehandle = opendir($file_dirname.'/'.$file_dir)) {
						$blacklist = array('.', '..', '.DS_Store');
					    while (false !== ($file = readdir($filehandle))) {
					    	if (!in_array($file, $blacklist)) {

					            $file_ext = explode('.', $file);
					            $file_ext = end($file_ext);

							    if( $file_ext == 'eot' ){
							    	$style .= 'src: url("'.$file_urlname.'/'.$file_dir.'/'.$file.'"); ';
							    	$style .= 'src: url("'.$file_urlname.'/'.$file_dir.'/'.$file.'?#iefix") format("embedded-opentype"), ';
							    }
							    else{
								    if( $file_ext == 'woff' ){
								    	$style .= 'url("'.$file_urlname.'/'.$file_dir.'/'.$file.'") format("woff"), ';
								    }
								    else if( $file_ext == 'ttf' ){
								    	$style .= 'url("'.$file_urlname.'/'.$file_dir.'/'.$file.'") format("truetype"), ';
								    }
								    else if( $file_ext == 'otf' ){
								    	$style .= 'url("'.$file_urlname.'/'.$file_dir.'/'.$file.'") format("opentype"), ';
								    }
								    else if( $file_ext == 'svg' ){
								    	$style .= 'url("'.$file_urlname.'/'.$file_dir.'/'.$file.'") format("svg"), ';
								    }
								}

					        }

					    }
					    closedir($filehandle);
					}

					$style .= 'font-weight: normal; font-style: normal; }';

		        }
		    }
		    closedir($handle);
		}
	}

	$style = str_replace(', font-weight', '; font-weight', $style);

	wp_add_inline_style( 'agni-custom-font', $style );

}
add_action( 'wp_enqueue_scripts', 'agni_custom_fonts_css' );
