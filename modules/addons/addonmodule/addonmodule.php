<?php
/**
 * WHMCS SDK Sample Addon Module
 *
 * An addon module allows you to add additional functionality to WHMCS. It
 * can provide both client and admin facing user interfaces, as well as
 * utilise hook functionality within WHMCS.
 *
 * This sample file demonstrates how an addon module for WHMCS should be
 * structured and exercises all supported functionality.
 *
 * Addon Modules are stored in the /modules/addons/ directory. The module
 * name you choose must be unique, and should be all lowercase, containing
 * only letters & numbers, always starting with a letter.
 *
 * Within the module itself, all functions must be prefixed with the module
 * filename, followed by an underscore, and then the function name. For this
 * example file, the filename is "addonmodule" and therefore all functions
 * begin "addonmodule_".
 *
 * For more information, please refer to the online documentation.
 *
 * @see https://developers.whmcs.com/addon-modules/
 *
 * @copyright Copyright (c) WHMCS Limited 2017
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function classLoadAddonModule ($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $path = str_replace('WHMCS' . DIRECTORY_SEPARATOR . 'Module' . DIRECTORY_SEPARATOR . 'Addon' . DIRECTORY_SEPARATOR . 'AddonModule' , 'lib' , $path);
    $file = __DIR__ . DIRECTORY_SEPARATOR . $path . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('classLoadAddonModule');

// Require any libraries needed for the module to function.
// require_once __DIR__ . '/path/to/library/loader.php';
//
// Also, perform any initialization required by the service's library.

use WHMCS\Module\Addon\AddonModule\Admin\AdminDispatcher;
use WHMCS\Module\Addon\AddonModule\Client\ClientDispatcher;

/**
 * Define addon module configuration parameters.
 *
 * Includes a number of required system fields including name, description,
 * author, language and version.
 *
 * Also allows you to define any configuration parameters that should be
 * presented to the user when activating and configuring the module. These
 * values are then made available in all module function calls.
 *
 * Examples of each and their possible configuration parameters are provided in
 * the fields parameter below.
 *
 * @return array
 */
function addonmodule_config()
{
    return array(
        'name' => 'Addon Module Sample', // Display name for your module
        'description' => 'This module provides an example WHMCS Addon Module which can be used as a basis for building a custom addon module.', // Description displayed within the admin interface
        'author' => 'Your name goes here', // Module author name
        'language' => 'english', // Default language
        'version' => '1.0', // Version number
        'fields' => array(
            // a text field type allows for single line text input
            'Text Field Name' => array(
                'FriendlyName' => 'Text Field Name',
                'Type' => 'text',
                'Size' => '25',
                'Default' => 'Default value',
                'Description' => 'Description goes here',
            ),
            // a password field type allows for masked text input
            'Password Field Name' => array(
                'FriendlyName' => 'Password Field Name',
                'Type' => 'password',
                'Size' => '25',
                'Default' => '',
                'Description' => 'Enter secret value here',
            ),
            // the yesno field type displays a single checkbox option
            'Checkbox Field Name' => array(
                'FriendlyName' => 'Checkbox Field Name',
                'Type' => 'yesno',
                'Description' => 'Tick to enable',
            ),
            // the dropdown field type renders a select menu of options
            'Dropdown Field Name' => array(
                'FriendlyName' => 'Dropdown Field Name',
                'Type' => 'dropdown',
                'Options' => array(
                    'option1' => 'Display Value 1',
                    'option2' => 'Second Option',
                    'option3' => 'Another Option',
                ),
                'Description' => 'Choose one',
            ),
            // the radio field type displays a series of radio button options
            'Radio Field Name' => array(
                'FriendlyName' => 'Radio Field Name',
                'Type' => 'radio',
                'Options' => 'First Option,Second Option,Third Option',
                'Description' => 'Choose your option!',
            ),
            // the textarea field type allows for multi-line text input
            'Textarea Field Name' => array(
                'FriendlyName' => 'Textarea Field Name',
                'Type' => 'textarea',
                'Rows' => '3',
                'Cols' => '60',
                'Description' => 'Freeform multi-line text input field',
            ),
        )
    );
}

/**
 * Activate.
 *
 * Called upon activation of the module for the first time.
 * Use this function to perform any database and schema modifications
 * required by your module.
 *
 * This function is optional.
 *
 * @return array Optional success/failure message
 */
