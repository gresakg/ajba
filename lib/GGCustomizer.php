<?php


class GGCustomizer {


	protected $prefix = 'ajba';

	protected $sections = array('themes','title_tagline','colors','header_image','background_image','static_front_page');

	protected static $instance;

	protected $customize;

	protected $text_domain;

	protected function __construct(WP_Customize_Manager $wp_customize) {
		$this->customize = $wp_customize;
		$this->set_text_domain();
		$this->set_fields();
	}

	public function add_section($section) {
		if(!in_array(trim($section), $this->sections)){
			array_push($this->sections, $section);
		}
	}

	public function set_fields() {
		$this->set_field(
			array(	'id'=>'footer_logo',
					'control' => "WP_Customize_Image_Control",
					'label' => 'Footer logo',
					'section' => 'title_tagline', 
					'default' => ''
				)
		);

	}

	protected function set_field($arg) {
		$arg['id'] = $this->prefix."_".$arg['id'];
		$this->customize->add_setting($arg['id'], array('default'=> $arg['default']));
		$this->customize->add_control(
			new $arg['control'](
				$this->customize,
				$arg['id'],
				array(
					'label' => __($arg['label'], $this->text_domain),
					'section' => $arg['section'],
					'settings' => $arg['id']
				)
			)
		);
	}

	protected function set_text_domain() {
		$theme = wp_get_theme();
		$this->text_domain = $theme->TextDomain;

	}


	public static function instance($wp_customize) {

        if (self::$instance === null) {
            self::$instance = new self($wp_customize);
        }
        return self::$instance;
    }
	
}