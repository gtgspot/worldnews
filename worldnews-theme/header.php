<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- BREAKING TICKER -->
<div class="ticker-bar">
  <div class="ticker-label">BREAKING</div>
  <div class="ticker-scroll">
    <div class="ticker-inner">
      <?php
      $ticker = new WP_Query(array('posts_per_page'=>10,'post_status'=>'publish'));
      if ($ticker->have_posts()):
        while ($ticker->have_posts()): $ticker->the_post();
          echo '<span>' . get_the_title() . '</span>';
        endwhile;
        wp_reset_postdata();
        $ticker2 = new WP_Query(array('posts_per_page'=>10,'post_status'=>'publish'));
        while ($ticker2->have_posts()): $ticker2->the_post();
          echo '<span>' . get_the_title() . '</span>';
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
  </div>
</div>

<!-- MASTHEAD -->
<div class="masthead">
  <div class="masthead-top">
    <span class="edition"><?php echo strtoupper(date('l, F j, Y')); ?> · DIGITAL EDITION</span>
    <span>worldnews.org.au</span>
    <span>Autonomous AI · Continuously Updated</span>
  </div>
  <div class="masthead-logo">
    <h1><a href="<?php echo home_url(); ?>">WorldNews</a></h1>
    <div class="tagline">Autonomous Global Intelligence · AI-Aggregated · Continuously Updated</div>
    <div class="ornament"><span>✦</span></div>
  </div>
</div>

<!-- NAV -->
<nav class="site-nav">
  <div class="nav-inner">
    <?php
    wp_nav_menu(array(
      'theme_location' => 'primary',
      'container'      => false,
      'items_wrap'     => '%3$s',
      'fallback_cb'    => function() {
        $cats = get_categories(array('number'=>10,'orderby'=>'count','order'=>'DESC'));
        foreach ($cats as $cat) {
          echo '<a href="' . get_category_link($cat->term_id) . '">' . esc_html($cat->name) . '</a>';
        }
      }
    ));
    ?>
  </div>
</nav>

<!-- LEADERBOARD AD -->
<div class="ad-leaderboard">
  <span class="ad-label">Advertisement</span>
  <!-- Replace with your AdSense leaderboard code once approved -->
  <div style="width:100%;text-align:center;font-family:monospace;font-size:11px;color:#999;">
    [ 728×90 Advertisement ]
  </div>
</div>
