<style type="text/css">
    .ui-autocomplete { z-index: 999999; }
    .modal-dialog { width:760px; }
</style>
<form id="form" action="" role="form" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $records['category_id']?> ">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="box-body"> -->
                    <div class="form-group">
                        <label>Category Name</label>
                        <input name="name" type="text" class="form-control" required placeholder="Category Name" value="<?php echo $records['name'] ?>">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <?php if(!empty($records)) : ?>
                        <textarea name="desc " type="text" class="form-control" required placeholder="Description"><?php echo $records['description'] ?></textarea>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
       <div class="modal-footer">
           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">
               <i class="fa fa-remove"></i>CLose
           </button>
           <button type="submit" class="btn btn-success save pull-left">
               <i class="fa fa-ok"> Save </i>
           </button>
       </div>
    </div>
</form>
<script>
$(document).ready(function(){
    $('#form').submit(function (event) {
        var btn = $('.save');
        btn.button('loading');
        event.preventDefault();
        var fd = new FormData($('#form')[0]);
        $.post("<?php echo site_url('admin/category/save_cat') ?>", $(this) .serialize(), function (data,textStatus, xhr) {
            if (data.status == 'true') {
                bootbox.alert(data.message, function() {
                    $('#AddCat').modal('hide');
                    window.location.reload();
                });
            } else {
                bootbox.alert(data.message, function() {
                btn.button('reset');
                });
            }
        },'json')
        .fail(function(){
            bootbox.alert("proccessing error",function() {
                btn.btn('reset');
            });
        });
    });
});
</script>