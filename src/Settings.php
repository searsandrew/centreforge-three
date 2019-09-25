<?php

namespace Mayfifteenth\Centreforge;

/**
 * The Settings class is holds the WordPress configuration
 */
class Settings
{
    /**
     * Execute is the main entry point into settings, it is responsible for firing all actions and filters for this class
     */
    public function execute() : void
    {
        // Dequeue/Enqueue scripts for Centreforge
        add_action('wp_enqueue_scripts', array($this, 'cf_enqueue_scripts'));

        // Activate/Deactivate items included in WordPress theme support
        $this->cf_theme_support();
    }

    public function cf_enqueue_scripts() : void
    {
        wp_enqueue_style( 'bootstrapstyle', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );

        wp_dequeue_script( 'jquery' );
        wp_enqueue_script( 'jquery-cdn', 'https://code.jquery.com/jquery-3.3.1.slim.min.js', array(), true);
        wp_enqueue_script( 'bootstrap-cdn', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", array('jquery-cdn'), true);
    }

    private function cf_theme_support() : void
    {
        // Support for logo editing in the Customizer
        add_theme_support( 'custom-logo', array(
            'height'      => 400,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
        ));

        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'centreforge' ),
        ));
    }
}