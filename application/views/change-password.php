<section class="MainSection-TopSpacing Page-Bg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <h5><?php echo trans('update_password'); ?></h5>
                <div>
                    <form action="<?php echo base_url('user/update_password'); ?>" method="POST" class="ajax_form mb-4"
                          onsubmit="return false;">
                        <div class="mb-3">
                            <input type="text" name="password" class="form-control" placeholder="<?php echo trans('password'); ?> *">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="confirm_password" class="form-control"
                                   placeholder="<?php echo trans('reenter_password'); ?> *">
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <button type="submit" class="btn btn-primary signin-button"><?php echo trans('submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>