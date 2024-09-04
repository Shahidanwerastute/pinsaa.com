<section class="MainSection-TopSpacing Page-Bg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 SideBar-bg">
                <?php $this->load->view('address/sidebar'); ?>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="No-Address-Yet">
                    <div class="No-Address-Content text-center">
                        <img class="mb-2" src="<?php echo base_url('assets/frontend/images/couch.png')?>" alt="">
                        <p><?php echo trans('you_have_no_address_yet'); ?></p>
                        <a href="<?php echo route('address/add?q=1'); ?>" class="btn btn-primary Btn-Blue"><?php echo trans('add_address'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="Pinsaa-Credits"><?php echo trans('all_rights_reserved_by_pinsaa'); ?></div>
            </div>
        </div> -->
    </div>
</section>