<footer>
    <div class="container">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="Pinsaa-Credits"><?php echo trans('all_rights_reserved_by_pinsaa'); ?></div>
            </div>
        </div>
    </div>
</footer>
<!--SignUp Modal Starts Here-->
<div class="modal fade login-modal" id="signupModal" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog RegisterModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="signupModalLabel"><?php echo trans('create_new_account'); ?></h5>
                <div class="account-login account-modal account-modal-register">
                    <form action="<?php echo base_url('user/sign_up'); ?>" method="POST" class="ajax_form mb-4"
                          onsubmit="return false;">
                        <div class="mb-3">
                            <input type="text" name="first_name" class="form-control"
                                   placeholder="<?php echo trans('first_name'); ?> *">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="last_name" class="form-control"
                                   placeholder="<?php echo trans('last_name'); ?> *">
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control"
                                   placeholder="<?php echo trans('email'); ?> *">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="mobile" class="form-control"
                                   placeholder="<?php echo trans('mobile'); ?> (966xxxxxxxxx) *">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="password" class="form-control"
                                   placeholder="<?php echo trans('password'); ?> *">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="confirm_password" class="form-control"
                                   placeholder="<?php echo trans('reenter_password'); ?> *">
                        </div>
                        <button type="submit"
                                class="btn btn-primary signin-button"><?php echo trans('sign_up'); ?></button>
                    </form>
                    <?php $social_logins = social_logins();
                    if ($social_logins) { ?>
                        <h2><?php echo trans('or_sign_up_with'); ?></h2>
                        <ul class="SignIn-With-buttons SignIn-With-buttons-Mobile">
                            <?php foreach ($social_logins as $social_login) { ?>
                                <li>
                                    <a href="<?php echo base_url('social_auth?provider=' . $social_login); ?>">
                                        <img src="<?php echo base_url('assets/frontend/images/' . strtolower($social_login) . '.svg'); ?>"
                                             alt=""> <?php echo $social_login; ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <!--<li><a href="#"><img src="<?php /*echo base_url('assets/frontend/images/apple.png'); */ ?>"
                                                 alt=""> Apple</a></li>-->
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--SignUp Modal Ends Here-->

<div class="modal fade login-modal" id="ForgetPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="ForgetPasswordModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog RegisterModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="ForgetPasswordModalLabel"><?php echo trans('forget_password'); ?></h5>
                <div class="account-login account-modal account-modal-register">
                    <form action="<?php echo base_url('user/forget_password'); ?>" method="POST" class="ajax_form mb-4"
                          onsubmit="return false;">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control"
                                   placeholder="<?php echo trans('email'); ?> *">
                        </div>
                        <button type="submit"
                                class="btn btn-primary signin-button"><?php echo trans('submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($this->session->userdata('user')) { ?>
    <div class="modal fade login-modal" id="UpdateProfileModal" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="UpdateProfileModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog RegisterModal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title" id="UpdateProfileModalLabel"><?php echo trans('update_profile'); ?></h5>
                    <div class="account-login account-modal account-modal-register">
                        <form action="<?php echo base_url('user/update_profile'); ?>" method="POST"
                              class="ajax_form mb-4"
                              onsubmit="return false;">
                            <input type="hidden" name="id" value="<?php echo $this->session->userdata('user')->id; ?>">
                            <div class="mb-3">
                                <input type="text" name="first_name" class="form-control"
                                       placeholder="<?php echo trans('first_name'); ?> *"
                                       value="<?php echo $this->session->userdata('user')->first_name; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="last_name" class="form-control"
                                       placeholder="<?php echo trans('last_name'); ?> *"
                                       value="<?php echo $this->session->userdata('user')->last_name; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control"
                                       placeholder="<?php echo trans('email'); ?> *"
                                       value="<?php echo $this->session->userdata('user')->email; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="mobile" class="form-control"
                                       placeholder="<?php echo trans('mobile'); ?> (966xxxxxxxxx) *"
                                       value="<?php echo $this->session->userdata('user')->mobile; ?>">
                            </div>
                            <div class="mb-3">
                                <h6><?php echo trans('change_password'); ?></h6>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="current_password" class="form-control"
                                       placeholder="<?php echo trans('current_password'); ?> *">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="new_password" class="form-control"
                                       placeholder="<?php echo trans('new_password'); ?> *">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="confirm_password" class="form-control"
                                       placeholder="<?php echo trans('reenter_new_password'); ?> *">
                            </div>
                            <button type="submit"
                                    class="btn btn-primary signin-button"><?php echo trans('update_profile'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>