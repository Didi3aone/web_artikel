<?php 
if(isset($gallery)) {
    $inputName = $gallery['name'];
    $inputImg  = $gallery['photo'];
} else {

    $inputName = set_value('name');
    $inputImg  = set_value('photo');
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Form 
            <small>Add some article</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open_multipart(current_url()); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title ?></h3>
                    </div>
                    <?php echo validation_errors(); ?>
                    <? if ( isset($gallery)) : ?>
                    <input type="hidden" name="gallery_id" value="<?php echo $gallery['gallery_id'] ?>">
                    <input type="hidden" name="created_at" value="<?php echo $gallery['created_at']?>">
                <?php endif; ?>
                <form role="form" enctype="multipart/form-data" method="post">
                    <div class="box-body">
                        <div class="col-md-6">
                            <label for="title">News Title *</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $inputName?>" placeholder="Title">
                        </div>

                        <div class="col-md-6">
                            <label for="image">Upload Image</label>
                            <input type="file" name="photo">
                            <!-- <img src="" alt=""> -->
                            <?php if (isset($gallery) ) {?>
                            <br>
                            <img src="<?php echo base_url('uploads/gallery/'.$gallery['photo'])?>" alt="" style="width: 100px; height: 70px;" id="prev">
                            <?php } ?>
                        </div>
                    </div>

                    <div style="height: 50px;"></div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-lg" value="save">Submit</button>
                        <a href="<?php echo site_url('admin/gallery')?>" class="btn btn-success btn-lg"><i class="fa fa-ok"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php echo form_close() ?>
</div>