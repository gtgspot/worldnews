<?php get_header(); ?>

<div class="main-wrap">

  <!-- HERO GRID -->
  <?php
  $hero_query = new WP_Query(array('posts_per_page'=>5,'post_status'=>'publish'));
  $hero_posts = array();
  if ($hero_query->have_posts()):
    while ($hero_query->have_posts()): $hero_query->the_post();
      $hero_posts[] = array(
        'id'       => get_the_ID(),
        'title'    => get_the_title(),
        'excerpt'  => get_the_excerpt(),
        'link'     => get_permalink(),
        'date'     => human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago',
        'category' => get_the_category() ? get_the_category()[0]->name : 'World',
      );
    endwhile;
    wp_reset_postdata();
  endif;

  if (!empty($hero_posts)):
    $main = $hero_posts[0];
    $sidebar = array_slice($hero_posts, 1, 4);
  ?>
  <div class="hero-grid">
    <div class="hero-main">
      <div class="hero-kicker">Top Story · <?php echo esc_html($main['category']); ?></div>
      <h2><?php echo esc_html($main['title']); ?></h2>
      <p class="hero-excerpt"><?php echo esc_html($main['excerpt']); ?></p>
      <div class="hero-meta">
        <span class="ai-tag">AI WRITTEN</span>
        <span><?php echo $main['date']; ?></span>
      </div>
      <a href="<?php echo esc_url($main['link']); ?>" class="read-more">Read Full Story →</a>
    </div>
    <div class="hero-sidebar">
      <?php foreach ($sidebar as $i => $post): ?>
      <div class="sidebar-story">
        <div class="sidebar-num">0<?php echo $i + 2; ?></div>
        <span class="region-tag"><?php echo esc_html($post['category']); ?></span>
        <h3><a href="<?php echo esc_url($post['link']); ?>"><?php echo esc_html($post['title']); ?></a></h3>
        <div class="story-meta"><?php echo $post['date']; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- ENGINE STATUS -->
  <?php
  $total_posts = wp_count_posts()->publish;
  $today_posts = new WP_Query(array(
    'posts_per_page' => -1,
    'date_query'     => array(array('after'=>'today')),
    'fields'         => 'ids'
  ));
  $today_count = $today_posts->found_posts;
  wp_reset_postdata();
  ?>
  <div class="engine-status">
    <div class="stat-block">
      <div class="stat-label"><span class="pulse"></span>AI Engine Status</div>
      <div class="stat-value">LIVE</div>
      <div class="stat-unit">Publishing every 15 minutes</div>
    </div>
    <div class="stat-block">
      <div class="stat-label">Stories Published Today</div>
      <div class="stat-value"><?php echo $today_count; ?></div>
      <div class="stat-unit">Across 9 categories</div>
    </div>
    <div class="stat-block">
      <div class="stat-label">Total Articles</div>
      <div class="stat-value"><?php echo number_format($total_posts); ?></div>
      <div class="stat-unit">Since launch</div>
    </div>
    <div class="stat-block">
      <div class="stat-label">RSS Sources</div>
      <div class="stat-value">7</div>
      <div class="stat-unit">DW · BBC · France24 · CNN · NPR · AJ · Guardian</div>
    </div>
  </div>

  <!-- LATEST NEWS 3-COL -->
  <div class="section-rule"><h2>Latest Reports</h2></div>
  <div class="news-grid">
  <?php
  $latest = new WP_Query(array('posts_per_page'=>3,'offset'=>5,'post_status'=>'publish'));
  $col = 0;
  if ($latest->have_posts()):
    while ($latest->have_posts()): $latest->the_post();
      $cat = get_the_category() ? get_the_category()[0]->name : 'World';
      $col++;
      ?>
      <div class="news-card" <?php if ($col == 3) echo 'style="border-right:none;"'; ?>>
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
    wp_reset_postdata();
  endif;
  ?>
  </div>

  <!-- IN-ARTICLE AD (mid-page rectangle) -->
  <div style="background:var(--ad-bg);border:1px solid var(--rule);border-top:2px solid var(--gold);padding:20px;margin:32px 0;text-align:center;min-height:100px;display:flex;align-items:center;justify-content:center;position:relative;">
    <span style="position:absolute;top:6px;right:10px;font-family:monospace;font-size:9px;color:var(--muted);letter-spacing:0.1em;">Advertisement</span>
    <!-- Replace with AdSense 728x90 or 300x250 code -->
    <span style="font-family:monospace;font-size:11px;color:#aaa;">[ Advertisement ]</span>
  </div>

  <!-- MORE NEWS 3-COL -->
  <div class="section-rule"><h2>World Reports</h2></div>
  <div class="news-grid">
  <?php
  $more = new WP_Query(array('posts_per_page'=>3,'offset'=>8,'post_status'=>'publish'));
  $col2 = 0;
  if ($more->have_posts()):
    while ($more->have_posts()): $more->the_post();
      $cat = get_the_category() ? get_the_category()[0]->name : 'World';
      $col2++;
      ?>
      <div class="news-card" <?php if ($col2 == 3) echo 'style="border-right:none;"'; ?>>
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
    wp_reset_postdata();
  endif;
  ?>
  </div>

</div><!-- /main-wrap -->

<?php get_footer(); ?>
