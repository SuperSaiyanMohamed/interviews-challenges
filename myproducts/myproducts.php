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
//    // connect to database
//    $connection = mysqli_connect('localhost' , 'root' , '' , 'datatest');
//    // check if the connection is not made
//    if (!$connection){
//        die("Database Connection broken");
//    }
//    // getting the value of count from options page
//    $query_count = "SELECT * FROM wp_count ";
//    $result_count = mysqli_query($connection, $query_count);
//    $value = mysqli_fetch_assoc($result_count);
//    $count = $value['value_count'];
    
    //if the connection of the database not made or broke for any reason
    if(!$wpdb){
        wp_die('Database Connection broken');
    }
    //getting the value of count from options page
    $count = $wpdb->get_var("SELECT value_count FROM wp_count");
    
// This is another deprecated code to form the data with another image variable but also didn't show images    
    
//    $query_product = "SELECT * FROM wp_posts WHERE post_type = 'product'";
//    if($result_product = mysqli_query($connection, $query_product)){
//    
//        $html = '';
//        $i = 0;
//        while ($row = mysqli_fetch_assoc($result_product)){
//            $dump1 = $row["ID"];
//            $query_product_img = "SELECT * FROM wp_posts WHERE post_parent = $dump1 AND post_mime_type = 'image/jpeg'";
//            $result_img = mysqli_query($connection, $query_product_img);
//            $dump2 = mysqli_fetch_assoc($result_img);
//            
//            $html .= '<h1>' . $dump1 . '</h1>';
//            $html .= '<h1>' . $i . '</h1>';
//            $html .= '<img src="' . $img["meta_value"] . '">';
//            $i++;
//            if($i==$count){
//                break;
//            }
//
//        }
//    }
    
    
//// begining to call data from the database    
//$query = "SELECT * FROM wp_posts WHERE post_status = 'publish' AND post_type LIKE 'product%'";
//// check if the query call outputs data
//if ($result = mysqli_query($connection, $query)) {
//    // design a table to hold the data
//    echo "<table>";
//    echo "<thead>";
//    echo "<tr>";
//    echo "<td>ID</td><td>Product Name</td><td>Place</td><td>Image</td>";
//    echo "</tr>"; 
//    echo "<thead>";
//    // a counter to keep the condition we specified in options page in check
//    $i=0;
//    // fetch data from the database
//    while ($row = mysqli_fetch_assoc($result)) {
//        // calling the ID of the row to use it in further queries
//        $post_id = $row["ID"];
//        echo "<tr>";
//        echo "<td style= 'width:70px; height:20px;'>".$post_id."</td>";
//        echo "<td style= 'width:100px; height:100px;'>".$row["post_title"]."</td>";
//        echo "<td>".$row["guid"]."</td>";
//        // calling a specific value (meta_value) from the database when the conditions are met
//        $query_img = "SELECT meta_value FROM wp_postmeta WHERE meta_key ='_thumbnail_id' AND post_id = $post_id";
//        $result_img = mysqli_query($connection, $query_img);
//        $img = mysqli_fetch_assoc($result_img);
//        // calling another specific value that was dependant on last query
//        $query_img_2 = "SELECT meta_value FROM wp_postmeta WHERE meta_key ='_wp_attached_file' AND post_id = ".$img['meta_value']."";
//        $result_img_2 = mysqli_query($connection, $query_img_2);
//        $img_2 = mysqli_fetch_assoc($result_img_2);
//        // putting the image in the table
//        $img_path = wp_upload_dir();
//        echo "<td><a><img src = '".$img_path['url']."/".$img_2["meta_value"]."' style= 'width:150px; height:150px;'></a></td>";
//        echo "</tr>";
//        $i++;
//        // check if the counter reached the same value as the options value called from database
//        if ($i==$count){
//            break;
//        }
//    }
//    // closing tags
//    echo "</table>";
//
//    // free result set
//    $result->close();
//}
    
    
    
// begining to call data from the database
$rows = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_status = 'publish' AND post_type LIKE 'product%'", ARRAY_A);
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
    foreach ($rows as $row) {
        // calling the ID of the row to use it in further queries
        $post_id = $row['ID'];
        echo "<tr>";
        // adding product id
        echo "<td style= 'width:70px; height:20px;'>". $post_id ."</td>";
        // adding product title
        echo "<td style= 'width:100px; height:100px;'>". $row['post_title'] ."</td>";
        // adding product type
        echo "<td>". $row['post_type'] ."</td>";
        // calling a specific value (meta_value) from the database when the conditions are met
        $img = $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key ='_thumbnail_id' AND post_id = $post_id");
        // calling another specific value that was dependant on last query
        $img_2 = $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key ='_wp_attached_file' AND post_id = ".$img["meta_value"]."");
        // putting the image in the table
        // calling the media folder in wordpress
        $img_path = wp_upload_dir();
        // adding the img tag and putting the img in it
        echo "<td><a><img src = '".$img_path['baseurl']."/".$img_2["meta_value"]."' style= 'width:150px; height:150px;'></a></td>";
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