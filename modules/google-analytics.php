<?php

namespace Roots\Soil\GoogleAnalytics;

/**
 * Google Analytics snippet from HTML5 Boilerplate
 *
 * Cookie domain is 'auto' configured. See: http://goo.gl/VUCHKM
 * You can enable/disable this feature in functions.php (or lib/config.php if you're using Sage):
 * add_theme_support('soil-google-analytics', 'UA-XXXXX-Y', 'wp_footer');
 */
list($ga_id, $hook) = $options + ['','wp_footer'];
add_action($hook, function () use ($ga_id) {
  if (!$ga_id) {
    return;
  }
  $dummyGA = (defined('WP_ENV') && WP_ENV !== 'production') || current_user_can('manage_options');
  ?>
  <script> 
    <?php if (apply_filters('soil/dummyGA', $dummyGA)) : ?>
      function ga() {if (window.console) {console.log('Google Analytics: ' + [].slice.call(arguments));}}
    <?php else : ?>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    <?php endif; ?>
    ga('create','<?= $ga_id; ?>','auto');ga('send','pageview');
  </script>
<?php
}, 20);
