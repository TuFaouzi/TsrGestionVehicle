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
        
         <div class="row" style="border: 1px solid gainsboro;">
            <div class="col-xs-12" id="PrintArea">
                <div class="panel-body">  
                    <div class="table-header">
                        <i class="fa fa-list"></i>
                         <a href="<?= base_url('language') ?>" class="btn btn-info"><i class="fa fa-list"></i><?php echo display('languagelist');?></a>
                    </div>
                    <hr>
                </div>
                <div>
                    <table id="sample-table-2" class="display compact cell-border" cellspacing="0" width="100%">
                        <thead>

                            <tr>
                                <td colspan="2">
                                    <?= form_open('language/addPhrase', ' class="form-inline" ') ?> 
                                         <div class="form-group">
                                             <label class="sr-only" for="addphrase"><?php echo display('phrasename');?></label>
                                            <input name="phrase[]" type="text" class="form-control" id="addphrase" placeholder="Phrase Name">
                                        </div>
                                          
                                        <button type="submit" class="btn btn-primary"><?php echo display('save');?></button>
                                    <?= form_close(); ?>
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <th>
                                    <?php echo display('slno'); ?>
                                </th>
                                <th>
                                    <?php echo display('vehicletype'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($phrases)) {?>
                                <?php
                                $i=0;
                                foreach ($phrases as $value) {?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $value->phrase ?></td>
                                </tr>
                                <?php } ?>
                            <?php } ?>
                           
                        </tbody>
                        <tfoot>
                            <tr><td colspan="2"><?php echo (!empty($links)?$links:null) ?></td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
