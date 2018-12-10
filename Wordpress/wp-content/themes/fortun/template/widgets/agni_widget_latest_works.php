<?php
/**
 * Fortun Latest Works Widget
 *
 * @author 		AgniHD
 * @package 	fortun/templates/widgets
 * @version     1.0
 */

class fortun_latest_works extends WP_Widget {

	public function __construct(){
 
		parent::__construct(
			'fortun_latest_works',
			esc_html__( 'Fortun: Latest Works', 'fortun' ),
				array(
					'classname'   => 'widget_fortun_latest_works',
					'description' => esc_html__( 'Your site\'s most recent works with unique layout of fortun. You can also display the latest works of particular category.', 'fortun' )
				)
			);			
	   
	}
	
	public function widget( $args, $instance ) {
		extract( $args );

		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$number = $instance['number'];
		$tax_args = '';
		if( !empty($categories) ){
			$tax_args = array( array(
				'taxonomy' => 'types',
				'field' => 'term_id',
				'terms' =>  explode( ',', $categories )  ) ) ;
		}

		$query_args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => $number, 
			'tax_query' => $tax_args,
		);
		
		$latest_posts_query = new WP_Query($query_args);
		if ($latest_posts_query->have_posts()) :		
			echo wp_kses_post( $before_widget );
			
		if ( $title )
			echo wp_kses_post( $before_title . $title . $after_title );  ?>
			<ul>			
			<?php  while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post(); 

				$portfolio_category_list = '';
				$terms = get_the_terms( $post->ID, 'types' );
	            if ( $terms && ! is_wp_error( $terms ) ) :
	                foreach ( $terms as $term )
	                {
	                    $portfolio_category_list .= '<li>'.$term->name.'</li>';
	                }
	            endif;?>	

				<li>													
					<?php if( (has_post_thumbnail()) ){ ?>
                        <div class="latest-works-thumbnail">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                    <?php } ?>
                    <div class="latest-works-details">
                        <?php the_title( sprintf( '<h6 class="latest-works-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' ) ?>
                        <ul class="portfolio-category list-inline">
                            <?php echo wp_kses_post( $portfolio_category_list ); ?>
                        </ul>
                    </div>			
				</li>			
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>		
			</ul>
		<?php endif; ?>	
			
		<?php	echo wp_kses_post( $after_widget );

	}
		
	public function form( $instance ) {
		$defaults = array( 'title' => esc_html__('Latest Works', 'fortun'), 'number' => 5, 'categories' => '');
		
		foreach ($instance as $value) {
			$value = esc_attr($value);
		}
		unset($value );
		$instance = wp_parse_args( (array) $instance , $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'fortun'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>

		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php esc_html_e('Show by category:', 'fortun'); ?></label> 
            <select id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories' ) ); ?>" class="widefat" style="width:100%;">
				<option value='' <?php selected( $instance['categories'], '' ); ?>><?php esc_html_e('All Categories', 'fortun'); ?></option>
				<?php foreach(get_terms('types','parent=0&hide_empty=0') as $term) { ?>
                <option <?php selected( $instance['categories'], $term->term_id ); ?> value="<?php echo wp_kses_post( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></option>
                <?php } ?>      
            </select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e('Number of posts to show:', 'fortun'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" size="3" />
		</p>
	<?php }
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}
	
}

function register_fortun_latest_works() {
    register_widget( 'fortun_latest_works' );
}

add_action( 'widgets_init', 'register_fortun_latest_works');
