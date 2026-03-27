<?php get_header(); ?>

<div class="single-post-wrap">
  <?php while (have_posts()): the_post(); ?>
  <article class="post-header">
    <?php $cat = get_the_category(); ?>
    <?php if ($cat): ?>
    <div class="post-kicker">
      <a href="<?php echo get_category_link($cat[0]->term_id); ?>" style="color:var(--red);text-decoration:none;">
        <?php echo esc_html($cat[0]->name); ?>
      </a>
    </div>
    <?php endif; ?>

    <h1><?php the_title(); ?></h1>

    <div class="post-meta">
      <span class="ai-pill">AI WRITTEN</span>
      <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago</span>
      <span>·</span>
      <span><?php echo ceil(str_word_count(get_the_content()) / 200); ?> min read</span>
    </div>

    <div class="post-content">
      <?php the_content(); ?>
    </div>

    <!-- BOTTOM AD -->
    <div style="background:var(--ad-bg);border:1px solid var(--rule);border-top:2px solid var(--gold);padding:20px;margin:32px 0;text-align:center;min-height:100px;display:flex;align-items:center;justify-content:center;position:relative;">
      <span style="position:absolute;top:6px;right:10px;font-family:monospace;font-size:9px;color:var(--muted);">Advertisement</span>
      <!-- Replace with your AdSense code -->
      <span style="font-family:monospace;font-size:11px;color:#aaa;">[ Advertisement ]</span>
    </div>

    <!-- RELATED POSTS -->
    <?php
    $cats = get_the_category();
    if ($cats):
      $related = new WP_Query(array(
        'category__in'   => array($cats[0]->term_id),
        'posts_per_page' => 3,
        'post__not_in'   => array(get_the_ID()),
        'orderby'        => 'rand'
      ));
      if ($related->have_posts()):
    ?>
    <div class="section-rule" style="margin-top:40px;"><h2>Related Stories</h2></div>
    <div class="news-grid">
    <?php
      $rc = 0;
      while ($related->have_posts()): $related->the_post();
        $rc++;
        $rcat = get_the_category() ? get_the_category()[0]->name : 'World';
    ?>
      <div class="news-card" <?php if ($rc == 3) echo 'style="border-right:none;"'; ?>>
        <div class="category"><?php echo esc_html($rcat); ?></div>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
        <div class="card-meta">
          <span class="ai-pill">AI WRITTEN</span>
          <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago</span>
        </div>
      </div>
    <?php
      endwhile;
      wp_reset_postdata();
    ?>
    </div>
    <?php endif; endif; ?>

  </article>
  <?php endwhile; ?>
</div>

<?php get_footer(); ?>
