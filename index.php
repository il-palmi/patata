<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/svg+xml" href="patata.svg">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body onload="display_ct(), display_qt()">
        <div class="container">
            <h1>Patata</h1>

            <div class="row">
                <div class="col-md-6">      
                    <div id='ct'></div>
                    <div id='ct2'></div>
                </div>
                <div class="col-md-6">
                    <div align=right id='quotesbox'></div>
                    <div align=right id='authorbox'></div>
                </div>
            </div>

            <hr/>

            <div id='tasktable'>
                <div class="task">
                    <h5 class="text-center">Tasklist</h5>
                    <table class="table table-striped " style="width: 70%; margin: 0 auto;">
                        <thead>
                            <tr>
                                <th>Priority</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Durate (Minutes)</th>
                                <th>Maintainer</th>
                            </tr>
                        </thead>
                        <tbody>                                    
                            <?php
                                class MyDB extends SQLite3{
                                        function __construct(){
                                            $this->open('patabase.db');
                                        }
                                }
                                $db = new MyDB();
                                $result = $db->query('SELECT ID, Tasktype, Title, Description, Durate, Done
                                                    FROM TASK 
                                                    WHERE Done = 0
                                                    ORDER BY ID');
                                $result2 = $db->query('SELECT T_ID, Maintainer
                                                    FROM T_MAINTAINER
                                                    ORDER BY T_ID');
                                while ($temp = $result2->fetchArray(SQLITE3_ASSOC)){
                                    $maintainer[$temp['T_ID']]=array();
                                }
                                while ($temp = $result2->fetchArray(SQLITE3_ASSOC)){
                                    //$maintainer[$temp['T_ID']]=array();              // Why do we need two cycle?
                                    array_push($maintainer[$temp['T_ID']],$temp['Maintainer']);
                                }
                                while ($tasklist = $result->fetchArray(SQLITE3_ASSOC)){
                                    echo "<tr>";
                                    echo "<td>".$tasklist['TaskType']."</td>";
                                    echo "<td>".$tasklist['Title']."</td>";
                                    echo "<td>";
                                    echo isset($tasklist['Description']) ? $tasklist['Description']: "";
                                    echo "</td>";
                                    echo "<td>".$tasklist['Durate']."</td>";
                                    echo "<td>";
                                    echo isset($maintainer[$tasklist['ID']]) ? implode(', ',$maintainer[$tasklist['ID']]) : "";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>                                            
                        </tbody>                 
                    </table> 
                </div>  
            </div>

            <script type="text/javascript"> //Reload task table every second
                var $tasktable = $("#tasktable");
                setInterval(function () {
                    $tasktable.load("index.php #tasktable");
                }, 1000);
            </script> 
            <hr/>                          

            <div class="row">
                <div class="col-md-6">
                    <div class="statswrapper">
                        <h6 class="text-center">Recently added items</h6>
                        <table class="table table-striped table-sm text-center">
                            <thead>
                                <tr>
                                    <td>Item</td>
                                    <td>Added</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="/item/R374">R374</a></td>
                                    <td>2018-10-18, 20:01</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/R373">R373</a></td>
                                    <td>2018-10-18, 20:01</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/C165">C165</a></td>
                                    <td>2018-10-18, 20:01</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/B152">B152</a></td>
                                    <td>2018-10-18, 20:01</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/R372">R372</a></td>
                                    <td>2018-10-18, 13:20</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/R371">R371</a></td>
                                    <td>2018-10-18, 13:20</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/127">127</a></td>
                                    <td>2018-10-16, 19:37</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/126">126</a></td>
                                    <td>2018-10-16, 19:16</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/HDD228">HDD228</a></td>
                                    <td>2018-10-16, 19:07</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/HDD227">HDD227</a></td>
                                    <td>2018-10-16, 19:04</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="statswrapper">
                        <h6 class="text-center">Recently modified items</h6>
                        <table class="table table-striped table-sm text-center">
                            <thead>
                                <tr>
                                    <td>Item</td>
                                    <td>Modified</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="/item/R374">R374</a></td>
                                    <td>2018-10-18, 20:01</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/R373">R373</a></td>
                                    <td>2018-10-18, 20:01</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/C165">C165</a></td>
                                    <td>2018-10-18, 20:01</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/B152">B152</a></td>
                                    <td>2018-10-18, 20:01</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/R372">R372</a></td>
                                    <td>2018-10-18, 13:20</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/R371">R371</a></td>
                                    <td>2018-10-18, 13:20</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/127">127</a></td>
                                    <td>2018-10-16, 19:37</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/126">126</a></td>
                                    <td>2018-10-16, 19:16</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/HDD228">HDD228</a></td>
                                    <td>2018-10-16, 19:07</td>
                                </tr>
                                <tr>
                                    <td><a href="/item/HDD227">HDD227</a></td>
                                    <td>2018-10-16, 19:04</td>
                                </tr>
                            </tbody>
                        </table>
                    <div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function display_c(){       //Refresh time for the date function
                var refresh=1000;
                mytime=setTimeout('display_ct()',refresh)
            }

            function addZero(i) {       
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }

            function display_ct() {     //Date generator function
                var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var x = new Date()
                var d = addZero(x.getDate())
                var mo = months[x.getMonth()]
                var y = addZero(x.getFullYear())
                var h = addZero(x.getHours())
                var mi = addZero(x.getMinutes())
                var s = addZero(x.getSeconds())
                var wd = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
                var td = wd[x.getDay()]
                var x1 = td + " - " + d + " " + mo + " " + y
                var x2 = h + ":" + mi + ":" + s
                document.getElementById('ct').innerHTML = x1
                document.getElementById('ct2').innerHTML = x2

                display_c();
            }

            <?php
                $quotesin = file_get_contents("quotes.json");
                $obj2 = json_decode("$quotesin", TRUE);
                $num_quotes = count($obj2) - 1;
                $quote_refresh = 5; // In seconds
            
            //display_q() Refresh time function for the quotes
            //display_qt() Quote string generator
                echo "
                function display_q(){                                      
                    var refresh=1000*$quote_refresh;
                    mytime=setTimeout('display_qt()',refresh)
                }

                function display_qt() {

                    var quotes_array = $quotesin
                    var val = Math.floor(Math.random() * $num_quotes)
                    document.getElementById('quotesbox').innerHTML = quotes_array[val].quote
                    document.getElementById('authorbox').innerHTML = \"Cit. \" + quotes_array[val].author
                    display_q();
                }";
            ?>
        </script>
    </body>
</html> 
