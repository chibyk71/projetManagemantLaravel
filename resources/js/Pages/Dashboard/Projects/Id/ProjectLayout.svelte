<script lang="ts">
    import { page } from '@inertiajs/svelte'
    import { Container } from "@sveltestrap/sveltestrap";
    import ActionButtons from "./actionButtons.svelte";
    import DasboardLayout from '@/layouts/dasboardLayout.svelte';

    const projectId = $page.props.project_id
    $:currentPath= $page.url as  string;
    const pattern = /^\/project\/(\w+)$/;
    $:isHome = currentPath.match(pattern)
</script>
<DasboardLayout>
    <div class="page-wrapper">
        <Container fluid>
            
                <!--page heading-->
                <div class="row page-titles">
    
                    <!-- Page Title & Bread Crumbs -->
                    <div class="col-md-12 col-lg-6 align-self-center">
                        <h3 class="text-themecolor">{$page.props.project_title}</h3>
                        <!--crumbs-->
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">App</li>
                            <li class="breadcrumb-item ">Project</li>
                            <li class="breadcrumb-item  active ">#{projectId}</li>
                        </ol>
                        <!--crumbs-->
                    </div>
                    <div class="col-md-12  col-lg-6 align-self-center text-right parent-page-actions p-b-9">
                        <ActionButtons />
                    </div>
                    <!-- action buttons -->
                </div>
                <!--page heading-->
    
                 <!--topnav-->
                 <div class="row">
                    <div class="col-lg-12">
                        <!-- Nav tabs -->
                        <ul data-modular-id="project_tabs_menu" class="nav nav-tabs profile-tab project-top-nav list-pages-crumbs" role="tablist">
                            <!--overview-->
                            <li class="nav-item">
                                <a class="nav-link tabs-menu-item" class:active={isHome} href={route("project.show",projectId)} role="tab" id="tabs-menu-overview">Overview</a>
                            </li>
                            <!--details-->
                            <li class="nav-item">
                                <a class="nav-link tabs-menu-item" class:active={currentPath.endsWith('details')} href={route("project.details",projectId)} role="tab">Details</a>
                            </li>
                            <!--[milestones]-->
                            <li class="nav-item">
                                <a class="nav-link tabs-menu-item" class:active={currentPath.endsWith('milestones')} href={route("project.milestones",projectId)} role="tab">Milestones</a>
                            </li>
    
                            <!--[files]-->
                            <li class="nav-item">
                                <a class="nav-link tabs-menu-item" class:active={currentPath.endsWith('files')} href={route("project.files",projectId)} role="tab">Files</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
    
    
                    </div>
                </div> <!--topnav-->
            <slot></slot>
        </Container>
    </div>
</DasboardLayout>