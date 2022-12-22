<?php

/**
 * Plugin Name: Effects Elementor
 * Plugin URI: https://effectstudios.co
 * Author: Effect Studios
 * Author URI: https://effectstudios.co
 * Description: Effects Studios Elementor Add-on Widgets
 * Version: 0.1.0
 * text-domain: effectstudios
 * 
 * @package effectstudios
 */


namespace Effects\ElementorWidgets;

use Effects\ElementorWidgets\Widgets\Effects_ImageCarousel;

if (!defined('ABSPATH')) {
  exit;
}

final class Effects
{
  private static $_instance = null;

  public static function get_instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  public function __construct()
  {
    add_action('elementor/init', [$this, 'init']);
  }

  public function init()
  {
    add_action('elementor/elements/categories_registered', [$this, 'create_new_category']);
    add_action('elementor/widgets/register', [$this, 'init_widgets']);
  }

  public function create_new_category($elements_manager)
  {
    $elements_manager->add_category(
      'effects',
      [
        'title' => __('Effects', 'effects')
      ]
    );
  }

  public function init_widgets($widgets_manager)
  {
    //Require Widgets Directory
    require_once __DIR__ . '/widgets/effects-imagecarousel.php';

    //Instantiate Widgets
    $widgets_manager->register(new Effects_ImageCarousel());
  }
}
Effects::get_instance();
