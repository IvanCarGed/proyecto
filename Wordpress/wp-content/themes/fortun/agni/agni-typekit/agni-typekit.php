<?php
/**
 * Typekit font
 *
 * @author 		AgniHD
 * @package 	fortun/agni
 * @version     1.0
 */

function agni_typekit_embed_code()
{
	$agni_typekit_options = get_option( 'agni_typekit_options' );
	if ( $agni_typekit_options['agni_typekit_id'] != '' ) {
		wp_enqueue_script( 'agni-typekit-id-script', '//use.typekit.net/'. esc_attr( $agni_typekit_options['agni_typekit_id'] ).'.js', array( 'jquery' ), '', false );
		wp_add_inline_script( 'agni-typekit-id-script', 'try{Typekit.load();}catch(e){}' );
	}
}
add_action( 'wp_enqueue_scripts', 'agni_typekit_embed_code' );

// define default settings
function agni_typekit_add_defaults()
{
	$tmp = get_option( 'agni_typekit_options' );
	if ( !is_array( $tmp ) ) {
		$arr = array( 'agni_typekit_id' => '' );
		update_option( 'agni_typekit_options', $arr );
	}
}
register_activation_hook( __FILE__, 'agni_typekit_add_defaults' );


// whitelist settings
function agni_typekit_init()
{
	register_setting( 'agni_typekit_options', 'agni_typekit_options', 'agni_typekit_validate_options' );
}
add_action( 'admin_init', 'agni_typekit_init' );


// sanitize and validate input
function agni_typekit_validate_options( $input )
{
	$input['agni_typekit_id'] = wp_filter_nohtml_kses( $input['agni_typekit_id'] );
	return $input;
}

// add the options page
function agni_typekit_add_options_page()
{
	add_submenu_page('fortun', esc_html__( 'Typekit Fonts', 'fortun' ), esc_html__( 'TypeKit Fonts', 'fortun' ), 'edit_theme_options', 'fortun-typekit-font', 'agni_typekit_render_form' );
}
add_action( 'admin_menu', 'agni_typekit_add_options_page', 99 );


// create the options page
function agni_typekit_render_form()
{
	ob_start();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Typekit Fonts', 'fortun' ) ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'agni_typekit_options' ); ?>
			<?php $agni_typekit_options = get_option( 'agni_typekit_options' ); ?>

			<div class="form-table">
				<h2 class="agni-typekit-text-field-title"><?php esc_html_e( 'Enter Typekit Kit ID', 'fortun' ) ?></h2>
				<input class="agni-typekit-text-field" type="text" size="20" maxlength="20" name="agni_typekit_options[agni_typekit_id]" value="<?php echo esc_attr( $agni_typekit_options['agni_typekit_id'] ); ?>" style="padding: 15px 25px; border: 0; border-radius: 40px; background-color: #222; color: #fff; font-size: 20px;" />
				<p class="typekit-instruction"><?php echo wp_kses(__( 'See the instructions at <a href="#instructions" target="blank">bottom</a>', 'fortun' ), array( 'a' => array( 'href' => array() ) ) ); ?></p>
			</div>
			<p class="agni-typekit-form-submit submit">
				<input type="submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Save Typkit kit ID', 'fortun' ) ?>" />
			</p>
		</form><br/>
	
	<?php if ( $agni_typekit_options['agni_typekit_id'] != '' ) { ?>
		<h3><?php echo esc_html_e( 'Font List :', 'fortun' ); ?></h3>
		<p><?php echo esc_html_e( 'List of font you\'re using on Typekit.', 'fortun' ); ?></p>
		
		<?php
		$kit = esc_attr( $agni_typekit_options['agni_typekit_id'] );
		global $wp_filesystem;
		$json = $wp_filesystem->get_contents( 'http://typekit.com/api/v1/json/kits/' . $kit . '/published' );

		$kits = json_decode( $json );
		$fonts = array(); 
		?>
		
		<table class="widefat">
		<thead>
			<tr>
				<?php echo '<th>'.esc_html__( 'Font', 'fortun' ).'</th><th>'.esc_html__( 'Font Family', 'fortun' ).'</th><th>'.esc_html__( 'Variations', 'fortun' ).'</th><th>'.esc_html__( 'URL', 'fortun' ).'</th>'; ?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<?php echo '<th>'.esc_html__( 'Font', 'fortun' ).'</th><th>'.esc_html__( 'Font Family', 'fortun' ).'</th><th>'.esc_html__( 'Variations', 'fortun' ).'</th><th>'.esc_html__( 'URL', 'fortun' ).'</th>'; ?>
			</tr>
		</tfoot>
		<tbody>
		
		<?php
		// Need to remove the strong/code html and target with Table CSS Styles
		foreach ($kits->kit->families AS $fontFamily)
		{
			echo '<tr><td><strong>';
			
			echo esc_html( $fontFamily->name );
			
			echo '</strong></td><td><code>';
			
			echo esc_html( $fontFamily->slug );
			
			echo '</code></td><td>';
			
			$variations = $fontFamily->variations;
			
			// Dear Developers reading the following. I am SURE there is a better way to do the following, but at the time of writing this I couldn't think of it (especially due to be NOT REALLY being a plugin developer. I would love for you to let me know a better way. Better yet, make a pull request on the GitHub Repo for it. PS. I'm thinking like another foreach statement within the first one? With conditionals for stuff like Italic/Bold/etc.? Something like a switch is needed. Anyway, I'll worry about that real soon!
			$font_variations_list = '';
			foreach ( $variations as $variation => $value ){
				$font_variations_list .=  str_replace('n', '', $value).'00, ';
			}
			echo trim( $font_variations_list, ', ');
			echo '</td><td>';
			
			echo '<a href="http://typekit.com/fonts/' . $fontFamily->slug . '">';
			_e( 'View on Typekit', 'fortun' );
			echo '</a></td></tr>';
			
		}
		
		?>
		
		</tbody>
		
		</table><br/>	
	
	<?php } ?>

	<h3><?php esc_html_e( 'Font usage :', 'fortun' ); ?></h3>
	<p><?php echo sprintf( wp_kses( __( 'Add your desire CSS codes at <a href="%s">Custom CSS</a>', 'fortun' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( admin_url() . 'admin.php?page=fortun-theme-options&tab=29' ) ); ?></p>
	<pre class="agni-typekit-font-usage" style="background-color: #fff; padding: 10px;"><?php 
	echo 'p {
  font-family: "Arial", sans-serif;
  font-weight: 400;
  font-style: italic;
}'; ?></pre><br/>

	<h3 id="instructions"><?php esc_html_e('Instructions', 'fortun'); ?></h3>
	<ol>
		<li><?php echo wp_kses(__( 'Go to <a href="https://typekit.com/" target="blank">typekit.com</a> and register for an account', 'fortun' ), array( 'a' => array( 'href' => array() ) ) ); ?></li>
		<li><?php esc_html_e('Choose a few fonts to add to your account and Publish them', 'fortun'); ?></li>
		<li><?php esc_html_e('Click Kit Editor at the top right and get your Typekit kit ID(at the bottom)', 'fortun'); ?></li>
	</ol>
		
	</div>
<?php
	echo ob_get_clean();
}

// Omit closing PHP tag baby!