<?php

class SSBD_HelloWorld extends ET_Builder_Module {

	public $slug       = 'ssbd_hello_world';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://owlpixel.com/social-share-button-divi',
		'author'     => 'Owlpixel',
		'author_uri' => 'https://owlpixel.com',
	);

	public function init() {
		$this->name = esc_html__( 'Hello World', 'ssbd-social-share-button-divi' );
	}

	public function get_fields() {
		return array(
			'content' => array(
				'label'           => esc_html__( 'Content', 'ssbd-social-share-button-divi' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'ssbd-social-share-button-divi' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		return sprintf( '<h1>%1$s</h1>', $this->props['content'] );
	}
}

new SSBD_HelloWorld;
