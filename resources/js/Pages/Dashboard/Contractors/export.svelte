<script>
  import { toggler } from "@/lib/scripts/panelToggler";
  import { IconFilterBolt, IconX } from "@tabler/icons-svelte";

    const id = 'export-contractors'
</script>
<div class="right-sidebar right-sidebar-export sidebar-lg animate__animated animate__bounceIn" class:shw-rside={$toggler == id}>
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <IconFilterBolt class="icon-Filter-2" />Export Contractors
                <span on:click={()=>toggler.close()}>
                    <IconX class="ti-close" />
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body p-l-35 p-r-35">

                <!--standard fields-->
                <div class="">
                    <h5>Standard Fields</h5>
                </div>
                <div class="line"></div>
                <div class="row">

                    <!--client_company_name-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_company_name]"
                                    name="standard_field[client_company_name]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[client_company_name]">Client Name</label>
                            </div>
                        </div>
                    </div>

                    <!--client_created-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_created]"
                                    name="standard_field[client_created]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[client_created]">Date Created</label>
                            </div>
                        </div>
                    </div>


                    <!--category-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[category]" name="standard_field[category]"
                                    class="filled-in chk-col-light-blue" checked>
                                <label class="p-l-30" for="standard_field[category]">Category</label>
                            </div>
                        </div>
                    </div>

                    <!--contact_name-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[contact_name]"
                                    name="standard_field[contact_name]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[contact_name]">Contact Name</label>
                            </div>
                        </div>
                    </div>

                    <!--contact_email-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[contact_email]"
                                    name="standard_field[contact_email]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[contact_email]">Contact Email</label>
                            </div>
                        </div>
                    </div>

                    <!--client_phone-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_phone]"
                                    name="standard_field[client_phone]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[client_phone]">Telephone</label>
                            </div>
                        </div>
                    </div>

                    <!--client_website-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_website]"
                                    name="standard_field[client_website]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[client_website]">Website</label>
                            </div>
                        </div>
                    </div>

                    <!--client_vat-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_vat]"
                                    name="standard_field[client_vat]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[client_vat]">VAT/TAX Number</label>
                            </div>
                        </div>
                    </div>

                    <!--client_billing_street-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_billing_street]"
                                    name="standard_field[client_billing_street]"
                                    class="filled-in chk-col-light-blue" checked>
                                <label class="p-l-30" for="standard_field[client_billing_street]">Street</label>
                            </div>
                        </div>
                    </div>

                    <!--client_billing_city-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_billing_city]"
                                    name="standard_field[client_billing_city]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[client_billing_city]">City</label>
                            </div>
                        </div>
                    </div>

                    <!--client_billing_state-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_billing_state]"
                                    name="standard_field[client_billing_state]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[client_billing_state]">State</label>
                            </div>
                        </div>
                    </div>

                    <!--client_billing_zip-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_billing_zip]"
                                    name="standard_field[client_billing_zip]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[client_billing_zip]">Zip Code</label>
                            </div>
                        </div>
                    </div>

                    <!--client_billing_country-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_billing_country]"
                                    name="standard_field[client_billing_country]"
                                    class="filled-in chk-col-light-blue" checked>
                                <label class="p-l-30" for="standard_field[client_billing_country]">Country</label>
                            </div>
                        </div>
                    </div>

                    <!--invoices-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[invoices]" name="standard_field[invoices]"
                                    class="filled-in chk-col-light-blue" checked>
                                <label class="p-l-30" for="standard_field[invoices]">Invoices</label>
                            </div>
                        </div>
                    </div>

                    <!--payments-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payments]" name="standard_field[payments]"
                                    class="filled-in chk-col-light-blue" checked>
                                <label class="p-l-30" for="standard_field[payments]">Payments</label>
                            </div>
                        </div>
                    </div>

                    <!--status-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_status]"
                                    name="standard_field[client_status]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="standard_field[client_status]">Status</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!--custon fields-->
                <div class="m-t-30">
                    <h5>Custom Fields</h5>
                </div>
                <div class="line"></div>
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="custom_field[client_custom_field_1]"
                                    name="custom_field[client_custom_field_1]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="custom_field[client_custom_field_1]">VAT</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="custom_field[client_custom_field_11]"
                                    name="custom_field[client_custom_field_11]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="custom_field[client_custom_field_11]">Last
                                    Project</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="custom_field[client_custom_field_21]"
                                    name="custom_field[client_custom_field_21]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="custom_field[client_custom_field_21]">Comments</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="custom_field[client_custom_field_41]"
                                    name="custom_field[client_custom_field_41]" class="filled-in chk-col-light-blue"
                                    checked>
                                <label class="p-l-30" for="custom_field[client_custom_field_41]">Projects
                                    Type</label>
                            </div>
                        </div>
                    </div>
                </div>


                <!--buttons-->
                <div class="buttons-block">

                    <button type="button"
                        class="btn btn-rounded-x btn-danger apply-filter-button"
                        data-url="https://midnight.growcrm.io/export/clients?&amp;ref=list" data-type="form"
                        data-ajax-type="POST" data-button-loading-annimation="yes">Export</button>
                </div>
            </div>

        </div>
    </form>
    <!--sidebar--> <!--clients table-->
</div>