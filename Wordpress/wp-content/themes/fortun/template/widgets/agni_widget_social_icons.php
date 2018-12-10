<?php
/**
 * Fortun Social Icon Widget
 *
 * @author 		AgniHD
 * @package 	fortun/templates/widgets
 * @version     1.0
 */

class fortun_social_icons extends WP_Widget {

	public function __construct(){
 
		parent::__construct(
			'fortun_social_icons',
			esc_html__( 'Fortun: Social Icons', 'fortun' ),
				array(
					'classname'   => 'widget_fortun_social_icons',
					'description' => esc_html__( 'A set of social icons to display social media links. This is designed only for fortun.', 'fortun' )
				)
			);			
	   
	}

	public function widget( $args, $instance ) {

		global $fortun_options;
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$googleplus = $instance['googleplus'];
		$dribbble = $instance['dribbble'];
		$instagram = $instance['instagram'];
		$behance = $instance['behance'];
		$tumblr = $instance['tumblr'];
		$flickr = $instance['flickr'];
		$pinterest = $instance['pinterest'];
		$youtube = $instance['youtube'];
		$snapchat = $instance['snapchat'];
		$soundcloud = $instance['soundcloud'];
		$vimeo = $instance['vimeo'];
		$linkedin = $instance['linkedin'];
				
		echo wp_kses_post( $before_widget );
		
		if ( $title )
			echo wp_kses( $before_title . $title . $after_title, array( 'h5' => array( 'class' => array() ), 'div' => array( 'class' => array() ) ) );

		?>		
        <ul class="list-inline">
            <?php if($facebook) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'facebook-link' ] );?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
            <?php if($twitter) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'twitter-link' ] ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
            <?php if($googleplus) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'google-plus-link' ] ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
            <?php if($dribbble) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'dribbble-link' ] ); ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li><?php } ?>
            <?php if($instagram) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'instagram-link' ] ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php } ?>
            <?php if($behance) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'behance-link' ] ); ?>" target="_blank"><i class="fa fa-behance"></i></a></li><?php } ?>
            <?php if($pinterest) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'pinterest-link' ] ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li><?php } ?>
            <?php if($flickr) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'flickr-link' ] ); ?>" target="_blank"><i class="fa fa-flickr"></i></a></li><?php } ?>
            <?php if($tumblr) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'tumblr-link' ] ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li><?php } ?>
            <?php if($youtube) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'youtube-link' ] ); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li><?php } ?>
            <?php if($snapchat) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'snapchat-link' ] ); ?>" target="_blank"><i class="fa fa-snapchat"></i></a></li><?php } ?>
            <?php if($soundcloud) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'soundcloud-link' ] ); ?>" target="_blank"><i class="fa fa-soundcloud"></i></a></li><?php } ?>
            <?php if($vimeo) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'vimeo-link' ] ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></li><?php } ?>
            <?php if($linkedin) { ?><li><a href="<?php echo esc_url( $fortun_options[ 'linkedin-link' ] ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
        </ul>
		<?php
		
		echo wp_kses_post( $after_widget );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['dribbble'] = strip_tags( $new_instance['dribbble'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );
		$instance['behance'] = strip_tags( $new_instance['behance'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['snapchat'] = strip_tags( $new_instance['snapchat'] );
		$instance['soundcloud'] = strip_tags( $new_instance['soundcloud'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );

		return $instance;
	}


	public function form( $instance ) {
		
		$defaults = array( 'title' => 'Social Icons', 'facebook' => 'on', 'twitter' => 'on', 'googleplus' => 'on', 'dribbble' => 'on', 'instagram' => 'on', 'behance' => '', 'tumblr' => '', 'flickr' => '', 'pinterest' => '', 'youtube' => '', 'snapchat' => '', 'soundcloud' => '', 'vimeo' => '', 'linkedin' => '' );
		
		foreach ($instance as $value) {
			$value = esc_attr($value);
		}
		unset($value );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
       
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'fortun'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>
        
        <hr />
        
        <p> You can configure your links at Fortun/Social Links </p>
        
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Facebook:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" <?php checked( (bool) $instance['facebook'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Twitter:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" <?php checked( (bool) $instance['twitter'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Google Plus:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'googleplus' ) ); ?>" <?php checked( (bool) $instance['googleplus'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Dribbble:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble' ) ); ?>" <?php checked( (bool) $instance['dribbble'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Instagram:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" <?php checked( (bool) $instance['instagram'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Behance:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'behance' ) ); ?>" <?php checked( (bool) $instance['behance'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Pinterest:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" <?php checked( (bool) $instance['pinterest'], true ); ?> />
		</p>        
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Flickr:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr' ) ); ?>" <?php checked( (bool) $instance['flickr'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Tumblr:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" <?php checked( (bool) $instance['tumblr'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Youtube:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" <?php checked( (bool) $instance['youtube'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'snapchat' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Snapchat:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'snapchat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'snapchat' ) ); ?>" <?php checked( (bool) $instance['snapchat'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('SoundCloud:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'soundcloud' ) ); ?>" <?php checked( (bool) $instance['soundcloud'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Vimeo:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" <?php checked( (bool) $instance['vimeo'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Linkedin:', 'fortun'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" <?php checked( (bool) $instance['linkedin'], true ); ?> />
		</p>


	<?php
	}	
}

function register_fortun_social_icons() {
    register_widget( 'fortun_social_icons' );
}

add_action( 'widgets_init', 'register_fortun_social_icons');
