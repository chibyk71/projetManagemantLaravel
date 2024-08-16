<script>
  import { page } from "@inertiajs/svelte";
  import { IconHome, IconUser, IconFolder, IconChartAreaLine, IconSettingsAutomation, IconUsers, IconListCheck } from "@tabler/icons-svelte";
</script>
 <!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" id="js-trigger-nav-team">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" id="main-scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" id="main-sidenav">
            <ul id="sidebarnav" data-modular-id="main_menu_team">
                <!--home-->
                <li data-modular-id="main_menu_team_home" class="sidenav-menu-item has-submenu" class:active={$page.url.startsWith('/dashboard')}>
                    <a class="" href="/dashboard" aria-expanded="false" target="_self">
                        <IconHome class="ti-home" />
                        <span class="hide-menu">Dashboard </span>
                    </a>
                </li>
                <!--home-->

                <!--users[done]-->
                <li data-modular-id="main_menu_team_clients" class="sidenav-menu-item has-submenu" class:active={$page.url.startsWith('/contractors')}>
                    <a class="has-arrow " href='/contractors' aria-expanded="false">
                        <IconUser class="sl-icon-people" />
                        <span class="hide-menu">Contractors </span>
                    </a>
                </li>
                <!--customers-->

                <!--projects[done]-->
                <li data-modular-id="main_menu_team_projects" class="sidenav-menu-item has-submenu" class:active={$page.url.startsWith('/projects')}>
                    <a class="has-arrow" href='/projects' aria-expanded="false">
                        <IconFolder class="ti-folder" />
                        <span class="hide-menu">Projects </span>
                    </a>
                </li>
                <!--projects-->
                
                <!--multipl menu-->
                <li data-modular-id="main_menu_team_contracts" class="sidenav-menu-item has-submenu" class:active={$page.url.startsWith('/teams')}>
                    <!--multiple menu-->
                    <a class="has-arrow " href='/teams' aria-expanded="false">
                        <IconUsers class="" />
                        <span class="hide-menu">Teams </span>
                    </a>
                </li>
                <!--contracts-->

                <!--knowledgebase-->
                <li data-modular-id="main_menu_reports" class="sidenav-menu-item has-submenu" class:active={$page.url.startsWith('/reports')}>
                    <a class=" p-r-20" href="{void(0)}" aria-expanded="false" target="_self">
                        <IconChartAreaLine class="sl-icon-chart" />
                        <span class="hide-menu">Reports </span>
                    </a>
                </li>
                <!--knowledgebase-->

                <!--other-->
                <li class="sidenav-menu-item has-submenu" class:active={$page.url.startsWith('/setting')}>
                    <a class="" href={void(0)} aria-expanded="true">
                        <IconSettingsAutomation class="ti-panel" />
                        <span class="hide-menu">Setting </span>
                    </a>
                    <ul aria-expanded="true" class="collapse in" style="">
                        <li>
                            <a href="/setting/general" id="settings-menu-main-general" class="settings-menu-link ">General Settings</a>
                        </li>
                        <!--[MULTITENANCY]-->
                                                <li>
                            <a href="/setting/modules" id="settings-menu-main-modules" class="settings-menu-link ">Modules</a>
                        </li>
                        <li>
                            <a href="/setting/company" id="settings-menu-main-company" class="settings-menu-link ">Company Details</a>
                        </li>
                        <li>
                            <a href="/setting/currency" id="settings-menu-main-currency" class="settings-menu-link ">Currency</a>
                        </li>
                        <li>
                            <a href="/setting/theme" id="settings-menu-main-theme" class="settings-menu-link ">Theme</a>
                        </li>
                        <li>
                            <a href="/setting/logos" id="settings-menu-main-logo" class="settings-menu-link ">Company Logo</a>
                        </li>
                        <li>
                            <a href="/setting/cronjobs" id="settings-menu-main-cronjobs" class="settings-menu-link ">Cron Job Settings</a>
                        </li>
                        <li>
                            <a href="/setting/system/clearcache" id="settings-menu-main-cronjobs" class="settings-menu-link ">Clear Cache</a>
                        </li>
                        <li>
                            <a href="/setting/errorlogs" id="settings-menu-main-errorlogs" class="settings-menu-link ">Error Logs</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <!-- End Sidebar scroll-->
</aside>