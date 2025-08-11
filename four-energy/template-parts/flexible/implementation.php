<?php
$img = get_sub_field('img');
$bg_url = '';
if ( is_array( $img ) && ! empty( $img['url'] ) ) {
    $bg_url = esc_url( $img['url'] );
} elseif ( is_string( $img ) ) {
    $bg_url = esc_url( $img );
}

    $title = get_sub_field('title');
    $title_solutions = get_sub_field('title_solutions');
?>

<section class="implementation mb-140" id="implementation">
    <div class="container">
        <div class="implementation__wrapper">
            <div class="implementation__wrapper_left" style="<?= $bg_url ? 'background-image: url(' . $bg_url . ');' : ''; ?>">
                <div class="implementation__wrapper_left_text" >
                    <?php if ( $title ) : ?>
                        <h2><?= esc_html( $title ); ?></h2>
                    <?php endif; ?>
                    
                    <?php if ( have_rows( 'implementation_list' ) ) : 
                         $i = 1?>
                        <ul>
                            <?php while ( have_rows( 'implementation_list' ) ) : the_row(); 
                                $item = get_sub_field('item');
                            ?>
                                <li>
                                <span><?= esc_html( sprintf( '%02d', $i ) ); ?></span>
                                    <p><?= esc_html( $item ); ?></p>
                                </li>
                            <?php $i++; endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                
            </div>
            <div class="implementation__wrapper_right">
                <?php if ( $title_solutions ) : ?>
                    <h2><?= esc_html( $title_solutions ); ?></h2>
                <?php endif; ?>
                <?php if ( have_rows( 'solutions' ) ) : 
                   ?>
                    <ul>
                        <?php while ( have_rows( 'solutions' ) ) : the_row();
                            $solution_item = get_sub_field('item'); // или как называется sub field
                        ?>  
                            <li>
                                
                                <p><?= esc_html( $solution_item ); ?></p>
                            </li>
                        <?php  endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
