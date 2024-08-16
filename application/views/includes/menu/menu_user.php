            <li class="green" data-toggle="tooltip" title='Profile'> 
                <a data-toggle="dropdown" class="dropdown-toggle " href="javascript:void(0)">
                    <i class="ace-icon fa fa-user fa-shake animated"></i>
                    <?php echo $this->lang->line('PROFILE'); ?>
                    <span class="badge badge-grey"></span>
                </a>

                <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                    <li class="dropdown-header">
                        <?php
                        echo $this->session->userdata('fullname');
                        echo "&nbsp;&nbsp;";
                        echo "<strong class=\"text-danger\">";
                        if ($this->session->userdata('user_type') == 9)
                            echo "(Admin)";
                        else
                            echo "(Operator)";
                        echo "</strong>";
                        ?>
                    </li> 
                    <li>
                    <?php if($this->session->userdata('user_type') == 9){ ?>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/app_setting">
                            <div class="clearfix">
                                <span class="pull-left">App Setting</span>                                          
                            </div> 
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/user_add">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_USER') ?></span>                                          
                            </div> 
                        </a>
                    </li>
                    <?php } //ends of if condition?>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/user_view">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('VIEW_USER') ?></span>                                         
                            </div> 
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/user_edit">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('EDIT_PROFILE') ?></span>                                          
                            </div> 
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/logout">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('LOG_OUT') ?></span>                                          
                            </div> 
                        </a>
                    </li>
            </li>