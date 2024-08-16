<script>
    import DasboardLayout from "@/layouts/dasboardLayout.svelte";
</script>

<DasboardLayout>
    <div class="page-wrapper" id="settings-wrapper" style="min-height: 799px;">
        <!-- main content -->
        <div class="container-fluid">
            <!--page heading-->
            <div class="row page-titles">
                <!-- Page Title & Bread Crumbs -->
                <!--CRUMBS CONTAINER (LEFT)-->
                <div
                    class="col-md-12 col-lg-5 align-self-center main-pages-crumbs"
                    id="breadcrumbs"
                >
                    <h3 class="text-themecolor">Company</h3>
                    <!--crumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>

                        <li class="breadcrumb-item">Settings</li>

                        <li class="breadcrumb-item active active-bread-crumb">
                            Company
                        </li>

                        <!--filtered results label-->
                    </ol>
                    <!--crumbs-->
                </div>

                <!--include various checkbox actions-->

                <!--Page Title & Bread Crumbs -->

                <!-- action buttons x -->
                <div
                    class="col-md-12 col-lg-7 align-self-center text-right parent-page-actions"
                ></div>
                <!-- action buttons -->
            </div>
            <!--page heading-->

            <!-- main content -->
            <!--custom fields - tab menu-->

            <!--other tab menus-->
            <div class="card min-h-300">
                <div
                    class="card-body tab-body tab-body-embedded"
                    id="embed-content-container"
                >
                    <!--settings-->
                    <form
                        class="form"
                        id="settingsFormCompany"
                        novalidate="novalidate"
                    >
                        <!--company-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label"
                                >Company Name</label
                            >
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm" name="settings_company_name" value="ABC Inc"/>
                            </div>
                        </div>

                        <!--address 1-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label"
                                >Address</label
                            >
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm" name="settings_company_address_line_1" value="10 Redcamp Road"/>
                            </div>
                        </div>

                        <!--city-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label"
                                >City</label
                            >
                            <div class="col-12">
                                <input
                                    type="text"
                                    class="form-control form-control-sm valid"
                                    id="settings_company_city"
                                    name="settings_company_city"
                                    value="Kent"
                                    aria-invalid="false"
                                />
                            </div>
                        </div>

                        <!--state-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label"
                                >State</label
                            >
                            <div class="col-12">
                                <input
                                    type="text"
                                    class="form-control form-control-sm valid"
                                    id="settings_company_state"
                                    name="settings_company_state"
                                    value="Milehill"
                                    aria-invalid="false"
                                />
                            </div>
                        </div>

                        <!--form text tem-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label"
                                >Zip Code</label
                            >
                            <div class="col-12">
                                <input
                                    type="text"
                                    class="form-control form-control-sm valid"
                                    id="settings_company_zipcode"
                                    name="settings_company_zipcode"
                                    value="ZE12 8QT"
                                    aria-invalid="false"
                                />
                            </div>
                        </div>

                        <!--form text tem-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label"
                                >Country</label
                            >
                            <div class="col-12">
                                <input
                                    type="text"
                                    class="form-control form-control-sm valid"
                                    id="settings_company_country"
                                    name="settings_company_country"
                                    value="United Kingdom"
                                    aria-invalid="false"
                                />
                            </div>
                        </div>

                        <!--form text tem-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label"
                                >Telephone</label
                            >
                            <div class="col-12">
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    id="settings_company_telephone"
                                    name="settings_company_telephone"
                                    value="012 345 6789"
                                />
                            </div>
                        </div>
                        
                        <!--buttons-->
                        <div class="text-right">
                            <button
                                type="submit"
                                id="commonModalSubmitButton"
                                class="btn btn-rounded-x btn-danger waves-effect text-left"
                                data-url="/settings/company"
                                data-loading-target=""
                                data-ajax-type="PUT"
                                data-type="form"
                                data-on-start-submit-button="disable"
                                >Save Changes</button
                            >
                        </div>
                    </form>
                </div>
            </div>
            <!-- /#main content -->
        </div>
        <!--page content -->

        <!--main content -->
    </div>
</DasboardLayout>
