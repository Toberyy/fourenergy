<?php
  // Основные поля блока
  $title         = get_sub_field('title');
  $subtitle      = get_sub_field('subtitle');
  $time          = get_sub_field('time');
  $text_bottom   = get_sub_field('text_bottom');
  // Поле «choice» — Post Object
  $support_post  = get_sub_field('choice');
?>

<section class="support-service">
  <div class="container">
    <div class="support-service__wrapper">

      <div class="support-service__wrapper_text">
        <?php if ( $title ) : ?>
            <?php echo wp_kses_post( $title ); ?>
        <?php endif; ?>

        <?php if ( $subtitle ) : ?>
          <p><?php echo wp_kses_post( $subtitle ); ?></p>
        <?php endif; ?>

        <?php if ( $time || $text_bottom ) : ?>
          <div class="support-service__wrapper_block">
            <?php if ( $time ) : ?>
              <span><?php echo esc_html( $time ); ?></span>
            <?php endif; ?>
            <?php if ( $text_bottom ) : ?>
              <p><?php echo wp_kses_post( $text_bottom ); ?></p>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
        <?php
            if ( $support_post) {
                $photo      = get_field( 'photo',    $support_post->ID );    
                $name       = get_the_title( $support_post );
                $position   = get_field( 'stage', $support_post->ID );
                $experience = get_field( 'experience', $support_post->ID );
        ?>
        <div class="bg">
                
                </div>
        <div class="support-service__wrapper_img"> 
            
            <?php if ( is_array( $photo ) && ! empty( $photo['url'] ) ) : ?>
                <img
                src="<?php echo esc_url( $photo['url'] ); ?>"
                alt="<?php echo esc_attr( $photo['alt'] ); ?>"
                loading="lazy"
                >
            <?php endif; ?>
        </div>
        <div class="support-service__wrapper_name">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/svg/message-notif.svg' ); ?>"  alt="massage"
                            >
          <?php if ( $name ) : ?>
            <span class="name"><?php echo esc_html( $name ); ?></span>
          <?php endif; ?>

          <?php if ( $position ) : ?>
            <span class="position"><?php echo esc_html( $position ); ?></span>
          <?php endif; ?>

          <?php if ( $experience ) : ?>
            <span class="experience"><?php echo esc_html( $experience ); ?></span>
          <?php endif; ?>
        </div>
      <?php } ?>

    </div>  
  </div>
</section>
