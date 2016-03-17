<?php
//This options page was created in reference to Lecture 9 Wordpress: Building an options page
//Adds the option page as a sub-menu item in Appearances within the Wordpress dashboard
function cuisine_add_submenu() {
add_submenu_page( 'themes.php', 'Options Page', 'Theme Options', 'manage_options', 'theme_options', 'my_theme_options_page');
}
add_action( 'admin_menu', 'cuisine_add_submenu' );

//Adding and registering settings
function cuisine_settings_init() {
register_setting( 'theme_options', 'cuisine_options_settings' );

//Adding a settings section
add_settings_section(
'cuisine_options_page_section',
'~Cuisine a la toile~',
'cuisine_options_page_section_callback',
'theme_options'
);

//Provides a desciption of our options page for the user
function cuisine_options_page_section_callback() {
echo 'This page allows users to customize the copyright content that appears in the footer, enter promotional content and select a background colour.' ; }

//Option 1: text box

//Creating a text box
add_settings_field(
'cuisine_text_field', //id
'Enter the copyright content you wish to display in the footer:', //Title (visible to user)
'cuisine_text_field_render', //$callback
'theme_options', //page
'cuisine_options_page_section' //section
);

//Calback function for the text box
//Whatever the user inputs will display on the page
function cuisine_text_field_render() {
$options = get_option( 'cuisine_options_settings' ); ?>
<input type="text" name="cuisine_options_settings[cuisine_text_field]" value="<?php if (isset($options['cuisine_text_field'])) echo $options['cuisine_text_field']; ?>" />
<?php
}

//Option 2: textarea

//Creating a textarea
add_settings_field(
'cuisine_textarea_field', //id
'Enter the content you wish to display for promotion:', //Title (visible to user)
'cuisine_textarea_field_render', //$callback
'theme_options', //page
'cuisine_options_page_section' //section
);

//Calback function for the textarea
//Whatever the user inputs will display on the page
function cuisine_textarea_field_render() {
$options = get_option( 'cuisine_options_settings' );
?>
<textarea cols="50" rows="4" name="cuisine_options_settings[cuisine_textarea_field]"><?php if (isset($options['cuisine_textarea_field'])) echo $options['cuisine_textarea_field']; ?></textarea>
<?php
}

//Option 3:

//Adding a select box
add_settings_field(
'cuisine_select_field', //id
'Select festive custom styling:', //Title (visible to user)
'cuisine_select_field_render', //$callback
'theme_options',  //page
'cuisine_options_page_section' //section
);

//Calback function for the select box
//Creating two options for the user to select and applying that change once the user selects it
function cuisine_select_field_render() {
$options = get_option('cuisine_options_settings'); ?>

<select name="cuisine_options_settings[cuisine_select_field]">
  <option value="" <?php if (isset($options['cuisine_select_field'])) selected($options['cuisine_select_field'], "" ); ?>>Regular</option>

<option value="christmas" <?php if (isset($options['cuisine_select_field'])) selected($options['cuisine_select_field'], "christmas" ); ?>>Christmas</option>

<option value="easter" <?php if (isset($options['cuisine_select_field'])) selected($options['cuisine_select_field'], "easter" ); ?>>Easter</option>
</select>

<?php
}
//Creating the options page
function my_theme_options_page(){ ?>
<form action="options.php" method="post"> <h2>Options Page</h2> <?php
settings_fields( 'theme_options' ); do_settings_sections( 'theme_options' ); submit_button();
?>
</form>
<?php
}
}
//Activating the plugin
add_action( 'admin_init', 'cuisine_settings_init' );
?>
