<!--  Author Name: MH RONY.
    GigHub Link: https://github.com/dev-mhrony
    Facebook Link:https://www.facebook.com/dev.mhrony
    Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
    for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
    Visit My Website : developerrony.com 
-->
<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['expense_date'], $_POST['expense_amount'])) {
        $expenseDate = $_POST['expense_date'];
        $expenseAmount = $_POST['expense_amount'];

        try {
            $stmt = $conn->prepare("INSERT INTO tbl_expense (expense_date, expense_amount) VALUES (:expense_date, :expense_amount)");
            
            $stmt->bindParam(":expense_date", $expenseDate, PDO::PARAM_STR); 
            $stmt->bindParam(":expense_amount", $expenseAmount, PDO::PARAM_STR);

            $stmt->execute();

            header("Location: http://localhost/daily-expenses-monitoring-app/");

            exit();
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }

    } else {
        echo "
            <script>
                alert('Please fill in all fields!');
                window.location.href = 'http://localhost/daily-expenses-monitoring-app/';
            </script>
        ";
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
