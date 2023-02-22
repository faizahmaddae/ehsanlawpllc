<?php

// Adds widget: GotinTouch
class GotinTouchWidget extends WP_Widget
{

    // Register widget with WordPress
    function __construct()
    {
        parent::__construct(
            'GotinTouchwidget',
            esc_html__('get in touch', 'textdomain'),
            array('description' => esc_html__('get in touch', 'textdomain'),) // Args
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
            'label' => 'Email',
            'id' => 'email',
            'default' => 'asif@ehsanlawpllc.com',
            'type' => 'text',
        ),

        array(
            'label' => 'Adresss',
            'id' => 'address',
            'default' => '5401 S Tacoma Way, suite 301. Tacoma. WA 98409',
            'type' => 'text',
        ),

        array(
            'label' => 'Telephone',
            'id' => 'telephone',
            'default' => '206-234-6883',
            'type' => 'text',
        ),


    );

    // Frontend display of widget
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        // $instance['categories']

?>



        <!-- Got in Touch -->

        <div class="got-in-touch py-5">

            <div class="container">

                <div class="row">

                    <div class="col-12 col-md-7">

                        <h4 class="fw-bold display-6"><?php echo $instance['title']; ?></h4>
                        <p class="h4 py-3">
                            Please fill out the form and we will be in touch soon
                        </p>

                        <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 1 ) ); ?>

                    </div>

                    <div class="col-12 col-md-5 d-flex align-items-center pt-4 pt-md-0">

                        <div class="m-md-auto">
                            <h5 class="fw-bold">Connect with us:</h5>
                            <p>
                                For currort or anv suections
                                Email tic at<br>
                                <a href="mailto:<?php echo $instance['email']; ?>">
                                    <?php echo $instance['email']; ?>
                                </a>
                            </p>

                            <div class="address">
                                <h5 class="fw-bold">US Adresss</h5>
                            </div>
                            <p>
                               <?php echo $instance['address']; ?>
                            </p>

                            <div class="Telephone">
                                <h5 class="fw-bold">Telephone</h5>
                            </div>
                            <p>
                                <a href="tel:<?php echo $instance['telephone']; ?>">
                                    <?php echo $instance['telephone']; ?>
                                </a>
                            </p>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- /Got in Touch -->




    <?php echo $args['after_widget'];
    }
    // Back-end widget fields
    public function field_generator($instance)
    {
        $output = '';
        foreach ($this->widget_fields as $widget_field) {
            $default = '';
            if (isset($widget_field['default'])) {
                $default = $widget_field['default'];
            }
            $widget_value = !empty($instance[$widget_field['id']]) ? $instance[$widget_field['id']] : esc_html__($default, 'textdomain');
            switch ($widget_field['type']) {
                case 'select':

                    $output .= '<p>';
                    $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'textdomain') . ':</label> ';
                    $output .= '<select id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '">';
                    $cats = get_categories('hide_empty=0&depth=1&type=post');
                    foreach ($cats as $category) {
                        if ($widget_value == $category->term_id) {
                            $output .= '<option value="' . $category->term_id . '" selected>' . $category->name . '</option>';
                        } else {
                            $output .= '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                        }
                    }
                    $output .= '</select>';
                    $output .= '</p>';
                    break;

                default:
                    $output .= '<p>';
                    $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'textdomain') . ':</label> ';
                    $output .= '<input class="widefat" id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" type="' . $widget_field['type'] . '" value="' . esc_attr($widget_value) . '">';
                    $output .= '</p>';
            }
        }
        echo $output;
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('', 'textdomain');
    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'textdomain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
<?php
        $this->field_generator($instance);
    }

    // Sanitize widget form values as they are saved
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        foreach ($this->widget_fields as $widget_field) {
            switch ($widget_field['type']) {
                default:
                    $instance[$widget_field['id']] = (!empty($new_instance[$widget_field['id']])) ? strip_tags($new_instance[$widget_field['id']]) : '';
            }
        }
        return $instance;
    }
}

function register_GotinTouchwidget()
{
    register_widget('GotinTouchWidget');
}
add_action('widgets_init', 'register_GotinTouchwidget'); ?>