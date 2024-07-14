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

                <!--multipl menu-->
                <li data-modular-id="main_menu_team_contracts" class="sidenav-menu-item has-submenu" class:active={$page.url.startsWith('/tasks')}>
                    <!--multiple menu-->
                    <a class="has-arrow " href='/task' aria-expanded="false">
                        <IconListCheck class="" />
                        <span class="hide-menu">Tasks </span>
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
                <li data-modular-id="main_menu_team_team" class="sidenav-menu-item has-submenu" class:active={$page.url.startsWith('/setting')}>
                    <a class="" href={void(0)} aria-expanded="false">
                        <IconSettingsAutomation class="ti-panel" />
                        <span class="hide-menu">Setting </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- End Sidebar scroll-->
</aside>