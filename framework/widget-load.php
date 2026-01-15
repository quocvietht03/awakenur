<?php

namespace AwakenurElementorWidgets;

/**
 * Class ElementorWidgets
 *
 * Main ElementorWidgets class
 * @since 1.0.0
 */
class ElementorWidgets
{

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var ElementorWidgets The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return ElementorWidgets An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public $widgets = array();

	public function widgets_list()
	{

		$this->widgets = array(
			'site-information',
			'site-information-style-1',
			'site-social',
			'site-copyright',
			'site-opening',
			'page-breadcrumb',
			'mobile-menu',
			'post-loop-item',
			'post-grid',
			'highlighted-heading',
			'heading-animation',
			'pricing-item',
			'upcoming-event',
			'give-form',
			'give-button',
			'sermon-loop-item',
			'give-loop-item',
			'pastor-loop-item',
			'event-grid',
			'list-faq',
			'upcoming-event-menu'
		);

		return $this->widgets;
	}

	/**
	 * widget_styles
	 *
	 * Load required core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function widget_styles()
	{
		wp_enqueue_style('slick-slider', get_template_directory_uri() . '/assets/libs/slick/slick.css', array(), false);
	}

	/**
	 * widget_scripts
	 *
	 * Load required core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function widget_scripts()
	{
		// wp_register_script('slick-slider', get_template_directory_uri() . '/assets/libs/slick/slick.min.js', array('jquery'), '', true);
		// wp_register_script('select2-min', get_template_directory_uri() . '/assets/libs/select2/select2.min.js', array('jquery'), '', true);
		wp_register_script('elementor-widgets',  get_template_directory_uri() . '/framework/widgets/frontend.js', ['jquery'], '', true);
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files()
	{

		foreach ($this->widgets_list() as $widget) {
			require_once(get_template_directory() . '/framework/widgets/' . $widget . '/widget.php');

			foreach (glob(get_template_directory() . '/framework/widgets/' . $widget . '/skins/*.php') as $filepath) {
				include $filepath;
			}
		}
	}

	/**
	 * Register categories
	 *
	 * Register new Elementor category.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_categories($elements_manager)
	{

		$elements_manager->add_category(
			'awakenur',
			[
				'title' => esc_html__('Awakenur', 'awakenur')
			]
		);
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets()
	{
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\SiteInformation\Widget_SiteInformation());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\SiteInformationStyle1\Widget_SiteInformationStyle1());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\SiteSocial\Widget_SiteSocial());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\SiteCopyright\Widget_SiteCopyright());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\SiteOpening\Widget_SiteOpening());

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\HighlightedHeading\Widget_HighlightedHeading());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\HeadingAnimation\Widget_HeadingAnimation());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PageBreadcrumb\Widget_PageBreadcrumb());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\MobileMenu\Widget_MobileMenu());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PricingItem\Widget_PricingItem());

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PostLoopItem\Widget_PostLoopItem());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PostGrid\Widget_PostGrid());


		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\UpcomingEvent\Widget_UpcomingEvent());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\UpcomingEventMenu\Widget_UpcomingEventMenu());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\EventGrid\Widget_EventGrid());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\SermonLoopItem\Widget_SermonLoopItem());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PastorLoopItem\Widget_PastorLoopItem());
		

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\GiveForm\Widget_GiveForm());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\GiveButton\Widget_GiveButton());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\GiveLoopItem\Widget_GiveLoopItem());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ListFaq\Widget_ListFaq());
	}
	/**
	 *  ElementorWidgets class constructor
	 *
	 * Register action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{

		// Register widget styles
		add_action('elementor/frontend/after_register_styles', [$this, 'widget_styles']);

		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register categories
		add_action('elementor/elements/categories_registered', [$this, 'register_categories']);

		// Register widgets
		add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
	}
}

// Instantiate ElementorWidgets Class
ElementorWidgets::instance();
