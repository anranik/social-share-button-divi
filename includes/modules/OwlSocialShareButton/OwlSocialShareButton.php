<?php
/**
 * Plugin Name: Social Sharing Buttons for Divi
 * Plugin URI: https://your-website.com/owl-social-sharing-buttons-for-divi
 * Description: A powerful and customizable social sharing buttons module for Divi
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://your-website.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: owl-social-sharing-buttons
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class OwlSocialShareButton extends ET_Builder_Module {
    public $slug = 'owl_social_share_button';
    public $vb_support = 'on';
    public $main_css_element = '%%order_class%%';
    public $icon_path = '';
    public $category = 'Social';
    public $help_videos = array();

    protected $module_credits = array(
        'module_uri' => 'https://your-website.com/owl-social-sharing-buttons-for-divi',
        'author' => 'Your Name',
        'author_uri' => 'https://your-website.com',
    );

    public function init() {
        $this->name = esc_html__('Owl Social Share Buttons', 'owl-social-sharing-buttons');
        $this->icon = 'share';
        $this->category = esc_html__('Social', 'owl-social-sharing-buttons');

        // Load CSS
        $this->setup_styles();
    }

    public function setup_styles() {
        wp_enqueue_style(
            'owl-social-share-button',
            plugin_dir_url(__FILE__) . 'style.css',
            array(),
            '1.0.0'
        );

        // Font Awesome
        wp_enqueue_style(
            'font-awesome-5',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
            array(),
            '5.15.4'
        );
    }

    public function get_fields() {
        return array(
            // General Settings
            'title' => array(
                'label' => esc_html__('Title', 'owl-social-sharing-buttons'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter a title to display above the social buttons.', 'owl-social-sharing-buttons'),
                'toggle_slug' => 'main_content',
            ),
            'show_title' => array(
                'label' => esc_html__('Show Title', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'on',
                'toggle_slug' => 'main_content',
            ),
            'custom_url' => array(
                'label' => esc_html__('Custom URL to Share', 'owl-social-sharing-buttons'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter a custom URL to share. Leave blank to use the current page URL.', 'owl-social-sharing-buttons'),
                'toggle_slug' => 'main_content',
            ),
            'custom_title' => array(
                'label' => esc_html__('Custom Title to Share', 'owl-social-sharing-buttons'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter a custom title to share. Leave blank to use the current page title.', 'owl-social-sharing-buttons'),
                'toggle_slug' => 'main_content',
            ),
            'custom_description' => array(
                'label' => esc_html__('Custom Description to Share', 'owl-social-sharing-buttons'),
                'type' => 'textarea',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter a custom description to share.', 'owl-social-sharing-buttons'),
                'toggle_slug' => 'main_content',
            ),
            'custom_image' => array(
                'label' => esc_html__('Custom Image to Share', 'owl-social-sharing-buttons'),
                'type' => 'upload',
                'option_category' => 'basic_option',
                'upload_button_text' => esc_attr__('Upload an image', 'owl-social-sharing-buttons'),
                'choose_text' => esc_attr__('Choose an Image', 'owl-social-sharing-buttons'),
                'update_text' => esc_attr__('Set As Image', 'owl-social-sharing-buttons'),
                'description' => esc_html__('Upload a custom image to share.', 'owl-social-sharing-buttons'),
                'toggle_slug' => 'main_content',
            ),

            // Network Settings
            'facebook' => array(
                'label' => esc_html__('Facebook', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'on',
                'toggle_slug' => 'networks',
            ),
            'twitter' => array(
                'label' => esc_html__('Twitter/X', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'on',
                'toggle_slug' => 'networks',
            ),
            'linkedin' => array(
                'label' => esc_html__('LinkedIn', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'on',
                'toggle_slug' => 'networks',
            ),
            'pinterest' => array(
                'label' => esc_html__('Pinterest', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'on',
                'toggle_slug' => 'networks',
            ),
            'reddit' => array(
                'label' => esc_html__('Reddit', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),
            'tumblr' => array(
                'label' => esc_html__('Tumblr', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),
            'whatsapp' => array(
                'label' => esc_html__('WhatsApp', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),
            'telegram' => array(
                'label' => esc_html__('Telegram', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),
            'viber' => array(
                'label' => esc_html__('Viber', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),
            'skype' => array(
                'label' => esc_html__('Skype', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),
            'messenger' => array(
                'label' => esc_html__('Messenger', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),
            'vk' => array(
                'label' => esc_html__('VK', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),
            'xing' => array(
                'label' => esc_html__('Xing', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),
            'email' => array(
                'label' => esc_html__('Email', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),
            'print' => array(
                'label' => esc_html__('Print', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'networks',
            ),

            // Display Settings
            'button_style' => array(
                'label' => esc_html__('Button Style', 'owl-social-sharing-buttons'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => array(
                    'filled' => esc_html__('Filled', 'owl-social-sharing-buttons'),
                    'outlined' => esc_html__('Outlined', 'owl-social-sharing-buttons'),
                    'minimal' => esc_html__('Minimal', 'owl-social-sharing-buttons'),
                ),
                'default' => 'filled',
                'toggle_slug' => 'display',
            ),
            
            'button_shape' => array(
                'label' => esc_html__('Button Shape', 'owl-social-sharing-buttons'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => array(
                    'square' => esc_html__('Square', 'owl-social-sharing-buttons'),
                    'rounded' => esc_html__('Rounded', 'owl-social-sharing-buttons'),
                    'circle' => esc_html__('Circle', 'owl-social-sharing-buttons'),
                ),
                'default' => 'rounded',
                'toggle_slug' => 'display',
            ),
            'button_size' => array(
                'label' => esc_html__('Button Size', 'owl-social-sharing-buttons'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => array(
                    'small' => esc_html__('Small', 'owl-social-sharing-buttons'),
                    'medium' => esc_html__('Medium', 'owl-social-sharing-buttons'),
                    'large' => esc_html__('Large', 'owl-social-sharing-buttons'),
                ),
                'default' => 'medium',
                'toggle_slug' => 'display',
            ),
            'button_layout' => array(
                'label' => esc_html__('Button Layout', 'owl-social-sharing-buttons'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => array(
                    'horizontal' => esc_html__('Horizontal', 'owl-social-sharing-buttons'),
                    'vertical' => esc_html__('Vertical', 'owl-social-sharing-buttons'),
                    'grid' => esc_html__('Grid', 'owl-social-sharing-buttons'),
                ),
                'default' => 'horizontal',
                'toggle_slug' => 'display',
            ),
            'show_label' => array(
                'label' => esc_html__('Show Label', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'on',
                'toggle_slug' => 'display',
            ),
            'show_count' => array(
                'label' => esc_html__('Show Share Count', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'off',
                'toggle_slug' => 'display',
                'description' => esc_html__('Note: Share count requires API setup for most networks', 'owl-social-sharing-buttons'),
            ),
            'hover_animation' => array(
                'label' => esc_html__('Hover Animation', 'owl-social-sharing-buttons'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => array(
                    'none' => esc_html__('None', 'owl-social-sharing-buttons'),
                    'grow' => esc_html__('Grow', 'owl-social-sharing-buttons'),
                    'shrink' => esc_html__('Shrink', 'owl-social-sharing-buttons'),
                    'pulse' => esc_html__('Pulse', 'owl-social-sharing-buttons'),
                    'float' => esc_html__('Float', 'owl-social-sharing-buttons'),
                    'rotate' => esc_html__('Rotate', 'owl-social-sharing-buttons'),
                ),
                'default' => 'grow',
                'toggle_slug' => 'display',
            ),
            'alignment' => array(
                'label' => esc_html__('Alignment', 'owl-social-sharing-buttons'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => array(
                    'left' => esc_html__('Left', 'owl-social-sharing-buttons'),
                    'center' => esc_html__('Center', 'owl-social-sharing-buttons'),
                    'right' => esc_html__('Right', 'owl-social-sharing-buttons'),
                    'left_top_fixed' => esc_html__('Left Top (Fixed)', 'owl-social-sharing-buttons'),
                    'left_center_fixed' => esc_html__('Left Center (Fixed)', 'owl-social-sharing-buttons'),
                    'left_bottom_fixed' => esc_html__('Left Bottom (Fixed)', 'owl-social-sharing-buttons'),
                    'right_top_fixed' => esc_html__('Right Top (Fixed)', 'owl-social-sharing-buttons'),
                    'right_center_fixed' => esc_html__('Right Center (Fixed)', 'owl-social-sharing-buttons'),
                    'right_bottom_fixed' => esc_html__('Right Bottom (Fixed)', 'owl-social-sharing-buttons'),
                ),
                'default' => 'left',
                'toggle_slug' => 'display',
            ),
            'mobile_position' => array(
                'label' => esc_html__('Mobile Position', 'owl-social-sharing-buttons'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => array(
                    'default' => esc_html__('Same as Desktop', 'owl-social-sharing-buttons'),
                    'bottom_fixed' => esc_html__('Bottom Fixed', 'owl-social-sharing-buttons'),
                    'top_fixed' => esc_html__('Top Fixed', 'owl-social-sharing-buttons'),
                ),
                'default' => 'bottom_fixed',
                'toggle_slug' => 'display',
                'show_if_not' => array('alignment' => array('left', 'center', 'right')),
            ),

            'floating_position' => array(
                'label' => esc_html__('Floating Position', 'owl-social-sharing-buttons'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => array(
                    'left_top' => esc_html__('Left Top', 'owl-social-sharing-buttons'),
                    'left_center' => esc_html__('Left Center', 'owl-social-sharing-buttons'),
                    'left_bottom' => esc_html__('Left Bottom', 'owl-social-sharing-buttons'),
                    'right_top' => esc_html__('Right Top', 'owl-social-sharing-buttons'),
                    'right_center' => esc_html__('Right Center', 'owl-social-sharing-buttons'),
                    'right_bottom' => esc_html__('Right Bottom', 'owl-social-sharing-buttons'),
                ),
                'default' => 'left_center',
                'toggle_slug' => 'display',
                'show_if' => array('button_style' => 'floating'),
            ),

            'mobile_floating_position' => array(
                'label' => esc_html__('Mobile Floating Position', 'owl-social-sharing-buttons'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => array(
                    'default' => esc_html__('Same as Desktop', 'owl-social-sharing-buttons'),
                    'bottom_fixed' => esc_html__('Bottom Fixed', 'owl-social-sharing-buttons'),
                    'top_fixed' => esc_html__('Top Fixed', 'owl-social-sharing-buttons'),
                ),
                'default' => 'bottom_fixed',
                'toggle_slug' => 'display',
                'show_if' => array('button_style' => 'floating'),
            ),

            // Advanced Settings
            'custom_css_class' => array(
                'label' => esc_html__('Custom CSS Class', 'owl-social-sharing-buttons'),
                'type' => 'text',
                'option_category' => 'configuration',
                'description' => esc_html__('Enter custom CSS class names for this module.', 'owl-social-sharing-buttons'),
                'toggle_slug' => 'custom_css',
                'tab_slug' => 'advanced',
            ),
            'use_original_colors' => array(
                'label' => esc_html__('Use Original Network Colors', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'on',
                'toggle_slug' => 'styling',
                'tab_slug' => 'advanced',
            ),
            'custom_color' => array(
                'label' => esc_html__('Custom Button Color', 'owl-social-sharing-buttons'),
                'type' => 'color-alpha',
                'custom_color' => true,
                'default' => '#444444',
                'toggle_slug' => 'styling',
                'tab_slug' => 'advanced',
                'show_if' => array('use_original_colors' => 'off'),
            ),
            'custom_hover_color' => array(
                'label' => esc_html__('Custom Button Hover Color', 'owl-social-sharing-buttons'),
                'type' => 'color-alpha',
                'custom_color' => true,
                'default' => '#222222',
                'toggle_slug' => 'styling',
                'tab_slug' => 'advanced',
                'show_if' => array('use_original_colors' => 'off'),
            ),
            'custom_text_color' => array(
                'label' => esc_html__('Custom Text Color', 'owl-social-sharing-buttons'),
                'type' => 'color-alpha',
                'custom_color' => true,
                'default' => '#ffffff',
                'toggle_slug' => 'styling',
                'tab_slug' => 'advanced',
                'show_if' => array('use_original_colors' => 'off'),
            ),
            'custom_text_hover_color' => array(
                'label' => esc_html__('Custom Text Hover Color', 'owl-social-sharing-buttons'),
                'type' => 'color-alpha',
                'custom_color' => true,
                'default' => '#ffffff',
                'toggle_slug' => 'styling',
                'tab_slug' => 'advanced',
                'show_if' => array('use_original_colors' => 'off'),
            ),
            'spacing' => array(
                'label' => esc_html__('Button Spacing', 'owl-social-sharing-buttons'),
                'type' => 'range',
                'option_category' => 'layout',
                'default' => '10px',
                'range_settings' => array(
                    'min' => '0',
                    'max' => '50',
                    'step' => '1',
                ),
                'validate_unit' => true,
                'fixed_unit' => 'px',
                'toggle_slug' => 'spacing',
                'tab_slug' => 'advanced',
            ),
            'icon_font_size' => array(
                'label' => esc_html__('Icon Font Size', 'owl-social-sharing-buttons'),
                'type' => 'range',
                'option_category' => 'font_option',
                'default' => '16px',
                'range_settings' => array(
                    'min' => '12',
                    'max' => '50',
                    'step' => '1',
                ),
                'validate_unit' => true,
                'fixed_unit' => 'px',
                'toggle_slug' => 'fonts',
                'tab_slug' => 'advanced',
            ),
            'label_font_size' => array(
                'label' => esc_html__('Label Font Size', 'owl-social-sharing-buttons'),
                'type' => 'range',
                'option_category' => 'font_option',
                'default' => '14px',
                'range_settings' => array(
                    'min' => '10',
                    'max' => '30',
                    'step' => '1',
                ),
                'validate_unit' => true,
                'fixed_unit' => 'px',
                'toggle_slug' => 'fonts',
                'tab_slug' => 'advanced',
                'show_if' => array('show_label' => 'on'),
            ),
            'open_in_new_tab' => array(
                'label' => esc_html__('Open Links in New Tab', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'on',
                'toggle_slug' => 'links',
                'tab_slug' => 'advanced',
            ),
            'add_rel_nofollow' => array(
                'label' => esc_html__('Add rel="nofollow"', 'owl-social-sharing-buttons'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'on' => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ),
                'default' => 'on',
                'toggle_slug' => 'links',
                'tab_slug' => 'advanced',
            ),
        );
    }

    public function get_settings_modal_toggles() {
        return array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Content', 'owl-social-sharing-buttons'),
                    'networks' => esc_html__('Networks', 'owl-social-sharing-buttons'),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'display' => esc_html__('Display Settings', 'owl-social-sharing-buttons'),
                    'styling' => esc_html__('Styling', 'owl-social-sharing-buttons'),
                    'spacing' => esc_html__('Spacing', 'owl-social-sharing-buttons'),
                    'fonts' => esc_html__('Fonts', 'owl-social-sharing-buttons'),
                    'links' => esc_html__('Links', 'owl-social-sharing-buttons'),
                    'custom_css' => esc_html__('Custom CSS', 'owl-social-sharing-buttons'),
                ),
            ),
        );
    }

    /**
     * Renders the module output.
     *
     * @param  array  $attrs       List of attributes.
     * @param  string $content     Content being processed.
     * @param  string $render_slug Slug of module that is used for rendering output.
     *
     * @return string
     */
    public function render( $attrs, $content = null, $render_slug ) {
        // Process props
        $title = $this->props['title'];
        $show_title = $this->props['show_title'] === 'on';
        $custom_url = $this->props['custom_url'];
        $custom_title = $this->props['custom_title'];
        $custom_description = $this->props['custom_description'];
        $custom_image = $this->props['custom_image'];

        // Network options
        $networks = array(
            'facebook' => array(
                'enabled' => $this->props['facebook'] === 'on',
                'name' => 'Facebook',
                'icon' => 'fab fa-facebook-f',
                'url' => 'https://www.facebook.com/sharer/sharer.php?u={url}&t={title}',
                'color' => '#3b5998'
            ),
            'twitter' => array(
                'enabled' => $this->props['twitter'] === 'on',
                'name' => 'Twitter',
                'icon' => 'fab fa-twitter',
                'url' => 'https://twitter.com/intent/tweet?url={url}&text={title}',
                'color' => '#1da1f2'
            ),
            'linkedin' => array(
                'enabled' => $this->props['linkedin'] === 'on',
                'name' => 'LinkedIn',
                'icon' => 'fab fa-linkedin-in',
                'url' => 'https://www.linkedin.com/shareArticle?mini=true&url={url}&title={title}&summary={description}',
                'color' => '#0077b5'
            ),
            'pinterest' => array(
                'enabled' => $this->props['pinterest'] === 'on',
                'name' => 'Pinterest',
                'icon' => 'fab fa-pinterest-p',
                'url' => 'https://pinterest.com/pin/create/button/?url={url}&media={image}&description={title}',
                'color' => '#e60023'
            ),
            'reddit' => array(
                'enabled' => $this->props['reddit'] === 'on',
                'name' => 'Reddit',
                'icon' => 'fab fa-reddit-alien',
                'url' => 'https://reddit.com/submit?url={url}&title={title}',
                'color' => '#ff4500'
            ),
            'tumblr' => array(
                'enabled' => $this->props['tumblr'] === 'on',
                'name' => 'Tumblr',
                'icon' => 'fab fa-tumblr',
                'url' => 'https://www.tumblr.com/share/link?url={url}&name={title}&description={description}',
                'color' => '#35465c'
            ),
            'whatsapp' => array(
                'enabled' => $this->props['whatsapp'] === 'on',
                'name' => 'WhatsApp',
                'icon' => 'fab fa-whatsapp',
                'url' => 'https://api.whatsapp.com/send?text={title}%20{url}',
                'color' => '#25d366'
            ),
            'telegram' => array(
                'enabled' => $this->props['telegram'] === 'on',
                'name' => 'Telegram',
                'icon' => 'fab fa-telegram-plane',
                'url' => 'https://t.me/share/url?url={url}&text={title}',
                'color' => '#0088cc'
            ),
            'viber' => array(
                'enabled' => $this->props['viber'] === 'on',
                'name' => 'Viber',
                'icon' => 'fab fa-viber',
                'url' => 'viber://forward?text={title}%20{url}',
                'color' => '#665cac'
            ),
            'skype' => array(
                'enabled' => $this->props['skype'] === 'on',
                'name' => 'Skype',
                'icon' => 'fab fa-skype',
                'url' => 'https://web.skype.com/share?url={url}&text={title}',
                'color' => '#00aff0'
            ),
            'messenger' => array(
                'enabled' => $this->props['messenger'] === 'on',
                'name' => 'Messenger',
                'icon' => 'fab fa-facebook-messenger',
                'url' => 'https://www.facebook.com/dialog/send?app_id=794927004237856&link={url}&redirect_uri={url}',
                'color' => '#0078ff'
            ),
            'vk' => array(
                'enabled' => $this->props['vk'] === 'on',
                'name' => 'VK',
                'icon' => 'fab fa-vk',
                'url' => 'https://vk.com/share.php?url={url}&title={title}&description={description}&image={image}',
                'color' => '#4a76a8'
            ),
            'xing' => array(
                'enabled' => $this->props['xing'] === 'on',
                'name' => 'Xing',
                'icon' => 'fab fa-xing',
                'url' => 'https://www.xing.com/app/user?op=share&url={url}',
                'color' => '#026466'
            ),
            'email' => array(
                'enabled' => $this->props['email'] === 'on',
                'name' => 'Email',
                'icon' => 'fas fa-envelope',
                'url' => 'mailto:?subject={title}&body={description}%20{url}',
                'color' => '#ea4335'
            ),
            'print' => array(
                'enabled' => $this->props['print'] === 'on',
                'name' => 'Print',
                'icon' => 'fas fa-print',
                'url' => '#',
                'color' => '#6d6d6d'
            ),
        );

        // Display settings
        $button_style = $this->props['button_style'];
        $button_shape = $this->props['button_shape'];
        $button_size = $this->props['button_size'];
        $button_layout = $this->props['button_layout'];
        $show_label = $this->props['show_label'] === 'on';
        $show_count = $this->props['show_count'] === 'on';
        $hover_animation = $this->props['hover_animation'];
        $alignment = isset($this->props['alignment']) ? $this->props['alignment'] : 'left';
        $mobile_position = isset($this->props['mobile_position']) ? $this->props['mobile_position'] : 'bottom_fixed';

        // Advanced settings
        $custom_css_class = $this->props['custom_css_class'];
        $use_original_colors = $this->props['use_original_colors'] === 'on';
        $custom_color = $this->props['custom_color'];
        $custom_hover_color = $this->props['custom_hover_color'];
        $custom_text_color = $this->props['custom_text_color'];
        $custom_text_hover_color = $this->props['custom_text_hover_color'];
        $spacing = $this->props['spacing'];
        $icon_font_size = $this->props['icon_font_size'];
        $label_font_size = $this->props['label_font_size'];
        $open_in_new_tab = $this->props['open_in_new_tab'] === 'on';
        $add_rel_nofollow = $this->props['add_rel_nofollow'] === 'on';

        // Generate CSS classes - keep these minimal
        $classes = array(
            'owl-social-share-buttons',
            'style-' . $button_style,
            'shape-' . $button_shape,
            'layout-' . $button_layout,
            'hover-' . $hover_animation
        );

        if ($show_label) {
            $classes[] = 'show-label';
        }

        if ($show_count) {
            $classes[] = 'show-count';
        }

        if ($use_original_colors) {
            $classes[] = 'original-colors';
        } else {
            $classes[] = 'custom-colors';
        }

        // Base styles for buttons based on size
        $button_height = '40px'; // medium default
        $button_padding = '0 15px';
        $button_min_width = '100px';
        
        if ($button_size === 'small') {
            $button_height = '30px';
            $button_padding = '0 10px';
            $button_min_width = '80px';
        } else if ($button_size === 'large') {
            $button_height = '50px';
            $button_padding = '0 20px';
            $button_min_width = '120px';
        }

        // Button radius based on shape
        $button_radius = '4px'; // rounded default
        if ($button_shape === 'square') {
            $button_radius = '0';
        } else if ($button_shape === 'circle') {
            $button_radius = '50px';
        }

        // Define container styles
        $container_style = 'width: 100%;';

        // Define container styles for buttons
        $buttons_container_style = 'display: flex; flex-wrap: wrap; width: 100%;';
        
        // Apply alignment directly to container and buttons container
        if ($alignment === 'center') {
            $container_style .= ' text-align: center;';
            $buttons_container_style .= ' margin: 0 auto; justify-content: center;';
            $classes[] = 'et_pb_text_align_center';
        } else if ($alignment === 'right') {
            $container_style .= ' text-align: right;';
            $buttons_container_style .= ' margin-left: auto; justify-content: flex-end;';
            $classes[] = 'et_pb_text_align_right';
        } else {
            $container_style .= ' text-align: left;';
            $buttons_container_style .= ' margin-right: auto; justify-content: flex-start;';
            $classes[] = 'et_pb_text_align_left';
        }


        // Handle fixed positioning alignments
        if (strpos($alignment, '_fixed') !== false) {
            $container_style .= ' position: fixed; z-index: 999; width: auto !important; margin-bottom: 0 !important;';
            
            if (strpos($alignment, 'left_top') !== false) {
                $container_style .= ' top: 20px; left: 20px;';
            } else if (strpos($alignment, 'left_center') !== false) {
                $container_style .= ' top: 50%; left: 20px; transform: translateY(-50%);';
            } else if (strpos($alignment, 'left_bottom') !== false) {
                $container_style .= ' bottom: 20px; left: 20px; top: auto;';
            } else if (strpos($alignment, 'right_top') !== false) {
                $container_style .= ' top: 20px; right: 20px; left: auto;';
            } else if (strpos($alignment, 'right_center') !== false) {
                $container_style .= ' top: 50%; right: 20px; left: auto; transform: translateY(-50%);';
            } else if (strpos($alignment, 'right_bottom') !== false) {
                $container_style .= ' bottom: 20px; right: 20px; left: auto; top: auto;';
            }
            
            // Apply mobile position adjustments
            if ($mobile_position !== 'default') {
                $output .= '<style>
                    @media only screen and (max-width: 768px) {
                        .owl-social-share-buttons.mobile-bottom_fixed {
                            position: fixed !important;
                            top: auto !important;
                            bottom: 0 !important;
                            left: 0 !important;
                            right: 0 !important;
                            transform: none !important;
                            width: 100% !important;
                            padding: 10px;
                            background-color: rgba(255, 255, 255, 0.95);
                            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
                            z-index: 999;
                        }
                        .owl-social-share-buttons.mobile-bottom_fixed .owl-social-share-buttons-container {
                            flex-direction: row !important;
                            justify-content: center !important;
                            flex-wrap: wrap !important;
                            width: 100% !important;
                        }
                        .owl-social-share-buttons.mobile-top_fixed {
                            position: fixed !important;
                            bottom: auto !important;
                            top: 0 !important;
                            left: 0 !important;
                            right: 0 !important;
                            transform: none !important;
                            width: 100% !important;
                            padding: 10px;
                            background-color: rgba(255, 255, 255, 0.95);
                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                            z-index: 999;
                        }
                        .owl-social-share-buttons.mobile-top_fixed .owl-social-share-buttons-container {
                            flex-direction: row !important;
                            justify-content: center !important;
                            flex-wrap: wrap !important;
                            width: 100% !important;
                        }
                    }
                </style>';
                
                $classes[] = 'mobile-' . $mobile_position;
            }
            
            // For fixed positions, make container column
            $buttons_container_style = 'display: flex; flex-direction: column; width: auto !important;';
        }

        if ($button_layout === 'vertical') {
            $buttons_container_style .= ' flex-direction: column;';
        } else if ($button_layout === 'grid') {
            $buttons_container_style = 'display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 10px; width: 100%;';
        }

        // HTML attributes for links
        $link_attrs = '';
        if ($open_in_new_tab) {
            $link_attrs .= ' target="_blank"';
        }
        if ($add_rel_nofollow) {
            $link_attrs .= ' rel="nofollow"';
        }

        // Determine the URL, title, description, and image to share
        $page_url = !empty($custom_url) ? $custom_url : (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $page_title = !empty($custom_title) ? $custom_title : (function_exists('get_the_title') ? get_the_title() : 'Share This Page');
        $page_description = !empty($custom_description) ? $custom_description : (function_exists('get_the_excerpt') ? get_the_excerpt() : 'Check out this page');
        $page_image = !empty($custom_image) ? $custom_image : (function_exists('get_the_post_thumbnail_url') && function_exists('get_the_ID') ? get_the_post_thumbnail_url(get_the_ID(), 'full') : '');

        // Add data attributes for hover colors for JavaScript to use
        $data_attrs = '';
        if (!$use_original_colors) {
            $data_attrs .= sprintf(' data-hover-bg-color="%1$s" data-hover-text-color="%2$s"', 
                esc_attr($custom_hover_color),
                esc_attr($custom_text_hover_color)
            );
        }
        
        // Build the HTML output
        $output = sprintf('<div class="%1$s" style="%2$s"%3$s>', 
            esc_attr(implode(' ', $classes)), 
            $container_style,
            $data_attrs
        );

        // Add buttons container
        $output .= sprintf('<div class="owl-social-share-buttons-container" style="%s">', $buttons_container_style);
         
        // Add title if enabled
        if ($show_title && !empty($title)) {
            $output .= '<h3 class="owl-social-share-title" style="margin-bottom: 15px; font-weight: 600; display: block; width: 100%; clear: both;">' . esc_html($title) . '</h3>';
        }

        // Generate buttons for enabled networks
        foreach ($networks as $network_id => $network) {
            if ($network['enabled']) {
                // Replace placeholders in URL
                $share_url = str_replace(
                    array('{url}', '{title}', '{description}', '{image}'),
                    array(rawurlencode($page_url), rawurlencode($page_title), rawurlencode($page_description), rawurlencode($page_image)),
                    $network['url']
                );

                // Button style - start with basic styling for all buttons
                $btn_style = sprintf(
                    'display: inline-flex; align-items: center; justify-content: center; height: %1$s; padding: %2$s; margin-right: %3$s; margin-bottom: %3$s; border-radius: %4$s; text-decoration: none; transition: all 0.3s ease; cursor: pointer; overflow: hidden; position: relative;',
                    $button_height,
                    $button_padding, 
                    $spacing,
                    $button_radius
                );

                // Apply style-specific button styling
                if ($button_style === 'filled') {
                    if ($use_original_colors) {
                        // Use network colors for filled buttons
                        $btn_style .= sprintf(
                            'background-color: %1$s; color: #ffffff; border: none;',
                            $network['color']
                        );
                    } else {
                        // Use custom colors for filled buttons
                        $btn_style .= sprintf(
                            'background-color: %1$s; color: %2$s; border: none;',
                            $custom_color,
                            $custom_text_color
                        );
                    }
                } else if ($button_style === 'outlined') {
                    if ($use_original_colors) {
                        // Use network colors for outlined buttons
                        $btn_style .= sprintf(
                            'background-color: transparent; color: %1$s; border: 2px solid %1$s;',
                            $network['color']
                        );
                    } else {
                        // Use custom colors for outlined buttons
                        $btn_style .= sprintf(
                            'background-color: transparent; color: %1$s; border: 2px solid %1$s;',
                            $custom_color
                        );
                    }
                } else if ($button_style === 'minimal') {
                    if ($use_original_colors) {
                        // Use network colors for minimal buttons
                        $btn_style .= sprintf(
                            'background-color: transparent; color: %1$s; border: none;',
                            $network['color']
                        );
                    } else {
                        // Use custom colors for minimal buttons
                        $btn_style .= sprintf(
                            'background-color: transparent; color: %1$s; border: none;',
                            $custom_color
                        );
                    }
                }

                // Special case for circle buttons without labels
                if ($button_shape === 'circle' && !$show_label) {
                    $btn_style .= sprintf(
                        'width: %1$s; padding: 0;',
                        $button_height
                    );
                }

                if ($show_label) {
                    $btn_style .= sprintf('min-width: %s;', $button_min_width);
                }

                // Icon style
                $icon_style = sprintf(
                    'font-size: %1$s;', 
                    $icon_font_size
                );

                // Label style
                $label_style = sprintf(
                    'font-size: %1$s; font-weight: 500; margin-left: 8px;',
                    $label_font_size
                );

                $button_content = sprintf('<i class="%1$s" style="%2$s" aria-hidden="true"></i>', esc_attr($network['icon']), $icon_style);

                if ($show_label) {
                    $button_content .= sprintf('<span style="%1$s">%2$s</span>', $label_style, esc_html($network['name']));
                }

                if ($show_count) {
                    $button_content .= sprintf('<span class="owl-social-share-count" style="background-color: rgba(0, 0, 0, 0.1); border-radius: 10px; padding: 0 8px; margin-left: 8px; font-size: 12px; min-width: 24px; text-align: center;">0</span>');
                }

                $output .= sprintf(
                    '<a href="%1$s" class="owl-social-share-button owl-social-share-%2$s" style="%3$s" %4$s>%5$s</a>',
                    esc_url($share_url),
                    esc_attr($network_id),
                    $btn_style,
                    $link_attrs,
                    $button_content
                );
            }
        }

        $output .= '</div>'; // Close buttons container
        $output .= '</div>'; // Close main container

        // Add inline script for print functionality and hover effects
        $output .= '<script>
            jQuery(document).ready(function($) {
                // Handle print button click
                $(".owl-social-share-print").on("click", function(e) {
                    e.preventDefault();
                    window.print();
                });
                
                // Add hover effects manually
                $(".owl-social-share-buttons.hover-grow .owl-social-share-button").hover(
                    function() { $(this).css("transform", "scale(1.1)"); },
                    function() { $(this).css("transform", ""); }
                );
                
                $(".owl-social-share-buttons.hover-shrink .owl-social-share-button").hover(
                    function() { $(this).css("transform", "scale(0.9)"); },
                    function() { $(this).css("transform", ""); }
                );
                
                $(".owl-social-share-buttons.hover-float .owl-social-share-button").hover(
                    function() { $(this).css("transform", "translateY(-5px)"); },
                    function() { $(this).css("transform", ""); }
                );
                
                $(".owl-social-share-buttons.hover-rotate .owl-social-share-button").hover(
                    function() { $(this).css("transform", "rotate(5deg)"); },
                    function() { $(this).css("transform", ""); }
                );
                
                // Apply custom hover colors
                $(".owl-social-share-button").hover(
                    function() {
                        var $button = $(this);
                        var originalBackgroundColor = $button.css("background-color");
                        var originalTextColor = $button.css("color");
                        var buttonStyle = $(".owl-social-share-buttons").attr("class").indexOf("style-filled") >= 0 ? "filled" : 
                                          $(".owl-social-share-buttons").attr("class").indexOf("style-outlined") >= 0 ? "outlined" : "minimal";
                        var useOriginalColors = $(".owl-social-share-buttons").attr("class").indexOf("original-colors") >= 0;
                        
                        // Store original values for restoration
                        $button.data("original-bg", originalBackgroundColor);
                        $button.data("original-color", originalTextColor);
                        
                        // Custom color values from module settings
                        var customHoverBgColor = "<?php echo $custom_hover_color; ?>";
                        var customHoverTextColor = "<?php echo $custom_text_hover_color; ?>";
                        
                        if (!useOriginalColors) {
                            if (buttonStyle === "filled") {
                                // For filled buttons, apply hover background and text color
                                $button.css({
                                    "background-color": customHoverBgColor,
                                    "color": customHoverTextColor
                                });
                            } else if (buttonStyle === "outlined") {
                                // For outlined buttons, apply hover color and fill with background
                                $button.css({
                                    "background-color": customHoverBgColor,
                                    "color": customHoverTextColor,
                                    "border-color": customHoverBgColor
                                });
                            } else if (buttonStyle === "minimal") {
                                // For minimal buttons, just change the text color
                                $button.css({
                                    "color": customHoverBgColor
                                });
                            }
                        } else {
                            // For original colors, handle outlined style specially
                            if (buttonStyle === "outlined") {
                                var borderColor = $button.css("border-color");
                                $button.css({
                                    "background-color": borderColor,
                                    "color": "#ffffff"
                                });
                            }
                        }
                    },
                    function() {
                        // Restore original values on mouseout
                        var $button = $(this);
                        $button.css({
                            "background-color": $button.data("original-bg"),
                            "color": $button.data("original-color"),
                            "border-color": $button.data("original-border")
                        });
                    }
                );
            });
        </script>';

        return $output;
    }
}

new OwlSocialShareButton;