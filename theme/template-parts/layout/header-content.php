<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vab
 */

?>

<header id="masthead" class="px-3 lg:px-[40px] h-[60px] lg:h-[100px] flex items-center justify-between">

	<div class="flex items-center gap-8">
		<?php
		if ( is_front_page() ) :
			?>
			<h1 class="font-serif text-[35px] text-[#000000] tracking-wide leading-none font-light mt-2"><?php bloginfo( 'name' ); ?></h1>
			<?php
		else :
			?>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
		endif;

		$vab_description = get_bloginfo( 'description', 'display' );
		if ( $vab_description || is_customize_preview() ) :
			?>
			<p><?php echo $vab_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<?php endif; ?>
	
		<nav id="site-navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'vab' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'flex flex-col sm:flex-row gap-2',
					'container'      => false,
					'walker'         => new Tailwind_Navwalker(),
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</div>
	<div class="flex items-center justify-end gap-4">
		<a href="#!" title="link 1" class="text-[#7b7b7b] text-[14px] leading-2 tracking-wide font-medium">+444 000 999</a>
		<a href="#!" title="link 1" class="text-[#7b7b7b] text-[14px] leading-2 tracking-wide font-medium">kastell@qodeinteractive.com</a>
		<i class="fa-sharp fa-light fa-xl fa-magnifying-glass ml-2"></i>
		<i class="fa-sharp fa-light fa-xl fa-grid-2"></i>
	</div>
</header><!-- #masthead -->
