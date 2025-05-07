<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class OwlSocialShareButton extends ET_Builder_Module {
    public  $slug = 'owl_social_share_button';
    public  $vb_support = 'on';
    public  $main_css_element = '%%order_class%%';

    protected  $module_credits = [ // Using short array syntax
        'module_uri' => 'https://owlpixel.com/social-share-button-divi',
        'author'     => 'Owlpixel',
        'author_uri' => 'https://owlpixel.com', // Corrected .comi to .com
    ];

    public function init(): void {
        $this->name = esc_html__('Owl Social Share Buttons', 'owl-social-sharing-buttons');
        $this->icon_path = plugin_dir_path(__FILE__) . 'icon.svg';
        // The category is already set as a class property.
        // If it needs to be translatable after object instantiation, this is okay.
        // Otherwise, it can be set directly in the property declaration if static.
        $this->category = esc_html__('Social', 'owl-social-sharing-buttons');

        $this->setup_styles();
    }

    public function setup_styles(): void {
        wp_enqueue_style(
            'owl-social-share-button',
            plugin_dir_url(__FILE__) . 'style.css',
            [], // Using short array syntax
            '1.0.0'
        );

        wp_enqueue_style(
            'font-awesome-5',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
            [], // Using short array syntax
            '5.15.4'
        );
    }

    public function get_fields(): array {
        return [
            // General Settings
            'title' => [
                'label'           => esc_html__('Title', 'owl-social-sharing-buttons'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter a title to display above the social buttons.', 'owl-social-sharing-buttons'),
                'toggle_slug'     => 'main_content',
            ],
            'show_title' => [
                'label'           => esc_html__('Show Title', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => [
                    'on'  => esc_html__('Yes', 'owl-social-sharing-buttons'),
                    'off' => esc_html__('No', 'owl-social-sharing-buttons'),
                ],
                'default'         => 'on',
                'toggle_slug'     => 'main_content',
            ],
            'custom_url' => [
                'label'           => esc_html__('Custom URL to Share', 'owl-social-sharing-buttons'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter a custom URL to share. Leave blank to use the current page URL.', 'owl-social-sharing-buttons'),
                'toggle_slug'     => 'main_content',
            ],
            'custom_title' => [
                'label'           => esc_html__('Custom Title to Share', 'owl-social-sharing-buttons'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter a custom title to share. Leave blank to use the current page title.', 'owl-social-sharing-buttons'),
                'toggle_slug'     => 'main_content',
            ],
            'custom_description' => [
                'label'           => esc_html__('Custom Description to Share', 'owl-social-sharing-buttons'),
                'type'            => 'textarea',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter a custom description to share.', 'owl-social-sharing-buttons'),
                'toggle_slug'     => 'main_content',
            ],
            'custom_image' => [
                'label'              => esc_html__('Custom Image to Share', 'owl-social-sharing-buttons'),
                'type'               => 'upload',
                'option_category'    => 'basic_option',
                'upload_button_text' => esc_attr__('Upload an image', 'owl-social-sharing-buttons'),
                'choose_text'        => esc_attr__('Choose an Image', 'owl-social-sharing-buttons'),
                'update_text'        => esc_attr__('Set As Image', 'owl-social-sharing-buttons'),
                'description'        => esc_html__('Upload a custom image to share.', 'owl-social-sharing-buttons'),
                'toggle_slug'        => 'main_content',
            ],

            // Network Settings
            // Example for Facebook, repeat for all networks
            'facebook' => [
                'label'           => esc_html__('Facebook', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'on',
                'toggle_slug'     => 'networks',
            ],
            'twitter' => [
                'label'           => esc_html__('Twitter/X', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'on',
                'toggle_slug'     => 'networks',
            ],
            'linkedin' => [
                'label'           => esc_html__('LinkedIn', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'on',
                'toggle_slug'     => 'networks',
            ],
            'pinterest' => [
                'label'           => esc_html__('Pinterest', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'on',
                'toggle_slug'     => 'networks',
            ],
            'reddit' => [
                'label'           => esc_html__('Reddit', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],
            'tumblr' => [
                'label'           => esc_html__('Tumblr', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],
            'whatsapp' => [
                'label'           => esc_html__('WhatsApp', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],
            'telegram' => [
                'label'           => esc_html__('Telegram', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],
             'viber' => [
                'label'           => esc_html__('Viber', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],
            'skype' => [
                'label'           => esc_html__('Skype', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],
            'messenger' => [
                'label'           => esc_html__('Messenger', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],
            'vk' => [
                'label'           => esc_html__('VK', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],
            'xing' => [
                'label'           => esc_html__('Xing', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],
            'email' => [
                'label'           => esc_html__('Email', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],
            'print' => [
                'label'           => esc_html__('Print', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'networks',
            ],

            // Display Settings
            'button_style' => [
                'label'           => esc_html__('Button Style', 'owl-social-sharing-buttons'),
                'type'            => 'select',
                'option_category' => 'layout',
                'options'         => [
                    'filled'   => esc_html__('Filled', 'owl-social-sharing-buttons'),
                    'outlined' => esc_html__('Outlined', 'owl-social-sharing-buttons'),
                    'minimal'  => esc_html__('Minimal', 'owl-social-sharing-buttons'),
                ],
                'default'         => 'filled',
                'toggle_slug'     => 'display',
            ],
            'button_shape' => [
                'label'           => esc_html__('Button Shape', 'owl-social-sharing-buttons'),
                'type'            => 'select',
                'option_category' => 'layout',
                'options'         => [
                    'square'  => esc_html__('Square', 'owl-social-sharing-buttons'),
                    'rounded' => esc_html__('Rounded', 'owl-social-sharing-buttons'),
                    'circle'  => esc_html__('Circle', 'owl-social-sharing-buttons'),
                ],
                'default'         => 'rounded',
                'toggle_slug'     => 'display',
            ],
            'button_size' => [
                'label'           => esc_html__('Button Size', 'owl-social-sharing-buttons'),
                'type'            => 'select',
                'option_category' => 'layout',
                'options'         => [
                    'small'  => esc_html__('Small', 'owl-social-sharing-buttons'),
                    'medium' => esc_html__('Medium', 'owl-social-sharing-buttons'),
                    'large'  => esc_html__('Large', 'owl-social-sharing-buttons'),
                ],
                'default'         => 'medium',
                'toggle_slug'     => 'display',
            ],
            'button_layout' => [
                'label'           => esc_html__('Button Layout', 'owl-social-sharing-buttons'),
                'type'            => 'select',
                'option_category' => 'layout',
                'options'         => [
                    'horizontal' => esc_html__('Horizontal', 'owl-social-sharing-buttons'),
                    'vertical'   => esc_html__('Vertical', 'owl-social-sharing-buttons'),
                    'grid'       => esc_html__('Grid', 'owl-social-sharing-buttons'),
                ],
                'default'         => 'horizontal',
                'toggle_slug'     => 'display',
            ],
            'show_label' => [
                'label'           => esc_html__('Show Label', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'on',
                'toggle_slug'     => 'display',
            ],
            'show_count' => [
                'label'           => esc_html__('Show Share Count', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'off',
                'toggle_slug'     => 'display',
                'description'     => esc_html__('Note: Share count requires API setup for most networks and is not implemented in the current free version of this module.', 'owl-social-sharing-buttons'),
            ],
            'hover_animation' => [
                'label'           => esc_html__('Hover Animation', 'owl-social-sharing-buttons'),
                'type'            => 'select',
                'option_category' => 'layout',
                'options'         => [
                    'none'   => esc_html__('None', 'owl-social-sharing-buttons'),
                    'grow'   => esc_html__('Grow', 'owl-social-sharing-buttons'),
                    'shrink' => esc_html__('Shrink', 'owl-social-sharing-buttons'),
                    'pulse'  => esc_html__('Pulse', 'owl-social-sharing-buttons'), // Note: Pulse animation often needs CSS keyframes
                    'float'  => esc_html__('Float', 'owl-social-sharing-buttons'),
                    'rotate' => esc_html__('Rotate', 'owl-social-sharing-buttons'),
                ],
                'default'         => 'grow',
                'toggle_slug'     => 'display',
            ],
            'alignment' => [
                'label'           => esc_html__('Alignment', 'owl-social-sharing-buttons'),
                'type'            => 'select',
                'option_category' => 'layout',
                'options'         => [
                    'left'                 => esc_html__('Left', 'owl-social-sharing-buttons'),
                    'center'               => esc_html__('Center', 'owl-social-sharing-buttons'),
                    'right'                => esc_html__('Right', 'owl-social-sharing-buttons'),
                    'left_top_fixed'       => esc_html__('Left Top (Fixed)', 'owl-social-sharing-buttons'),
                    'left_center_fixed'    => esc_html__('Left Center (Fixed)', 'owl-social-sharing-buttons'),
                    'left_bottom_fixed'    => esc_html__('Left Bottom (Fixed)', 'owl-social-sharing-buttons'),
                    'right_top_fixed'      => esc_html__('Right Top (Fixed)', 'owl-social-sharing-buttons'),
                    'right_center_fixed'   => esc_html__('Right Center (Fixed)', 'owl-social-sharing-buttons'),
                    'right_bottom_fixed'   => esc_html__('Right Bottom (Fixed)', 'owl-social-sharing-buttons'),
                ],
                'default'         => 'left',
                'toggle_slug'     => 'display',
            ],
            'mobile_position' => [
                'label'           => esc_html__('Mobile Position (for Fixed Alignment)', 'owl-social-sharing-buttons'),
                'type'            => 'select',
                'option_category' => 'layout',
                'options'         => [
                    'default'      => esc_html__('Same as Desktop', 'owl-social-sharing-buttons'),
                    'bottom_fixed' => esc_html__('Bottom Fixed (Mobile)', 'owl-social-sharing-buttons'),
                    'top_fixed'    => esc_html__('Top Fixed (Mobile)', 'owl-social-sharing-buttons'),
                ],
                'default'         => 'bottom_fixed',
                'toggle_slug'     => 'display',
                // 'show_if_not' implies it shows if alignment is NOT one of these.
                // This seems to intend it shows IF alignment IS one of the fixed ones.
                // A better approach for show_if for fixed might be to list the fixed alignments.
                // Or, handle visibility based on 'alignment' containing '_fixed'.
                // For simplicity, rely on user understanding or adjust if Divi supports regex/contains for show_if.
                'description'     => esc_html__('Applies when a "Fixed" alignment is chosen for desktop.', 'owl-social-sharing-buttons'),
            ],
            // 'floating_position' and 'mobile_floating_position' were mentioned in the original but had 'show_if' => 'floating'
            // which seems to be a button_style not present in the provided styles. Assuming these are not primary for now.

            // Advanced Settings
            'custom_css_class' => [
                'label'           => esc_html__('Custom CSS Class', 'owl-social-sharing-buttons'),
                'type'            => 'text',
                'option_category' => 'configuration',
                'description'     => esc_html__('Enter custom CSS class names for this module, separated by spaces.', 'owl-social-sharing-buttons'),
                'toggle_slug'     => 'custom_css',
                'tab_slug'        => 'advanced',
            ],
            'use_original_colors' => [
                'label'           => esc_html__('Use Original Network Colors', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'on',
                'toggle_slug'     => 'styling',
                'tab_slug'        => 'advanced',
            ],
            'custom_color' => [
                'label'        => esc_html__('Custom Button Color', 'owl-social-sharing-buttons'),
                'type'         => 'color-alpha',
                'custom_color' => true,
                'default'      => '#444444',
                'toggle_slug'  => 'styling',
                'tab_slug'     => 'advanced',
                'show_if'      => ['use_original_colors' => 'off'],
            ],
            'custom_hover_color' => [
                'label'        => esc_html__('Custom Button Hover Color', 'owl-social-sharing-buttons'),
                'type'         => 'color-alpha',
                'custom_color' => true,
                'default'      => '#222222',
                'toggle_slug'  => 'styling',
                'tab_slug'     => 'advanced',
                'show_if'      => ['use_original_colors' => 'off'],
            ],
            'custom_text_color' => [
                'label'        => esc_html__('Custom Text/Icon Color', 'owl-social-sharing-buttons'),
                'type'         => 'color-alpha',
                'custom_color' => true,
                'default'      => '#ffffff',
                'toggle_slug'  => 'styling',
                'tab_slug'     => 'advanced',
                'show_if'      => ['use_original_colors' => 'off'],
            ],
            'custom_text_hover_color' => [
                'label'        => esc_html__('Custom Text/Icon Hover Color', 'owl-social-sharing-buttons'),
                'type'         => 'color-alpha',
                'custom_color' => true,
                'default'      => '#ffffff',
                'toggle_slug'  => 'styling',
                'tab_slug'     => 'advanced',
                'show_if'      => ['use_original_colors' => 'off'],
            ],
            'spacing' => [
                'label'           => esc_html__('Button Spacing (Gap)', 'owl-social-sharing-buttons'),
                'type'            => 'range',
                'option_category' => 'layout',
                'default'         => '10px',
                'range_settings'  => ['min' => '0', 'max' => '50', 'step' => '1'],
                'validate_unit'   => true,
                'fixed_unit'      => 'px',
                'toggle_slug'     => 'spacing',
                'tab_slug'        => 'advanced',
            ],
            'icon_font_size' => [
                'label'           => esc_html__('Icon Font Size', 'owl-social-sharing-buttons'),
                'type'            => 'range',
                'option_category' => 'font_option',
                'default'         => '16px',
                'range_settings'  => ['min' => '10', 'max' => '50', 'step' => '1'],
                'validate_unit'   => true,
                'fixed_unit'      => 'px',
                'toggle_slug'     => 'fonts',
                'tab_slug'        => 'advanced',
            ],
            'label_font_size' => [
                'label'           => esc_html__('Label Font Size', 'owl-social-sharing-buttons'),
                'type'            => 'range',
                'option_category' => 'font_option',
                'default'         => '14px',
                'range_settings'  => ['min' => '10', 'max' => '30', 'step' => '1'],
                'validate_unit'   => true,
                'fixed_unit'      => 'px',
                'toggle_slug'     => 'fonts',
                'tab_slug'        => 'advanced',
                'show_if'         => ['show_label' => 'on'],
            ],
            'open_in_new_tab' => [
                'label'           => esc_html__('Open Links in New Tab', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'on',
                'toggle_slug'     => 'links',
                'tab_slug'        => 'advanced',
            ],
            'add_rel_nofollow' => [
                'label'           => esc_html__('Add rel="nofollow" to Links', 'owl-social-sharing-buttons'),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => ['on' => esc_html__('Yes', 'owl-social-sharing-buttons'), 'off' => esc_html__('No', 'owl-social-sharing-buttons')],
                'default'         => 'on', // Good default for SEO on share links
                'toggle_slug'     => 'links',
                'tab_slug'        => 'advanced',
            ],
        ];
    }

    public function get_settings_modal_toggles(): array {
        return [
            'general'  => [
                'toggles' => [
                    'main_content' => esc_html__('Content', 'owl-social-sharing-buttons'),
                    'networks'     => esc_html__('Networks', 'owl-social-sharing-buttons'),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'display'    => esc_html__('Display Settings', 'owl-social-sharing-buttons'),
                    'styling'    => esc_html__('Styling', 'owl-social-sharing-buttons'),
                    'spacing'    => esc_html__('Spacing & Sizing', 'owl-social-sharing-buttons'),
                    'fonts'      => esc_html__('Fonts', 'owl-social-sharing-buttons'),
                    'links'      => esc_html__('Link Behavior', 'owl-social-sharing-buttons'),
                    'custom_css' => esc_html__('Custom CSS', 'owl-social-sharing-buttons'),
                ],
            ],
        ];
    }

    public function render($attrs, $content = null, $render_slug): string {
        $final_output = '';

        // Get prop values with defaults
        $title_text             = $this->props['title'] ?? '';
        $show_title             = ($this->props['show_title'] ?? 'on') === 'on';
        $custom_url             = $this->props['custom_url'] ?? '';
        $custom_title_text      = $this->props['custom_title'] ?? '';
        $custom_description_text = $this->props['custom_description'] ?? '';
        $custom_image_url       = $this->props['custom_image'] ?? '';

        $button_style_val      = $this->props['button_style'] ?? 'filled';
        $button_shape_val      = $this->props['button_shape'] ?? 'rounded';
        $button_size_val       = $this->props['button_size'] ?? 'medium';
        $button_layout_val     = $this->props['button_layout'] ?? 'horizontal';
        $show_label_val        = ($this->props['show_label'] ?? 'on') === 'on';
        $show_count_val        = ($this->props['show_count'] ?? 'off') === 'on';
        $hover_animation_val   = $this->props['hover_animation'] ?? 'grow';
        $alignment_val         = $this->props['alignment'] ?? 'left';
        $mobile_position_val   = $this->props['mobile_position'] ?? 'bottom_fixed';

        $custom_css_class_val  = $this->props['custom_css_class'] ?? '';
        $use_original_colors_val = ($this->props['use_original_colors'] ?? 'on') === 'on';
        $custom_color_val        = $this->props['custom_color'] ?? '#444444';
        $custom_hover_color_val  = $this->props['custom_hover_color'] ?? '#222222';
        $custom_text_color_val   = $this->props['custom_text_color'] ?? '#ffffff';
        $custom_text_hover_color_val = $this->props['custom_text_hover_color'] ?? '#ffffff';
        $spacing_val             = $this->props['spacing'] ?? '10px';
        $icon_font_size_val      = $this->props['icon_font_size'] ?? '16px';
        $label_font_size_val     = $this->props['label_font_size'] ?? '14px';
        $open_in_new_tab_val     = ($this->props['open_in_new_tab'] ?? 'on') === 'on';
        $add_rel_nofollow_val    = ($this->props['add_rel_nofollow'] ?? 'on') === 'on';

        // Prepare variables for JS
        $js_custom_hover_bg_color    = esc_js($custom_hover_color_val);
        $js_custom_hover_text_color  = esc_js($custom_text_hover_color_val);


        $defined_networks = [
            'facebook'  => ['name' => 'Facebook',  'icon' => 'fab fa-facebook-f',    'url' => 'https://www.facebook.com/sharer/sharer.php?u={url}&t={title}', 'color' => '#3b5998'],
            'twitter'   => ['name' => 'Twitter/X', 'icon' => 'fab fa-twitter',       'url' => 'https://twitter.com/intent/tweet?url={url}&text={title}', 'color' => '#1da1f2'],
            'linkedin'  => ['name' => 'LinkedIn',  'icon' => 'fab fa-linkedin-in',   'url' => 'https://www.linkedin.com/shareArticle?mini=true&url={url}&title={title}&summary={description}', 'color' => '#0077b5'],
            'pinterest' => ['name' => 'Pinterest', 'icon' => 'fab fa-pinterest-p',   'url' => 'https://pinterest.com/pin/create/button/?url={url}&media={image}&description={title}', 'color' => '#e60023'],
            'reddit'    => ['name' => 'Reddit',    'icon' => 'fab fa-reddit-alien',  'url' => 'https://reddit.com/submit?url={url}&title={title}', 'color' => '#ff4500'],
            'tumblr'    => ['name' => 'Tumblr',    'icon' => 'fab fa-tumblr',        'url' => 'https://www.tumblr.com/share/link?url={url}&name={title}&description={description}', 'color' => '#35465c'],
            'whatsapp'  => ['name' => 'WhatsApp',  'icon' => 'fab fa-whatsapp',      'url' => 'https://api.whatsapp.com/send?text={title}%20{url}', 'color' => '#25d366'],
            'telegram'  => ['name' => 'Telegram',  'icon' => 'fab fa-telegram-plane','url' => 'https://t.me/share/url?url={url}&text={title}', 'color' => '#0088cc'],
            'viber'     => ['name' => 'Viber',     'icon' => 'fab fa-viber',         'url' => 'viber://forward?text={title}%20{url}', 'color' => '#665cac'],
            'skype'     => ['name' => 'Skype',     'icon' => 'fab fa-skype',         'url' => 'https://web.skype.com/share?url={url}&text={title}', 'color' => '#00aff0'],
            'messenger' => ['name' => 'Messenger', 'icon' => 'fab fa-facebook-messenger','url' => 'https://www.facebook.com/dialog/send?app_id=YOUR_APP_ID&link={url}&redirect_uri={url_encoded_current_page}', 'color' => '#0078ff'], // IMPORTANT: Replace YOUR_APP_ID
            'vk'        => ['name' => 'VK',        'icon' => 'fab fa-vk',            'url' => 'https://vk.com/share.php?url={url}&title={title}&description={description}&image={image}', 'color' => '#4a76a8'],
            'xing'      => ['name' => 'Xing',      'icon' => 'fab fa-xing',          'url' => 'https://www.xing.com/app/user?op=share&url={url}', 'color' => '#026466'],
            'email'     => ['name' => 'Email',     'icon' => 'fas fa-envelope',      'url' => 'mailto:?subject={title}&body={description}%20{url}', 'color' => '#7d7d7d'], // Changed color for better default
            'print'     => ['name' => 'Print',     'icon' => 'fas fa-print',         'url' => '#', 'color' => '#6d6d6d'],
        ];

        $active_networks = [];
        foreach ($defined_networks as $key => $details) {
            if (($this->props[$key] ?? 'off') === 'on') {
                $active_networks[$key] = $details;
            }
        }

        // CSS Classes
        $module_classes = ['owl-social-share-buttons'];
        $module_classes[] = 'style-' . sanitize_html_class($button_style_val);
        $module_classes[] = 'shape-' . sanitize_html_class($button_shape_val);
        $module_classes[] = 'layout-' . sanitize_html_class($button_layout_val);
        if (!empty($hover_animation_val) && $hover_animation_val !== 'none') {
            $module_classes[] = 'hover-' . sanitize_html_class($hover_animation_val);
        }
        if ($show_label_val) $module_classes[] = 'show-label';
        if ($show_count_val) $module_classes[] = 'show-count'; // Actual count fetching/display is separate
        $module_classes[] = $use_original_colors_val ? 'original-colors' : 'custom-colors';
        if (!empty($custom_css_class_val)) $module_classes[] = sanitize_html_class($custom_css_class_val);


        // Button Dimensions
        $btn_height = '40px'; $btn_padding = '0 15px'; $btn_min_width = 'auto';
        if ($show_label_val) $btn_min_width = '100px'; // Only apply min-width if labels are shown

        if ($button_size_val === 'small') { $btn_height = '30px'; $btn_padding = '0 10px'; if ($show_label_val) $btn_min_width = '80px'; }
        if ($button_size_val === 'large') { $btn_height = '50px'; $btn_padding = '0 20px'; if ($show_label_val) $btn_min_width = '120px'; }

        $btn_radius = '4px'; // default for rounded
        if ($button_shape_val === 'square') $btn_radius = '0';
        if ($button_shape_val === 'circle') $btn_radius = '50px';

        // Container Styles
        $container_style_props = ['width: 100%;']; // Main module wrapper
        $buttons_wrap_style_props = ['display: flex;', 'flex-wrap: wrap;']; // Direct wrapper for buttons

        // Alignment for the buttons wrapper
        if ($alignment_val === 'center') {
            $buttons_wrap_style_props[] = 'justify-content: center;';
            $module_classes[] = 'et_pb_text_align_center'; // For title alignment if needed
        } elseif ($alignment_val === 'right') {
            $buttons_wrap_style_props[] = 'justify-content: flex-end;';
            $module_classes[] = 'et_pb_text_align_right'; // For title alignment
        } else { // left
            $buttons_wrap_style_props[] = 'justify-content: flex-start;';
            $module_classes[] = 'et_pb_text_align_left'; // For title alignment
        }

        $is_fixed_position = strpos($alignment_val, '_fixed') !== false;

        if ($is_fixed_position) {
            $container_style_props = ['position: fixed;', 'z-index: 1000;']; // Higher z-index
            $buttons_wrap_style_props[] = 'flex-direction: column;'; // Fixed usually vertical

            if (strpos($alignment_val, 'left_top') !== false) $container_style_props[] = 'top: 20px; left: 20px;';
            elseif (strpos($alignment_val, 'left_center') !== false) $container_style_props[] = 'top: 50%; left: 20px; transform: translateY(-50%);';
            elseif (strpos($alignment_val, 'left_bottom') !== false) $container_style_props[] = 'bottom: 20px; left: 20px;';
            elseif (strpos($alignment_val, 'right_top') !== false) $container_style_props[] = 'top: 20px; right: 20px;';
            elseif (strpos($alignment_val, 'right_center') !== false) $container_style_props[] = 'top: 50%; right: 20px; transform: translateY(-50%);';
            elseif (strpos($alignment_val, 'right_bottom') !== false) $container_style_props[] = 'bottom: 20px; right: 20px;';

            // Mobile specific styles for fixed position
            if ($mobile_position_val !== 'default') {
                $module_classes[] = 'mobile-fixed-' . sanitize_html_class($mobile_position_val);
                // Corresponding CSS for .mobile-fixed-bottom_fixed and .mobile-fixed-top_fixed should be in style.css or added via wp_add_inline_style
                // For brevity, not adding large CSS blocks here. Example:
                // wp_add_inline_style('owl-social-share-button-style-handle', '@media (max-width: 767px) { .owl-social-share-buttons.mobile-fixed-bottom_fixed { /* styles */ } }');
            }
        } else { // Not fixed
            if ($button_layout_val === 'vertical') {
                $buttons_wrap_style_props[] = 'flex-direction: column;';
                 // For vertical non-fixed, ensure alignment of items if container is wider
                if($alignment_val === 'center') $buttons_wrap_style_props[] = 'align-items: center;';
                else if ($alignment_val === 'right') $buttons_wrap_style_props[] = 'align-items: flex-end;';
                else $buttons_wrap_style_props[] = 'align-items: flex-start;';

            } elseif ($button_layout_val === 'grid') {
                $buttons_wrap_style_props = [ // Override for grid
                    'display: grid;',
                    'grid-template-columns: repeat(auto-fill, minmax(' . esc_attr($show_label_val ? '120px' : '40px') . ', 1fr));', // Adjust minmax based on label
                    'gap: ' . esc_attr($spacing_val) . ';',
                ];
            }
        }

        // Link Attributes
        $link_attr_str = '';
        if ($open_in_new_tab_val) $link_attr_str .= ' target="_blank"';
        if ($add_rel_nofollow_val) $link_attr_str .= ' rel="nofollow noopener noreferrer"';


        // Share URL and Content
        $current_page_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . ($_SERVER['HTTP_HOST'] ?? '') . ($_SERVER['REQUEST_URI'] ?? '');
        $share_url_final = !empty($custom_url) ? $custom_url : $current_page_url;
        
        $share_title_final = $custom_title_text;
        if (empty($share_title_final) && function_exists('get_the_title')) {
            $share_title_final = get_the_title();
        }
        if (empty($share_title_final)) {
            $share_title_final = esc_html__('Check this out!', 'owl-social-sharing-buttons');
        }

        $share_desc_final = $custom_description_text;
        if (empty($share_desc_final) && function_exists('get_the_excerpt')) {
             $share_desc_final = get_the_excerpt(); // Note: get_the_excerpt() might need a post ID if not in loop
        }
         if (empty($share_desc_final)) {
            $share_desc_final = ''; // Keep it empty if no specific description
        }

        $share_image_final = $custom_image_url;
        if (empty($share_image_final) && function_exists('get_the_post_thumbnail_url') && function_exists('get_the_ID') && has_post_thumbnail(get_the_ID())) {
            $share_image_final = get_the_post_thumbnail_url(get_the_ID(), 'full');
        }

        // Data attributes for JS hover effects if custom colors are used
        $module_data_attrs = '';
        if (!$use_original_colors_val) {
            $module_data_attrs = sprintf(
                ' data-custom-hover-bg="%s" data-custom-hover-text="%s"',
                esc_attr($custom_color_val), // Default state, JS will use custom_hover_color_val
                esc_attr($custom_text_color_val) // Default state
            );
        }

        // Start Output
        $final_output .= sprintf(
            '<div class="%s" style="%s"%s>',
            esc_attr(implode(' ', array_unique($module_classes))),
            esc_attr(implode(' ', $container_style_props)),
            $module_data_attrs
        );

        if ($show_title && !empty($title_text)) {
            $title_style = 'margin-bottom: 15px; font-weight: 600; display: block; width: 100%; clear: both;';
            // Inherit text-align from parent if et_pb_text_align_* class is set
            $final_output .= sprintf('<h3 class="owl-social-share-title" style="%s">%s</h3>', esc_attr($title_style), esc_html($title_text));
        }

        $final_output .= sprintf('<div class="owl-social-share-buttons-wrap" style="%s">', esc_attr(implode(' ', $buttons_wrap_style_props)));

        foreach ($active_networks as $network_key => $network) {
            $network_share_url = $network['url'];
            $network_share_url = str_replace('{url}', rawurlencode($share_url_final), $network_share_url);
            $network_share_url = str_replace('{title}', rawurlencode(wp_strip_all_tags($share_title_final)), $network_share_url);
            $network_share_url = str_replace('{description}', rawurlencode(wp_strip_all_tags($share_desc_final)), $network_share_url);
            $network_share_url = str_replace('{image}', rawurlencode($share_image_final), $network_share_url);
            // Specific for Messenger app_id and redirect_uri if needed
             if ($network_key === 'messenger') {
                 $network_share_url = str_replace('{url_encoded_current_page}', rawurlencode($share_url_final), $network_share_url);
                 // Reminder: YOUR_APP_ID needs to be replaced or made configurable.
                 // For testing, you can remove app_id, but it's recommended for full functionality.
                 // $network_share_url = str_replace('app_id=YOUR_APP_ID&', '', $network_share_url);
             }


            $btn_styles_arr = [
                'display: inline-flex;', 'align-items: center;', 'justify-content: center;',
                'height: ' . esc_attr($btn_height) . ';',
                'padding: ' . esc_attr($btn_padding) . ';',
                'border-radius: ' . esc_attr($btn_radius) . ';',
                'text-decoration: none;', 'transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, transform 0.3s ease;',
                'cursor: pointer;', 'overflow: hidden;', 'position: relative;',
                'line-height: 1;', // Ensure icon and text align well
            ];
            if ($button_layout_val !== 'grid') { // Grid handles gap, others need margin
                 $btn_styles_arr[] = 'margin-right: ' . esc_attr($spacing_val) . ';';
                 $btn_styles_arr[] = 'margin-bottom: ' . esc_attr($spacing_val) . ';';
            }


            if ($show_label_val) {
                $btn_styles_arr[] = 'min-width: ' . esc_attr($btn_min_width) . ';';
            } else {
                 // For icon-only circle buttons, ensure width equals height for a perfect circle
                if ($button_shape_val === 'circle') {
                    $btn_styles_arr[] = 'width: ' . esc_attr($btn_height) . ';';
                    $btn_styles_arr[] = 'padding: 0;'; // Override padding
                }
            }


            if ($button_style_val === 'filled') {
                $bg_color = $use_original_colors_val ? $network['color'] : $custom_color_val;
                $text_color = $use_original_colors_val ? '#ffffff' : $custom_text_color_val;
                $btn_styles_arr[] = 'background-color: ' . esc_attr($bg_color) . ';';
                $btn_styles_arr[] = 'color: ' . esc_attr($text_color) . ';';
                $btn_styles_arr[] = 'border: 1px solid ' . esc_attr($bg_color) . ';'; // Border for consistency, same as bg
            } elseif ($button_style_val === 'outlined') {
                $border_color = $use_original_colors_val ? $network['color'] : $custom_color_val;
                $text_color = $use_original_colors_val ? $network['color'] : $custom_color_val; // Text color is usually same as border
                $btn_styles_arr[] = 'background-color: transparent;';
                $btn_styles_arr[] = 'color: ' . esc_attr($text_color) . ';';
                $btn_styles_arr[] = 'border: 2px solid ' . esc_attr($border_color) . ';';
            } elseif ($button_style_val === 'minimal') {
                $text_color = $use_original_colors_val ? $network['color'] : $custom_color_val;
                $btn_styles_arr[] = 'background-color: transparent;';
                $btn_styles_arr[] = 'color: ' . esc_attr($text_color) . ';';
                $btn_styles_arr[] = 'border: none;';
            }

            $icon_style_str = 'font-size: ' . esc_attr($icon_font_size_val) . ';';
            $label_style_str = 'font-size: ' . esc_attr($label_font_size_val) . '; font-weight: 500;';
            if ($show_label_val) { // Add margin to icon if label is present
                $icon_style_str .= ' margin-right: 8px;';
            }


            $button_inner_html = sprintf('<i class="%s" style="%s" aria-hidden="true"></i>', esc_attr($network['icon']), esc_attr($icon_style_str));
            if ($show_label_val) {
                $button_inner_html .= sprintf('<span class="owl-social-share-label" style="%s">%s</span>', esc_attr($label_style_str), esc_html($network['name']));
            }
            if ($show_count_val) {
                // Actual share count fetching would require JS APIs and is complex. This is a placeholder.
                $button_inner_html .= '<span class="owl-social-share-count" style="background-color: rgba(0,0,0,0.05); border-radius: 3px; padding: 2px 6px; margin-left: 8px; font-size: 0.8em;">0</span>';
            }

            $final_output .= sprintf(
                '<a href="%s" class="owl-social-share-button owl-social-share-%s" style="%s" %s data-network-color="%s" data-network-text-color="%s">%s</a>',
                esc_url($network_share_url),
                esc_attr($network_key),
                esc_attr(implode(' ', $btn_styles_arr)),
                $link_attr_str,
                esc_attr($network['color']), // Store original network color for JS hover
                esc_attr($button_style_val === 'filled' ? '#ffffff' : $network['color']), // Store original text color for JS hover
                $button_inner_html
            );
        }

        $final_output .= '</div>'; // Close .owl-social-share-buttons-wrap
        $final_output .= '</div>'; // Close .owl-social-share-buttons

        // Inline script for hover effects and special functionalities
        // Using CSS :hover for animations like grow, shrink, float, rotate is generally more performant.
        // JS is used here for color changes that depend on module settings.
        $final_output .= "
        <script type='text/javascript'>
        jQuery(document).ready(function($) {
            var \$module = $('.owl-social-share-buttons.{$render_slug}'); // Scope to current module instance
            if (!\$module.length) \$module = $('%%order_class%%'); // Fallback for VB or other contexts

            // Print functionality
            \$module.find('.owl-social-share-print a').on('click', function(e) {
                e.preventDefault();
                window.print();
            });

            var buttons = \$module.find('.owl-social-share-button');
            var moduleClasses = \$module.attr('class') || '';
            var isOriginalColors = moduleClasses.includes('original-colors');
            var buttonStyle = 'filled'; // Default
            if (moduleClasses.includes('style-outlined')) buttonStyle = 'outlined';
            else if (moduleClasses.includes('style-minimal')) buttonStyle = 'minimal';

            var customHoverBg = \$module.data('custom-hover-bg') || '" . $js_custom_hover_bg_color . "';
            var customHoverText = \$module.data('custom-hover-text') || '" . $js_custom_hover_text_color . "';

            buttons.each(function() {
                var \$button = $(this);
                // Store original CSS for restoring on mouseout
                \$button.data('original-css', {
                    'background-color': \$button.css('background-color'),
                    'color': \$button.css('color'),
                    'border-color': \$button.css('border-color')
                });
                var networkColor = \$button.data('network-color');
                var originalNetworkTextColor = \$button.data('network-text-color') || networkColor;


                \$button.hover(function() {
                    if (isOriginalColors) {
                        if (buttonStyle === 'outlined') {
                            $(this).css({ 'background-color': networkColor, 'color': '#ffffff', 'border-color': networkColor });
                        } else if (buttonStyle === 'filled') {
                            // Darken or lighten original color slightly for hover on filled
                            // This is a simple example, a real color manipulation library would be better
                             $(this).css({'opacity': '0.85'}); // Simple opacity change
                        } else if (buttonStyle === 'minimal') {
                             $(this).css({'opacity': '0.75'});
                        }
                    } else { // Custom colors
                        if (buttonStyle === 'filled') {
                            $(this).css({ 'background-color': customHoverBg, 'color': customHoverText, 'border-color': customHoverBg });
                        } else if (buttonStyle === 'outlined') {
                            $(this).css({ 'background-color': customHoverBg, 'color': customHoverText, 'border-color': customHoverBg });
                        } else if (buttonStyle === 'minimal') {
                            $(this).css({ 'color': customHoverBg }); // For minimal, hover BG often means text color
                        }
                    }
                }, function() { // Mouseout
                    $(this).css($(this).data('original-css'));
                     if (isOriginalColors && (buttonStyle === 'filled' || buttonStyle === 'minimal')) {
                        $(this).css({'opacity': '1'}); // Reset opacity
                    }
                });
            });
        });
        </script>";

        return $final_output;
    }
}

new OwlSocialShareButton;