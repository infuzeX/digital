<!DOCTYPE html>
    <html lang="en">
<!-- Mirrored from www.shreethemes.in/landrick/layouts/page-invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Apr 2020 12:22:01 GMT -->
<head>
        <meta charset="utf-8" />
        <title>PadhHigh</title>
       
        <meta name="Version" content="2.1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    </head>

    <body>
        <!-- Loader -->
        <!--<div id="preloader">-->
        <!--    <div id="status">-->
        <!--        <div class="spinner">-->
        <!--            <div class="double-bounce1"></div>-->
        <!--            <div class="double-bounce2"></div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- Loader -->

        
        <!-- Navbar STart -->
        <header id="topnav" class="defaultscroll sticky">
            <div class="container">
                <!-- Logo container-->
                <div>
                    <a class="logo" href="index.html">Padhhigh<span class="text-primary">.</span></a>
                </div>                 
                <!-- End Logo container-->
                <div class="menu-extras">
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>
        
                <div id="navigation">
                    <!-- Navigation Menu-->   
                    <ul class="navigation-menu">
                        <li><a href="index.html">Home</a></li>
                    </ul><!--end navigation menu-->
                </div><!--end navigation-->
            </div><!--end container-->
        </header><!--end header-->
        <!-- Navbar End -->

        <!-- Invoice Start -->
        <section class="bg-invoice bg-light">
            <div class="container">
                <div class="row mt-5 pt-4 pt-sm-0 justify-content-center">
                    <div class="col-lg-12">
                        <div class="card shadow rounded border-0">
                            <div class="card-body">
                                <div class="invoice-table pb-4">
                                    <div class="table-responsive bg-white shadow rounded">
                                        <table class="table mb-0 table-center invoice-tb" id="tblData">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th scope="col" class="text-left">Index</th>
                                                  <th scope="col" class="text-left">Name</th>
                                                  <th scope="col" class="text-left">Contact</th>
                                                     <th scope="col" class="text-left">College</th>
                                                  <th scope="col" class="text-left">Who Tell you About inturn</th>
                                                  <th scope="col" class="text-left">Date</th>
                                                  <th scope="col" class="text-left">Time</th>
                                                  
                                                  
                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $conn = new mysqli('localhost','padhhigh_demoform','padhhigh','padhhigh_demoform');
                                                    if ($conn->connect_error) {
                                                        die("Connection Failed: " . $conn->connect_error);
                                                    }else{
                                                        $sql = "SELECT id, name, contact, college, who, date, time FROM pdf";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            // output data of each row
                                                            while($row = $result->fetch_assoc()) {
                                                                ?>
                                                                <tr>
                                                                    <td class="text-left"><?php echo $row["id"]; ?></td>
                                                                    <td><?php echo $row["name"]; ?></td>
                                                                    <td><?php echo $row["contact"]; ?></td>
                                                                    <td><?php echo $row["college"]; ?></td>
                                                                    <td><?php echo $row["who"]; ?></td>
                                                                    <td><?php echo $row["date"]; ?></td>
                                                                    <td><?php echo $row["time"]; ?></td>

                                                                </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo "0 results";
                                                        }
                                                        $conn->close();
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <button onclick="exportTableToExcel('tblData')">Export Table Data To Excel File</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- Invoice End -->

        <!-- Footer Start -->
        <footer class="footer footer-bar">
            <div class="container text-center">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <p class="mb-0">&#1042;© 2019-20 PadhHigh. Design  <i class="mdi mdi-heart text-danger"></i> by <a href="http://www.padhhigh.com/" target="_blank" class="text-success">PadhHigh</a>.</p>
                        </div>
                    </div>
                </div><!--end row-->
            </div><!--end container-->
        </footer><!--end footer-->
        <!-- Footer End -->
        
        <!-- Back to top -->
        <a href="#" class="back-to-top rounded text-center" id="back-to-top"> 
            <i class="mdi mdi-chevron-up d-block"> </i> 
        </a>
        <!-- Back to top -->
        <script>
            function exportTableToExcel(tableID, filename = 'data'){
                var downloadLink;
                var dataType = 'application/vnd.ms-excel';
                var tableSelect = document.getElementById(tableID);
                var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
                
                // Specify file name
                filename = filename?filename+'.xls':'excel_data.xls';
                
                // Create download link element
                downloadLink = document.createElement("a");
                
                document.body.appendChild(downloadLink);
                
                if(navigator.msSaveOrOpenBlob){
                    var blob = new Blob(['\ufeff', tableHTML], {
                        type: dataType
                    });
                    navigator.msSaveOrOpenBlob( blob, filename);
                }else{
                    // Create a link to the file
                    downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                
                    // Setting the file name
                    downloadLink.download = filename;
                    
                    //triggering the function
                    downloadLink.click();
                }
            }
        </script>

        <!-- javascript -->
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>

</html>