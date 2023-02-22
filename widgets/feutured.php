<?php 


// Adds widget: Feutured
class Feutured_Widget extends WP_Widget {

	// Register widget with WordPress
	function __construct() {
		parent::__construct(
                    'feutured_widget',
                    esc_html__( 'Feutured', 'textdomain' ),
                    array( 'description' => esc_html__( 'feutured after header', 'textdomain' ), ) // Args
                );
                add_action( 'admin_footer', array( $this, 'media_fields' ) );
                add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
            
	}

	// Widget fields
	private $widget_fields = array(
    
            array(
                'label' => 'heading 1',
                'id' => 'heading_1',
                'default' => 'EHSAN LAW PLLC',
                'type' => 'text',
            ),
        
            array(
                'label' => 'heading 2',
                'id' => 'heading_2',
                'default' => 'RELIABLE AND EFFECTIVE LEGAL SOLUTIONS',
                'type' => 'text',
            ),
        
            array(
                'label' => 'heading 3',
                'id' => 'heading_3',
                'default' => 'THE EXPERIENCE YOUR CASE NEEDS',
                'type' => 'text',
            ),
        
            array(
                'label' => 'background',
                'id' => 'bg',
                'default' => 'http://localhost/ehsanlawpllc/wp-content/uploads/2022/12/cover.png',
                'type' => 'media',
            ),
        
            array(
                'label' => 'link',
                'id' => 'link',
                'default' => '',
                'type' => 'url',
            )
	);

	// Frontend display of widget
	public function widget( $args, $instance ) {
		echo $args['before_widget']; ?>
        
        <div class="container text-white featured">

            <div class="d-flex align-items-center justify-content-center min-h-100" style="height:100%">
                <div class="text-center">
                    <h1 class="text-center display-1 fw-bold title" data-aos="fade-up"><?php echo $instance['heading_1'];?></h1>
                    <h2 class="text-center display-6 fw-bold" data-aos="fade-up" data-aos-delay="300"><?php echo $instance['heading_2'];?></h2>
                    <p class="fst-normal" style="letter-spacing: 3px;" data-aos="fade-up" data-aos-delay="400"><?php echo $instance['heading_3'];?></p>
                    <a href="<?php echo $instance['link']; ?>" class="btn btn-warning" data-aos="fade-up" data-aos-delay="500">Contact Us</a>
                </div>
            </div>
            </div>
		<?php echo $args['after_widget'];
        }

        // Media field backend
	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$(document).on('click','.custommedia',function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.id);
								$('span#preview'+id).css('background-image', 'url('+attachment.url+')');
								$('input#'+id).trigger('change');
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
					$(document).on('click', '.remove-media', function() {
						var parent = $(this).parents('p');
						parent.find('input[type="media"]').val('').trigger('change');
						parent.find('span').css('background-image', 'url()');
					});
				}
			});
		</script>
		<?php
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
                                case 'media':
                                        $media_url = '';
                                        if ($widget_value) {
                                            $media_url = wp_get_attachment_url($widget_value);
                                        }
                                        $output .= '<p>';
                                        $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'domtest' ).':</label> ';
                                        $output .= '<input style="display:none;" class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.$widget_value.'">';
                                        $output .= '<span id="preview'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" style="margin-right:10px;border:2px solid #eee;display:block;width: 100px;height:100px;background-image:url('.$media_url.');background-size:contain;background-repeat:no-repeat;"></span>';
                                        $output .= '<button id="'.$this->get_field_id( $widget_field['id'] ).'" class="button select-media custommedia">Add Media</button>';
                                        $output .= '<input style="width: 19%;" class="button remove-media" id="buttonremove" name="buttonremove" type="button" value="Clear" />';
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

			if($widget_field['id'] =='bg'){
				// set header image
				$bg = $instance[$widget_field['id']];
				$bg = wp_get_attachment_url($bg);
				set_theme_mod( 'header_image', $bg );
				set_theme_mod( 'header_image_data', array( 'attachment_id' => $bg, 'url' => $bg ) );
			}
		}
		return $instance;
	}
}

function register_Feutured_widget() {
	register_widget( 'Feutured_Widget' );
}
add_action( 'widgets_init', 'register_Feutured_widget' );?>