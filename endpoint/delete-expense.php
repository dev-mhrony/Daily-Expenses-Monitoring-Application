<!--  Author Name: MH RONY.
    GigHub Link: https://github.com/dev-mhrony
    Facebook Link:https://www.facebook.com/dev.mhrony
    Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
    for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
    Visit My Website : developerrony.com 
-->
<?php
include ('../conn/conn.php');

if (isset($_GET['expense'])) {
    $expense = $_GET['expense'];

    try {

        $query = "DELETE FROM tbl_expense WHERE tbl_expense_id = '$expense'";

        $stmt = $conn->prepare($query);

        $query_execute = $stmt->execute();

        if ($query_execute) {
            header("Location: http://localhost/daily-expenses-monitoring-app/");
        } else {
            header("Location: http://localhost/daily-expenses-monitoring-app/");
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
<!--  Author Name: MH RONY.
GigHub Link: https://github.com/dev-mhrony
Facebook Link:https://www.facebook.com/dev.mhrony
Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
Visit My Website : developerrony.com 
-->