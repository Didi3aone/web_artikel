<div id="content">
    <!-- widget grid --> 
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <h1 class="page-title txt-color-blueDark"><?= $title ?></h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
            <h1>
                <a class="btn btn-primary" href="<?= site_url('/manager/user/create') ?>" rel="tooltip" title="Buat User Baru" data-placement="left">
                    <i class="fa fa-plus fa-lg"></i>
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
                        <h2><?= $title_page ?> </h2>
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <!-- <div class="jarviswidget-editbox"> -->
                            <!-- This area used as dropdown edit box -->
                        <!-- </div> -->
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                        
                            <table id="dataTable" class="table table-striped table-bordered" width="100%">
                              
                                    <tr>
                                        <th data-hide="phone">ID</th>
                                        <th data-class="expand"> Nama </th>
                                        <th data-hide="phone"> Posisi </th>
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