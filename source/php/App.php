<?php

namespace ApiArDialogueRoom;

class App
{
    public function __construct()
    {
        add_action('init', array($this, 'registerPostType'), 9);
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
