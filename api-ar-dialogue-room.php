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
        'api-ar-dialogue-room-settings' => 'group_61ea7a87e8aaa' //Update with acf id here, settings view
    ));
    $acfExportManager->import();
});

// Start application
new ApiArDialogueRoom\App();
