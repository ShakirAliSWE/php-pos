<?php
include_once "../includes/includes.php";
global $objFormFields;

?>
<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([["title" => "All Users", "active" => true]])?>
    </div>
    <div>
        <a href = "../users/?_action=add" class="btn btn-primary"><i class="fa fa-plus m-1"></i>ADD NEW USER</a>
    </div>
</div>
<div class="custom-container">
    <div class="table-responsive">
        <table id="example" class="table" style="width: 100%;white-space: nowrap;">
            <thead>
            <tr>
                <th>ID</th>
                <th>USERNAME</th>
                <th>PASSWORD</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            ajax: '../api/users.php?action=all',
            columns: [
                {data: 'id'},
                {data: 'username'},
                {data: 'password'},
                {data: 'status'},
                {
                    data: 'id',
                    render: function (data, type) {
                        return `<div class="d-flex gap-1">
                                       <a href = "../users/?_action=view&_id=${data}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                                       <a href = "../users/?_action=edit&_id=${data}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                    </div>`;
                    },
                },
            ]
        });
    });
</script>