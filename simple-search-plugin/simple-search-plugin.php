<?php
/*
Plugin Name: Simple Search Plugin
Description: Un plugin sencillo de buscador hecho en HTML y CSS, integrado como un widget de Elementor.
Version: 1.0
Author: Tu Nombre
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Salir si se accede directamente
}

// Definir la clase del widget
function simple_search_init() {
    class Simple_Search_Widget extends \Elementor\Widget_Base {
        public function get_name() {
            return 'simple_search';
        }

        public function get_title() {
            return __( 'Simple Search', 'simple-search-plugin' );
        }

        public function get_icon() {
            return 'eicon-search';
        }

        public function get_categories() {
            return [ 'general' ];
        }

        protected function _register_controls() {
            // Sección de contenido
            $this->start_controls_section(
                'content_section',
                [
                    'label' => __( 'Content', 'simple-search-plugin' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'search_placeholder',
                [
                    'label' => __( 'Search Placeholder', 'simple-search-plugin' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'aqui va la direccion', 'simple-search-plugin' ),
                ]
            );

            $this->end_controls_section();

            // Sección de estilo
            $this->start_controls_section(
                'style_section',
                [
                    'label' => __( 'Style', 'simple-search-plugin' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            // Estilo del formulario
            $this->add_control(
                'form_background_color',
                [
                    'label' => __( 'Form Background Color', 'simple-search-plugin' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .simple-search-form' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'form_border',
                    'label' => __( 'Form Border', 'simple-search-plugin' ),
                    'selector' => '{{WRAPPER}} .simple-search-form',
                ]
            );

            $this->add_control(
                'form_border_radius',
                [
                    'label' => __( 'Form Border Radius', 'simple-search-plugin' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .simple-search-form' => 'border-radius: {{TOP}} {{RIGHT}} {{BOTTOM}} {{LEFT}};',
                    ],
                ]
            );

            $this->add_control(
                'form_padding',
                [
                    'label' => __( 'Form Padding', 'simple-search-plugin' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .simple-search-form' => 'padding: {{TOP}} {{RIGHT}} {{BOTTOM}} {{LEFT}};',
                    ],
                ]
            );

            // Estilo del campo de búsqueda
            $this->add_control(
                'input_background_color',
                [
                    'label' => __( 'Input Background Color', 'simple-search-plugin' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .simple-search-field' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'input_text_color',
                [
                    'label' => __( 'Input Text Color', 'simple-search-plugin' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .simple-search-field' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'input_border',
                    'label' => __( 'Input Border', 'simple-search-plugin' ),
                    'selector' => '{{WRAPPER}} .simple-search-field',
                ]
            );

            $this->add_control(
                'input_border_radius',
                [
                    'label' => __( 'Input Border Radius', 'simple-search-plugin' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .simple-search-field' => 'border-radius: {{TOP}} {{RIGHT}} {{BOTTOM}} {{LEFT}};',
                    ],
                ]
            );

            $this->add_control(
                'input_padding',
                [
                    'label' => __( 'Input Padding', 'simple-search-plugin' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .simple-search-field' => 'padding: {{TOP}} {{RIGHT}} {{BOTTOM}} {{LEFT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'input_typography',
                    'label' => __( 'Typography', 'simple-search-plugin' ),
                    'selector' => '{{WRAPPER}} .simple-search-field',
                ]
            );

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();

            // Agregar estilos en línea
            $inline_styles = '';
            if ( $settings['form_background_color'] ) {
                $inline_styles .= sprintf(
                    '.elementor-element-%s .simple-search-form { background-color: %s; }',
                    $this->get_id(),
                    $settings['form_background_color']
                );
            }

            if ( $settings['input_background_color'] ) {
                $inline_styles .= sprintf(
                    '.elementor-element-%s .simple-search-field { background-color: %s; }',
                    $this->get_id(),
                    $settings['input_background_color']
                );
            }

            if ( $settings['input_text_color'] ) {
                $inline_styles .= sprintf(
                    '.elementor-element-%s .simple-search-field { color: %s; }',
                    $this->get_id(),
                    $settings['input_text_color']
                );
            }

            // Agregar estilos en línea a la página
            if ( ! empty( $inline_styles ) ) {
                echo '<style>' . $inline_styles . '</style>';
            }

            ?>
            <form role="search" method="get" class="simple-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="text" class="simple-search-field" value="<?php echo esc_attr( $settings['search_placeholder'] ); ?>" readonly />
            </form>
            <?php
        }

        protected function _content_template() {
            ?>
            <form role="search" method="get" class="simple-search-form" action="{{{ home_url('/') }}}">
                <input type="text" class="simple-search-field" value="{{{ settings.search_placeholder }}}" readonly />
            </form>
            <?php
        }
    }

    // Registrar el widget con Elementor
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Simple_Search_Widget() );
}
add_action( 'elementor/widgets/register', 'simple_search_init' );
