<?php
//Check if the value in the options text exists!
if (isset($_POST['new_option_name'])){
    //put the value of options into variable
    $value = $_POST['new_option_name'];
    //connect to database
    $connection = mysqli_connect('localhost','root','','datatest');
    //check if connection is made!
    if($connection){
        //select the count value in the database and store the new value in it
        if (mysqli_query($connection,'SELECT * FROM wp_usermeta WHERE meta_key = "count"')){
            $query = "UPDATE wp_count SET value_count = $value";
            $result = mysqli_query($connection,$query);
        }
        //check if the query carries on
        if(!$result){
            die('Query Failed');
        }
    }
    //condition for breaking connection with the database
    else{
        die('Database Connection Broken');
    }
    
    
}

// create custom plugin settings menu
add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('My Random Products', 'My Products', 'administrator', __FILE__, 'my_cool_plugin_settings_page' , plugins_url('/images/icon.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'my-cool-plugin-settings-group', 'new_option_name' );
}
// options page design
function my_cool_plugin_settings_page() {
?>
<div class="wrap">
<h1>My Products</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Number of Products</th>
        <td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
        <label><?php echo $_SESSION["count"] ?></label>
        </tr>
    </table>
    
    <?php/* button to click on */ submit_button(); ?>
</form>
</div>
<?php } ?>