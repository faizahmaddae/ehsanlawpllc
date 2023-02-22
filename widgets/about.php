<?php

// Adds widget: About
class About_Widget extends WP_Widget {

	// Register widget with WordPress
	function __construct() {
		parent::__construct(
                    'about_widget',
                    esc_html__( 'About', 'textdomain' ),
                    array( 'description' => esc_html__( 'about posts', 'textdomain' ), ) // Args
                );
	}

	// Widget fields
	private $widget_fields = array(
        
            array(
                'label' => 'Categories',
                'id' => 'categories',
                'type' => 'select',
                'options' => array(
                    'cat1',
                    'cat2',
                    'cat3'
                ),
            ),
            array(
                'label' => 'CTA Label',
                'id' => 'cta_label',
                'type' => 'text',
            ),
        
            array(
                'label' => 'Post limit',
                'id' => 'limit',
                'default' => '1',
                'type' => 'number',
            ),
        
            
	);

	// Frontend display of widget
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
        // $instance['categories']

        $aboutPosts = new WP_Query(array(
            'post_type' => array('post'),
            'showposts' => $instance['limit'],
            'cat' => $instance['categories'],
        ));

        // print_r($aboutPosts);
        
        ?>
        
            <!-- about -->
            <div class="about my-5">

            <?php while($aboutPosts->have_posts()): $aboutPosts->the_post();?>
                <div class="container">
                    <br>
                    <div class="row flex-sm-row-reverse">

                        <div class="col-12 col-lg-4 text-center text-lg-end" data-aos="fade-up" data-aos-delay="400">
                            <img src="<?php echo get_the_post_thumbnail_url(null,'small'); ?>" class="img-fluid rounded img-info" alt="<?php the_title();?>">
                            
                        </div>

                        <div class="col-12 col-md-9 col-lg-8 about-text-info" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="h2 fw-bold my-4"><?php the_title();?></h3>
                            <?php
                            // if has excerpt
                            if(has_excerpt()){
                                the_excerpt();
                            }else{
                                // limit content
                                echo wp_trim_words(get_the_content(), 30);
                            }

                            ?>
                            <a href="<?php the_permalink();?>" class="btn btn-warning"><?php echo $instance['cta_label'];?></a>
                        </div>

                    </div>
                </div>
                <?php endwhile;?>
            </div>
            <!-- /about -->
		
		<?php echo $args['after_widget'];
        }
	// Back-end widget fields
	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset($widget_field['default']) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'textdomain' );
			switch ( $widget_field['type'] ) {
                                case 'select':
                                    
                                        $output .= '<p>';
                                        $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
                                        $output .= '<select id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'">';
                                        $cats = get_categories('hide_empty=0&depth=1&type=post');
                                        foreach ($cats as $category) {
                                            if ($widget_value == $category->term_id) {
                                                $output .= '<option value="'.$category->term_id.'" selected>'.$category->name.'</option>';
                                            } else {
                                                $output .= '<option value="'.$category->term_id.'">'.$category->name.'</option>';
                                            }
                                        }
                                        $output .= '</select>';
                                        $output .= '</p>';
                                        break;
                        
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'textdomain' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'textdomain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	// Sanitize widget form values as they are saved
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}

function register_About_widget() {
	register_widget( 'About_Widget' );
}
add_action( 'widgets_init', 'register_About_widget' );?>