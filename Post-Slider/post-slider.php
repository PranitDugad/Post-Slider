<?php
/**
 * Plugin Name: Post Slider
 * Description: A custom block for rtCamp that shows a slideshow of posts.
 * Version: 1.0
 * Author: Pranit Dugad
 */

defined( 'ABSPATH' ) || exit;

function post_slider_render( $attributes ) {
    $url = $attributes['url'];
    $response = wp_remote_get($url, array(
        'sslverify' => false, // Disable SSL verification
    ));

    if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
        return '<p>Failed to fetch posts.</p>';
    }

    $posts = json_decode( wp_remote_retrieve_body( $response ), true );
         if ( empty( $posts ) ) {
        return '<p>No posts found.</p>';
    }

    ob_start(); // Start output buffering
    ?>
    <div class="post-slider">
        <div class="slides">
            <?php foreach ( $posts as $post ) : ?>
                <?php
                $featured_image = $post['jetpack_featured_media_url'] ?? '';
                $post_link = esc_url( $post['link'] );
                $post_title = esc_html( $post['title']['rendered'] );
                ?>
                <div class="slide">
                    <a href="<?php echo $post_link; ?>" target="_blank" rel="noopener noreferrer">
                        <?php if ( $featured_image ) : ?>
                            <img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo $post_title; ?>" />
                        <?php endif; ?>
                        <h2><?php echo $post_title; ?></h2>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="previous">Previous</button>
        <button class="next">Next</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const slides = document.querySelectorAll('.slide');
            const nextButton = document.querySelector('.next');
            const previousButton = document.querySelector('.previous');
            let currentIndex = 0;

            const showSlide = (index) => {
                slides.forEach((slide, i) => {
                    slide.style.display = i === index ? 'block' : 'none';
                });
            };

            nextButton.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % slides.length;
                showSlide(currentIndex);
            });

            previousButton.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                showSlide(currentIndex);
            });

            showSlide(currentIndex); // Show the first slide initially
        });
    </script>
    <?php
    return ob_get_clean(); // Return the buffered output
}

function post_slider_register_block() {
    // Register the block script
    wp_register_script(
        'post-slider-block',
        plugins_url( 'build/index.js', _FILE_ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-server-side-render' ),
        true
    );

    // Register the block style
    wp_register_style(
        'post-slider-style',
        plugins_url( 'style.css', _FILE_ )
    );

    register_block_type( 'my-plugin/post-slider', array(
        'editor_script' => 'post-slider-block',
        'style' => 'post-slider-style',
        'attributes' => array(
            'url' => array(
                'type' => 'string',
                'default' => 'https://wptavern.com/wp-json/wp/v2/posts',
            ),
        ),
        'render_callback' => 'post_slider_render',
    ));
}
add_action( 'init', 'post_slider_register_block' );