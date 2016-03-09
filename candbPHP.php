<?php
$name = $_POST['name'];
$email = $_POST['email'];
$tree = $_POST['tree'];
$wreath = $_POST['wreath'];
$candyCane = $_POST['candyCane'];
$swag = $_POST['swag'];
$comment = $_POST['comment'];
$sentDate .= date("F j - Y - g:i a");

$cvsData = 
"\n"
.$name. "," 
.$email. ","
.$tree. "," 
.$wreath. "," 
.$candyCane. "," 
.$swag. ","     
.$comment. "," 
.$sentDate. ",";

$fp = fopen("candbtreeorder.csv","a"); // $fp is now the file pointer to file $filename

if($fp){
fwrite($fp,$cvsData); // Write information to the file
fclose($fp); // Close the file
}

//Start Email info
$formcontent="From: $name \n
Email: $email \n
Tree: $tree \n
Wreath: $wreath \n
Other items ordered: $candyCane, $swag \n
Comments: $comment";

$recipient = "pete@mymettle.com, meems@mplatts.com";
$subject = "Crate&Barrel Tree Pre-Order from $name";
$mailheader = "From: $email";
$headers .= "MIME-Version: 1.0";
$headers .= "Content-Type: text/html; charset=ISO-8859-1";

mail($recipient, $subject, $formcontent, $mailheader ) or die("Error!");
header( 'Location: candb-thank-you.html' ) ;
?>

<?php
//Start Email confirmation to user
$email = $_POST['email'];

$mailheader = "MIME-Version: 1.0" . "\r\n";
$mailheader .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$mailheader .= "From: TP Pines <meems@mplatts.com> \r\n";

// Subject of confirmation email.
$conf_subject = 'Thank you for ordering from TP Pines';

$msg = '<html>
    <head>
        <title></title>
    </head>
    <body>
        <p>
		 Thank you for ordering from T.P.Pines Tree Farm.
        <br /><br />
        We will send you a reminder email the day before we delivery your tree as well as the day of delivery. We will be in the Crate&Barrel parking lot, by the Community Garden next to the loading dock on Thursday Dec 3rd from 11am to 2pm with your order. If you need any help securing your tree to your vehicle we will be happy to do so. <br /><br />
        
        Merry Christmas,<br /><br />

        Frank Platts<br />
        Tree Chopper Especialista<br/>
        T.P.Pines
        <br />
		
		</p>
    </body>
</html>'
;


mail( $_POST['email'], $conf_subject, $msg, $mailheader );

?>