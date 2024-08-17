<script>
    import DasboardLayout from "@/layouts/dasboardLayout.svelte";
    import { OptionTinyMce } from "@/lib/scripts/tinymceProps";
    import { Col, FormFeedback, FormGroup, Input, Label, Row } from "@sveltestrap/sveltestrap";
    import Editor from "@tinymce/tinymce-svelte";
    import { useForm } from "@inertiajs/svelte";
    import { modal } from "@/lib/scripts/modalToggler";
    import LogoSettingModal from "@/lib/components/logoSettingModal.svelte";
    import { notify } from "@/lib/scripts/notify";
    import { asset } from "@/lib/scripts/userStore";

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
    })

    const submit = ()=> {
        $form.post(route("setting.website.store"),{
            onSuccess: ()=> {
                notify({
                    toast: true,
                    timer: 1500,
                    title: "Successful",
                    icon: "success"
                })
            }
        })
    }
</script>

<DasboardLayout>
    <div class="page-wrapper" id="settings-wrapper" style="min-height: 799px;">
        <!-- main content -->
        <div class="container-fluid">
            <!--page heading-->
            <div class="row page-titles">
                <!-- Page Title & Bread Crumbs -->
                <!--CRUMBS CONTAINER (LEFT)-->
                <div class="col-md-12 col-lg-5 align-self-center main-pages-crumbs">
                    <h3 class="text-themecolor">Settings</h3>
                    <!--crumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>

                        <li class="breadcrumb-item">Settings</li>

                        <li class="breadcrumb-item active active-bread-crumb">
                            Website
                        </li>

                        <!--filtered results label-->
                    </ol>
                    <!--crumbs-->
                </div>

                <!--include various checkbox actions-->

                <!--Page Title & Bread Crumbs -->
            </div>

            <div class="card min-h-300">
                <div class="card-body">
                    <form id="website" method="post" action={route("setting.website.store")} on:submit|preventDefault={submit}>
                        <FormGroup>
                            <Label>Front page Heading</Label>
                            <Input invalid={$form.errors.front_page_heading} feedback={$form.errors.front_page_heading} type="textarea" bind:value={$form.front_page_heading}  name="front_page_heading" />
                        </FormGroup>
                        <FormGroup>
                            <Label>Front page Sub-Heading</Label>
                            <Input invalid={$form.errors.front_page_subheading} feedback={$form.errors.front_page_subheading} type="textarea" bind:value={$form.front_page_subheading} name="front_page_sub_heading" />
                        </FormGroup>
                        <FormGroup>
                            <Label>Our Mission</Label>
                            <Editor conf={OptionTinyMce} bind:value={$form.mission} name="mission" scriptSrc="storage/tinymce/tinymce.min.js" />
                            <FormFeedback valid={$form.errors.mission}>{$form.errors.mission}</FormFeedback>
                        </FormGroup>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card card-outline-warning">
                                    <div class="card-header fx-settings-logo-card">
                                        <h4 class="m-b-0">Large Logo</h4>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="p-b-20">
                                            <img class="logo-large display-inline-block" src={asset+large_logo} alt="Large Logo"/>
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
                                            <img class="logo-small display-inline-block" src={asset+small_logo} alt="Small Logo"/>
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

                        <Row class="gx-4">
                            <Col md="6" >
                                <FormGroup>
                                    <Label>Front Page Jumbo Image</Label>
                                    <a href="{void(0)}" class="btn btn-rounded-x btn-danger edit_image_icon" on:click={()=>modal.open({comp:LogoSettingModal,prop:{placeholder: "front_img"}})}>Change Image</a>
                                    <Input class="w-100 h-100" type="image" src="{asset+front_img}" />
                                </FormGroup>
                            </Col>
                            <Col md="6" >
                                <FormGroup>
                                    <Label>About Page Jumbo Image</Label>
                                    <a href="{void(0)}" class="btn btn-rounded-x btn-danger edit_image_icon" on:click={()=>modal.open({comp:LogoSettingModal,prop:{placeholder: "about_img"}})}>Change Logo</a>
                                    <Input type="image" class="w-100 h-100" src={asset+about_img} />
                                </FormGroup>
                            </Col>
                        </Row>

                        <div class="text-right mt-4">
                            <button form="website" type="submit" class="btn btn-rounded-x btn-danger text-left">Save Changes
                                {#if $form.processing}
                                    <div class="spinner-border spinner-border-sm text-primary"></div>
                                {/if}
                            </button>
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

<style>
    .edit_image_icon {
        position: absolute;
        right: 16px;
        top: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
