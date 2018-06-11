<style type="text/css" media="screen">
    .ui-autocomplete { z-index: 999999; }
    /*.modal-dialog { width:350px; }*/
</style>
<form id="form" action="" role="form" action="" method="post">
    <input type="hidden" name="id" value="i">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input name="name" type="text" id="name"  value="<?php echo $records->tag_name ;?>" class="form-control" required placeholder="Tag Name">
                    <!-- <input type="hidden" name="tag_create_date"> -->
                </div>

                <div class="form-group">
                    <label for="category"> Category </label>
                    <select name="cat" class="form-control select2" style="width: 100%;">
                        <option value="">-- Select Category --</option>
                        <?php 
                            foreach($category as $cat): 
                        ?>
                        <option value="<?php echo $cat->category_id ?>" <?php echo ($cat->category_id) ? '' : 'selected' ?>><?php echo $cat->category_name ?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
        </div>
       <div class="modal-footer">
           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">
               <i class="fa fa-remove"></i>CLose
           </button>
           <button type="submit" class="btn btn-success save pull-right">
               <i class="fa fa-ok"> Save </i>
           </button>
       </div>
</form>
<script>
$(document).ready(function(){
    $('#form').submit(function (event) {
        var btn = $('.save');
        btn.button('loading');
        event.preventDefault();
        var fd = new FormData($('#form')[0]);
        $.post("<?php echo site_url('admin/tag/save_tag') ?>", $(this) .serialize(), function (data,textStatus, xhr) {
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
                window.location.reload();
            });
        });
    });
});
</script>