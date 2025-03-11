<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Advance_Image_Gallery_widgets extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'huge-advanced-image-gallery';
    }

    public function get_title(): string {
        return esc_html__( 'Huge Advance Image Gallery', 'huge_image_gallery' );
    }

    public function get_icon(): string {
        return 'eicon-code';
    }

    public function get_categories(): array {
        return [ 'basic' ];
    }
    
    // Add Masonry as a script dependency
    public function get_script_depends() {
        return ['huge_imagesloaded', 'huge_masonry', 'huge_advanced_image_gallery_js'];
    }
    public function get_style_depends() {
        return ['huge_advanced_image_gallery_css'];
    }
    

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'huge_image_gallery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'images',
            [
                'label' => __( 'Add Images', 'huge_image_gallery' ),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'       => __('Columns', 'huge_image_gallery'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'description' => __('Set the number of columns for different screen sizes.', 'huge_image_gallery'),
                'options'     => [
                    '1' => __('1 Column', 'huge_image_gallery'),
                    '2' => __('2 Columns', 'huge_image_gallery'),
                    '3' => __('3 Columns', 'huge_image_gallery'),
                    '4' => __('4 Columns', 'huge_image_gallery'),
                    '5' => __('5 Columns', 'huge_image_gallery'),
                    '6' => __('6 Columns', 'huge_image_gallery'),
                    '8' => __('8 Columns', 'huge_image_gallery'),
                    '10' => __('10 Columns', 'huge_image_gallery'),
                    '12' => __('12 Columns', 'huge_image_gallery'),
                ],
                'default'     => '3',
                'selectors'   => [
                    '{{WRAPPER}} .advanced-image-gallery' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
                'condition' => [
                    'enable_masonry!' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => __('Grid Gap', 'huge_image_gallery'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', '%'], 
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .advanced-image-gallery' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_masonry!' => 'yes',
                ],
            ]
        );
        

        $this->add_control(
            'enable_lightbox',
            [
                'label' => __( 'Enable Lightbox', 'huge_image_gallery' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'huge_image_gallery' ),
                'label_off' => __( 'No', 'huge_image_gallery' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'enable_lightbox_gallery',
            [
                'label'        => __( 'Enable Lightbox Gallery', 'huge_image_gallery' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'description'  => __( 'If enabled, images will be grouped in a gallery for lightbox navigation.', 'huge_image_gallery' ),
                'default'      => 'yes',
                'condition'    => [
                    'enable_lightbox' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_overlay',
            [
                'label'        => __( 'Enable Overlay', 'huge_image_gallery' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label'        => __( 'Show Icon on Overlay', 'huge_image_gallery' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'no',
                'condition'    => [
                    'enable_overlay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'overlay_icon',
            [
                'label'        => __( 'Overlay Icon', 'huge_image_gallery' ),
                'type'         => \Elementor\Controls_Manager::ICONS,
                'default'      => [
                    'value'   => 'fas fa-search',
                    'library' => 'fa-solid',
                ],
                'condition'    => [
                    'enable_overlay' => 'yes',
                    'show_icon'      => 'yes',
                ],
            ]
        );

        $this->add_control(
            'overlay_animation',
            [
                'label'        => __( 'Overlay Animation', 'huge_image_gallery' ),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'options'      => [
                    'fade-in'        => __( 'Fade In', 'huge_image_gallery' ),
                    'fade-out'       => __( 'Fade Out', 'huge_image_gallery' ),
                    'fade-in-up'     => __( 'Fade In Up', 'huge_image_gallery' ),
                    'fade-in-down'   => __( 'Fade In Down', 'huge_image_gallery' ),
                    'fade-in-left'   => __( 'Fade In Left', 'huge_image_gallery' ),
                    'fade-in-right'  => __( 'Fade In Right', 'huge_image_gallery' ),
                    'fade-out-up'    => __( 'Fade Out Up', 'huge_image_gallery' ), 
                    'fade-out-down'  => __( 'Fade Out Down', 'huge_image_gallery' ), 
                    'fade-out-left'  => __( 'Fade Out Left', 'huge_image_gallery' ), 
                    'fade-out-right' => __( 'Fade Out Right', 'huge_image_gallery' ), 
                    'slide-up'       => __( 'Slide Up', 'huge_image_gallery' ),
                    'slide-down'     => __( 'Slide Down', 'huge_image_gallery' ),
                    'slide-left'     => __( 'Slide Left', 'huge_image_gallery' ),
                    'slide-right'    => __( 'Slide Right', 'huge_image_gallery' ),
                    'zoom-in'        => __( 'Zoom In', 'huge_image_gallery' ),
                    'zoom-out'       => __( 'Zoom Out', 'huge_image_gallery' ),
                    'rotate'         => __( 'Rotate', 'huge_image_gallery' ),
                    'flip'           => __( 'Flip', 'huge_image_gallery' ),
                    'scale'          => __( 'Scale', 'huge_image_gallery' ),
                    'wipe'           => __( 'Wipe', 'huge_image_gallery' ),
                    'pulse'          => __( 'Pulse', 'huge_image_gallery' ),
                    'none'           => __( 'None', 'huge_image_gallery' ),
                ],
                'default'      => 'fade-in',
                'condition'    => [
                    'enable_overlay' => 'yes',
                ],
            ]
        );

        // Toggle for enabling fixed height
        $this->add_control(
            'enable_fixed_height',
            [
                'label' => __( 'Enable Fixed Image Height', 'huge_image_gallery' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'huge_image_gallery' ),
                'label_off' => __( 'No', 'huge_image_gallery' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'enable_masonry!' => 'yes',
                ],
            ]
        );

        // Fixed Height Value
        $this->add_control(
            'fixed_height',
            [
                'label' => __( 'Image Height', 'huge_image_gallery' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [ 'min' => 50, 'max' => 500 ],
                ],
                'default' => [ 'size' => 200, 'unit' => 'px' ],
                'condition' => [
                    'enable_fixed_height' => 'yes',
                    'enable_masonry!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_caption',
            [
                'label' => __('Show Caption', 'huge_image_gallery'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'huge_image_gallery'),
                'label_off' => __('No', 'huge_image_gallery'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition'    => [
                    'enable_overlay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_masonry',
            [
                'label' => __( 'Enable Masonry', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'plugin-name' ),
                'label_off' => __( 'No', 'plugin-name' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        
        $this->add_control(
            'masonry_columns',
            [
                'label'       => __('Masonry Columns', 'huge_image_gallery'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'description' => __('Set the number of columns for Masonry layout.', 'huge_image_gallery'),
                'options'     => [
                    '1' => __('1 Column', 'huge_image_gallery'),
                    '2' => __('2 Columns', 'huge_image_gallery'),
                    '3' => __('3 Columns', 'huge_image_gallery'),
                    '4' => __('4 Columns', 'huge_image_gallery'),
                    '5' => __('5 Columns', 'huge_image_gallery'),
                    '6' => __('6 Columns', 'huge_image_gallery'),
                    '8' => __('8 Columns', 'huge_image_gallery'),
                    '10' => __('10 Columns', 'huge_image_gallery'),
                    '12' => __('12 Columns', 'huge_image_gallery'),
                ],
                'default'     => '3',
                'condition'   => [
                    'enable_masonry' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'masonry_gap',
            [
                'label' => __('Masonry Gap', 'huge_image_gallery'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'condition' => [
                    'enable_masonry' => 'yes',
                ],
            ]
        );
        

        $this->end_controls_section();

        /***************************************************************** style ************************************************************************** */

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Gallery Style', 'huge_image_gallery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Add a Separator for Better UI
        $this->add_control(
            'images_heading',
                [
                    'label' => __( 'Images', 'huge_image_gallery' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                ]
        );
        
        // Image Border Radius
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'huge_image_gallery' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px'  => ['min' => 0, 'max' => 50],
                    '%'   => ['min' => 0, 'max' => 100],
                    'em'  => ['min' => 0, 'max' => 5, 'step' => 0.1],
                    'rem' => ['min' => 0, 'max' => 5, 'step' => 0.1],
                ],
                'selectors' => [
                    '{{WRAPPER}} .huge-gallery-item img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __( 'Image Border', 'huge_image_gallery' ),
                'selector' => '{{WRAPPER}} .huge-gallery-item img',
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'label' => __( 'Box Shadow', 'huge_image_gallery' ),
                'selector' => '{{WRAPPER}} .huge-gallery-item img',
            ]
        );

        // Add a Separator for Better UI
        $this->add_control(
            'overlay_heading',
                [
                    'label' => __( 'Overlay', 'huge_image_gallery' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'condition' => [
                    'enable_overlay' => 'yes',
                    ],
                ]
        );

        // Overlay Background Control
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'overlay_background',
                'label' => __( 'Overlay Background', 'huge_image_gallery' ),
                'types' => [ 'classic', 'gradient' ], 
                'selector' => '{{WRAPPER}} .image-overlay',
                'condition' => [
                    'enable_overlay' => 'yes',
                ],
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => 'rgba(0, 0, 0, 0.5)',
                    ],
                ],
            ]
        );

        // Add Border Control for Overlay
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'overlay_border',
                'label' => __( 'Overlay Border', 'huge_image_gallery' ),
                'selector' => '{{WRAPPER}} .image-overlay',
                'condition' => [
                    'enable_overlay' => 'yes',
                ],
            ]
        );
        // Image Border Radius
        $this->add_responsive_control(
            'overlay_border_radius',
            [
                'label' => __( 'Overlay Border Radius', 'huge_image_gallery' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px'  => ['min' => 0, 'max' => 50],
                    '%'   => ['min' => 0, 'max' => 100],
                    'em'  => ['min' => 0, 'max' => 5, 'step' => 0.1],
                    'rem' => ['min' => 0, 'max' => 5, 'step' => 0.1],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-overlay' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_overlay' => 'yes',
                ],
            ]
        );

        // Add Box Shadow Control for Overlay
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'overlay_box_shadow',
                'label' => __( 'Overlay Box Shadow', 'huge_image_gallery' ),
                'selector' => '{{WRAPPER}} .image-overlay',
                'condition' => [
                    'enable_overlay' => 'yes',
                ],
                'condition' => [
                    'enable_overlay' => 'yes',
                ],
            ]
        );

        // Add a Separator for Better UI
        $this->add_control(
            'icon_heading',
                [
                    'label' => __( 'Icon', 'huge_image_gallery' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'condition' => [
                        'enable_overlay' => 'yes',
                        'show_icon' => 'yes',
                    ],
                ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => __('Icon Background Color', 'huge_image_gallery'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .overlay-icon' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'enable_overlay' => 'yes',
                    'show_icon' => 'yes',
                ],
            ]
        );        
        
        // Icon Color
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', 'huge_image_gallery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .overlay-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'enable_overlay' => 'yes',
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'huge_image_gallery'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => ['min' => 10, 'max' => 100],
                    'em' => ['min' => 0.5, 'max' => 5],
                    'rem' => ['min' => 0.5, 'max' => 5],
                ],
                'default' => [
                    'size' => 32,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .overlay-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; fill: currentColor;',
                    '{{WRAPPER}} .overlay-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .overlay-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_overlay' => 'yes',
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __('Border', 'huge_image_gallery'),
                'selector' => '{{WRAPPER}} .overlay-icon',
                'condition' => [
                    'enable_overlay' => 'yes',
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => __('Border Radius', 'huge_image_gallery'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 50],
                    '%'  => ['min' => 0, 'max' => 100],
                    'em' => ['min' => 0, 'max' => 5],  
                    'rem' => ['min' => 0, 'max' => 5],
                ],
                'selectors' => [
                    '{{WRAPPER}} .overlay-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_overlay' => 'yes',
                    'show_icon' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __('Icon Margin', 'huge_image_gallery'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .overlay-icon svg, {{WRAPPER}} .overlay-icon i, {{WRAPPER}} .overlay-icon img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_overlay' => 'yes',
                    'show_icon' => 'yes',
                ],
            ]
        );
        
        
         // Add a Separator for Better UI
         $this->add_control(
            'caption_heading',
                [
                    'label' => __( 'Caption', 'huge_image_gallery' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'condition' => [
                        'enable_overlay' => 'yes',
                        'show_caption' => 'yes',
                    ],
                ]
        );

        // Caption Style
        $this->add_control(
            'caption_color',
            [
                'label' => __( 'Caption Color', 'huge_image_gallery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image-caption' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'enable_overlay' => 'yes',
                    'show_caption' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'caption_typography',
                'label' => __( 'Caption Typography', 'huge_image_gallery' ),
                'selector' => '{{WRAPPER}} .image-caption',
                'condition' => [
                    'enable_overlay' => 'yes',
                    'show_caption' => 'yes',
                ],
            ]
        );


        $this->add_responsive_control(
            'caption_margin',
            [
                'label' => __( 'Caption Margin', 'huge_image_gallery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'top'    => 10,
                    'right'  => 10,
                    'bottom' => 10,
                    'left'   => 10,
                    'unit'   => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_overlay' => 'yes',
                    'show_caption' => 'yes',
                ],
            ]
        );
        
        
        $this->end_controls_section();
    }
    
    protected function render(): void {
        $settings = $this->get_settings_for_display();
    
        if (empty($settings['images'])) {
            return;
        }
    
        $enable_masonry = $settings['enable_masonry'] === 'yes';
        $enable_lightbox = $settings['enable_lightbox'] === 'yes';
        $enable_lightbox_gallery = $settings['enable_lightbox_gallery'] === 'yes';
        $enable_overlay = $settings['enable_overlay'] === 'yes';
        $show_icon = $settings['show_icon'] === 'yes';
        $overlay_icon = $settings['overlay_icon'];
        $overlay_animation = $settings['overlay_animation'];
        $show_caption = $settings['show_caption'] === 'yes';
        $enable_fixed_height = $settings['enable_fixed_height'] === 'yes';
        $fixed_height = ($enable_fixed_height && isset($settings['fixed_height']['size'], $settings['fixed_height']['unit'])) 
            ? esc_attr($settings['fixed_height']['size'] . $settings['fixed_height']['unit']) 
            : 'auto';

        if ($enable_masonry) {
            $fixed_height = 'auto';
        }

    
        // Masonry-specific settings
        $masonry_columns = $enable_masonry ? $settings['masonry_columns'] : '3';
        $masonry_gap = $enable_masonry ? $settings['masonry_gap']['size'] : 10; 
        $masonry_gap_unit = $enable_masonry ? $settings['masonry_gap']['unit'] : 'px'; 
    
        // Calculate the margin (half of the gap)
        $masonry_margin = $masonry_gap / 2;
    
        // Add a class for masonry layout if enabled
        $gallery_class = $enable_masonry ? 'advanced-image-gallery huge-masonry' : 'advanced-image-gallery';
    
        // Inline styles for masonry layout
        $masonry_item_style = $enable_masonry ? sprintf(
            'style="width: calc(100%% / %d - %s); margin: %s;"',
            $masonry_columns,
            $masonry_gap . $masonry_gap_unit, 
            $masonry_margin . $masonry_gap_unit 
        ) : '';
        ?>
    
        <div class="<?php echo $gallery_class; ?>">
            <?php foreach ($settings['images'] as $image): 
                $image_url = esc_url($image['url']);
                $image_alt = esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true));
                $image_caption = wp_get_attachment_caption($image['id']);
                $lightbox_attributes = $enable_lightbox_gallery ? ' data-elementor-lightbox-slideshow="gallery"' : '';
            ?>
                <div class="huge-gallery-item" <?php echo $masonry_item_style; ?>>
                    <?php if ($enable_lightbox): ?>
                        <a href="<?php echo $image_url; ?>" data-elementor-open-lightbox="yes" <?php echo $lightbox_attributes; ?>>
                    <?php endif; ?>
    
                    <div class="gallery-image-wrapper">
                        <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>" style="height: <?php echo $fixed_height; ?>; object-fit: cover; width: 100%;">
                        
                        <?php if ($enable_overlay): ?>
                            <div class="image-overlay <?php echo esc_attr($overlay_animation); ?>">
                                <?php if ($show_icon && !empty($overlay_icon['value'])): ?>
                                    <div class="overlay-icon">
                                        <?php \Elementor\Icons_Manager::render_icon($overlay_icon, ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($show_caption && !empty($image_caption)): ?>
                                    <div class="image-caption"><?php echo esc_html($image_caption); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
    
                    <?php if ($enable_lightbox): ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    
        <?php
    }
    
    
    

}