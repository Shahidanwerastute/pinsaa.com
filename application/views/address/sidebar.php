<div class="SideBar">
    <h1><?php echo trans('menu'); ?></h1>
    <ul class="SideMenu">
        <li><a href="<?php echo base_url('address/add'); ?>" class="<?php echo (strtolower($this->router->fetch_class()) == 'address' && strtolower($this->router->fetch_method()) == 'add' ? 'active' : ''); ?>"><i class="icofont-plus me-2"></i> <?php echo trans('add_new_address'); ?></a></li>
        <li><a href="<?php echo base_url('address/manage'); ?>" class="<?php echo (strtolower($this->router->fetch_class()) == 'address' && strtolower($this->router->fetch_method()) == 'manage' ? 'active' : ''); ?>"><i class="icofont-ui-edit me-2"></i> <?php echo trans('list_of_address'); ?></a></li>
    </ul>
</div>