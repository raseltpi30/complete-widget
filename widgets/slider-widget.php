<?php

namespace Elementor;

class Slider_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'slider_widget';
    }

    public function get_title()
    {
        return __('Slider Widget', 'elementor');
    }

    public function get_icon()
    {
        return 'eicon-slider-full-screen';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_control(
            'author',
            [
                'label' => __('Author', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Japan Alpha',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Your Title Here',
            ]
        );

        $repeater->add_control(
            'topic',
            [
                'label' => __('Topic', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Natural park',
            ]
        );

        $repeater->add_control(
            'des',
            [
                'label' => __('des', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'xplicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut,
            exercitationem eum aperiam illo illum laudantium?',
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __('Slides', 'elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'image' => ['url' => ''],
                        'author' => 'Author',
                        'title' => 'Title',
                        'topic' => 'Topic',
                        'des' => 'des.',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        wp_enqueue_style('custom-slider-style');
        wp_enqueue_script('custom-slider-script');

        if (!empty($settings['slides'])) {
            echo '<div class="carousel">';
            echo '<div class="list">';
            foreach ($settings['slides'] as $slide) {
                echo '<div class="item">';
                echo '<div class="overlay"></div>';
                echo '<img src="' . esc_url($slide['image']['url']) . '" alt="' . esc_attr($slide['title']) . '">';
                echo '<div class="content">';
                echo '<div class="author">' . esc_html($slide['author']) . '</div>';
                echo '<div class="title">' . esc_html($slide['title']) . '</div>';
                echo '<div class="topic">' . esc_html($slide['topic']) . '</div>';
                echo '<div class="des">' . esc_html($slide['des']) . '</div>';
                echo '<div class="buttons"><button>SUBSCRIBE</button></div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '<div class="thumbnail">';
            foreach ($settings['slides'] as $slide) {
                echo '<div class="item">';
                echo '<img src="' . esc_url($slide['image']['url']) . '" alt="' . esc_attr($slide['title']) . '">';
                echo '<div class="content">';
                echo '<div class="title">' . esc_html($slide['title']) . '</div>'; // Same design for title in thumbnails
                echo '<div class="des">' . esc_html(strlen($slide['des']) > 20 ? substr($slide['des'], 0, 20) . '...' : $slide['des']) . '</div>';
                // Same design for des in thumbnails
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '<div class="time-line">';
            echo '<button id="prev"><</button>';
            echo '<button id="next">></button>';
            echo '</div>';
            echo '<div class="time"></div>';
            echo '<div class="current-title"></div>'; // Added for displaying the current title
            echo '</div>';
        }
    }
}
