<?php 

class Ajba{

	/**
	 * Theme path
	 * @var string
	 */
	protected $path;

	/**
	 * Wordpress and theme combined version
	 * @var string
	 */
	protected $version;

	protected static $instance;

	private function __construct($path){
		$this->path = $path;
		$this->set_version();
		$this->set_filters();
	} 

	public function set_filters() {
		add_theme_support( 'post-thumbnails' );
		add_action("wp_enqueue_scripts",array($this,"enqueue_scripts"));
		add_action('init', array($this,"post_type_support"));
		add_action('init', array($this,"register_menus"));
		add_action('init', array($this,"sidebars"));
	}

	public function post_type_support() {
		add_post_type_support( 'post', 'thumbnail' );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( "base", get_stylesheet_directory_uri()."/css/base.min.css" , array(), $this->version );
		wp_enqueue_style( "main", get_stylesheet_directory_uri()."/css/main.css" , array("base"), $this->version );
		wp_enqueue_script( "main", get_template_directory_uri()."/js/main.js", array("jquery"), $this->version, true );
		add_action( 'init', array($this, 'register_menus') );
	}

	public function register_menus() {
		register_nav_menus( array(
				'main-menu' => __('Main menu')
			) );
	}

	public function sidebars() {
		register_sidebar( array(
			'name' => 'Footer',
			'id' => 'footer',
			'before_widget' => '<div id="%1$s" class="widget col %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		) );
	}

	protected function set_version() {
		$theme = wp_get_theme();
		$wp_version = get_bloginfo( 'version' );
		$this->version =  $wp_version ."." . $theme->get('Version');
	}

	public static function instance($path) {

        if (self::$instance === null) {
            self::$instance = new self($path);
        }
        return self::$instance;
    }
}