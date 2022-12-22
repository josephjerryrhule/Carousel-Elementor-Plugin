<?php

/**
 * Effects Flickity Image Carousel Widget Add-on
 * 
 * @package effects
 */

namespace Effects\ElementorWidgets\Widgets;

use \Elementor\Widget_Base;

class Effects_ImageCarousel extends Widget_Base
{

  public function get_name()
  {
    return 'effects-image-carousel';
  }

  public function get_title()
  {
    return __('Effects Image Carousel', 'effects');
  }

  public function get_icon()
  {
    return 'eicon-elementor';
  }

  public function get_categories()
  {
    return ['effects', 'basic'];
  }

  public function get_style_depends()
  {
    wp_register_style('effects-style', plugins_url('scss/effects.css', __FILE__));
    wp_register_style('owl-style', plugins_url('scss/owl.theme.default.min.css', __FILE__));

    return ['effects-style', 'owl-style'];
  }

  public function get_script_depends()
  {
    wp_register_script('bootstrap-script', plugins_url('js/bootstrap.min.js', __FILE__));
    wp_register_script('owl-script', plugins_url('js/owl.carousel.min.js', __FILE__));
    wp_register_script('effects-script', plugins_url('js/effects.js', __FILE__));

    return ['bootstrap-script', 'owl-script', 'effects-script'];
  }

  public function register_controls()
  {

    $this->start_controls_section(
      'content-section',
      [
        'label' => __('Content', 'effects'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
      'list_title',
      [
        'label' => __('Image Title', 'effects'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Image Item #1', 'effects'),
        'label_block' => true,
      ]
    );

    $repeater->add_control(
      'list_image',
      [
        'label' => __('Image', 'effects'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $repeater->add_control(
      'link',
      [
        'label' => __('Link', 'effects'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('https://example.com', 'effects'),
        'default' => [
          'url' => __('#', 'effects'),
        ],
        'dynamic' => [
          'active' => true,
        ],
      ]
    );

    $this->add_control(
      'list',
      [
        'label' => __('Image List', 'effects'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'list_title' => __('Image Title #1', 'effects'),
          ],
          [
            'list_title' => __('Image Title #2', 'effects'),
          ],
          [
            'list_title' => __('Image Title #3', 'effects'),
          ],
        ],
        'title_field' => '{{{ list_title }}}'
      ]
    );

    $this->end_controls_section();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
    $list = $settings['list'];
?>
    <div class="effectsimagecarousel-area">
      <div class="effectsimagecarousel owl-carousel">

        <?php
        if ($list) {
          foreach ($list as $index => $item) {
        ?>
            <a href="<?php echo esc_url($item['link']['url']); ?>">
              <div class="item">
                <img src="<?php echo esc_url($item['list_image']['url']); ?>" alt="<?php echo $item['list_title']; ?>" class="effectscarouselimage">
              </div>
            </a>
        <?php
          }
        }
        ?>

      </div>
    </div>
  <?php
  }

  protected function content_template()
  {
  ?>
    <div class="effectsimagecarousel-area">
      <div class="effectsimagecarousel owl-carousel d-block">
        <# if(settings.list){ _.each(settings.list,function(item,index){ #>
          <div class="item">
            <img src="{{{item.list_image.url}}}" class="effectscarouselimage">
          </div>
          <# }); } #>
      </div>
    </div>
<?php
  }
}
