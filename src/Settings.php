<?php

namespace Mayfifteenth\Centreforge;

/**
 * The Settings class is holds the WordPress configuration
 */
class Settings
{
    /**
     * Execute is the main entry point into settings, it is responsible for firing all actions and filters for this class
     * 
     * @return void
     */
    public function execute() : void
    {
        // Dequeue/Enqueue scripts for Centreforge
        add_action('wp_enqueue_scripts', array($this, 'cf_enqueue_scripts'));

        // Activate/Deactivate items included in WordPress theme support
        $this->cf_theme_support();

        // Register WordPress settings
        $this->cf_register_settings();
    }

    /** 
     * Centreforge Enqueue Scripts is responsible for loading up Bootstrap and its dependencies.
     * Design and theme specific scripts should be loaded in the child theme.
     * 
     * @return void
     */
    public function cf_enqueue_scripts() : void
    {
        wp_enqueue_style( 'bootstrapstyle', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );
        wp_enqueue_style( 'style', get_stylesheet_uri() );

        wp_dequeue_script( 'jquery' );
        wp_enqueue_script( 'jquery-cdn', 'https://code.jquery.com/jquery-3.3.1.slim.min.js', array(), true);
        wp_enqueue_script( 'bootstrap-cdn', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", array('jquery-cdn'), true);
    }

    /**
     * Centreforge Theme Support is responsible for activating WordPress features.
     * 
     * @return void
     */
    private function cf_theme_support() : void
    {
        // Support for logo editing in the Customizer
        add_theme_support( 'custom-logo', array(
            'height'      => 400,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'description'),
        ));

        // Support for theme background image
        add_theme_support( 'custom-background', array(
            'default-image'          => '',
            'default-preset'         => 'fill', // 'default', 'fill', 'fit', 'repeat', 'custom'
            'default-position-x'     => 'center',    // 'left', 'center', 'right'
            'default-position-y'     => 'center',     // 'top', 'center', 'bottom'
            'default-size'           => 'cover',    // 'auto', 'contain', 'cover'
            'default-repeat'         => 'no-repeat',  // 'repeat-x', 'repeat-y', 'repeat', 'no-repeat'
            'default-attachment'     => 'fixed',  // 'scroll', 'fixed'
        ));

        //Support for post thumbnails
        add_theme_support( 'post-thumbnails' );
        
    }

    private function cf_register_settings() : void
    {
        // Register a Nav menu location
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'centreforge' ),
        ));
    }
}