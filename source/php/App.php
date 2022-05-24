<?php

namespace ApiArDialogueRoom;

class App
{
    public function __construct()
    {
        add_action('init', array($this, 'registerPostType'), 9);
        add_action('init', array($this, 'registerOptionsPageForDashboard'), 9);
        add_action('add_meta_boxes', array($this, 'addMetaBoxForDialogueLinks'), 9);
    }

    public function addMetaBoxForDialogueLinks($postType)
    {
        if (empty($_GET['post']) || $_GET['post'] == '0') {
            return;
        }

        $postTypes = ['ar-dialogue-room'];

        if (in_array($postType, $postTypes)) {
            add_meta_box(
                'ar-dialogue-links',
                __('Dialogue Links', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
                array($this, 'renderMetaBoxContent'),
                $postType,
                'side'
            );
        }
    }

    public function buildDeeplink($verb, $payload)
    {
        return sprintf('pladdra://%1$s/%2$s', $verb, base64_encode(json_encode($payload, JSON_UNESCAPED_SLASHES)));
    }

    public function renderMetaBoxContent()
    {
        $restUrl = get_field('custom_rest_url', 'option')
            ? get_field('custom_rest_url', 'option')
            : get_rest_url(null, 'wp/v2/ar-dialogue-room');

        printf(
            '<a href="%2$s">%1$s</a>',
            __('Visitor deeplink', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
            $this->buildDeeplink(
                'ar-dialogue-room',
                [
                    'endpoint' => $restUrl . '/' . $_GET['post'] . '?acf_format=standard',
                ]
            )
        );

        if (!empty(get_field('auth_string', 'option'))) {
            echo '</br>';
            printf(
                '<a href="%2$s">%1$s</a>',
                __('Admin deeplink', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
                $this->buildDeeplink(
                    'ar-dialogue-room-admin',
                    [
                        'endpoint' => $restUrl . '/' .  $_GET['post'] . '?acf_format=standard',
                        'headers' => [
                            'Authorization' => base64_encode(get_field('auth_string', 'option'))
                        ]
                    ]
                )
            );
        }
    }

    public function registerOptionsPageForDashboard()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title'    => _x('Dialogue Room Settings', 'ACF', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
                'menu_title'    => _x('Settings', 'Project Manager Dashboard settings', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
                'menu_slug'     => 'api-ar-dialogue-room-settings',
                'parent_slug'   => 'edit.php?post_type=ar-dialogue-room',
            ));
        }
    }

    public function registerPostType()
    {
        $args = array(
            'menu_icon'          => 'dashicons-portfolio',
            'public'             => true,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'supports'           => array('title', 'author', 'revisions', 'thumbnail'),
            'show_in_rest'       => true,
        );

        $restArgs = array(
            'exclude_keys' => array()
        );

        $postType = new \ApiArDialogueRoom\Helper\PostType(
            'ar-dialogue-room',
            __('Room Dialogue', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
            __('Room Dialogues', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
            $args,
            array(),
            $restArgs
        );
    }
}
