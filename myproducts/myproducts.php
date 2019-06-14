<?php 
/*
Plugin Name: My Products
Description: We will display a number of products you specify
Version: 1.0.0
Author: Abo elseed
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.txt
*/

// stoping intruders from calling directly


//if (!defined('ASBPATH')){
//    exit('Go AWAY!');
//}

// Include the options page to get number of products from it
include 'options.php';

// function to recall data from database to page
function readdata(){
    //Calling the wordpress database global variable to interact with the wordpress database
    global $wpdb;
    global $post;
    global $woocommerce;

    
    //if the connection of the database not made or broke for any reason
    if(!$wpdb){
        wp_die('Database Connection broken');
    }
    //getting the value of count from options page
//    $count = get_option("product_count",0);
    
    $count = get_option('product_count',0);
    

// begining to call data from the database
$rows = array('post_status' => 'publish',
             'post_type'=> 'product');
    $row = new WP_Query($rows);
    // design a table to hold the data
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<td>ID</td><td>Product Name</td><td>Category</td><td>Image</td>";
    echo "</tr>"; 
    echo "<thead>";
    // a counter to keep the condition we specified in options page in check
    $i=0;
    // fetch data from the database
    while ($row->have_posts()) {
        $row->the_post();
        // calling the ID of the row to use it in further queries
        $post_id = $post->ID;
        echo "<tr>";
        // adding product id
        echo "<td style= 'width:70px; height:20px;'>". $post_id ."</td>";
        // adding product title
        echo "<td style= 'width:100px; height:100px;'>". $post->post_title ."</td>";
        // adding product type
        echo "<td>". $post->post_type ."</td>";
        
        // putting the image in a variable to display
        $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID));
        
        //deprecated failed woocommerce function with me
        //$picture = $woocommerce->get('products/'. $post->ID . 'images/src');
        
        // adding the img tag and putting the img in it
        echo "<td><a><img src = '".$thumbnail_url[0]."' style= 'width:150px; height:150px;'></a></td>";
        echo "</tr>";
        $i++;
        // check if the counter reached the same value as the options value called from database
        if ($i==$count){
            break;
        }
    }
    // closing tags
    echo "</table>";

}
// adding shortcode to be used in the plugin
add_shortcode('my_random_products','readdata');
?>