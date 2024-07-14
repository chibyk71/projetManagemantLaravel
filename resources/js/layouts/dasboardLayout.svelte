<script>
    import Layout from "./Layout.svelte";
    import { IconAlarm, IconBell, IconFolder, IconLock, IconLogout2, IconMenu2, IconMenuOrder, IconMessageCircle, IconPlus, IconSettings2, IconUser, IconUsersGroup, IconWallet } from '@tabler/icons-svelte';
    import { Dropdown, DropdownItem, DropdownMenu, DropdownToggle } from '@sveltestrap/sveltestrap';
    import { onMount } from 'svelte';
    import Notifications from '@/lib/components/sidebar/notifications.svelte';
    import { toggler } from '@/lib/scripts/panelToggler';
    import LeftSidebar from '@/lib/components/sidebar/leftSidebar.svelte';
    import { modal } from '@/lib/scripts/modalToggler';
    import UpdateAvatar from '@/lib/components/updateAvatar.svelte';
    import UpdateProfile from '@/lib/components/updateProfile.svelte';
    import ChangePassword from '@/lib/components/changePassword.svelte';
    import { base, userStore } from '@/lib/scripts/userStore';
    import Add from '@/Pages/Dashboard/Contractors/add.svelte';
    import EditProject from '@/lib/components/progectPageModals/editProject.svelte';
    import { page,inertia } from "@inertiajs/svelte";

    function nxAutoHideSideMenu() {
        if (!document.body.classList.contains('mini-sidebar')) {
            document.body.classList.add('mini-sidebar')
        }
    }

    function toggleSideMenu() {
        document.body.classList.toggle('mini-sidebar')
    }

    onMount (() => {
        if (window.innerWidth <= 765) {
            nxAutoHideSideMenu();
        }
        //window has been resized
        window.onresize = function () {
            if (window.innerWidth <= 765) {
                nxAutoHideSideMenu();
            }
        };
    })
    
    export let user = $page.props.user
    $userStore = user
    
