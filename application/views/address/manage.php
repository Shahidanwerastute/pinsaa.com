<section class="MainSection-TopSpacing Page-Bg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 SideBar-bg">
                <?php $this->load->view('address/sidebar'); ?>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="Manage-Address">
                    <div class="row">
                        <?php if ($addresses) {
                            foreach ($addresses as $address) { ?>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="address-box">
                                    <span class="address-location">
                                        <a href="javascript:void(0)"
                                           onclick="$('#AddressDetail_<?php echo $address->id; ?>').modal('show');">
                                            <?php echo $address->location_name; ?>
                                        </a>
                                    </span>
                                        <div class="location-icons">
                                            <a class="share-address" target="_blank" href="https://api.whatsapp.com/send?text=<?php echo share_address_on_whatsapp_message(route('share', [base64_encode($address->id)])); ?>"
                                               data-action="share/whatsapp/share"
                                               title="<?php echo trans('share_address_urls'); ?>"><img class="me-3"
                                                                                                       src="<?php echo base_url('assets/frontend/images/link.svg') ?>"
                                                                                                       alt=""></a>
                                            <a href="javascript:void(0);" title="<?php echo trans('copy_address'); ?>"><img class="me-3 copy"
                                                                               data-content="<?php echo address_to_copy($address); ?>"
                                                                               src="<?php echo base_url('assets/frontend/images/copy.svg') ?>"
                                                                               alt=""></a>
                                            <a href="javascript:void(0);" title="<?php echo trans('delete_address'); ?>" class="delete_address"
                                               data-id="<?php echo $address->id; ?>"><img class="me-3"
                                                                                          src="<?php echo base_url('assets/frontend/images/delete.svg') ?>"
                                                                                          alt=""></a>
                                            <a href="<?php echo route('address/edit', [$address->id]) ?>" title="<?php echo trans('edit_address'); ?>"><img
                                                        src="<?php echo base_url('assets/frontend/images/edit.svg') ?>"
                                                        alt=""></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade login-modal" id="AddressDetail_<?php echo $address->id; ?>"
                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                     aria-labelledby="AddressDetail_<?php echo $address->id; ?>Label" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog RegisterModal">
                                        <div class="modal-content position-relative">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-title" id="AddressDetail">
                                                    <div class="address-box Modal-address-box">
                        <span class="address-location"><a href="javascript:void(0)"><?php echo $address->location_name; ?></a></span>
                                                        <div class="location-icons">
                                                            <a class="share-address" target="_blank" href="https://api.whatsapp.com/send?text=<?php echo share_address_on_whatsapp_message(route('share', [base64_encode($address->id)])); ?>"
                                                               data-action="share/whatsapp/share"
                                                               title="<?php echo trans('share_address_urls'); ?>"><img class="me-3"
                                                                                                                       src="<?php echo base_url('assets/frontend/images/link.svg') ?>"
                                                                                                                       alt=""></a>
                                                            <a href="javascript:void(0);" title="<?php echo trans('copy_address'); ?>"><img class="me-3 copy"
                                                                                               data-content="<?php echo address_to_copy($address); ?>"
                                                                                               src="<?php echo base_url('assets/frontend/images/copy.svg') ?>"
                                                                                               alt=""></a>
                                                            <a href="javascript:void(0);" title="<?php echo trans('delete_address'); ?>" class="delete_address"
                                                               data-id="<?php echo $address->id; ?>"><img class="me-3"
                                                                                                          src="<?php echo base_url('assets/frontend/images/delete.svg') ?>"
                                                                                                          alt=""></a>
                                                            <a href="<?php echo route('address/edit', [$address->id]) ?>" title="<?php echo trans('edit_address'); ?>"><img
                                                                        src="<?php echo base_url('assets/frontend/images/edit.svg') ?>"
                                                                        alt=""></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="Address-Details">
                                                    <h2><?php echo trans('contact_info'); ?></h2>
                                                    <div class="Address-Label"><?php echo trans('name'); ?></div>
                                                    <p><?php echo $address->name; ?></p>
                                                    <div class="Address-Label"><?php echo trans('number'); ?></div>
                                                    <p><?php echo $address->phone; ?></p>
                                                    <h2 class="mt-4"><?php echo trans('location_info'); ?></h2>
                                                    <div class="Address-Label"><?php echo trans('address'); ?></div>
                                                    <p><?php echo trans('apartment_number') . ": " . $address->apartment_number . ", " . trans('building_number') . ": " . $address->building_number . ", " . trans('building_type') . ": " . building_types($address->building_type) . "<br>" . $address->address . ", " . $address->district . ', ' . $address->city . ', ' . $address->region . ', ' . $address->country; ?></p>
                                                    <?php if ($address->latitude && $address->longitude) { ?>
                                                        <div class="Address-Label"><?php echo trans('location_map'); ?></div>
                                                        <a href="http://www.google.com/maps/place/<?php echo $address->latitude; ?>,<?php echo $address->longitude; ?>"
                                                           target="_blank" class="pupup-map-link"><?php echo trans('click_here_to_view'); ?></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                        } ?>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="address-box address-box-light-bg justify-content-center">
                                <span class="address-location">
                                    <a href="<?php echo route('address/add'); ?>"><i class="icofont-plus me-2"></i> <?php echo trans('add_address'); ?></a>
                                </span>
                            </div>
                        </div>
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

<div class="modal fade login-modal" id="addressURLs"
     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="addressURLsLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-lg RegisterModal">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>