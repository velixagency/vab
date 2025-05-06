<?php
/**
 * Custom Block Registration
 *
 * Registers all custom Gutenberg blocks for the theme.
 */

/**
 * Register custom blocks.
 */
function vab_register_blocks() {
    error_log( 'vab_register_blocks called' );
    if ( ! function_exists( 'register_block_type' ) ) {
        error_log( 'register_block_type not available' );
        return;
    }
    register_block_type( get_template_directory() . '/../blocks/hero', [
        'api_version' => 3,
        'render_callback' => 'vab_render_hero_block',
    ] );
}
add_action( 'init', 'vab_register_blocks' );

/**
 * Render callback for the Hero block.
 *
 * @param array $attributes Block attributes.
 * @param string $content Block content.
 * @return string Rendered block HTML.
 */
function vab_render_hero_block( $attributes, $content ) {
    // Ensure attributes exist
    $slides = ! empty( $attributes['slides'] ) ? $attributes['slides'] : [];

    ob_start();
    ?>
    <div class="hero-swiper max-w-4xl mx-auto">
        <div class="swiper-wrapper">
            <?php foreach ( $slides as $slide ) : ?>
                <div class="swiper-slide" data-swiper-parallax="-300">
                    <img
                        data-src="<?php echo esc_url( $slide['image']['url'] ); ?>"
                        class="swiper-lazy w-full h-64 object-cover"
                        alt="<?php echo esc_attr( $slide['title'] ); ?>"
                    >
                    <div class="swiper-lazy-preloader"></div>
                    <div
                        class="absolute inset-0 flex items-center justify-center text-white text-3xl font-bold"
                        data-swiper-parallax="-200"
                    >
                        <?php echo esc_html( $slide['title'] ); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <?php
    return ob_get_clean();
}