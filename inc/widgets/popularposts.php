<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: Realistic Popular Posts
	Description: A widget that displays popular posts.
	Version: 03.09.2017

-----------------------------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class realistic_popular_posts_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'realistic_popular_posts_widget',
			__('Realistic: Popular Posts','realistic'),
			array( 'description' => __( 'Displays most Popular Posts with Thumbnail.','realistic' ) )
		);
	}

 	public function form( $instance ) {

		$defaults = array(
            'qty'           => 5,
			'comments'      => 1,
			'date'          => 1,
			'days'          => 0,
			'show_thumb'    => 1,
		);

		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : esc_attr__( 'Popular Posts', 'realistic' );
		$qty = isset( $instance[ 'qty' ] ) ? absint( $instance[ 'qty' ] ) : $defaults['qty'];
		$comments = isset( $instance[ 'comments' ] ) ? realistic_sanitize_checkbox( $instance[ 'comments' ] ) : $defaults['comments'];
		$date = isset( $instance[ 'date' ] ) ? realistic_sanitize_checkbox( $instance[ 'date' ] ) : $defaults['date'];
		$days = isset( $instance[ 'days' ] ) ? absint( $instance[ 'days' ] ) : $defaults['days'];
		$show_thumb = isset( $instance[ 'show_thumb' ] ) ? realistic_sanitize_checkbox( $instance[ 'show_thumb' ] ) : $defaults['show_thumb']; ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'realistic' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
	       <label for="<?php echo $this->get_field_id( 'days' ); ?>"><?php esc_attr_e( 'Popularity limit (days), 0 for No-limit', 'realistic' ); ?>
	       <input id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>" type="number" min="1" step="1" value="<?php echo $days; ?>" />
	       </label>
        </p>
	   
		<p>
			<label for="<?php echo $this->get_field_id( 'qty' ); ?>"><?php esc_attr_e( 'Number of Posts to show', 'realistic' ); ?></label> 
			<input id="<?php echo $this->get_field_id( 'qty' ); ?>" name="<?php echo $this->get_field_name( 'qty' ); ?>" type="number" min="1" step="1" value="<?php echo $qty; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" value="1" <?php if ( isset( $instance[ 'show_thumb' ] ) ) { checked( 1, $instance[ 'show_thumb' ], true ); } ?> />
				<?php esc_attr_e( 'Show Thumbnails', 'realistic' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'date' ); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" value="1" <?php if ( isset($instance[ 'date' ] ) ) { checked( 1, $instance[ 'date' ], true ); } ?> />
				<?php esc_attr_e( 'Show post date', 'realistic' ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'comments' ); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'comments' ); ?>" name="<?php echo $this->get_field_name( 'comments' ); ?>" value="1" <?php checked( 1, $instance[ 'comments' ], true ); ?> />
				<?php esc_attr_e( 'Show comments number', 'realistic' ); ?>
			</label>
		</p>

		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['qty'] = absint( $new_instance['qty'] );
		$instance['comments'] = realistic_sanitize_checkbox( $new_instance['comments'] );
		$instance['date'] = realistic_sanitize_checkbox( $new_instance['date'] );
		$instance['days'] = absint( $new_instance['days'] );
		$instance['show_thumb'] = realistic_sanitize_checkbox( $new_instance['show_thumb'] );
		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
        $title = null; $comments = null; $date = null; $days = null; $qty = null; $show_thumb = null;

        if (! empty( $instance['title'] ) ) { $title = apply_filters( 'widget_title', $instance['title'] ); }
        if (! empty( $instance['comments'] ) ) { $comments = $instance['comments']; }
        if (! empty( $instance['date'] ) ) { $date = $instance['date']; }
        if (! empty( $instance['days'] ) ) { $days = $instance['days']; }
        if (! empty( $instance['qty'] ) ) { $qty = $instance['qty']; }
        if (! empty( $instance['show_thumb'] ) ) { $show_thumb = $instance['show_thumb']; }

		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		echo self::get_popular_posts( $qty, $comments, $date, $days, $show_thumb );
		echo $after_widget;
	}

	public function get_popular_posts( $qty, $comments, $date, $days, $show_thumb ) {

        global $post;
        $popular_days = array();

		if ( $days ) {
			$popular_days = array(
        		//set date ranges
        		'after' => "$days day ago",
        		'before' => 'today',
        		//allow exact matches to be returned
        		'inclusive' => true,
        	);
		}
		
		$popular = get_posts( array(
                'suppress_filters' => false,
                'ignore_sticky_posts' => 1,
                'orderby' => 'comment_count',
                'numberposts' => $qty,
                'date_query' => $popular_days,
            )
        ); ?>

		<div class="widget-container recent-posts-wrap">
		<ul>
		
		<?php foreach( $popular as $post ) {
			setup_postdata( $post ); ?>
			<li class="post-box horizontal-container">

				<?php if ( $show_thumb == 1 ) { ?>
				<div class="widget-post-img">
					<a rel="nofollow" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<img src="<?php echo realistic_get_thumbnail( $post->ID, 'tiny' ); ?>" class="attachment-featured wp-post-image" alt="<?php the_title_attribute(); ?>">				
						<?php realistic_post_format_icon( get_post_format( $post->ID ) ); ?>
					</a>
				</div>
				<?php } ?>
				<div class="widget-post-data">
					<h4><a class="mdl-card__title-text" rel="nofollow" href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
					<?php if ( $date == 1 || $comments == 1 ) { ?>
						<div class="widget-post-info">
							<?php if ( $date == 1 ) { ?>
								<span class="posted"><i class="material-icons">access_time</i><?php realistic_posted(); ?></span>
							<?php } ?>

							<?php if ( $comments == 1 ) { ?>
								<span class="comments"><i class="material-icons">chat_bubble</i><?php realistic_entry_comments(); ?></span>
							<?php } ?>
						</div><!--end .widget-post-info-->
					<?php } ?>
				</div>
			</li>
		<?php } ?>

		<?php wp_reset_postdata(); ?>

		</ul>
		</div>
	<?php }
}