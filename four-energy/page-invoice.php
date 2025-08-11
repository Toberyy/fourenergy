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

			
			<div class="page-content">
				<section class="cta_invoice cta" style="bach">
				<div class="cta__wrapper">
					<div class="cta-block__info">
						<?php theme_breadcrumbs(); ?>	
						<h2 class="title">
						Прекрасно! <br> заявка принята.
						</h2>
						<div class="cta-block__subtitle">В скором времени наш менеджер свяжется с вами,
                        для уточнения деталей вашей завки.</div>
						<a href="/" class="cta-block__btn btn">Перейти на главную</a>
						
					</div>
                    <?php $img = get_field('img');?>
                    
                    <div class="cta-block__visual">
						<img 
                            src="<?=$img['url'];?>" 
                            alt="<?=$img['alt'];?>"
                        >
                    </div>
                    <?php if ( have_rows( 'list' ) ) : ?>
                        <div class="cta__list">
                            <?php while ( have_rows( 'list' ) ) : the_row();
                                $item = get_sub_field( 'item' );
                            ?>
                                <div class="cta__list_item">
                                    <?= $item ?>
                                </div>

                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
				</div>
			
			</section>	

			</div>

	</main>

<?php
get_footer();
