
<aside class="right-side">
    <section class="content">

        <div class="row">
            <div class="col-sm-12">

        <!-- alert message -->
            <?php if ($this->session->flashdata('message') != null) {  ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $this->session->flashdata('message'); ?>
            </div> 
            <?php } ?>

            <?php if ($this->session->flashdata('exception') != null) {  ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $this->session->flashdata('exception'); ?>
            </div>
            <?php } ?>

            <?php if (validation_errors()) {  ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo validation_errors(); ?>
            </div>
            <?php } ?>
                
            </div>
        </div>
        <br/>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?= base_url('language/phrase') ?>"> <i class="fa fa-plus"></i><?php echo display('addphrase');?></a>
                    <a class="btn btn-primary" href="<?= base_url('language') ?>"> <i class="fa fa-list"></i><?php echo display('languagelist');?></a> 
                </div> 
            </div>
            <div class="panel-body">
                <div class="row">
                    <!-- phrase -->
                    <div class="col-sm-12">
                        <?= form_open('language/addlebel') ?>
                        <table class="table table-striped">
                            <thead> 
                                <tr>
                                    <th><i class="fa fa-th-list"></i></th>
                                    <th><?php echo display('phrase');?></th>
                                    <th><?php echo display('label');?></th> 
                                </tr>
                            </thead>

                            <tbody>
                                <?= form_hidden('language', $language) ?>
                                    <?php if (!empty($phrases)) {?>
                                        <?php $sl = 1 ?>
                                        <?php foreach ($phrases as $value) {?>
                                        <tr class="<?= (empty($value->$language)?"bg-danger":null) ?>">
                                        
                                            <td width="2%"><?= $sl++ ?></td>
                                            <td><input type="text" name="phrase[]" value="<?= $value->phrase ?>" class="form-control" readonly></td>
                                            <td><input type="text" name="lang[]" value="<?= $value->$language ?>" class="form-control"></td> 
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>

                                    <tfoot>
                                        <tr>
                                            <td colspan="2"> 
                                                <button type="reset" class="btn btn-danger"><?php echo display('reset');?></button>
                                                <button type="submit" class="btn btn-success"><?php echo display('save');?></button>
                                            </td>
                                            <td colspan="2">
                                                <?php echo (!empty($links)?$links:null) ?>
                                            </td>
                                        </tr>
                                    </tfoot>
                            </tbody>
                            <?= form_close() ?>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </section>
</aside>