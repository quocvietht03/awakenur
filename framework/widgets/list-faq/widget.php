<?php

namespace AwakenurElementorWidgets\Widgets\ListFaq;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;


class Widget_ListFaq extends Widget_Base
{

    public function get_name()
    {
        return 'bt-list-faq';
    }

    public function get_title()
    {
        return __('List FAQ', 'awakenur');
    }

    public function get_icon()
    {
        return 'eicon-posts-ticker';
    }

    public function get_categories()
    {
        return ['awakenur'];
    }

    public function get_script_depends()
    {
        return ['elementor-widgets'];
    }

    protected function register_layout_section_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'awakenur'),
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'faq_title',
            [
                'label' => __('Text', 'awakenur'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('FAQ title', 'awakenur'),
            ]
        );

        $repeater->add_control(
            'faq_content',
            [
                'label' => __('Content', 'awakenur'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('FAQ content', 'awakenur'),
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __('List Faq', 'awakenur'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'faq_title' => __('FAQ title 01', 'awakenur'),
                        'faq_content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
                    ],
                    [
                        'faq_title' => __('FAQ title 02', 'awakenur'),
                        'faq_content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
                    ],
                    [
                        'faq_title' => __('FAQ title 03', 'awakenur'),
                        'faq_content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
                    ],
                ],
                'title_field' => '{{{ faq_title }}}',
            ]
        );


        $this->end_controls_section();
    }

    protected function register_style_section_controls()
    {
        $this->start_controls_section(
            'section_style_item',
            [
                'label' => esc_html__('General', 'awakenur'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'list_gap',
            [
                'label' => __('Space Between', 'awakenur'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-list-faq--default .item-faq:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__('Content', 'awakenur'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_style',
            [
                'label' => esc_html__('Title', 'awakenur'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'list_title_color',
            [
                'label' => __('Color', 'awakenur'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'list_title_active_color',
            [
                'label' => __('Color Active', 'awakenur'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-title.active h3' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'list_title_hover_color',
            [
                'label' => __('Color Hover', 'awakenur'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-title:hover h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_title_typography',
                'label' => __('Typography', 'awakenur'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-item-title h3 ',
            ]
        );
        $this->add_control(
            'content_style',
            [
                'label' => esc_html__('Content', 'awakenur'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'list_content_color',
            [
                'label' => __('Color', 'awakenur'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_content_typography',
                'label' => __('Typography', 'awakenur'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-item-content',
            ]
        );
        $this->end_controls_section();
    }

    protected function register_controls()
    {
        $this->register_layout_section_controls();
        $this->register_style_section_controls();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['list'])) {
            return;
        }

?>
        <div class="bt-elwg-list-faq--default">
            <div class="bt-elwg-list-faq-inner">
                <?php foreach ($settings['list'] as $index => $item): ?>
                    <div class="item-faq">
                        <div class="bt-item-title">
                            <?php if (!empty($item['faq_title'])): ?>
                                <h3> <?php echo esc_html($item['faq_title']) ?> </h3>
                            <?php endif; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
                                <path d="M23.6781 11.724L14.9281 20.474C14.8061 20.5963 14.6612 20.6934 14.5017 20.7596C14.3422 20.8259 14.1711 20.86 13.9984 20.86C13.8256 20.86 13.6546 20.8259 13.495 20.7596C13.3355 20.6934 13.1906 20.5963 13.0687 20.474L4.31868 11.724C4.07211 11.4774 3.93359 11.143 3.93359 10.7943C3.93359 10.4456 4.07211 10.1111 4.31868 9.86458C4.56525 9.61801 4.89967 9.47949 5.24837 9.47949C5.59707 9.47949 5.93149 9.61801 6.17806 9.86458L13.9995 17.686L21.8209 9.86348C22.0674 9.61691 22.4019 9.47839 22.7506 9.47839C23.0993 9.47839 23.4337 9.61691 23.6802 9.86348C23.9268 10.1101 24.0653 10.4445 24.0653 10.7932C24.0653 11.1419 23.9268 11.4763 23.6802 11.7229L23.6781 11.724Z" fill="currentColor" />
                            </svg>
                        </div>
                        <?php if (!empty($item['faq_content'])):
                            echo '<div class="bt-item-content">' . $item['faq_content'] . '</div>';
                        endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php }

    protected function content_template() {}
}
