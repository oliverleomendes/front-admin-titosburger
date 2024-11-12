<?php include_once("includes/global.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titos Burger - Dashboard</title>
    <link rel="stylesheet" href="assets/css/mdb.min.css">
</head>
<body>
    <header>
        <?php include_once("includes/header.php"); ?>
    </header>

    <main class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5>Welcome, <span id="user-banner">!</span></h5>
            </div>
        </div>    
    </main>

    <footer>
        <?php include_once("includes/footer.php"); ?>
    </footer>
    <script>
        document.getElementById("user-banner").innerText = localStorage.getItem("NAME");
    </script>
</body>
</html>