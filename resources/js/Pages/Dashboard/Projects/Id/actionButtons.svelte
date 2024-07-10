<script>
    import { page } from "@inertiajs/svelte";
    import AssignedUser from "@/lib/components/progectPageModals/assignedUser.svelte";
    import ChangeStatus from "@/lib/components/progectPageModals/changeStatus.svelte";
    import CreateNewFile from "@/lib/components/progectPageModals/createNewFile.svelte";
    import CreateNewMilestone from "@/lib/components/progectPageModals/createNewMilestone.svelte";
    import CreateNewTask from "@/lib/components/progectPageModals/createNewTask.svelte";
    import EditProject from "@/lib/components/progectPageModals/editProject.svelte";
    import { Trash } from "@/lib/scripts/deleteAlert";
    import { modal } from "@/lib/scripts/modalToggler";
    import { DropdownToggle, Dropdown, DropdownItem, DropdownMenu, Tooltip } from "@sveltestrap/sveltestrap";
    import { IconArchive, IconCheckbox, IconFilter, IconNote, IconPlus, IconSearch, IconTrash, IconUser, IconUsers } from "@tabler/icons-svelte";
    
    $:currentPath = $page.url;
    $:isHome = currentPath === "projects"

    
    $:createNew = currentPath == 'tasks'? CreateNewTask : (currentPath == 'milestones') ? CreateNewMilestone : (currentPath == 'files') ? CreateNewFile: undefined 
</script>

{#if true}
    <div id="list-page-actions">
    
        <!--SEARCH BOX-->
        {#if currentPath == 'tasks' || currentPath == 'files'}
            <div class="header-search" id="header-search">
                <IconSearch class="sl-icon-magnifier" />
                <input type="text" class="form-control search-records list-actions-search" name="search_query" placeholder="Search">
            </div>
        {/if}
    
        {#if isHome || (currentPath == 'details')}
            <button on:click={()=>modal.open({comp:AssignedUser})} type="button" id="assign" class="data-toggle-action-tooltip list-actions-button btn btn-page-actions">
                <IconUsers class="sl-icon-people" />
                <Tooltip target='assign'>Assigned Users</Tooltip>
            </button>
        {/if}
        {#if isHome || (currentPath == 'details')}
            <!--edit project-->
            <Dropdown class='d-inline-block'>
                <DropdownToggle class='data-toggle-tooltip list-actions-button btn btn-page-actions'>
                    <IconNote class="" />
                </DropdownToggle>
                <DropdownMenu>
                    <!-- TODO what this dropdown buttons do -->
                    <DropdownItem on:click={()=>modal.open({comp:EditProject})}>
                        Edit Project
                    </DropdownItem>
                    <!--change status-->
                    <DropdownItem  on:click={()=>modal.open({comp:ChangeStatus})}>
                        Change Status
                    </DropdownItem>
                    <!--archive-->
                    <DropdownItem>
                        Archive
                    </DropdownItem>
                </DropdownMenu>
            </Dropdown>
        {/if}
    
        <!--clone-->
        <!-- <button type="button" class="data-toggle-tooltip list-actions-button btn btn-page-actions
        actions-modal-button js-ajax-ux-request edit-add-modal-button"
            title="Clone Project" data-toggle="modal" data-target="#commonModal"
            data-modal-title="Clone Project"
            data-url="/projects/{projectId}/clone"
            data-action-url="/projects/{projectId}/clone"
            data-loading-target="actionsModalBody" data-action-method="POST">
            <i class=" mdi mdi-content-copy" />
        </button> -->
    
        <!--delete-->
        {#if isHome || (currentPath == 'details')}
            <button type="button" on:click={Trash} id='trash' class="list-actions-button btn btn-page-actions">
                <IconTrash class="sl-icon-trash" />
                <Tooltip target='trash'>Delete Project</Tooltip>
            </button>
        {/if}
    
        {#if  currentPath == 'tasks'}
            <!--ARCHIVED TASKS-->
            <button type="button" class="list-actions-button btn btn-page-actions" id='achive'>
                <IconArchive class="ti-archive" />
                <Tooltip target='achive'>(Show/Hide) Archived Tasks</Tooltip>
            </button>
        {/if}
    
        <!--SHOW OWN TASKS-->
       {#if  currentPath == 'tasks'}
         <button type="button" title="My Tasks" id="pref_filter_own_tasks" class="list-actions-button btn btn-page-actions">
             <IconUser class="sl-icon-user" />
             <Tooltip target='pref_filter_own_tasks'>(Show/Hide) My Tasks</Tooltip>
         </button>
       {/if}
    
        <!--HIDE COMPLETED TASKS-->
        {#if currentPath == 'tasks'}
            <button type="button" id="pref_hide_completed_tasks" class="list-actions-button btn btn-page-actions">
                <IconCheckbox class="ti-check-box" />
                <Tooltip target='pref_hide_completed_tasks'>(Show/Hide) Completed Tasks</Tooltip>
            </button>
        {/if}
    
        <!--FILTERING-->
        {#if currentPath == 'tasks'}
            <button type="button" title="Filter"  class="list-actions-button btn btn-page-actions">
                <IconFilter class="mdi mdi-filter-outline" />
            </button>
        {/if}
    
        <!--ADD NEW ITEM-->
        {#if currentPath == 'tasks' || currentPath == 'milestones' || currentPath == 'files'}
            <button type="button" on:click={()=> modal.open({comp:createNew})} class="btn btn-danger btn-add-circle edit-add-modal-button">
                <IconPlus class="ti-plus d-block" />
            </button>
        {/if}
    </div>
{/if}