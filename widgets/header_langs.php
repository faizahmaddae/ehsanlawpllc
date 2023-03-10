<?php

// Adds widget: HeaderLangs
class HeaderLangs_Widget extends WP_Widget
{

    // Register widget with WordPress
    function __construct()
    {
        parent::__construct(
            'HeaderLangs_widget',
            esc_html__('HeaderLangs', 'textdomain'),
            array('description' => esc_html__('header languages', 'textdomain'),) // Args
        );
    }

    // Widget fields
    private $widget_fields = array(

        array(
            'label' => 'lang 1',
            'id' => 'lang_1',
            'default' => 'فارسی',
            'type' => 'text',
        ),

        array(
            'label' => 'lang 1 link',
            'id' => 'lang_1_link',
            'default' => '#',
            'type' => 'text',
        ),

        array(
            'label' => 'lang 2',
            'id' => 'lang_2',
            'default' => 'پشتو',
            'type' => 'text',
        ),

        array(
            'label' => 'lang 2 link',
            'id' => 'lang_2_link',
            'default' => '#',
            'type' => 'text',
        ),

        array(
            'label' => 'Phone',
            'id' => 'phone',
            'default' => '+1 206-234-6883',
            'type' => 'text',
        ),

    );

    // Frontend display of widget
    public function widget($args, $instance)
    {
        // print_r($instance);
        echo $args['before_widget']; ?>

        <div class="d-flex d-none d-lg-block">
            <div class="ms-auto">

                <div class="lang text-end text-dark">
                    <a href="<?php echo $instance['lang_1_link']; ?>" class="text-dark">
                        <?php echo $instance['lang_1'] ?>
                    </a>
                    <a href="<?php echo $instance['lang_2_link']; ?>" class="text-dark pe-2">
                        <?php echo $instance['lang_2'] ?>
                    </a>
                </div>
                <a href="tel:<?php echo $instance['phone'];?>" class="text-dark">
                    <p class="m-0"><?php echo $instance['phone'];?></p>
                </a>
            </div>
        </div>

        <p class="divider-text d-md-block d-lg-none"></p>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-md-block d-lg-none">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $instance['lang_1_link']; ?>"><?php echo $instance['lang_1'] ?></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo $instance['lang_2_link']; ?>"><?php echo $instance['lang_2'] ?></a>
            </li>

        </ul>

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
                case 'textarea':
                    $output .= '<p>';
                    $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'domtest') . ':</label> ';
                    $output .= '<textarea class="widefat" id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" rows="6" cols="6" value="' . esc_attr($widget_value) . '">' . $widget_value . '</textarea>';
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
                    $instance[$widget_field['id']] = (!empty($new_instance[$widget_field['id']])) ? $new_instance[$widget_field['id']] : '';
            }
        }
        return $instance;
    }
}

function register_HeaderLangs_widget()
{
    register_widget('HeaderLangs_Widget');
}
add_action('widgets_init', 'register_HeaderLangs_widget'); ?>