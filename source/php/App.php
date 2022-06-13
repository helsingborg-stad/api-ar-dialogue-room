<?php

namespace ApiArDialogueRoom;

class App
{
    public function __construct()
    {
        add_action('init', array($this, 'registerPostType'), 9);
        add_action('init', array($this, 'registerOptionsPageForDashboard'), 9);
        add_action('add_meta_boxes', array($this, 'addMetaBoxForDialogueLinks'), 9);
        add_filter('manage_edit-' . 'ar-dialogue-room' . '_columns', array($this, 'addDeeplinksColumn'));
        add_action('manage_' . 'ar-dialogue-room' . '_posts_custom_column', array($this, 'renderDeeplinksColumn'), 10, 2);
    }

    public function addDeeplinksColumn($columns)
    {
        return array_merge($columns, [
            'deeplinks' => __('Deeplinks', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
            'qr' => __('Visit QR', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
        ]);
    }

    public function renderDeeplinksColumn($column, $postId)
    {
        switch ($column) {
            case 'deeplinks':
                $this->renderDeeplinks($postId);
                break;
            case 'qr':
                $this->renderQR($postId, 100);
                break;
        }
    }

    public function renderQR($postId, $size = 300)
    {
        printf(
            '<a href="%2$s" class="%3$s"alt="%1$s">
                <img style="%4$s" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=%2$s">
            </a>',
            $this->createDeepLinks($postId)['visit']['label'],
            $this->createDeepLinks($postId)['visit']['url'],
            '',
            'width: 100%; max-width: ' . $size . 'px; text-align: center; display: block;'
        );
    }

    public function renderDeeplinks($postId)
    {
        echo '<ul>';
        foreach ($this->createDeepLinks($postId) as $deeplink) {
            printf(
                '<li>
                    <a href="%2$s" class="%3$s" style="%4$s">
                        %1$s
                    </a>
                </li>',
                $deeplink['label'],
                $deeplink['url'],
                'button button-large',
                'text-align: center;'
            );
        }
        echo '</ul>';
    }

    public function addMetaBoxForDialogueLinks($postType)
    {
        if (
            !empty($_GET['post'])
            && $_GET['post'] !== '0'
            && in_array($postType, ['ar-dialogue-room'])
        ) {
            add_meta_box(
                'ar-dialogue-qr',
                __('Visit QR', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
                array($this, 'renderQrMetaBox'),
                $postType,
                'side'
            );
            add_meta_box(
                'ar-dialogue-deeplinks',
                __('Deeplinks', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
                array($this, 'renderDeeplinksMetaBox'),
                $postType,
                'side'
            );
        }
    }

    public function renderQrMetaBox()
    {
        $this->renderQR($_GET['post']);
    }

    public function renderDeeplinksMetaBox()
    {
        $this->renderDeeplinks($_GET['post']);
    }

    public function buildDeeplink($verb, $payload)
    {
        return sprintf('pladdra://%1$s/%2$s', $verb, base64_encode(json_encode($payload, JSON_UNESCAPED_SLASHES)));
    }

    public function createDeepLinks($postId)
    {
        return array_filter([
            'visit' => [
                'label' => __('Visit Room in App', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
                'url' => $this->buildDeeplink(
                    'ar-dialogue-room',
                    [
                        'endpoint' => (get_field('custom_rest_url', 'option')
                        ? get_field('custom_rest_url', 'option')
                        : get_rest_url(null, 'wp/v2/ar-dialogue-room') . '/' . $postId . '?acf_format=standard'),
                    ]
                ),
            ],
            'admin' => [
                'label' => __('Edit Room in App', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN),
                'url' => !empty(get_field('auth_string', 'option')) ? $this->buildDeeplink(
                    'ar-dialogue-room-admin',
                    [
                        'endpoint' => (get_field('custom_rest_url', 'option')
                        ? get_field('custom_rest_url', 'option') . '/' . $postId . '?acf_format=standard'
                        : get_rest_url(null, 'wp/v2/ar-dialogue-room') . '/' . $postId . '?acf_format=standard'),
                        'headers' => [
                            'Authorization' => base64_encode(get_field('auth_string', 'option'))
                        ]
                    ]
                ) : null,
            ]
        ], function ($d) {
            return $d['url'] !== null;
        });
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