function addonmodule_activate()
{
    // Create custom tables and schema required by your module
    $query = "CREATE TABLE `mod_addonexample` (`id` INT( 1 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,`demo` TEXT NOT NULL )";
    full_query($query);

    return array(
        'status' => 'success', // Supported values here include: success, error or info
        'description' => 'This is a demo module only. In a real module you might report an error/failure or instruct a user how to get started with it here.',
    );
}

/**
 * Deactivate.
 *
 * Called upon deactivation of the module.
 * Use this function to undo any database and schema modifications
 * performed by your module.
 *
 * This function is optional.
 *
 * @return array Optional success/failure message
 */
function addonmodule_deactivate()
{
    // Undo any database and schema modifications made by your module here
    $query = "DROP TABLE `mod_addonexample`";
    full_query($query);

    return array(
        'status' => 'success', // Supported values here include: success, error or info
        'description' => 'This is a demo module only. In a real module you might report an error/failure here.',
    );
}

/**
 * Upgrade.
 *
 * Called the first time the module is accessed following an update.
 * Use this function to perform any required database and schema modifications.
 *
 * This function is optional.
 *
 * @return void
 */
function addonmodule_upgrade($vars)
{
    $currentlyInstalledVersion = $vars['version'];

    /// Perform SQL schema changes required by the upgrade to version 1.1 of your module
    if ($currentlyInstalledVersion < 1.1) {
        $query = "ALTER `mod_addonexample` ADD `demo2` TEXT NOT NULL ";
        full_query($query);
    }

    /// Perform SQL schema changes required by the upgrade to version 1.2 of your module
    if ($currentlyInstalledVersion < 1.2) {
        $query = "ALTER `mod_addonexample` ADD `demo3` TEXT NOT NULL ";
        full_query($query);
    }
}

/**
 * Admin Area Output.
 *
 * Called when the addon module is accessed via the admin area.
 * Should return HTML output for display to the admin user.
 *
 * This function is optional.
 *
 * @see AddonModule\Admin\Controller@index
 *
 * @return string
 */
function addonmodule_output($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink']; // eg. addonmodules.php?module=addonmodule
    $version = $vars['version']; // eg. 1.0
    $_lang = $vars['_lang']; // an array of the currently loaded language variables

    // Get module configuration parameters
    $configTextField = $vars['Text Field Name'];
    $configPasswordField = $vars['Password Field Name'];
    $configCheckboxField = $vars['Checkbox Field Name'];
    $configDropdownField = $vars['Dropdown Field Name'];
    $configRadioField = $vars['Radio Field Name'];
    $configTextareaField = $vars['Textarea Field Name'];

    // Dispatch and handle request here. What follows is a demonstration of one
    // possible way of handling this using a very basic dispatcher implementation.

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

    $dispatcher = new AdminDispatcher();
    $response = $dispatcher->dispatch($action, $vars);
    echo $response;
}

/**
 * Admin Area Sidebar Output.
 *
 * Used to render output in the admin area sidebar.
 * This function is optional.
 *
 * @param array $vars
 *
 * @return string
 */
function addonmodule_sidebar($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $_lang = $vars['_lang'];

    // Get module configuration parameters
    $configTextField = $vars['Text Field Name'];
    $configPasswordField = $vars['Password Field Name'];
    $configCheckboxField = $vars['Checkbox Field Name'];
    $configDropdownField = $vars['Dropdown Field Name'];
    $configRadioField = $vars['Radio Field Name'];
    $configTextareaField = $vars['Textarea Field Name'];

    $sidebar = '<p>Sidebar output HTML goes here</p>';
    return $sidebar;
}

/**
 * Client Area Output.
 *
 * Called when the addon module is accessed via the client area.
 * Should return an array of output parameters.
 *
 * This function is optional.
 *
 * @see AddonModule\Client\Controller@index
 *
 * @return array
 */
function addonmodule_clientarea($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink']; // eg. index.php?m=addonmodule
    $version = $vars['version']; // eg. 1.0
    $_lang = $vars['_lang']; // an array of the currently loaded language variables

    // Get module configuration parameters
    $configTextField = $vars['Text Field Name'];
    $configPasswordField = $vars['Password Field Name'];
    $configCheckboxField = $vars['Checkbox Field Name'];
    $configDropdownField = $vars['Dropdown Field Name'];
    $configRadioField = $vars['Radio Field Name'];
    $configTextareaField = $vars['Textarea Field Name'];

    // Dispatch and handle request here. What follows is a demonstration of one
    // possible way of handling this using a very basic dispatcher implementation.

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

    $dispatcher = new ClientDispatcher();
    return $dispatcher->dispatch($action, $vars);
}
