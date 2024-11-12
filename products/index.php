<?php include_once("../includes/global.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titos Burger - Products</title>
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
                    <h5>Products list</h5>

                    <button class="btn btn-success" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#createProduct">
                        New product
                    </button>
                </div>
            </div>

            <div class="card-body">
                
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>        
                    </thead>
                    <tbody id="list-products"></tbody>
                </table>

            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductLabel">Edit</h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="edit-product-name">Product name: </label>
                                <input type="text" name="edit-product-name" id="edit-product-name" class="form-control">
                                <input type="hidden" name="edit-id-product" id="edit-id-product">
                            </div>
                        </div>     
                        <div class="row">
                            <div class="col-md-12">
                                <label for="edit-product-desc">Description: </label>
                                <textarea name="edit-product-desc" id="edit-product-desc" rows="5" class="form-control"></textarea>
                            </div>
                        </div>                           
                        <div class="row">
                            <div class="col-md-12">
                                <label for="edit-product-category">Category: </label>
                                <select name="edit-product-category" id="edit-product-category" class="form-control"></select>
                            </div>
                        </div>                  
                        <div class="row">
                            <div class="col-md-12">
                                <label for="edit-product-price">Price: </label>
                                <input type="text" name="edit-product-price" id="edit-product-price" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="pUpdate()" data-mdb-ripple-init>Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create -->
        <div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="createProductLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductLabel">Create</h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="create-product-name">Product name: </label>
                                <input type="text" name="create-product-name" id="create-product-name" class="form-control">
                            </div>
                        </div>     
                        <div class="row">
                            <div class="col-md-12">
                                <label for="create-product-desc">Description: </label>
                                <textarea name="create-product-desc" id="create-product-desc" rows="5" class="form-control"></textarea>
                            </div>
                        </div>                           
                        <div class="row">
                            <div class="col-md-12">
                                <label for="create-product-category">Category: </label>
                                <select name="create-product-category" id="create-product-category" class="form-control"></select>
                            </div>
                        </div>                  
                        <div class="row">
                            <div class="col-md-12">
                                <label for="create-product-price">Price: </label>
                                <input type="text" name="create-product-price" id="create-product-price" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="pSave()" data-mdb-ripple-init>Create</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include_once("../includes/footer.php"); ?>
    </footer>

    <script>
        const createProduct = document.getElementById('createProduct')

        fetch(`${base_url_api}/products/listAll.php`)
            .then(response => response.json())
            .then((response) => {
                let auxTable = "";

                response.map(product => {
                    auxTable += `<tr>
                                    <td>${product.id_product}</td>
                                    <td>${product.product_name}</td>
                                    <td>${product.price}</td>
                                    <td>${product.id_category}</td>
                                    <td>${product.id_status}</td>
                                    <td>
                                        <button onclick="edit(${product.id_product}, '${product.product_name}', '${product.price}', '${product.description}', '${product.id_category}')" class="btn btn-sm btn-primary">Edit</button>
                                        <button onclick="pDelete(${product.id_product})" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                `;

                    console.log(product);
                })

                document.getElementById("list-products").innerHTML = auxTable;

            })

        function edit(id_product, producut_name, price, desc, id_category) {
            const editProductEl = document.getElementById('editProduct')
            const modal = new mdb.Modal(editProductEl)
            modal.show()

            $("#edit-product-name").val(producut_name);
            $("#edit-product-desc").val(desc);
            $("#edit-product-price").val(price);
            $("#edit-id-product").val(id_product);
            getCategories('edit', id_category);

        }

        function pSave() {
            let product_name = $("#create-product-name").val();
            let description  = $("#create-product-desc").val();
            let price        = $("#create-product-price").val();
            let id_category  = $("#create-product-category option:selected").val();

            fetch(`${base_url_api}/products/save.php`, {
                method: 'POST',
                body: JSON.stringify({
                    product_name: product_name,
                    image: '',
                    price: price,
                    id_category: id_category,
                    description: description,
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

        function pUpdate() {
            let id_product   = $("#edit-id-product").val();
            let product_name = $("#edit-product-name").val();
            let description  = $("#edit-product-desc").val();
            let price        = $("#edit-product-price").val();
            let id_category  = $("#edit-product-category option:selected").val();

            fetch(`${base_url_api}/products/update.php?id=${id_product}`, {
                method: 'PUT',
                body: JSON.stringify({
                    product_name: product_name,
                    image: '',
                    price: price,
                    id_category: id_category,
                    description: description,
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

        function pDelete(id_product) {
            fetch(`${base_url_api}/products/delete.php?id=${id_product}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(response => console.log(response))
        }

        function getCategories(type, id_category) {
            fetch(`${base_url_api}/categories/listAll.php`)
            .then(response => response.json())
            .then((response) => {
                let auxSelect = "<option value='0'>Choose...</option>";

                response.categories.map(category => {
                    if(id_category == category.id_category)
                        auxSelect += `<option value="${category.id_category}" selected>${category.category_name}</option>`;
                    else
                        auxSelect += `<option value="${category.id_category}">${category.category_name}</option>`;
                })

                document.getElementById(type + "-product-category").innerHTML = auxSelect;
            })
        }

        createProduct.addEventListener('shown.bs.modal', event => {
            getCategories('create', null)
        })
    </script>
</body>
</html>