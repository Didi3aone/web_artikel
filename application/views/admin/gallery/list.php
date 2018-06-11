<style>
    .modal-dialog{width:900px;}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-title"> News List </h1>
            <form id="search-form" class="form-inline" method="get" role="form">
                <a href="<?php echo site_url("admin/gallery/add_gallery") ?>" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i>Add Gallery</a>
            </form>
        <span class="pull-left" style="margin-bottom: 5px;">
        </span>
        <!-- <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">News List</a></li>
        </ol> -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header"></div>
                    <div class="box-body">
                        <div style="overflow-x:auto;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                <tr>
                                <?php 
                                    if( isset($records)):
                                    foreach($records as $record):
                                ?>
                                    <td><?php echo $record['gallery_id'] ?></td>
                                    <td><?php echo $record['name'] ?></td>
                                    <td><?php if ( !empty($record['photo'] ))?>
                                        <img src="<?php echo base_url('uploads/gallery/'.$record['photo'])?>" class="img-rounded" alt="" style="width: 100px;height: 60px;">
                                    </td>
                                    <td><a href="<?php echo site_url('admin/gallery/edit/'.$record['gallery_id'])?>" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i>Edit</a> <a href="javascript:void" class="btn btn-danger btn-sm" onclick="confirmation('<?php echo site_url("admin/gallery/del_gallery/".$record['gallery_id']) ?>'); return false"><i class="fa fa-trash"></i>Delete</a></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade modal-info" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
<!-- Alert Permession Delete -->
<div id="alert-flash" style="display: none;"></div>

<script>
    $('body').on('hidden.bs.modal','.modal',function(){
        $(this).removeData('bs.modal');
    });

    function confirmation(url)
    {
        bootbox.confirm("Are you sure ?", function(result) {
            if (result) {
                $.ajax ({
                    url : url,
                    dataType : "JSON",
                    timeout : 10000,
                    success : function(data) {
                        if (data.status === 'true') {
                            bootbox.alert(data.message,function() {
                                window.location.reload();
                            });
                        }
                    }, error : function(x, t, m) {
                        $("#alert-flash").html(x.responseText);
                        if ( t === "timeout") {
                            bootbox.alert(m);
                        } else {
                            bootbox.alert(m);
                        }
                    }
                })
            }
        })
    }
</script>