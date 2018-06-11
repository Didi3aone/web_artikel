<style>
    body.modal-dialog {width: 500px;}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<!-- <section class="content-header">
<h1>
Data Tables
<small>advanced tables</small>
</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
<li><a href="#">Tables</a></li>
<li class="active">Data tables</li>
</ol>
</section> -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $title ;?></h3>
                    <a href="<?php echo site_url("admin/event/add_event") ?>" class="btn btn-success pull-right" data-toggle='modal' data-target='#AddEvent'>
                        <i class="fa fa-plus"></i><span class="hidden-xs">Create New</span>
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Post Date</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Content</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <!-- <?php echo var_dump($records) ?> -->
                            <tr>
                                <?php
                                $no = 1; 
                                if (isset($event)) : ?>
                                <?php  foreach ($event as $record): ?>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $record->name ?></td>
                                    <td><?php echo $record->post_date ?></td>
                                    <td><?php echo $record->image ?></td>
                                    <td><?php echo $record->category_name?></td>
                                    <td><?php echo $record->content?></td>
                                    <td><?php echo $record->description ?></td>
                                    <td><a href="<?php echo site_url("admin/category/edit_cat/$record->id") ?>" class="btn btn-info btn-sm" data-toggle='modal' data-target='#myModal'><i class="fa fa-pencil"></i><span class="hidden-xs">Edit</span></a>
                                        <a href="javascript:void(0)" class=" btn btn-danger btn-sm" onclick="confirmation('<?php echo site_url("admin/category/delete_cat/$record->id"); ?>'); return false" > <i class="fa fa-times-circle"></i> <span class="hidden-xs">Delete</span></a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif; ?>
                    </table>
                    <!-- <?php echo $link; ?> -->
                </div>
            </div>
        </section>
    </div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="AddEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <div class="modal fade modal-info" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <!-- alert permission delete -->
    <div id="alert-flash" style="display:none;"></div>

<script>
    // $('body').on('hidden.bs.modal','.modal',function() {
    //     $(this).removeData('bs.modal');
    // });
    
    function confirmation(url){
        bootbox.confirm("Are You Sure?", function(result) {
            if(result){
                $.ajax({
                    url: url,
                    dataType: "JSON",
                    timeout: 10000,
                    success: function(data) {
                        if (data.status === 'true') {
                            bootbox.alert(data.message, function(){
                                // $('#myModal').modal('hide');
                                window.location.reload();
                            });
                        }
                    }, error: function(x, t, m) {
                        if (t === "timeout") {
                            bootbox.alert(m);
                        } else {
                            $("#alert-flash").html(x.responseText);
                            bootbox.alert(m);
                        }
                    }
                });
            }
        });
    }
</script>