</script>
<Layout>
    <div id="main-wrapper">
         <!---------------------------------------------------------------------------------------
            [NEXTLOOP}
                always collapse left menu for small devices
            (NB: this code is in the correct place. It must run before menu is added to DOM)
            --------------------------------------------------------------------------------------->
    
        <!--top nav-->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" id="topnav-logo-container">
                    <!--logo-->
                    <div class="sidenav-menu-item logo m-t-0">
                        <a class="navbar-brand" href="/">
                            <img src="{base}storage/logos/app/logo-small.png" alt="homepage" class="logo-small"/>
                            <img src="{base}storage/logos/app/logo.png" alt="homepage" class="logo-large"/>
                        </a>
                    </div>
                </div>
    
                <div class="navbar-collapse header-overlay" id="main-top-nav-bar">
                    <div class="page-wrapper-overlay js-close-side-panels hidden" data-target=""></div>
    
                    <ul class="navbar-nav mr-auto">
                        <!--left menu toogle (hamburger menu) - main application -->
                        <li class="nav-item main-hamburger-menu">
                            <a class="nav-link nav-toggler hidden-md-up" href={void(0)} on:click={toggleSideMenu}>
                                <IconMenu2 />
                            </a>
                        </li>
                        <li class="nav-item main-hamburger-menu">
                            <a class="nav-link sidebartoggler hidden-sm-down update-user-ux-preferences" href={void(0)} on:click={toggleSideMenu}>
                                <IconMenu2 class="sl-icon-menu" />
                            </a>
                        </li>
                    </ul>
    
                    <!--RIGHT SIDE-->
                    <ul class="navbar-nav navbar-top-right my-lg-0" id="right-topnav-navbar">
                        <!-- Reminders Notification-->
                        <Dropdown nav class='nav-item d-none d-sm-block'>
                            <DropdownToggle nav class="nav-link font-22 waves-dark text-danger p-t-9">
                                <IconAlarm class="ti-alarm-clock display-inline-block text-danger" />
                            </DropdownToggle>
                            <DropdownMenu class='mailbox animate__animated dropdown-menu-right animate__bounceInDown top-nav-events'>
                                <ul>
                                    <li>
                                        <div class="drop-title">
                                            Reminder - Due
                                        </div>
                                    </li>
                                    <li>
                                        <!--events container-->
                                        <div class="message-center topnav-reminders-container"
                                            id="topnav-reminders-container">
                                            <div class="topnav-reminder clearfix" id="topnav_reminder_93">
                                                <div class="x-icon">
                                                     <IconWallet class="ti-wallet" />
                                                </div>
                                                <div class="x-content">
                                                    <div class="x-date-time clearfix">
                                                        <div class="x-time">10:00</div>
                                                        <div class="x-date"><span>12-31-2022</span>
                                                            <span class="js-reminder-mark-read-single" data-container="topnav_reminder_93" data-progress-bar="hidden" data-url="https://midnight.growcrm.io/reminders/93/delete-reminder">
                                                                 <input class="radio-col-info" name="group4" type="radio" id="reminder_checkbox_93">
                                                                <label for="reminder_checkbox_93"></label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="x-title">
                                                        Follow up with the customer
                                                    </div>
                                                    <div class="x-link">
                                                        <a href="https://midnight.growcrm.io/estmates/42">EST-000042</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--events added dynamically here-->
                                        </div>
                                    </li>
                                    <li class="" id="topnav-reminders-container-footer">
                                        <a class="nav-link text-center" href={void(0)} id="topnav-reminders-delete-all" data-url="https://midnight.growcrm.io/reminders/delete-all-my-due-reminders" data-progress-bar="hidden">
                                            <strong>Delete All</strong>
                                            <i class="fa fa-angle-right" />
                                        </a>
                                    </li>
                                </ul>
                            </DropdownMenu>
                        </Dropdown>
                        <!-- Reminders Notification-->
    
                        <!-- event notifications -->
                        <li class="nav-item">
                            <a class="nav-link font-22 p-t-10 p-r-10" on:click={()=> toggler.open('notification')} href={void(0)} aria-expanded={$toggler == 'notification'}>
                                <IconBell class="sl-icon-bell" />
                                <div class="notify" id="topnav-notification-icon">
                                    <span class="heartbit"></span>
                                    <span class="point"></span>
                                </div>
                            </a>
                        </li>
    
                        <!-- messages notification -->
                        <li class="nav-item">
                            <a class="nav-link font-22 p-t-10 p-r-10" href="/messages" aria-expanded="false">
                                <IconMessageCircle class="sl-icon-bubbles" />
                                <div class="notify" id="topnav-messages-notification-icon">
                                    <span class="heartbit"></span>
                                    <span class="point"></span>
                                </div>
                            </a>
                        </li>
    
                        <!-- settings -->
                        <li class="nav-item">
                            <a class="nav-link font-22 p-t-10 p-r-10" href="{void(0)}" id="32" aria-expanded="false">
                                <IconSettings2 class="sl-icon-settings" />
                            </a>
                        </li>
    
                        <!-- add content -->
                        <Dropdown nav class='nav-item'>
                            <DropdownToggle nav class="nav-link waves-effect waves-dark">
                                <IconPlus class="mdi mdi-plus-circle-multiple-outline text-danger font-28"/>                        
                            </DropdownToggle>
                            <DropdownMenu class='mailbox animate__animated dropdown-menu-right animate__bounceInDown top-nav-events'>
                                 <!-- client -->
                                 <DropdownItem on:click={()=>modal.open({comp:Add})} class='dropdown-item-iconed edit-add-modal-button'><IconUsersGroup /> Contractor</DropdownItem>
    
                                <!-- project -->
                                <DropdownItem on:click={()=>modal.open({comp:EditProject})} class='dropdown-item-iconed edit-add-modal-button'><IconFolder /> Project</DropdownItem>
    
                                <!-- task -->
                                <DropdownItem class='dropdown-item-iconed edit-add-modal-button'><IconMenuOrder /> Task</DropdownItem>
                            </DropdownMenu>
                        </Dropdown>
    
                        <!-- profile -->
                        <Dropdown nav class='nav-item u-pro'>
                            <DropdownToggle nav class="nav-link p-l-20 p-r-20 waves-dark profile-pic">
                                <img src="/storage/{user?.avatar|| 'avatar.jpg'}" id="topnav_avatar" alt="user" class=""/>
                                <span class="hidden-md-down" id="topnav_username">{user?.name.split(' ')[0]|| 'Visitor'}</span>                       
                            </DropdownToggle>
                            <DropdownMenu class='animate__flipInY animate__animated dropdown-menu-right'>
                                 <!-- client -->
                                 <!-- TODO use official dropdown item tags for all items and implement modal create -->
                                 <ul class="dropdown-user">
                                    {#if user}
                                        <li>
                                            <div class="dw-user-box d-flex align-items-start">
                                                <div class="u-img">
                                                    <img src="/storage/{user?.avatar}" alt="user"/>
                                                </div>
                                                <div class="u-text flex-fill">
                                                    <h4 class="text-capitalize">{user?.name}</h4>
                                                    <p class="text-muted">{user?.email}</p>
                                                    <a href={void(0)} on:click={()=> modal.open({comp:UpdateAvatar})} class="btn btn-rounded btn-danger btn-sm edit-add-modal-button">Update Avatar</a
                                                    >
                                                </div>
                                            </div>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <!--my profile-->
                                        <li>
                                            <a href={void(0)} on:click={()=> modal.open({comp:UpdateProfile,prop:{data:user}})} class="edit-add-modal-button"> <IconUser class="p-r-4" /> Update My Profile</a>
                                        </li>
                                        <!--update password-->
                                        <li>
                                            <a href={void(0)} on:click={()=>modal.open({comp:ChangePassword,prop:{data:{}}})} class="edit-add-modal-button"> <IconLock size={16} class="p-r-4" />Update Password</a>
                                        </li>
        
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href={route("logout")} use:inertia={{method:"post"}}><IconLogout2 class="p-r-4"/> Logout</a>
                                        </li>
                                    {:else}
                                        <DropdownItem href='/auth/login/'>
                                            <IconLock size={16} /> Login
                                        </DropdownItem>
                                    {/if}
                                </ul>
                            </DropdownMenu>
                        </Dropdown>
                        <!-- /#profile -->
                    </ul>
                </div>
            </nav>
        </header>
    
        <LeftSidebar />
    
        <slot />
    </div>
    
    
    <Notifications />
</Layout>