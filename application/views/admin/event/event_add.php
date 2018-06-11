<style type="text/css">
    .ui-autocomplete { z-index: 999999; }
    .modal-dialog { width:760px; }
</style>

<form id="form" action="" role="form" action="" method="post">
    <input type="hidden" name="id" value="i">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="box-body"> -->
                    <div class="form-group">
                        <label>Event Name</label>
                        <input name="name" type="text" class="form-control" required placeholder="Event Name">
                    </div>

                    <div class="form-group">
                        <label>Post Date</label>
                        <input name="post_date" type="date" class="form-control" required placeholder="Post Date">
                    </div>

<!--                     <div class="form-group">
                        <label>Event Name</label>
                        <input name="" type="text" class="form-control" required placeholder="Category Name">
                    </div>
 -->
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                        <option value=""> -Select Category -</option>
                         <?php foreach ($category as $val) : ?>
                         <option value="<?php echo $val->id?>"><?php echo $val->category_name?></option>
                     <?php endforeach;?>
                     </select>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                         <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Event Detail</label>
                         <textarea  name="content" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image">
                    </div>

                </div>
            </div>
        </div>
       <div class="modal-footer">
           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">
               <i class="fa fa-remove"></i>CLose
           </button>
           <button type="submit" class="btn btn-success save">
               <i class="fa fa-ok"> Save </i>
           </button>
       </div>
    </div>
</form>
<script>
    var processSave = false;
    $(document).ready(function(){
        $('#form').submit(function(event) {
            if ( processSave == false) {
                processSave = true;
                var btn = $('.save');
                event.preventDefault();
                var fd = new FormData($('#form')[0]);

                $.post("<?php echo site_url('admin/event/save_event')?>", $(this).serialize(),function(data, textStatus, xhr) {
                    console.log(data);
                    if(data.status == 'true') {
                        bootbox.alert(data.message,function(){
                            console.log("execute save");
                            $.ajax({
                                type: 'post',
                                url:"<?php echo site_url("admin/event/upload_image");?>/"+data.id,
                                data:fd,
                                processData: false,
                                contentType:false,
                                success : function(d) {
                                    processSave = false;
                                    $('#AddEvent').modal('hide');
                                    window.location.reload();
                                }
                            });
                        });
                    } else {
                        bootbox.alert(data.message,function() {
                            btn.button('reset');
                        });
                    }
                },'json')
                .fail(function() {
                    bootbox.alert("proccessing error", function(){
                        btn.button('reset');
                    });
                });
            }
        });
    });
</script>