<?php include_once("../includes/global.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titos Burger - Categories</title>
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
                    <h5>Categories list</h5>

                    <button class="btn btn-success" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#createCategory">
                        New category
                    </button>
                </div>
            </div>

            <div class="card-body">
                
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>        
                    </thead>
                    <tbody id="list-categories"></tbody>
                </table>

            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryLabel">Edit</h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="category">Category: </label>
                                <input type="text" name="edit-category" id="edit-category" class="form-control">
                                <input type="hidden" name="edit-id-category" id="edit-id-category">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="cUpdate()" data-mdb-ripple-init>Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create -->
        <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCategoryLabel">Create</h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="category">Category: </label>
                                <input type="text" name="create-category" id="create-category" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="cSave()" data-mdb-ripple-init>Create</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include_once("../includes/footer.php"); ?>
    </footer>

    <script>
        fetch(`${base_url_api}/categories/listAll.php`)
        .then(response => response.json())
        .then((response) => {
            let auxTable = "";

            response.categories.map(category => {
                auxTable += `<tr>
                                <td>${category.id_category}</td>
                                <td>${category.category_name}</td>
                                <td>${category.id_status}</td>
                                <td>
                                    <button onclick="edit(${category.id_category}, '${category.category_name}')" class="btn btn-sm btn-primary">Edit</button>
                                    <button onclick="cDelete(${category.id_category})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            `;
            })

            document.getElementById("list-categories").innerHTML = auxTable;

        })

        function edit(id_category, category_name) {
            const editCategoryEl = document.getElementById('editCategory')
            const modal = new mdb.Modal(editCategoryEl)
            modal.show()

            $("#edit-category").val(category_name);
            $("#edit-id-category").val(id_category);
        }

        function cDelete(id_category) {
            fetch(`${base_url_api}/categories/delete.php?id=${id_category}`, {
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

        function cUpdate() {
            let id_category = $("#edit-id-category").val();
            let category_name = $("#edit-category").val();

            fetch(`${base_url_api}/categories/update.php?id=${id_category}`, {
                method: 'PUT',
                body: JSON.stringify({
                    category_name: category_name,
                    image: '',
                    id_status: 1
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

        function cSave() {
            let category_name = $("#create-category").val();

            fetch(`${base_url_api}/categories/save.php`, {
                method: 'POST',
                body: JSON.stringify({
                    category_name: category_name,
                    image: ''
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
    </script>
</body>
</html>