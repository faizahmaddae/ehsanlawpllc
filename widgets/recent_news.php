<?php

// Adds widget: About
class RecentNews_Widget extends WP_Widget
{

    // Register widget with WordPress
    function __construct()
    {
        parent::__construct(
            'RecentNews_widget',
            esc_html__('Recent News', 'textdomain'),
            array('description' => esc_html__('Recent News', 'textdomain'),) // Args
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
            'label' => 'Post limit',
            'id' => 'limit',
            'default' => '5',
            'type' => 'number',
        ),


    );

    // Frontend display of widget
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        // $instance['categories']

        $recentNewsPosts = new WP_Query(array(
            'post_type' => array('post'),
            'showposts' => $instance['limit'],
            'cat' => $instance['categories'],
        ));

        // print_r($recentNewsPosts);

?>

        <!-- recent-news -->
        <div class="recent-news my-5">

            <h4 class="fw-bold"><?php echo $instance['title']; ?>
            </h4>

            <?php while ($recentNewsPosts->have_posts()) : $recentNewsPosts->the_post(); ?>
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4 col-4">
                            <img src="<?php
                                        if (has_post_thumbnail()) {
                                            echo get_the_post_thumbnail_url(null, 'sidebar_news');
                                        } else {
                                            echo 'https://via.placeholder.com/140x90?text=No+Image';
                                        }; ?>" class="img-fluid rounded-start" alt="<?php the_title();?>">
                        </div>
                        <div class="col-md-8 col-8">
                            <div class="card-body">
                                <a href="<?php the_permalink(); ?>" class="text-dark"><h5 class="card-title fs-6"><?php the_title(); ?></h5></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <!-- /about -->

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

function register_RecentNews_widget()
{
    register_widget('RecentNews_Widget');
}
add_action('widgets_init', 'register_RecentNews_widget'); ?>