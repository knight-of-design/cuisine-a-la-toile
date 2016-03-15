<?php 

function cuisine_add_submenu() {
add_submenu_page( 'themes.php', 'Options Page', 'Theme Options', 'manage_options', 'theme_options', 'my_theme_options_page');
}
add_action( 'admin_menu', 'cuisine_add_submenu' );


function cuisine_settings_init() {
register_setting( 'theme_options', 'cuisine_options_settings' );

add_settings_section(
'cuisine_options_page_section', 
'~Cuisine a la toile~', 
'cuisine_options_page_section_callback', 
'theme_options' 
);

function cuisine_options_page_section_callback() { 
echo 'This page allows users to customize the copyright content that appears in the footer, enter promotional content and select a background colour.' ; }

//Option 1
add_settings_field( 
'cuisine_text_field',
'Enter the copyright content you wish to display in the footer:',
'cuisine_text_field_render',
'theme_options',
'cuisine_options_page_section' 
);


function cuisine_text_field_render() {
$options = get_option( 'cuisine_options_settings' ); ?>
<input type="text" name="cuisine_options_settings[text_field]" value="<?php if (isset($options['cuisine_text_field'])) echo $options['cuisine_text_field']; ?>" />
<?php
}

//Option 2
add_settings_field( 
'cuisine_textarea_field',
'Enter the content you wish to display for promotion:',
'cuisine_textarea_field_render', 
'theme_options',
'cuisine_options_page_section'
);

function cuisine_textarea_field_render() {
$options = get_option( 'cuisine_options_settings' );
?>
<textarea cols="50" rows="4" name="cuisine_options_settings[cuisine_textarea_field]"><?php if (isset($options['cuisine_textarea_field'])) echo $options['cuisine_textarea_field']; ?></textarea>
<?php
}

//Option 3
add_settings_field( 
'cuisine_select_field',
'Select your background color of choice:', 
'cuisine_select_field_render', 
'theme_options', 
'cuisine_options_page_section'
);

function cuisine_select_field_render() {
$options = get_option('cuisine_options_settings'); ?>


<select name="cuisine_options_settings[cuisine_select_field]">

<option value="1" <?php if (isset($options['cuisine_select_field'])) selected($options['cuisine_select_field'], 1 ); ?>>Option 1</option>

<option value="2" <?php if (isset($options['cuisine_select_field'])) selected($options['cuisine_select_field'], 2 ); ?>>Option 2</option>
</select>

<?php
}

function my_theme_options_page(){ ?>
<form action="options.php" method="post"> <h2>Options Page</h2> <?php
settings_fields( 'theme_options' ); do_settings_sections( 'theme_options' ); submit_button();
?>
</form>
<?php
}
}
add_action( 'admin_init', 'cuisine_settings_init' );
?>