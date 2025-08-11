<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fourenergy
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<link rel="canonical" href="<?php echo esc_url( home_url( add_query_arg( array(), $wp->request ) ) ); ?>" />
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
	<meta property="og:description" content="<?php bloginfo('description'); ?>">
	<meta property="og:url" content="<?php echo esc_url( home_url( add_query_arg( array(), $wp->request ) ) ); ?>">
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="container">
			<div class="site-header__content">
				<div class="site-logo">
					<?php
					if (function_exists('the_custom_logo')) {
						the_custom_logo();
					}
					?>
					<span>Интегратор автоматизированных систем для производств</span>
				</div>
				<div class="menu__links">
					<button class="menu__links_button">

					</button>
					<?php
						if ( has_nav_menu( 'footer-menu-one' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'footer-menu-one',
							'menu_class'     => 'menu__links_list',
							'menu_id'        => 'menu__links_list',
							'container'      => false,
							'fallback_cb'    => false,
						) );
						}
					?>
				</div>
				
				
				<nav id="site-navigation" class="main-navigation">
					<div class="close">&times</div>
						<?php
							wp_nav_menu( array(
							'theme_location'  => 'primary-menu',
							'menu_class'      => 'main-menu',  
							'menu_id'        => 'main-menu',
							'container'       => 'div',             
							'container_class' => 'header-menu-wrap', 
							'container_id'    => '',                 
							) );
						?>
				</nav>
				
				<?php 
					$tel = get_field('telefon','options');
					$mail_main = get_field('mail_main','options');

					$telegram = get_field('telegram','options');
					$whatsapp = get_field('whatsapp','options');
				?>

				<?php if ($mail_main) : ?>
					<a href="mailto:<?=$mail_main;?>" class="mail"><?=$mail_main;?></a>
				<?php endif; ?>
				<?php if ($tel) : ?>
					<a href="tel:+<?=$tel;?>" class="telefon"><span><?=$tel;?></span></a>
				<?php endif; ?>
				<?php if ($telegram) : ?>
					<a href="<?=$telegram;?>" class="telegram" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
							<rect width="44" height="44" rx="22" fill="#24A1DD"/>
							<path d="M18.8475 24.9845L18.5167 29.6378C18.99 29.6378 19.195 29.4345 19.4409 29.1903L21.66 27.0695L26.2584 30.437C27.1017 30.907 27.6959 30.6595 27.9234 29.6612L30.9417 15.5178L30.9425 15.517C31.21 14.2703 30.4917 13.7828 29.67 14.0887L11.9284 20.8812C10.7175 21.3512 10.7359 22.0262 11.7225 22.332L16.2584 23.7428L26.7942 17.1503C27.29 16.822 27.7409 17.0037 27.37 17.332L18.8475 24.9845Z" fill="white"/>
						</svg>
					</a>
				<?php endif; ?>
				<?php if ($whatsapp) : ?>
					<a href="<?=$whatsapp;?>" class="whatsapp" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
							<rect width="44" height="44" rx="22" fill="#25D366"/>
							<path d="M12 32.0001C12.215 31.2141 12.4195 30.4678 12.6232 29.7211C12.869 28.8203 13.1178 27.92 13.3561 27.0172C13.3794 26.92 13.3682 26.8178 13.3244 26.7279C12.3644 24.9849 11.947 23.1158 12.1139 21.1407C12.3531 18.3133 13.5961 15.9909 15.7912 14.1906C17.0121 13.1852 18.4645 12.5003 20.0169 12.198C24.655 11.2756 29.1161 13.6489 31.0274 17.822C31.7407 19.3818 32.0111 21.0222 31.8784 22.7247C31.5449 27.0068 28.3781 30.6515 24.185 31.5864C21.8213 32.1132 19.5603 31.8039 17.4019 30.7099C17.3056 30.6653 17.1972 30.6542 17.0939 30.6782C15.4798 31.0956 13.8674 31.518 12.255 31.94C12.1832 31.9575 12.111 31.9733 12 32.0001ZM14.3942 29.6326C14.4893 29.6096 14.5611 29.5934 14.6325 29.5746C15.509 29.3454 16.3856 29.1209 17.2621 28.8821C17.4391 28.8341 17.5731 28.8612 17.7275 28.9527C19.6379 30.0846 21.681 30.4198 23.8494 29.9319C28.4825 28.8884 31.2878 24.0049 29.8599 19.4786C28.5589 15.3556 24.4421 12.9673 20.2072 13.8855C16.7145 14.6448 13.9471 17.7034 13.7727 21.5623C13.7005 23.1575 14.0507 24.6685 14.8854 26.0334C15.1497 26.4654 15.196 26.8265 15.0411 27.2964C14.792 28.0553 14.6108 28.837 14.3942 29.6326Z" fill="white"/>
							<path d="M16.9396 19.6826C16.9542 18.8545 17.2777 18.1733 17.8624 17.6052C17.9474 17.5179 18.0492 17.4488 18.1617 17.4021C18.2743 17.3554 18.3951 17.332 18.5169 17.3335C18.6559 17.3335 18.7961 17.3544 18.9343 17.3406C19.2265 17.3118 19.3934 17.4554 19.4957 17.7037C19.7703 18.3615 20.0542 19.016 20.3096 19.6813C20.3559 19.802 20.3288 19.9948 20.2595 20.1071C20.0715 20.3977 19.8657 20.6765 19.6435 20.9419C19.5107 21.1063 19.4999 21.2524 19.6071 21.4327C20.4156 22.7901 21.5397 23.7772 23.0135 24.3595C23.213 24.4384 23.3758 24.4071 23.5123 24.2343C23.7577 23.9246 24.0132 23.6232 24.2527 23.3081C24.3905 23.1257 24.5516 23.0577 24.7561 23.152C25.4657 23.4859 26.1702 23.8198 26.8702 24.17C26.9437 24.2067 27.0117 24.3311 27.0146 24.4175C27.043 25.1542 26.8289 25.7711 26.1723 26.2006C25.3551 26.7349 24.4969 26.7816 23.5845 26.5254C21.2442 25.8684 19.5061 24.405 18.1108 22.4733C17.6516 21.8347 17.2284 21.1769 17.0498 20.3972C16.9938 20.1647 16.9746 19.9218 16.9396 19.6826Z" fill="white"/>
						</svg>
					</a>
				<?php endif; ?>
				<button class="btn modal-open"><span>Рассчитать стоимость</span></button>
				<button class="menu__burger">

				</button>	
			</div>
			
		</div>
		
	</header>
