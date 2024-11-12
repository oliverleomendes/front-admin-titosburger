<?php include_once("includes/global.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titos Burger - Administration</title>
    <link rel="stylesheet" href="assets/css/mdb.min.css">
</head>
<body style="background-color: #f5f5f5">
    <main class="container">
        <div class="d-flex align-items-center justify-content-center" style="margin-top: 15vh;">
            <div class="card" style="width: 400px;">
                <div class="card-header">
                    <h5 class="text-center">Administration Panel</h5>
                </div>
                <div class="card-body">                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="user">User:</label>
                            <input type="text" name="user" id="user" class="form-control">
                        </div>
                    </div>                 
                    <div class="row">
                        <div class="col-md-12">
                            <label for="pass">Password:</label>
                            <input type="password" name="pass" id="pass" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-success" onclick="authentication()">
                            Sign In
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include_once("includes/footer.php"); ?>
    </footer>
    <script src="assets/js/login.min.js"></script>
</body>
</html>