<script>
    import DasboardLayout from "@/layouts/dasboardLayout.svelte";
    import { OptionTinyMce } from "@/lib/scripts/tinymceProps";
    import { Col, FormGroup, Input, Label, Row } from "@sveltestrap/sveltestrap";
    import { IconEdit } from "@tabler/icons-svelte";
    import Editor from "@tinymce/tinymce-svelte";
    import { useForm } from "@inertiajs/svelte";
    import { modal } from "@/lib/scripts/modalToggler";
    import LogoSettingModal from "@/lib/components/logoSettingModal.svelte";

    export let front_page_heading = null;
    export let front_page_subheading = null;

    export let mission = null;
    export let front_img = null;
    export let about_img = null;
    export let large_logo
    export let small_logo

    const form  = useForm({
        front_page_heading,
        front_page_subheading,
        mission,
        front_img,
        about_img,
    })
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
                    <h3 class="text-themecolor">Settings</h3>
                    <!--crumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>

                        <li class="breadcrumb-item">Settings</li>

                        <li class="breadcrumb-item active active-bread-crumb">
                            User Roles
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
                >
                    <div id="list-page-actions">
                        <!--ADD NEW ITEM-->
                        <button
                            type="button"
                            class="btn btn-danger btn-add-circle edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                            data-toggle="modal"
                            data-target="#commonModal"
                            data-url="https://midnight.growcrm.io/settings/roles/create"
                            data-loading-target="commonModalBody"
                            data-modal-title="Create A New Role"
                            data-action-url="https://midnight.growcrm.io/settings/roles"
                            data-action-method="POST"
                            data-action-ajax-class=""
                            data-modal-size=""
                            data-action-ajax-loading-target="commonModalBody"
                            data-save-button-class=""
                            data-project-progress="0"
                        >
                            <i class="ti-plus"></i>
                        </button>

                        <!--add new button (link)-->
                    </div>
                </div>
                <!-- action buttons -->
            </div>

            <div class="card min-h-300">
                <div class="card-body">
                    <div class="">
                        <FormGroup>
                            <Label>Front page Heading</Label>
                            <Input type="textarea" bind:value={$form.front_page_heading} size=""  name="front_page_heading" />
                        </FormGroup>
                        <FormGroup>
                            <Label>Front page Sub-Heading</Label>
                            <Input type="textarea" bind:value={$form.front_page_subheading} name="front_page_sub_heading" />
                        </FormGroup>
                        <FormGroup>
                            <Label>Our Mission</Label>
                            <Editor conf={OptionTinyMce} bind:value={$form.mission} scriptSrc="storage/tinymce/tinymce.min.js" />
                        </FormGroup>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card card-outline-warning">
                                    <div class="card-header fx-settings-logo-card">
                                        <h4 class="m-b-0">Large Logo</h4>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="p-b-20">
                                            <img class="logo-large display-inline-block" src={large_logo} alt="Large Logo"/>
                                        </div>
                                        <p class="card-text">
                                            Used when the main menu is expanded
                                        </p>
                                        <p class="card-text">
                                            Also used on emails, estimates, etc.
                                        </p>
                                        <p
                                            class="card-text text-bold font-weight-500"
                                        >
                                            Best image dimensions : (185px X 45px)
                                        </p>
    
                                        <a href="{void(0)}" class="btn btn-rounded-x btn-danger" on:click={()=>modal.open({comp:LogoSettingModal,prop:{placeholder: "large_logo"}})}>Change Logo</a>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="card card-outline-warning">
                                    <div class="card-header fx-settings-logo-card">
                                        <h4 class="m-b-0">Small Logo</h4>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="p-b-20">
                                            <img class="logo-small display-inline-block" src={small_logo} alt="Small Logo"/>
                                        </div>
                                        <p class="card-text">
                                            Used when the main menu is collapsed
                                        </p>
                                        <p
                                            class="card-text text-bold font-weight-500"
                                        >
                                            Best image dimensions : (45px X 45px)
                                        </p>
    
                                        <a href="{void(0)}" class="btn btn-rounded-x btn-danger" on:click={()=>modal.open({comp:LogoSettingModal,prop:{placeholder: "small_logo"}})}>Change Logo</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <Row class="gx-4" form={true}>
                            <Col md="6" >
                                <FormGroup>
                                    <Label>Front Page Jumbo Image</Label>
                                    <a href="{void(0)}" class="btn btn-rounded-x btn-danger edit_image_icon" on:click={()=>modal.open({comp:LogoSettingModal,prop:{placeholder: "front_img"}})}>Change Image</a>
                                    <Input class="w-100 h-100" type="image" src="/storage/project/6692983d02191.jpg" />
                                </FormGroup>
                            </Col>
                            <Col md="6" >
                                <FormGroup>
                                    <Label>About Page Jumbo Image</Label>
                                    <a href="{void(0)}" class="btn btn-rounded-x btn-danger edit_image_icon" on:click={()=>modal.open({comp:LogoSettingModal,prop:{placeholder: "about_img"}})}>Change Logo</a>
                                    <Input type="image" class="w-100 h-100" src="/storage/project/6692983d02191.jpg" />
                                </FormGroup>
                            </Col>
                        </Row>
                    </div>
                </div>
            </div>
            <!-- /#main content -->
        </div>
        <!--page content -->

        <!--main content -->
    </div>
</DasboardLayout>

<style>
    .edit_image_icon {
        position: absolute;
        right: 16px;
        top: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .edit_image_icon::before{
        content: "";
        width: 100%;
        height: 30px;
        background-color: rgba(0, 0, 0, 0.3);
        display: inline-block;
        position: absolute;
        top: 0;
        border-radius: inherit;
        border: 1px solid #20aee3;
    }
</style>
