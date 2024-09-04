<section class="MainSection-TopSpacing Page-Bg page-TopSpacing">
    <div class="container">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 SideBar-bg">
                <?php $this->load->view('address/sidebar'); ?>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="information-block-for-mobile" style="display:none;">
                    <h2><?php echo trans('personal_information'); ?></h2>
                    

                    <div class="address-progress-bar address-progress-bar-mobile">
                        <div class="chart" id="graph" data-percent="50">
                            <img src="<?php echo base_url('assets/frontend/images/step1.png'); ?>" class="step-img">
                        </div>
                        <div class="progress-bar-status"><?php echo trans('add_contact_information_for_this_address'); ?></div>
                    </div>
                </div>
                <div class="new-address">
                    <div class="Personal-Information">
                        <div id="map"></div>
                        <div class="information-block ">
                            <h2><?php echo trans('personal_information'); ?></h2>
                           <div class="cros_button">
                           <a href="<?php echo route('address/manage'); ?>">
                            <i class="fas fa-times  fs-6 text-dark"></i>
                            </a>
                           </div>
                            <div class="address-progress-bar">
                                <div class="chart" id="graph" data-percent="50">
                                    <img src="<?php echo base_url('assets/frontend/images/step1.png'); ?>" class="step-img">
                                </div>
                                <div class="progress-bar-status"><?php echo trans('add_contact_information_for_this_address'); ?></div>
                            </div>
                            <div class="contact-details">
                                <form action="<?php echo route('address/save'); ?>" method="POST" class="ajax_form" id="regForm" onsubmit="return false;">
                                    <div class="tab">
                                        <div class="row mt-4">
                                            <div class="col-md-12 col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input address-for" type="radio" name="address_for" id="inlineRadio1" value="me">
                                                    <label class="form-check-label" for="inlineRadio1"><?php echo trans('me'); ?></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input address-for" type="radio" name="address_for" id="inlineRadio2" value="other">
                                                    <label class="form-check-label" for="inlineRadio2"><?php echo trans('other'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12 col-12">
                                                <input type="text" name="name" class="form-control required user_detail" placeholder="<?php echo trans('full_name'); ?> *" data-value="<?php echo ($user->first_name ? $user->first_name . ' ' . $user->last_name : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 col-12">
                                                <input type="text" name="email" class="form-control required user_detail" placeholder="<?php echo trans('email_address'); ?> *" data-value="<?php echo $user->email; ?>">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 col-12">
                                                <input type="text" name="phone" class="form-control required user_detail" placeholder="<?php echo trans('phone_number'); ?> *" data-value="<?php echo $user->mobile; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <div class="second-step">
                                            <div class="row mt-2">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="location_name" class="form-control required" placeholder="<?php echo trans('location_name_ex_home'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="country" class="form-control required" placeholder="<?php echo trans('country'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="region" class="form-control required" placeholder="<?php echo trans('region'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="city" class="form-control required" placeholder="<?php echo trans('city'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="district" class="form-control required" placeholder="<?php echo trans('district_name'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="address" class="form-control required" placeholder="<?php echo trans('address'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12 col-12">

                                                    <select name="building_type" id="building_type" class="form-control form-control-select-building-type" required>
                                                        <option value="" selected><?php echo trans('building_type'); ?></option>

                                                        <?php
                                                        $building_types = building_types();
                                                        foreach($building_types as $key => $val) { ?>
                                                            <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3 field-for-villa" style="display: none;">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="villa_number" class="form-control " placeholder="<?php echo trans('villa_number'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3 field-for-villa" style="display: none;">
                                                <div class="col-md-12 col-12">
                                                    <input type="file" name="villa_picture" id="villa_picture" class="" />
                                                    <label for="villa_picture" class="form-control"><?php echo trans('villa_picture'); ?> *</label>

                                                </div>
                                            </div>
                                            <div class="row mt-3 field-for-building" style="display: none;">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="building_number" class="form-control " placeholder="<?php echo trans('building_number'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3 field-for-building field-for-office" style="display: none;">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="floor_number" class="form-control " placeholder="<?php echo trans('floor_number'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3 field-for-office" style="display: none;">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="office_number" class="form-control " placeholder="<?php echo trans('office_number'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3 field-for-office" style="display: none;">
                                                <div class="col-md-12 col-12">
                                                    <input type="file" name="office_picture" id="office_picture" class="" />
                                                    <label for="office_picture" class="form-control"><?php echo trans('office_picture'); ?> *</label>
                                                </div>
                                            </div>
                                            <div class="row mt-3 field-for-building" style="display: none;">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="apartment_number" class="form-control " placeholder="<?php echo trans('apartment_number'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3 field-for-building" style="display: none;">
                                                <div class="col-md-12 col-12">
                                                    <input type="file" name="building_picture" id="building_picture" class="" />
                                                    <label for="building_picture" class="form-control"><?php echo trans('building_picture'); ?> *</label>
                                                </div>
                                            </div>
                                            <div class="row mt-3 field-for-building" style="display: none;">
                                                <div class="col-md-12 col-12">
                                                    <input type="file" name="apartment_picture" id="apartment_door_picture" class="" />
                                                    <label for="apartment_door_picture" class="form-control"><?php echo trans('apartment_door_picture'); ?> *</label>
                                                </div>
                                            </div>
                                            <div class="row mt-3 field-for-other" style="display: none;">
                                                <div class="col-md-12 col-12">
                                                    <input type="text" name="other" class="form-control " placeholder="<?php echo trans('other'); ?> *">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12 col-12">
                                                    <textarea name="note" class="form-control" placeholder="<?php echo trans('note'); ?>" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 col-12">
                                            <div class="step-form-buttons">
                                                <button class="gray-button signin-button btn btn-primary w-50 me-3" type="button" id="prevBtn" onclick="goPrev();"><?php echo trans('previous'); ?></button>
                                                <button class="signin-button btn btn-primary w-50" type="button" id="nextBtn" onclick="goNext();"><?php echo trans('next'); ?></button>
                                                <button class="signin-button btn btn-primary w-50" type="button" id="submitBtn" onclick="submitForm();" style="display: none;"><?php echo trans('submit'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="latitude">
                                    <input type="hidden" name="longitude">
                                </form>
                            </div>
                        </div>
                        <div class="map_search_div">
                            <input type="text" class="map-search-field" id="map_search" placeholder="<?php echo trans('search_map'); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="Pinsaa-Credits "><?php echo trans('all_rights_reserved_by_pinsaa'); ?></div>
            </div>
        </div> -->
    </div>
</section>