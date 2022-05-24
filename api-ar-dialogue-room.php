<?php

/**
 * Plugin Name:       API AR Dialogue Room
 * Plugin URI:        https://github.com/helsingborg-stad/api-ar-dialogue-room
 * Description:       Backend for AR Room Dialogues.
 * Version:           1.0.0
 * Author:            Nikolas Ramstedt
 * Author URI:        https://github.com/helsingborg-stad
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       api-ar-dialogue-room
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('API_AR_DIALOGUE_ROOM_PATH', plugin_dir_path(__FILE__));
define('API_AR_DIALOGUE_ROOM_URL', plugins_url('', __FILE__));
define('API_AR_DIALOGUE_ROOM_TEMPLATE_PATH', API_AR_DIALOGUE_ROOM_PATH . 'templates/');
define('API_AR_DIALOGUE_ROOM_TEXT_DOMAIN', 'api-ar-dialogue-room');

load_plugin_textdomain(API_AR_DIALOGUE_ROOM_TEXT_DOMAIN, false, API_AR_DIALOGUE_ROOM_PATH . '/languages');

require_once API_AR_DIALOGUE_ROOM_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once API_AR_DIALOGUE_ROOM_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new ApiArDialogueRoom\Vendor\Psr4ClassLoader();
$loader->addPrefix('ApiArDialogueRoom', API_AR_DIALOGUE_ROOM_PATH);
$loader->addPrefix('ApiArDialogueRoom', API_AR_DIALOGUE_ROOM_PATH . 'source/php/');
$loader->register();

// Acf auto import and export
add_action('acf/init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('api-ar-dialogue-room');
    $acfExportManager->setExportFolder(API_AR_DIALOGUE_ROOM_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        'dialogue-configuration' => 'group_6285175045f1e', //Update with acf id here, settings view
        'room-dialogue-options' => 'group_628cd2d8cfbc5'
    ));
    $acfExportManager->import();
});

add_action('admin_notices', function () {
    $dependencies = [
        'acf' => [
            'name' => 'Advanced Custom Fields PRO',
            'enabled' => class_exists('ACF'),
            'download' => 'https://www.advancedcustomfields.com/'
        ]
    ];

    $missingDependecies = array_filter($dependencies, function ($d) {
        return !$d['enabled'];
    });

    if (count($missingDependecies) > 0) {
        $class = 'notice notice-error';
        $message = __('API Kiosk Model Viewer: Please install & activate required plugins:', API_AR_DIALOGUE_ROOM_TEXT_DOMAIN);
        $listItems = implode('', array_map(function ($item) {
            return sprintf('<li><a href="%2$s" target="_blank">%1$s</a></li>', esc_html($item['name']), esc_html($item['download']));
        }, $missingDependecies));

        printf('<div class="%1$s"><h4>%2$s</h4><ul>%3$s</ul></div>', esc_attr($class), esc_html($message), $listItems);
    }
});

// Start application
new ApiArDialogueRoom\App();
