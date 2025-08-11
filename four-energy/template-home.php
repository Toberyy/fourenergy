<?php
/*
Template name: Главная
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div class="wrapper" id="page-wrapper">
    <?php 
        if( have_rows('content') ):
            $flex_index = 0;
            while ( have_rows('content') ) : the_row(); 
                switch ( get_row_layout() ) {

                    case 'hero':
                        get_template_part( 'template-parts/flexible/hero' );
                        break;

                    case 'who-is-it-for':
                        include(TEMPLATEPATH.'/template-parts/flexible/who-is-it-for.php');
                        break;
                        
                    case 'implementation':
                        include(TEMPLATEPATH.'/template-parts/flexible/implementation.php');
                        break;
                            
                    case 'cta':
                        include(TEMPLATEPATH.'/template-parts/flexible/cta.php');
                        break;

                    case 'automation-benefits':
                        include(TEMPLATEPATH.'/template-parts/flexible/automation-benefits.php');
                        break;

                    case 'workflow':
                        include(TEMPLATEPATH.'/template-parts/flexible/workflow.php');
                        break;
                        
                    case 'quality-control':
                        include(TEMPLATEPATH.'/template-parts/flexible/quality-control.php');
                        break;

                    case 'project-analysis':
                        include(TEMPLATEPATH.'/template-parts/flexible/project-analysis.php');
                        break;

                    case 'guarantee':
                        include(TEMPLATEPATH.'/template-parts/flexible/guarantee.php');
                        break;
                        
                    case 'faq':
                        include(TEMPLATEPATH.'/template-parts/flexible/faq.php');
                        break;


                    case 'preview-project':
                        include(TEMPLATEPATH.'/template-parts/flexible/preview-project.php');
                        break;

                    case 'deadlines':
                        include(TEMPLATEPATH.'/template-parts/flexible/deadlines.php');
                        break;

                    case 'contractor-interaction':
                        include(TEMPLATEPATH.'/template-parts/flexible/contractor-interaction.php');
                        break;

                    case 'reviews':
                        include(TEMPLATEPATH.'/template-parts/flexible/reviews.php');
                        break;

                    case 'commissioning-checklist':
                        include(TEMPLATEPATH.'/template-parts/flexible/commissioning-checklist.php');
                        break;

                    case 'support-service':
                        include(TEMPLATEPATH.'/template-parts/flexible/support-service.php');
                        break;

                    case 'documentation':
                        include(TEMPLATEPATH.'/template-parts/flexible/documentation.php');
                        break;


                    case 'team':
                        include(TEMPLATEPATH.'/template-parts/flexible/team.php');
                        break;

                    case 'price-assurance':
                        include(TEMPLATEPATH.'/template-parts/flexible/price-assurance.php');
                        break;

                    case 'own-equipment':
                        include(TEMPLATEPATH.'/template-parts/flexible/own-equipment.php');
                        break;

                    case 'warehouse':
                        include(TEMPLATEPATH.'/template-parts/flexible/warehouse.php');
                        break;
                }
                $flex_index++;
            endwhile;
        endif;
    ?>
</div><!-- #page-wrapper -->
<?php get_footer(); ?>
