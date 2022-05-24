<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_6285175045f1e',
    'title' => __('Dialogue Configuration', 'api-ar-dialogue-room'),
    'fields' => array(
        0 => array(
            'key' => 'field_6285177928d54',
            'label' => __('Plane Dimensions Width (m)', 'api-ar-dialogue-room'),
            'name' => 'plane_dimensions_width',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'show_in_graphql' => 1,
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => 0,
            'max' => '',
            'step' => '',
        ),
        1 => array(
            'key' => 'field_6285179f28d55',
            'label' => __('Plane Dimensions Height (m)', 'api-ar-dialogue-room'),
            'name' => 'plane_dimensions_height',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'show_in_graphql' => 1,
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => 0,
            'max' => '',
            'step' => '',
        ),
        2 => array(
            'key' => 'field_6285186695afa',
            'label' => __('Resources', 'api-ar-dialogue-room'),
            'name' => 'resources',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'show_in_graphql' => 1,
            'collapsed' => '',
            'min' => 0,
            'max' => 0,
            'layout' => 'table',
            'button_label' => '',
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_6285189b95afb',
                    'label' => __('Name', 'api-ar-dialogue-room'),
                    'name' => 'name',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'show_in_graphql' => 1,
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                1 => array(
                    'key' => 'field_628518ec95afd',
                    'label' => __('Model', 'api-ar-dialogue-room'),
                    'name' => 'model',
                    'type' => 'file',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'show_in_graphql' => 1,
                    'return_format' => 'url',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                    'mime_types' => 'glb',
                ),
                2 => array(
                    'key' => 'field_628518a895afc',
                    'label' => __('Marker Model', 'api-ar-dialogue-room'),
                    'name' => 'marker_model',
                    'type' => 'file',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'show_in_graphql' => 1,
                    'return_format' => 'url',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                    'mime_types' => 'glb',
                ),
            ),
        ),
        3 => array(
            'key' => 'field_62866a4d045c5',
            'label' => __('Scenes', 'api-ar-dialogue-room'),
            'name' => 'scenes',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'show_in_graphql' => 1,
            'collapsed' => 'field_62866a73045ca',
            'min' => 0,
            'max' => 0,
            'layout' => 'table',
            'button_label' => '',
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_62866a73045ca',
                    'label' => __('Scene Name', 'api-ar-dialogue-room'),
                    'name' => 'scene_name',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'show_in_graphql' => 1,
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                1 => array(
                    'key' => 'field_62866a86045cc',
                    'label' => __('JSON', 'api-ar-dialogue-room'),
                    'name' => 'json',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'show_in_graphql' => 1,
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => '',
                    'rows' => 1,
                    'new_lines' => '',
                ),
                2 => array(
                    'key' => 'field_62866a64045c9',
                    'label' => __('Scene ID', 'api-ar-dialogue-room'),
                    'name' => 'scene_id',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '15',
                        'class' => '',
                        'id' => '',
                    ),
                    'show_in_graphql' => 1,
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                3 => array(
                    'key' => 'field_62866a7a045cb',
                    'label' => __('Featured Scene', 'api-ar-dialogue-room'),
                    'name' => 'scene_is_featured',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '15',
                        'class' => '',
                        'id' => '',
                    ),
                    'show_in_graphql' => 1,
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
            ),
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'ar-dialogue-room',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
        0 => 'the_content',
        1 => 'discussion',
        2 => 'comments',
        3 => 'format',
        4 => 'page_attributes',
        5 => 'featured_image',
        6 => 'categories',
        7 => 'tags',
        8 => 'send-trackbacks',
    ),
    'active' => true,
    'description' => '',
));
}