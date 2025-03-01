<?php
/**
 * Plugin Name: Post Slider
 * Description: A custom block for rtCamp that shows a slideshow of posts.
 * Version: 1.0
 * Author: Pranit Dugad
 */

defined('ABSPATH') || exit;

function post_slider_render($attributes) {
    $url = $attributes['url'] ?? 'https://wptavern.com/wp-json/wp/v2/posts';
    $autoScroll = !empty($attributes['autoScroll']) ? 'true' : 'false';
    $loop = !empty($attributes['loop']) ? 'true' : 'false';
    $showDots = !empty($attributes['showDots']) ? 'true' : 'false';
    $showDate = !empty($attributes['showDate']) ? 'true' : 'false';

    $cache_key = 'post_slider_cache_' . md5($url);
    $posts = get_transient($cache_key);

    if ($posts === false) {
        $response = wp_remote_get($url, array('sslverify' => false));

        if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
            return '<p>Failed to fetch posts.</p>';
        }

        $posts = json_decode(wp_remote_retrieve_body($response), true);

        if (empty($posts)) {
            set_transient($cache_key, [], HOUR_IN_SECONDS);
            return '<p>No posts found.</p>';
        }

        set_transient($cache_key, $posts, HOUR_IN_SECONDS);
    }

    ob_start();
    ?>
    <div class="post-slider-main">
        <div class="container">
            <div class="post-slider-wrapper">
                <div class="post-slider" data-autoscroll="<?php echo esc_attr($autoScroll); ?>" data-loop="<?php echo esc_attr($loop); ?>">
                    <div class="slides">
                        <?php foreach ($posts as $post) : ?>
                            <?php
                            $featured_image = $post['jetpack_featured_media_url'] ?? '';
                            $post_link = esc_url($post['link']);
                            $post_title = esc_html($post['title']['rendered']);
                            $post_excerpt = $post['excerpt']['rendered'];
                            $post_date = date('F j, Y', strtotime($post['date']));

                            ?>
                            <div class="slide">
                                <a href="<?php echo $post_link; ?>" target="_blank">
                                    <?php if ($featured_image) : ?>
                                        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($post_title); ?>" loading="lazy" />
                                    <?php endif; ?>
                                    <?php if ($showDate === 'true') : ?> 
                                        <small><?php echo $post_date; ?></small>
                                    <?php endif; ?>
                                    <h2><?php echo $post_title; ?></h2>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="posts-slider-nav-main">
                        <div class="posts-slider-nav-btn">
                            <button class="previous"></button>
                            <button class="next"></button>
                        </div>
                        <div class="posts-slider-nav-dots">
                            <?php if ($showDots === 'true') : ?>
                                <div class="dots"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function post_slider_register_block() {
    wp_register_script(
        'post-slider-block',
        plugins_url('build/index.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-server-side-render'),
        filemtime(plugin_dir_path(__FILE__) . 'build/index.js')
    );

    wp_register_script(
        'post-slider-frontend-js',
        plugin_dir_url(__FILE__) . 'src/assets/main.js',
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'src/assets/main.js'),
        true
    );

    wp_register_style(
        'post-slider-editor-style',
        plugins_url('src/assets/style.css', __FILE__),
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'src/assets/style.css')
    );

    wp_register_style(
        'post-slider-frontend-style',
        plugin_dir_url(__FILE__) . 'src/assets/style.css',
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'src/assets/style.css')
    );

    register_block_type('my-plugin/post-slider', array(
        'editor_script' => 'post-slider-block',
        'editor_style'  => 'post-slider-editor-style',
        'style'         => 'post-slider-frontend-style',
        'attributes'    => array(
            'url'        => array('type' => 'string', 'default' => 'https://wptavern.com/wp-json/wp/v2/posts'),
            'autoScroll' => array('type' => 'boolean', 'default' => true),
            'loop'       => array('type' => 'boolean', 'default' => true),
            'showDots'   => array('type' => 'boolean', 'default' => true),
            'showDate'   => array('type' => 'boolean', 'default' => true),
        ),
        'render_callback' => 'post_slider_render',
    ));

    // 🛠️ Ensure Editor Scripts Load
    add_action('enqueue_block_editor_assets', function () {
        wp_enqueue_script('post-slider-block'); // Load index.js
        wp_enqueue_script('post-slider-frontend-js'); // Load main.js in the editor
        wp_enqueue_style('post-slider-editor-style');
    });

    // 🛠️ Ensure Frontend Scripts Load
    add_action('wp_enqueue_scripts', function () {
        if (has_block('my-plugin/post-slider')) {
            wp_enqueue_script('post-slider-frontend-js');
            wp_enqueue_style('post-slider-frontend-style');
        }
    });
}
add_action('init', 'post_slider_register_block');