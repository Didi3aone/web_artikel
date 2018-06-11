<div id="content">
    <!-- widget grid -->
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <h1 class="page-title txt-color-blueDark"><?= $title ?></h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
            <h1>
                <a href="<?= site_url('manager/category/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>
                </a>
            </h1>
        </div>
    </div>
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2><?= $title ?> </h2>
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body no-padding">

                            <table id="dataTable" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>                         
                                    <tr>
                                        <th data-hide="phone">ID</th>
                                        <th data-class="expand">Nama Kategori</th>
                                        <th data-hide="phone,tablet">Di Buat</th>
                                        <th data-hide="phone,tablet">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- end widget content -->
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>
<!-- end widget div -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="/artikel/asset/images/pejuangsubuh.jpg" width="150" alt="pejuangsubuh">
                </h4>
            </div>
            <div class="modal-body no-padding">

                <form id="form" class="smart-form" method="POST" action="<?php echo site_url('admin/category/procces_form') ?>">
                    <fieldset>
                        <section>
                            <div class="row">
                                <label class="label col col-2">Nama Kategori</label>
                                <div class="col col-10">
                                    <label class="input">
                                        <input type="text" name="nama_kategori" value="">
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <label class="label col col-2">Deskripsi</label>
                                <div class="col col-10">
                                    <label class="input">
                                        <textarea name="desc" class="form-control"></textarea>
                                    </label>
                                    <div class="note">
                                        Deskripsi Kategori
                                    </div>
                                </div>
                            </div>
                        </section>

                    </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary btn-submit">
                               <i class="fa fa-save"></i>save
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-arrow-left"></i>Cancel
                            </button>

                        </footer>
                    </form>                     
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->