<?php
////////////////////////////////////////////////////////////////////
// Functions - Customizer
////////////////////////////////////////////////////////////////////
function vanderweb_customize_register( $wp_customize ) {
    ////////////////////////////////////////////////////////////////////
    // Sidebar Settings
    $wp_customize->add_section( 'vanderweb_settings' , array(
        'title'      => __( 'Vander Web Settings', 'vanderweb' ),
        'priority'   => 30,
    ));
    
    // Header Control
    $wp_customize->add_setting('vanderweb_headertoogle', array(
        'default'        => 'logomain',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('vanderweb_headertoogle', array(
        'label'      => __('Select Logo position', 'vanderweb'),
        'section'    => 'vanderweb_settings',
        'settings'   => 'vanderweb_headertoogle',
        'type'       => 'radio',
        'choices'    => array(
            'logomain' => 'Logo next to Main Menu',
            'logotop' => 'Logo above Main Menu',
        ),
    ));
    
    // Menuitem with Dropdown behavior
    $wp_customize->add_setting('vanderweb_menudropdown', array(
        'default'        => 'false',
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));
    $wp_customize->add_control('vanderweb_menudropdown', array(
        'label'    => __('Menuitem with Dropdown behavior', 'vanderweb'),
        'section'  => 'vanderweb_settings',
        'settings' => 'vanderweb_menudropdown',
        'type'     => 'checkbox',
        'type'       => 'radio',
        'choices'    => array(
            'false' => 'First click open dropdown, next click closes dropdown',
            'true' => 'First click open dropdown, next click follow link',
        ),
    ));
    
    // Left Sidebar Bootstrap Size
    $wp_customize->add_setting('vanderweb_left_size', array(
        'default'        => 'col-md-3',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vanderweb_left_size', array(
        'label'      => __('Left Sidebar Bootstrap Size', 'vanderweb'),
        'section'    => 'vanderweb_settings',
        'type' => 'text',
    ));
    // Right Sidebar Bootstrap Size
    $wp_customize->add_setting('vanderweb_right_size', array(
        'default'        => 'col-md-3',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vanderweb_right_size', array(
        'label'      => __('Right Sidebar Bootstrap Size', 'vanderweb'),
        'section'    => 'vanderweb_settings',
        'type' => 'text',
    ));
    
    // To-the-top Button
    $wp_customize->add_setting('vanderweb_tothetop', array(
        'default'        => 'no',
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));
    $wp_customize->add_control('vanderweb_tothetop', array(
        'label'    => __('To-the-top Button', 'vanderweb'),
        'section'  => 'vanderweb_settings',
        'settings' => 'vanderweb_tothetop',
        'type'     => 'checkbox',
        'type'       => 'radio',
        'choices'    => array(
            'no' => 'No',
            'yes' => 'Yes',
        ),
    ));
    ////////////////////////////////////////////////////////////////////
}
add_action( 'customize_register', 'vanderweb_customize_register' );
?>