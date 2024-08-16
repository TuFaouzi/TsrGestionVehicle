            <li class="grey" data-toggle="tooltip" title='Settings'>
                <a data-toggle="dropdown" class="dropdown-toggle " href="javascript:void(0)">
                    <i class="ace-icon fa fa-cogs faa-shake animated"></i>
                    <?php echo $this->lang->line('SETTINGS'); ?>
                    <span class="badge badge-grey"></span>
                </a>

                <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                    <li class="dropdown-header"><?php echo $this->lang->line('SETTINGS') ?></li> 
                    <li>
                        <a href="<?php echo base_url(); ?>company/create">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_COMPANY') ?></span><!--VEHICAL_TYPE_SETUP-->                                         
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>vehicle/vehicle_type_create">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_VEHICLE_TYPE') ?></span><!--VEHICAL_TYPE_SETUP-->                                         
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>vehicle/vehicle_information_create">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_VEHICLE_INFORMATION') ?></span><!--VEHICAL_INFORMATION-->                                         
                            </div>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() . 'vehicle/vehicle_fitness_add'; ?>">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_VEHICAL_FITNESS') ?></span>                                           
                            </div>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() . 'fule_rate/create'; ?>">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_VEHICAL_FULE_RATE') ?></span>                                         
                            </div>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>driver_info/create">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_DRIVER_INFORMATION') ?></span>                                            
                            </div>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>district/district_create">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_DISTRICT_INFORMATION') ?></span>                                          
                            </div>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>city/city_create">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_STATION_INFORMATION') ?></span>                                           
                            </div>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>station_distence/station_distence_create">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_STATION_TO_STATION_INFORMATION') ?></span>                                            
                            </div>

                        </a>
                    </li>
                     <li>
                        <a href="<?php echo base_url(); ?>rent/create">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_COMPANY_RENT') ?></span>                                          
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>expense_list/create">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo $this->lang->line('ADD_EXPENSE_TYPE') ?></span>                                          
                            </div>

                        </a>
                    </li> 

                </ul>
            </li>