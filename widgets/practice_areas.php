<?php

// Adds widget: About
class PRACTICE_AREAS extends WP_Widget
{

    // Register widget with WordPress
    function __construct()
    {
        parent::__construct(
            'PRACTICE_AREAS',
            esc_html__('PRACTICE', 'textdomain'),
            array('description' => esc_html__('PRACTICE posts', 'textdomain'),) // Args
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
        // array(
        //     'label' => 'CTA Label',
        //     'id' => 'cta_label',
        //     'type' => 'text',
        // ),

        array(
            'label' => 'Post limit',
            'id' => 'limit',
            'default' => '8',
            'type' => 'number',
        ),


    );

    // Frontend display of widget
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        // $instance['categories']

        $practicPosts = new WP_Query(array(
            'post_type' => array('post'),
            'showposts' => $instance['limit'],
            'cat' => $instance['categories'],
        ));
        
    ?>

        <!-- PRACTICE AREAS -->
        <div class="practice py-5">
            <div class="container">
                <div class="row text-center my-4">
                    <a href="<?php echo get_category_link($instance['categories']); ?>" class="text-black">
                        <h3 class="fw-bold h2">
                            <?php echo $instance['title'] ; ?>
                        </h3>
                    </a>
                </div>
                <div class="row">

                <?php $c= 1; while($practicPosts->have_posts()): $practicPosts->the_post();?>

                    <div class="col-12 col-md-3 my-2" data-aos="fade-up" data-aos-delay="<?php echo $c*100;?>">
                        <div class="card bg-dark text-white">
                            
                            <img src="<?php echo get_the_post_thumbnail_url(null,'practice_areas'); ?>" class="img-fluid card-img" alt="<?php the_title();?>">
                            <div class="card-img-overlay text-center d-flex align-items-center">
                                <a href="<?php the_permalink();?>" class="text-white m-auto">
                                    <h3 class="card-title fw-bold m-auto"><?php echo get_the_title();?></h3>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php $c++; endwhile;?>

                </div>
            </div>
        </div>
        <!-- /PRACTICE AREAS -->


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

function register_PRACTICE_AREAS()
{
    register_widget('PRACTICE_AREAS');
}
add_action('widgets_init', 'register_PRACTICE_AREAS'); ?>