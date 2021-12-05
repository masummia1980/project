
<?php include_once '../model/db_config.php'; ?>
<?php 
  
  // Define variables and initialize with empty values
        $name = $code = "";
        $name_err = $code_err = "";
        
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $input_name = trim($_POST["product_name"]);
            $input_code = trim($_POST["product_code"]);
            
            // Check input errors before inserting in database
            if(empty($name_err) && empty($code_err)){ 
                $sql = "INSERT INTO products_typs (product_name, product_code) VALUES (?, ?)";
                
                    if($statement = mysqli_prepare($link, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($statement, "ss", $param_name, $param_code);

                        // Set parameters
                        $param_name = $input_name;
                        $param_code =  $input_code; 
                        if(mysqli_stmt_execute($statement)){
                            header("location: index.php");
                            exit();
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }
                }  
                // Close statement
                mysqli_stmt_close($statement);
            }            
            // Close connection
            mysqli_close($link); 
        
?>
<!DOCTYPE html>
<html>
<?php include '../view/layout/header.php'; ?>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include '../view/layout/side_navbar.php'; ?>
        <!-- Page Content  -->
        <div id="content">
        <?php include '../view/layout/content_navbar.php'; ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <h3 style="text-align: center;">Product Add Form</h3>
                        </div>
                        <form accept="" class="shadow p-4">              
                            <div class="mb-3">
                                <span style="color:red;" id="both_err"></span>
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="<?php echo $name;?>"  minlength="4" onchange="changeCode()">
                                <span style="color:red;" id="name_err"></span>
                                <!-- <?php echo $name_err;?> -->
                            </div>
                            <div class="mb-3">
                                <label for="product_code">Product Code</label>
                                <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Product Code" value="<?php echo $code;?>">
                                <span style="color:red;" id="code_err"></span>
                                <!-- <?php echo $code_err;?> -->
                            </div>
                            <div class="mb-3 text-center">
                                <button type="button" class="btn btn-primary" onclick="AddProduct()">Add Product</button>
                            </div>
                        </form>
                    </div> 
                    <div class="col-md-8 col-sm-6" id="data_show">
                        <div class="mb-3">
                            <h3 style="text-align: center;">Show Data</h3>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>                                
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Code</th>
                                <th colspan="2" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="show_data"></tbody>
                        </table>                        
                    </div>             
                </div>
            </div>
        </div>
    </div>
    <?php include '../js/js_library.php'; ?>   
</body>
</html>