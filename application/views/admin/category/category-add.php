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