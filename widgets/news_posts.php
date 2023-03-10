<?php

// Adds widget: News Posts
class NEWS_POSTS extends WP_Widget
{

    // Register widget with WordPress
    function __construct()
    {
        parent::__construct(
            'NEWS_POSTS',
            esc_html__('News Posts', 'textdomain'),
            array('description' => esc_html__('News posts', 'textdomain'),) // Args
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
    );

    // Frontend display of widget
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        // $instance['categories']

        $practicPosts = new WP_Query(array(
            'post_type' => array('post'),
            'showposts' => 1,
            'cat' => $instance['categories'],
        ));

        // print_r($practicPosts->post_count);

?>


        <!-- news -->
        <div class="news my-5 w100hidden">
            <div class="container">
                <div class="row text-center">
                    <a href="<?php
                                echo get_category_link($instance['categories']);
                                ?>" class="text-black">
                        <h3 class="fw-bold"><?php echo $instance['title']; ?></h3>
                    </a>
                </div>


                <div class="row my-4">

                    <?php while ($practicPosts->have_posts()) : $practicPosts->the_post(); ?>

                        <!-- large image -->
                        <div class="col" data-aos="fade-right">
                            <div class="card text-white border-0">

                                <img src="<?php

                                            if (has_post_thumbnail()) {
                                                echo get_the_post_thumbnail_url(null, 'squre');
                                            } else {
                                                echo 'https://via.placeholder.com/620x485?text=No+Image';
                                            }; ?>" class="card-img" alt="<?php the_title(); ?>">



                                <div class="card-img-overlay d-flex align-items-center p-0">
                                    <a href="<?php the_permalink(); ?>" class="card-title mt-auto text-white px-2 py-3 mb-0 w-100">
                                        <h4 class="fw-bold"><?php the_title(); ?></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /large image -->
                    <?php endwhile; ?>


                    <div class="col d-none d-lg-block d-md-block">
                        <div class="row">
                            <?php
                            // reset query
                            wp_reset_query();

                            $practicPosts2 = new WP_Query(array(
                                'post_type' => array('post'),
                                'showposts' => 3,
                                'offset' => 1,
                                'cat' => $instance['categories'],
                            ));; ?>

                            <?php $c = 0;
                            while ($practicPosts2->have_posts()) : $practicPosts2->the_post(); ?>


                                <?php if ($c == 0) : ?>
                                    <div class="col-12" data-aos="fade-left">
                                        <div class="card text-white squire-card">

                                            <img src="<?php
                                                        if (has_post_thumbnail()) {
                                                            echo get_the_post_thumbnail_url(null, 'news_horizantal');
                                                        } else {
                                                            echo 'https://via.placeholder.com/620x230?text=No+Image';
                                                        }; ?>" class="card-img" alt="<?php the_title(); ?>">
                                            <div class="card-img-overlay d-flex align-items-center p-0">
                                                <a href="<?php the_permalink(); ?>" class="card-title mt-auto text-white px-2 py-3 mb-0 w-100">
                                                    <h4 class="fw-bold"><?php the_title(); ?>
                                                    </h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>

                                    <div class="col-6 d-none d-lg-block" data-aos="fade-left" data-aos-delay="<?php echo $c*200;?>">
                                        <div class="card text-white mt-3">
                                            <img src="<?php
                                                        if (has_post_thumbnail()) {
                                                            echo get_the_post_thumbnail_url(null, 'squre');
                                                        } else {
                                                            echo 'https://via.placeholder.com/300x230?text=No+Image';
                                                        }; ?>" class="card-img" alt="<?php the_title(); ?>">
                                            <div class="card-img-overlay d-flex align-items-end p-0">
                                                <a href="<?php the_permalink(); ?>" class="card-title mt-auto text-white px-2 py-3 mb-0 w-100">
                                                    <h5 class="fw-bold"><?php the_title(); ?></h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                <?php endif;  ?>

                            <?php $c++;
                            endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /news -->



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

function register_NEWS_POSTS()
{
    register_widget('NEWS_POSTS');
}
add_action('widgets_init', 'register_NEWS_POSTS'); ?>