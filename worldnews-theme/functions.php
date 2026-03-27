<?php
function worldnews_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption'));
  register_nav_menus(array('primary' => 'Primary Navigation'));
}
add_action('after_setup_theme', 'worldnews_setup');

function worldnews_enqueue() {
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=IBM+Plex+Mono:wght@400;500&family=Barlow:wght@300;400;500;600&display=swap', array(), null);
  wp_enqueue_style('worldnews-style', get_stylesheet_uri(), array('google-fonts'), '1.0');
}
add_action('wp_enqueue_scripts', 'worldnews_enqueue');

function worldnews_widgets() {
  register_sidebar(array(
    'name'          => 'Affiliate Rail',
    'id'            => 'affiliate-rail',
    'before_widget' => '<div class="affiliate-item">',
    'after_widget'  => '</div>',
    'before_title'  => '<div class="aff-category">',
    'after_title'   => '</div>',
  ));
}
add_action('widgets_init', 'worldnews_widgets');

function worldnews_ai_disclosure($content) {
  if (!is_single() || !in_the_loop() || !is_main_query()) return $content;
  $d = '<div class="ai-disclosure" style="margin-top:32px;"><strong>AI DISCLOSURE:</strong> This article was autonomously aggregated and rewritten by artificial intelligence. WorldNews.org.au does not employ journalists. Sources are cited within each article.</div>';
  return $content . $d;
}
add_filter('the_content', 'worldnews_ai_disclosure');

function worldnews_schema() {
  if (!is_single()) return;
  global $post;
  $schema = array(
    '@context'      => 'https://schema.org',
    '@type'         => 'NewsArticle',
    'headline'      => get_the_title(),
    'datePublished' => get_the_date('c'),
    'dateModified'  => get_the_modified_date('c'),
    'url'           => get_permalink(),
    'publisher'     => array('@type'=>'Organization','name'=>'WorldNews.org.au','url'=>home_url()),
    'author'        => array('@type'=>'Organization','name'=>'WorldNews.org.au Editorial AI'),
  );
  echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';
}
add_action('wp_head', 'worldnews_schema');

remove_action('wp_head', 'wp_generator');

function worldnews_excerpt_length() { return 30; }
add_filter('excerpt_length', 'worldnews_excerpt_length');
