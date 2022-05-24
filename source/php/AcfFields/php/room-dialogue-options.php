<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_628cd2d8cfbc5',
    'title' => __('Room Dialogue Options', 'api-ar-dialogue-room'),
    'fields' => array(
        0 => array(
            'key' => 'field_628cd2ead2408',
            'label' => __('Auth String', 'api-ar-dialogue-room'),
            'name' => 'auth_string',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => __('user:top-secret-application-password', 'api-ar-dialogue-room'),
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
        1 => array(
            'key' => 'field_628cd36ebe712',
            'label' => __('Custom REST URL', 'api-ar-dialogue-room'),
            'name' => 'custom_rest_url',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'api-ar-dialogue-room-settings',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));
}