<?php include_once("../includes/global.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titos Burger - Status</title>
    <link rel="stylesheet" href="../assets/css/mdb.min.css">
</head>
<body>
    <header>
        <?php include_once("../includes/header.php"); ?>
    </header>

    <main class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between aling-itens-center">
                    <h5>Status list</h5>

                    <button class="btn btn-success" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#createStatus">
                        New status
                    </button>
                </div>
            </div>

            <div class="card-body">
                
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>        
                    </thead>
                    <tbody id="list-status"></tbody>
                </table>

            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editStatus" tabindex="-1" aria-labelledby="editStatusLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStatusLabel">Edit</h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="edit-status">Status: </label>
                                <input type="text" name="edit-status" id="edit-status" class="form-control">
                                <input type="hidden" name="edit-id-status" id="edit-id-status" class="form-control">
                            </div>
                        </div>     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="sUpdate()" data-mdb-ripple-init>Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create -->
        <div class="modal fade" id="createStatus" tabindex="-1" aria-labelledby="createStatusLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createStatusLabel">Create</h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="create-status">Status: </label>
                                <input type="text" name="create-status" id="create-status" class="form-control">
                            </div>
                        </div>     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="sSave()" data-mdb-ripple-init>Create</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include_once("../includes/footer.php"); ?>
    </footer>

    <script>
        fetch(`${base_url_api}/status/listAll.php`)
        .then(response => response.json())
        .then((response) => {
            let auxTable = "";

            response.status.map(status => {
                auxTable += `<tr>
                                <td>${status.id_status}</td>
                                <td>${status.status}</td>
                                <td>
                                    <button onclick="edit(${status.id_status}, '${status.status}')" class="btn btn-sm btn-primary">Edit</button>
                                    <button onclick="pDelete(${status.id_status})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            `;

                console.log(status);
            })

            document.getElementById("list-status").innerHTML = auxTable;

        })

        function edit(id_status, status_name) {
            const editStatusEl = document.getElementById('editStatus')
            const modal = new mdb.Modal(editStatusEl)
            modal.show()

            $("#edit-status").val(status_name);
            $("#edit-id-status").val(id_status);
        }

        function sSave() {
            let status_name = $("#create-status").val();

            fetch(`${base_url_api}/status/save.php`, {
                method: 'POST',
                body: JSON.stringify({
                    status: status_name
                })
            })
            .then(response => response.json())
            .then(response => {
                if(response.cod == 0) {
                    window.location.reload();
                } else {

                }
            })
        }

        function sUpdate() {
            let status_name = $("#edit-status").val();
            let id_status = $("#edit-id-status").val();

            fetch(`${base_url_api}/status/update.php?id=${id_status}`, {
                method: 'PUT',
                body: JSON.stringify({
                    status: status_name
                })
            })
            .then(response => response.json())
            .then(response => {
                if(response.cod == 0) {
                    window.location.reload();
                } else {

                }
            })
        }

        function pDelete(id_category) {
            fetch(`${base_url_api}/status/delete.php?id=${id_category}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(response => {
                if(response.cod == 0) {
                    window.location.reload();
                } else {

                }
            })
        }
    </script>
</body>
</html>