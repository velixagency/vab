<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vab
 */

get_header();
?>
<section class="block block-hero px-3 lg:px-[40px] relative">
	<div class="absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] z-50">
		<p class="uppercase text-white font-sans tracking-widest text-[22px] text-center">Built To Last</p>
		<h1 class="text-white text-[130px] uppercase font-serif">Apartments</h1>
	</div>
	<div class="swiper hero-swiper h-screen lg:h-[925px] bg-[#010101] relative z-10">
		<div class="swiper-wrapper">
			<div class="swiper-slide text-white text-[130px] uppercase font-serif w-full flex items-center justify-center">
				<div>
asxasx
				</div>
			</div>
			<div class="swiper-slide text-white text-[130px] uppercase font-serif w-full flex items-center justify-center">
				<div>
asxas
				</div>
			</div>
			<div class="swiper-slide text-white text-[130px] uppercase font-serif w-full flex items-center justify-center">
				<div>
asxax
				</div>
			</div>
		</div>
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	</div>
</section>
	<section id="primary">
		<main id="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'page' );

				// If comments are open, or we have at least one comment, load
				// the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
