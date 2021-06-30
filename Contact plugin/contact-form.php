<?php

/**
 * Plugin Name: Contact form
 * Plugin URI: https://github.com/Mr-Yassine/Contact-Form-Plugin.git
 * Description: Simple WordPress Contact Form.
 * Version: 1.0
 * Author: Yassine BILAL
 * Author URI: https://github.com/Mr-Yassine
 */

wp_register_style( 'namespace', '/includes/css/style.css' );


function form_plugin(){

    $content = '';
    $content .= '<h2>  </h2>';
    $content .= '<form method ="post" action = "">';


        $content .= '<label for ="name"> Name </label>';
        $content .= '<input type = "text" name ="Name" class="form-control" placeholder = "Enter your name" />';
        
        $content .= '<label for ="email"> Email </label>';
        $content .= '<input type = "email" name ="Email" class="form-control" placeholder = "Enter your email" />';

        $content .= '<label for ="subject"> Subject </label>';
        $content .= '<input type = "text" name ="Subject" class="form-control" placeholder = "Subject"/> ';

        $content .= '<label for ="message"> Message </label>';
        $content .= '<textarea name = "Message" class="form-control" placeholder = "Enter your message"></textarea>' ;


        $content .= '<input type= "submit" name= "submit-btn" class=" btn btn-md" value= "Submit"/>';

    $content .= '</form>';

    return $content;
}

add_shortcode ('contact-form','form_plugin' );

// function form_capture(){

//     if (isset ($_POST ['submit-btn'])){

//         $name = sanitize_text_field($_POST['your_name']);
//         $email = sanitize_text_field($_POST['your_email']);
//         $subject = sanitize_text_field($_POST['your_subject']);
//         $message = sanitize_textarea_field($_POST['your_message']);

//         $to = 'yassine.yb.99@gmail.com';
//         // $subject = 'Test form submission';
//         $comment = ''.$name.' - '.$email.' - '.$subject.' - '.$message;

//         // echo "<pre>"; print_r($_POST); echo "</pre>";
//         wp_mail($to, $subject, $comment);
//     }
// }



if(isset($_POST['submit-btn'])){

    create_table();
    insert_data();
}



function create_table(){

    $connection = mysqli_connect('localhost','root','');
    mysqli_select_db($connection,"contact-plugin-wp");

    $sql = "CREATE TABLE Contact (id int NOT NULL PRIMARY KEY AUTO_INCREMENT, Name varchar(255) NOT NULL, Email varchar(55) NOT NULL, Subject varchar(55) NOT NULL, Message varchar(255) NOT NULL)";
    $result = mysqli_query($connection, $sql);
    return $result;

}
register_activation_hook(__FILE__,'create_table');


function insert_data(){

  $connection = mysqli_connect('localhost','root','');
  mysqli_select_db($connection,"contact-plugin-wp");

    $Name=$_POST['Name'];
    $Email=$_POST['Email'];
    $Subject=$_POST['Subject'];
    $Message=$_POST['Message'];


    if (empty($Name) || empty($Email) || empty($Subject) || empty($Message)) {

        echo '<h1 style="color:red;">All fields are required</h1>';

    }else{

        $query="INSERT INTO Contact (Name, Email, Subject, Message)" . "VALUES ('$Name','$Email','$Subject','$Message')";
        mysqli_query($connection,$query);

    }
}



//Supprision de la table contact en parallèle avec la suppression du plugin

function drop_table(){

    $connection = mysqli_connect('localhost','root','');
    mysqli_select_db($connection,"contact-plugin-wp");

    $sql = "DROP TABLE Contact";
    $result = mysqli_query($connection, $sql);
    return $result;

}
register_uninstall_hook( __FILE__,'drop_table');



function admin_dashboard(){
    add_menu_page('forms','Contact','manage_options','contact-dashboard','dashboard_admin_contact','dashicons-email',4);
}

add_action('admin_menu','admin_dashboard');

function dashboard_admin_contact(){
    require_once('admin-dashboard.php');
}


?>