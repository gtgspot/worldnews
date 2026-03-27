<?php get_header(); ?>

<div class="main-wrap">
  <div class="section-rule">
    <h2>
      <?php
      if (is_category()) echo single_cat_title('', false);
      elseif (is_tag()) echo single_tag_title('', false);
      elseif (is_date()) echo get_the_date('F Y');
      else echo 'Archives';
      ?>
    </h2>
  </div>

  <div class="news-grid">
  <?php
  $col = 0;
  if (have_posts()):
    while (have_posts()): the_post();
      $cat = get_the_category() ? get_the_category()[0]->name : 'World';
      $col++;
      $border = ($col % 3 === 0) ? 'style="border-right:none;"' : '';
  ?>
    <div class="news-card" <?php echo $border; ?>>
      <div class="category"><?php echo esc_html($cat); ?></div>
      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <p><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
      <div class="card-meta">
        <span class="ai-pill">AI WRITTEN</span>
        <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago</span>
      </div>
    </div>
  <?php
    endwhile;
  else:
    echo '<p style="padding:40px;color:var(--muted);">No stories found.</p>';
  endif;
  ?>
  </div>

  <div style="margin:40px 0;text-align:center;">
    <?php the_posts_pagination(array(
      'prev_text' => '← Earlier',
      'next_text' => 'Later →',
    )); ?>
  </div>

</div>

<?php get_footer(); ?>
