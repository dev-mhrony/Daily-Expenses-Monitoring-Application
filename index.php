<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Expenses Monitoring Application - Code Camp BD</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<!--  Author Name: MH RONY.
    GigHub Link: https://github.com/dev-mhrony
    Facebook Link:https://www.facebook.com/dev.mhrony
    Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
    for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
    Visit My Website : developerrony.com 
-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: linear-gradient(-225deg, #322d33 0%, #000000 52%, #140d1f 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .expenses-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            background-color: rgb(255, 255, 255);
            border-radius: 10px;
            height: 90vh;
            width: 90vw;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
        
        .header {
            display: flex;
            width: 100%;
            justify-content: space-between;
            border-bottom: 1px solid rgb(200, 200, 200);
            padding-bottom: 10px;
        }

        .table-graph-container {
            display: flex;
            width: 100%;
            height: 100%;
            padding: 20px
        }

        .table-container {
            width: 500px;
            padding-right: 10px;
            border-right: 1px solid rgb(200, 200, 200);
            height: 100%;
        }

        .graph-container > canvas {
            margin-left: 10px;
            width: 800px;
            height: 100% !important;
        }

        .btn-primary {
            background-color: #D41872 !important;
            border: none !important;
            outline: none !important;
        }
    </style>
</head>
<body>
<!--  Author Name: MH RONY.
    GigHub Link: https://github.com/dev-mhrony
    Facebook Link:https://www.facebook.com/dev.mhrony
    Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
    for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
    Visit My Website : developerrony.com 
-->
    <div class="main">
        <div class="expenses-container">
            
            <div class="header">
                <h3>Daily Expenses Monitoring Application </h3>
                <?php 

                $hostName = "localhost";
                $userName = "root";
                $password = "";
                $dbName = "ccbd_expenses";
                $db_conn= mysqli_connect($hostName,$userName,$password,$dbName);


                    include('./conn/conn.php');
                    $get_total_amount = "SELECT SUM(`expense_amount`) as total_expense FROM `tbl_expense`";
                    $total_amount = mysqli_query($db_conn,$get_total_amount);
                    $total_amount = mysqli_fetch_array($total_amount);
                    
                ?>
                <button type="button" class="btn btn-sm btn-success">Total Expense = <?php echo $total_amount['total_expense'] ?></button>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addExpenseModal">+ Add Expense</button>

                <!-- Modal -->
                <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpense" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addExpense">Add Expense</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./endpoint/add-expense.php" method="POST">
                                    <div class="form-group">
                                        <label for="expenseDate">Expense Date:</label>
                                        <input type="date" class="form-control" id="expenseDate" name="expense_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="expenseAmount">Expense Amount:</label>
                                        <input type="number" min="1" class="form-control" id="expenseAmount" placeholder="Enter Expense Amount" name="expense_amount">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <marquee onMouseOver="this.stop()" style="color: #e92f33;" onMouseOut="this.start()">This is a Code Camp BD's free source code for educational use only. It can never be used for commercial purposes. Don't forget to take <a target="_blank" href="https://www.youtube.com/@codecampbdofficial">Code Camp BD</a> permission if needed! to contact - <a target="_blank" href="https://www.facebook.com/dev.mhrony">MH RONY</a> </marquee>


 <!--  Author Name: MH RONY.
    GigHub Link: https://github.com/dev-mhrony
    Facebook Link:https://www.facebook.com/dev.mhrony
    Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
    for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
    Visit My Website : developerrony.com 
-->           

            <div class="table-graph-container">
                <div class="table-container">
                    <table class="table text-center table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Expense</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="expenseTableBody">
                            <?php
                                include('./conn/conn.php');

                                $stmt = $conn->prepare("SELECT * FROM tbl_expense ORDER BY expense_date");
                                $stmt->execute();
                                $result = $stmt->fetchAll();

                                foreach ($result as $row) {
                                    $expenseId = $row['tbl_expense_id'];
                                    $expenseDate = $row['expense_date'];
                                    $expenseAmount = $row['expense_amount'];


                                    // Output the table row
                                    echo '<tr class="expenseList">';
                                    echo '<th hidden>' . $expenseId . '</th>';
                                    echo '<td>' . $expenseDate . '</td>';
                                    echo '<td>' . $expenseAmount . '</td>';
                                    echo '<td><button type="button" class="btn btn-sm btn-danger" onclick="removeExpense(' . $expenseId . ')">X</button></td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="graph-container">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>   
  <!--  Author Name: MH RONY.
    GigHub Link: https://github.com/dev-mhrony
    Facebook Link:https://www.facebook.com/dev.mhrony
    Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
    for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
    Visit My Website : developerrony.com 
-->      
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<!--  Author Name: MH RONY.
    GigHub Link: https://github.com/dev-mhrony
    Facebook Link:https://www.facebook.com/dev.mhrony
    Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
    for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
    Visit My Website : developerrony.com 
-->
    <?php
        

        $stmt = $conn->prepare("SELECT * FROM tbl_expense ORDER BY expense_date");
        $stmt->execute();
        $result = $stmt->fetchAll();

        $labels = [];
        $expenses = [];

        foreach ($result as $row) {
            $expenseDate = $row['expense_date'];
            $expenseAmount = $row['expense_amount'];

            // Store data for chart
            $labels[] = $expenseDate;
            $expenses[] = $expenseAmount;
        }
    ?>

    
    <script>
        function removeExpense(id) {
            if (confirm("Do you want to delete this expense?")) {
                window.location = "./endpoint/delete-expense.php?expense=" + id;
            }
        }

        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Total Amount of Expense per Day',
                    data: <?php echo json_encode($expenses); ?>,
                    borderColor: '#D41872',
                    backgroundColor: '#D41872',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script><!--  Author Name: MH RONY.
    GigHub Link: https://github.com/dev-mhrony
    Facebook Link:https://www.facebook.com/dev.mhrony
    Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
    for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
    Visit My Website : developerrony.com 
-->
</body>
</html>