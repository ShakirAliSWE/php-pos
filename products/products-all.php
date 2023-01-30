<?php
include_once "../includes/includes.php";
global $objFormFields;

?>
<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([["title" => "All Products", "active" => true]])?>
    </div>
    <div>
        <a href = "../products/?_action=add" class="btn btn-primary"><i class="fa fa-plus m-1"></i>ADD NEW PRODUCT</a>
    </div>
</div>
<div class="custom-container">
    <div class="table-responsive">
        <table id="example" class="table" style="width: 100%;white-space: nowrap;">
            <thead>
            <tr>
                <th>ID</th>
                <th>CODE</th>
                <th>TITLE</th>
                <th>UNIT</th>
                <th>BUYING PRICE</th>
                <th>SELLING PRICE</th>
                <th>ACTIVE</th>
                <th>ACTION</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            ajax: '../api/products.php?action=all',
            columns: [
                {data: 'id'},
                {data: 'code'},
                {data: 'title'},
                {data: 'unit'},
                {data: 'buyingPrice'},
                {data: 'sellingPrice'},
                {data: 'status'},
                {
                    data: 'id',
                    render: function (data, type) {
                        return `<div class="d-flex gap-1">
                                       <a href = "../products/?_action=view&_id=${data}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                                       <a href = "../products/?_action=edit&_id=${data}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                       <!-- <a href = "../products/?_action=delete&_id=${data}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>-->
                                    </div>`;
                    },
                },
            ]
        });
    });
</script>