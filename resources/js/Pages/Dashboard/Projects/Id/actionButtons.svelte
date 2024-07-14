<script>
    import { page } from "@inertiajs/svelte";
    import AssignedUser from "@/lib/components/progectPageModals/assignedUser.svelte";
    import ChangeStatus from "@/lib/components/progectPageModals/changeStatus.svelte";
    import CreateNewFile from "@/lib/components/progectPageModals/createNewFile.svelte";
    import CreateNewMilestone from "@/lib/components/progectPageModals/createNewMilestone.svelte";
    import EditProject from "@/lib/components/progectPageModals/editProject.svelte";
    import { Trash } from "@/lib/scripts/deleteAlert";
    import { modal } from "@/lib/scripts/modalToggler";
    import { DropdownToggle, Dropdown, DropdownItem, DropdownMenu, Tooltip } from "@sveltestrap/sveltestrap";
    import { IconArchive, IconCheckbox, IconFilter, IconNote, IconPlus, IconSearch, IconTrash, IconUser, IconUsers } from "@tabler/icons-svelte";
    
    $:currentPath = $page.url;
    const pattern = /^\/project\/(\w+)$/;
    $:isHome = currentPath.match(pattern)

    
    $:createNew = (currentPath.endsWith('milestones')) ? CreateNewMilestone : (currentPath.endsWith('files')) ? CreateNewFile: undefined 
</script>

{#if true}
    <div id="list-page-actions">
    
        <!--SEARCH BOX-->
        {#if currentPath.endsWith('tasks') || currentPath.endsWith('files')}
            <div class="header-search" id="header-search">
                <IconSearch class="sl-icon-magnifier" />
                <input type="text" class="form-control search-records list-actions-search" name="search_query" placeholder="Search">
            </div>
        {/if}
    
        {#if isHome || (currentPath.endsWith('details'))}
            <button on:click={()=>modal.open({comp:AssignedUser})} type="button" id="assign" class="data-toggle-action-tooltip list-actions-button btn btn-page-actions">
                <IconUsers class="sl-icon-people" />
                <Tooltip target='assign'>Assigned Users</Tooltip>
            </button>
        {/if}
        {#if isHome || (currentPath.endsWith('details'))}
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

        <!--delete-->
        {#if isHome || (currentPath.endsWith('details'))}
            <button type="button" on:click={Trash} id='trash' class="list-actions-button btn btn-page-actions">
                <IconTrash class="sl-icon-trash" />
                <Tooltip target='trash'>Delete Project</Tooltip>
            </button>
        {/if}
    
        <!--ADD NEW ITEM-->
        {#if currentPath.endsWith('milestones') || currentPath.endsWith('files')}
            <button type="button" on:click={()=> modal.open({comp:createNew})} class="btn btn-danger btn-add-circle edit-add-modal-button">
                <IconPlus class="ti-plus d-block" />
            </button>
        {/if}
    </div>
{/if}