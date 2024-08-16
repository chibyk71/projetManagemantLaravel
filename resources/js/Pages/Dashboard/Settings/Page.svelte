<script>
    import DasboardLayout from "@/layouts/dasboardLayout.svelte";
</script>

<DasboardLayout>
    <div class="page-wrapper" id="settings-wrapper" style="min-height: 799px;">

        <!--overlay-->
        <div class="page-wrapper-overlay js-close-side-panels hidden"></div>
        <!--overlay-->

        <!-- main content -->
        <!-- main content -->
        <div class="container-fluid">

        <!--page heading-->
        <div class="row page-titles">

            <!-- Page Title & Bread Crumbs -->
            <!--CRUMBS CONTAINER (LEFT)-->
        <div class="col-md-12 col-lg-5 align-self-center main-pages-crumbs" id="breadcrumbs">
        <h3 class="text-themecolor">Settings</h3>
        <!--crumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">App</li>
                    
            <li class="breadcrumb-item  active active-bread-crumb ">Settings</li>
                    
            <!--filtered results label-->
                </ol>
        <!--crumbs-->
        </div>

        <!--include various checkbox actions-->


            <!--Page Title & Bread Crumbs -->

            <!-- action buttons -->
            <div class="col-md-12 col-lg-7 align-self-center text-right parent-page-actions">
            </div>
            <!-- action buttons -->
        </div>
        <!--page heading-->


        <!-- main content -->
        <div class="card min-h-300">
                <div class="card-body tab-body tab-body-embedded" id="embed-content-container">
                <!--page notification-->
        <div class="row">
        <div class="col-12">
            <div class="page-notification-imaged">
                <img src="https://midnight.growcrm.io/public/images/settings.png" alt="Application Settings">
                <div class="message">
                    <h3>Manage Application Settings</h3>
                </div>
                <div class="sub-message" id="sub-message-large">
                    <h4>Select any item from the left menu</h4>
                </div>
                <div class="sub-message hidden" id="sub-message-small">
                    <h4>To access the settings menu, use the toggle button on the top toolbar <i class="sl-icon-menu text-danger"></i></h4>
                </div>
                <!--[MULTITENANCY]-->
                            <div class="m-t-20">
                    <h4><span class="badge badge-success"> Version 2.6</span>
                        </h4>
                </div>

                <div class="m-t-20">
                    <a href="https://midnight.growcrm.io/app/settings/updates" class="btn btn-rounded-x btn-sm btn-danger waves-effect text-left">Check for updates</a>
                </div>
                        </div>
        </div>
        </div>
            </div>
        </div>
        <!-- /#main content -->

        </div>
        <!--page content -->
    </div>
</DasboardLayout>