<?php

namespace ApiArDialogueRoom;

class App
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
        wp_register_style(
            'api-ar-dialogue-room-css',
            API_AR_DIALOGUE_ROOM_URL . '/dist/' .
            \ApiArDialogueRoom\Helper\CacheBust::name('css/api-ar-dialogue-room.css')
        );
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
        wp_register_script(
            'api-ar-dialogue-room-js',
            API_AR_DIALOGUE_ROOM_URL . '/dist/' .
            \ApiArDialogueRoom\Helper\CacheBust::name('js/api-ar-dialogue-room.js')
        );
    }
}
