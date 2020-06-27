<?php 
/*
*Plugin Name: Contact Form
*Plugin URI: 
*Description: Plugin for brief
*Author: xxxxxx
*Author URI: lien github
*Version: 0.1
*/

require_once(ABSPATH . 'wp-config.php');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($connection, DB_NAME);


function newTableData()
{
    global $connection;

    $sql = "CREATE TABLE Posts(id int NOT NULL PRIMARY KEY AUTO_INCREMENT, Nom varchar(100) NOT NULL, email varchar(155) NOT NULL, text varchar(200) NOT NULL)";
    $result = mysqli_query($connection, $sql);
    return $result;
}

if ($connection == true){
    newTableData();
}



add_action("admin_menu", "addMenu");
function addMenu()
{
  add_menu_page("Contact Form", "Contact Form", 4, "contact-form", "contactform" );

}

function contactform()
{
echo <<< 'EOD'
<center>
<div style="background: linear-gradient(#B53471,#6F1E51,#B53471,#6F1E51);width:40%; height:690px;margin-top:2%;border-radius:16px;">
<br>
  <h1 style="color:white;font-size:24px"> Contact Form</h1>
  <h2 style="color:white;font-size:18px">Shortcode : [plugin_form] </span></h2>

  <br>
  <div>
  <form method="POST"  >
  <label style="color:white;font-size:24px;margin-right:4%;">Name:</label><input type="text" name="nom" style="width: 58%;font-size: 16px;outline: none;"><br><br>
  <label style="color:white;font-size:24px;margin-right:5%;">Email:</label><input type="text" name="email" style="width: 58%;font-size: 16px;outline: none;"><br><br>
  <label style="color:white;font-size:24px;margin-right:7%;">Text:</label><textarea type="text" name="text"  style="width:58%;height:150px;font-size: 16px;outline: none;"></textarea><br><br><br><input type="submit" name="submitcheck" style="background-color:white;border-radius:4px;width: 150px;height: 40px;border:none;color: #B53471;font-weight:bold;">
</form>

<br>
<form method="POST" >
<h2 style="color:white;font-size:18px">Shortcode :[plugin_form text='false'] </span></h2>
<label style="color:white;font-size:24px;margin-right:4%;">Name:</label><input type="text" name="nom" style="width: 58%;font-size: 16px;outline: none;"><br><br>
<label style="color:white;font-size:24px;margin-right:5%;">Email:</label><input type="text" name="email" style="width: 58%;font-size: 16px;outline: none;"><br><br>
<input type="submit" name="submitcheck" style="background-color:white;border-radius:4px;width: 150px;height: 40px;border:none;color: #B53471;font-weight:bold;">
</form>
</div>
</div> </center>
EOD;
}


//  show / hide had inputs

    function contact($atts){
        extract(shortcode_atts(
            array(
                'name' => 'true',
                'email' => 'true',
                'text' => 'true'
                
        ), $atts));
    
        if($name== "true"){
            $name1 = '<label style="color:#6F1E51;font-size:20px;margin-right:4%;">Name:</label><br><br><input type="text" name="nom" required style="width: 68%;font-size: 16px;outline: none;"><br><br>
            ';
        }else{
            $name1 = "";
        }

        if($email== "true"){
            $email1 = '<label style="color:#6F1E51;font-size:20px;margin-right:5%;">Email:</label><br><br><input type="text" name="email" required  style="width: 68%;font-size: 16px;outline: none;"><br><br>
            ';
        }else{
            $email1 = "";
        }

        if($text== "true"){
            $text1 = '<label style="color:#6F1E51;font-size:20px;margin-right:7%;">Text:</label><br><br><textarea type="text" name="text" required style="width: 68%;height:150px;font-size: 16px;outline: none;"></textarea><br><br><br>
            ';
        }else{
            $text1 = "";
        }



        echo '<form method="POST"   >' .$name1 . $email1 . $text1 . '<input type="submit" name="submitcheck" style="background-color: #B53471;border-radius:4px;width: 150px;height: 40px;border:none;color:white;font-weight:bold;">

        </form>';
    }
    add_shortcode('plugin_form', 'contact');

    

    function form($name, $email,  $text)
    {
        global $connection;
  
      $sql = "INSERT INTO posts(Nom, email, text) VALUES ('$name', '$email', '$text')";
      $result = mysqli_query($connection , $sql);
     
      return $result;
    }

    if(isset($_POST['submitcheck'])){

        $name = $_POST['nom'];
        $email = $_POST['email'];
        $text = $_POST['text'];

        form($name, $email, $text);

    

    }



?>