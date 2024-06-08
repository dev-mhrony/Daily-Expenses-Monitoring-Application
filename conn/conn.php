<!--  Author Name: MH RONY.
    GigHub Link: https://github.com/dev-mhrony
    Facebook Link:https://www.facebook.com/dev.mhrony
    Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
    for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
    Visit My Website : developerrony.com 
-->
<?php 

$servername = "localhost";
$username = "root";
$password = "";
$db = "ccbd_expenses";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed " . $e->getMessage();
}

?><!--  Author Name: MH RONY.
GigHub Link: https://github.com/dev-mhrony
Facebook Link:https://www.facebook.com/dev.mhrony
Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
Visit My Website : developerrony.com 
-->