<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package test
 */

get_header();
?>

	<main id="primary" class="site-no-main">

		<section class="error-404 not-found">
			
			<div class="page-content">
				<section class="cta_404" style="bach">
				<div class="cta-block__inner">
					<div class="cta-block__info">
						<?php theme_breadcrumbs(); ?>	
						<h2 class="title">
						Страница, которую Вы ищете,
						не может быть найдена
						</h2>
						<div class="cta-block__subtitle">Возможно, вы перешли по ссылке, в которой была допущена ошибка,
						или ресурс был удален. Попробуйте перейти на главную страницу	</div>
						<a href="/" class="cta-block__btn btn">Перейти на главную</a>
						
					</div>
						<div class="cta-block__visual">
						<img 
            src="<?= esc_url( get_template_directory_uri() . '/assets/svg/405.svg' ) ?>" 
            alt="404"
          >
						</div>
				</div>
			
			</section>	

			</div>
		</section>

	</main>

<?php
get_footer();
