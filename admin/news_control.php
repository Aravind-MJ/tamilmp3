<?php include 'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admin
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">News Control</li>
        </ol>
    </section>

    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">
                News Control
            </div>
        </div>
        <div class="box-body">
            <form action="news_control_process.php" method="post" id="news">
                <div class="form-group">
                    <label>NEWS</label>
                    <textarea id="news" name="news" class="form-control"></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="ADD NEWS">
            </form>
        </div>
    </div>
    <br>
    <div class="box box-success">
        <div class="box-header">
            <div class="box-title">
                News Details
            </div>
        </div>
        <div class="box-body">
            <table id="newsTable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th width="100px">#</th>
                        <th>News</th>
                        <th width="200px">Active</th>
                        <th width="200px">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';
                    $query = sprintf("SELECT * FROM news WHERE del_status=0");
                    $result = mysqli_query($link, $query);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['news'];?></td>
                            <td><input <?php echo ($row['active'] == '1') ? 'checked' : ''; ?> rowid="<?php echo $row['id']; ?>" data-on="Active" data-off="Inactive" class="toggle-event" data-toggle="toggle" type="checkbox"></td>
                            <td><a href="javascript:void(0)" onclick="deleteConfirm('delete_news.php?id=<?= $row['id'] ?>')" class="btn btn-danger "><i class="fa fa-times"></i></a></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.content-wrapper -->
<script>

    function deleteConfirm(href) {
        var ask = window.confirm("Are you sure you want to delete this item?");
        if (ask) {
            document.location.href = href;
        }
    }

    $(document).ready(function () {

        $('.toggle-event').change(function () {
//            alert("asda");
            var status = $(this).prop('checked') == true ? '1' : '0';
            var rowId = $(this).attr('rowid');
//            alert(status);
            url = "news_active.php";
            $.ajax({
                url: url,
                type: 'POST',
                data: {id: rowId, status: status}
            }).done(function (data) {
                if (data == "SUCCESS") {
                    //alert("State Changed");
                } else {
                    alert("State Change Failed");
                }
            });

        });

        $('#newsTable').DataTable({
            responsive: true
        });

        $('#news').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                news: {
                    message: 'Please Enter News',
                    validators: {
                        notEmpty: {
                            message: 'Please enter News'
                        },
                        stringLength: {
                            max: 250,
                            message: 'The News cannot exceed 250 Characters'
                        }
                    }
                }
            }
        });
    });
</script>
<?php include 'footer.php'; ?>