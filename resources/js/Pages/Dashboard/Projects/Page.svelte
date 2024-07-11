<script lang="ts">
	import Avatar from '@/lib/components/avatar.svelte';
    import { IconBookmark, IconChevronDown, IconChevronUp, IconDots, IconFilter, IconNote, IconPlus, IconSearch, IconSettings, IconTableExport, IconTrash, IconUser, IconUsers, IconX } from '@tabler/icons-svelte';
    import { Dropdown, DropdownItem, DropdownMenu, DropdownToggle, Progress, Tooltip } from '@sveltestrap/sveltestrap';
    import NothingFound from '@/lib/components/nothingFound.svelte';
    import { modal } from '@/lib/scripts/modalToggler';
    import EditProject from '@/lib/components/progectPageModals/editProject.svelte';
    import { fDate } from '@/lib/scripts/fdate';
    import AssignedUser from '@/lib/components/progectPageModals/assignedUser.svelte';
    import { Delete } from '@/lib/scripts/deleteFromDb';
    import ChangeStatus from '@/lib/components/progectPageModals/changeStatus.svelte';
    import { parseStatus } from '@/lib/scripts/parceStatus';
    import { readable } from 'svelte/store';
    import { Render, Subscribe, createRender, createTable } from "svelte-headless-table";
    import { addSortBy, addHiddenColumns, addSelectedRows, addDataExport } from 'svelte-headless-table/plugins';
    import SelectIndicator from './selectIndicator.svelte';
    import SelectAll from './selectAll.svelte';
    import DasboardLayout from '@/layouts/dasboardLayout.svelte';
    

    export let data;
    
    const projects = readable<{
    id: string;
    title: string;
    contractorId: string;
    start_date: string;
    due_date: string;
    canceled_date: string | null;
    completed_date: string | null;
    status: string;
    progress: string;
    description: string;
    created_by_id: string;
    contract_sum: string;
    date_of_award: string;
    duration: string | null;
    project_number: string;
    contractor_name: string;
    files: string;
    milestones: string;
    team: string; // Note: This should ideally be an array of objects, but the provided data is a string
}[]>(data.projects.data);
    
    const table = createTable(projects,{
        sort: addSortBy(),
        hidden: addHiddenColumns({
            initialHiddenColumnIds:['completed_date','contract_sum',"canceled_date"]
        }),
        select: addSelectedRows(),
        export: addDataExport({format:'csv'})
    });
    const column = table.createColumns([
        table.display({
            id: 'selected',
            header: ({props},)=>{
                return createRender(SelectAll,{
                    allRowsSelected:allRowsSelected
                })
            },
            cell: ({row}, {pluginStates}) =>{
                const { isSelected } = pluginStates.select.getRowState(row)
                return createRender(SelectIndicator,{
                    isSelected
                })
            }
        }),
        table.column({
            header:"Title",
            accessor: "title"
        }),
        table.column({
            header:"Project Number",
            accessor: "project_number"
        }),
        table.column({
            header:"Date Awarded",
            accessor: "date_of_award"
        }),
        table.column({
            header:"Contractor",
            accessor: "contractor_name"
        }),
        table.column({
            header:"Start Date",
            accessor: "start_date"
        }),
        table.column({
            header:"Due Date",
            accessor: "due_date"
        }),
        table.column({
            header:"Cancelled Date",
            accessor: "canceled_date"
        }),
        table.column({
            header:"Date Completed",
            accessor: "completed_date",
        }),
        table.column({
            header:"Contract Sum",
            accessor: "contract_sum"
        }),
        table.column({
            header:"Progress",
            accessor: "progress"
        }),
        table.column({
            header:"Files",
            accessor: "files"
        }),
        table.column({
            header:"Milestones",
            accessor: "milestones"
        }),
        table.column({
            header:"Status",
            accessor: "status"
        }),
        table.column({
            header:"Team",
            accessor: "team"
        }),
    ])

    const {
        headerRows,
        rows,
        tableAttrs,
        tableBodyAttrs,
        pluginStates,
        flatColumns
    } = table.createViewModel(column);

    const { allRowsSelected, someRowsSelected, selectedDataIds } = pluginStates.select
    const { hiddenColumnIds } = pluginStates.hidden

    const getSelectedIds = (obj: Record<string, boolean>) => {
        let ids:number[] = []
        Object.keys(obj).forEach(id=>{
           ids.push($rows[Number(id)].original.id)
        })
        return ids
    }

    const toggleHiddenColumn = (e: Event & { currentTarget: EventTarget & HTMLInputElement; },str:string) => {
        if (!e.currentTarget.checked) {
            $hiddenColumnIds.push(str)
            $hiddenColumnIds = $hiddenColumnIds
        }

        if (e.currentTarget.checked) {
            $hiddenColumnIds = $hiddenColumnIds.filter(id=> {
                return id !== str
            })
        }
    }

    let showHiddenFilter = false
</script>

<style>
    .list-actions-button :global(svg) {
        display: block;
    }
</style>

<DasboardLayout>
    <!--page wrapper-->
    <div class="page-wrapper" style="min-height: 799px">
    
        <div class="container-fluid">
            <!--page heading-->
            <div class="row page-titles">
                <!-- Page Title & Bread Crumbs -->
                <!--CRUMBS CONTAINER (LEFT)-->
                <div class="col-md-12 col-lg-5 align-self-center list-pages-crumbs" id="breadcrumbs">
                    <h3 class="text-themecolor">Projects</h3>
                    <!--crumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>
    
                        <li class="breadcrumb-item active active-bread-crumb">
                            Projects
                        </li>
    
                        <!--filtered results label-->
                    </ol>
                    <!--crumbs-->
                </div>
    
                <div class="col-md-12 col-lg-7 p-b-9 align-self-center text-right" id="list-page-actions-container">
                    <div id="list-page-actions">
                        <!--SEARCH BOX-->
                        <div class="header-search" id="header-search">
                            <IconSearch class="sl-icon-magnifier" />
                            <input type="text" class="form-control search-records list-actions-search" name="search" placeholder="Search" />
                        </div>
    
                        <!--SHOW OWN PROJECTS-->
                        <button type="button" data-toggle="tooltip" title="My Projects" class="list-actions-button btn btn-page-actions">
                            <IconUser class="sl-icon-user i" size={18} />
                        </button>
    
                        <!--EXPORT-->
                        <button type="button" data-toggle="tooltip" title="Export Projects" class="list-actions-button btn btn-page-actions">
                            <IconTableExport class="ti-export" size={18} />
                        </button>
    
                        <!--FILTERING-->
                        <button type="button" data-toggle="tooltip" title="Filter" class="list-actions-button btn btn-page-actions">
                            <IconFilter class="mdi mdi-filter-outline" />
                        </button>
    
                        <!--ADD NEW ITEM-->
                        <button type="button" class="btn btn-danger btn-add-circle" on:click={()=>modal.open({comp:EditProject,prop:{data:{}}})}>
                            <IconPlus class="ti-plus d-block" />
                        </button>
                    </div>
                </div>
                <!-- action buttons -->
            </div>
            <!--page heading-->
    
            <!--stats panel-->
            <div class="stats-wrapper" id="projects-stats-wrapper">
                <!--WIDGET NOTES: stats displayed on top of result tables and list pages-->
                <div class="card-group table-stats-cards" id="list-pages-stats-widget">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3 id="stats-widget-value-1">{data.all}</h3>
                                    <h6 class="card-subtitle" id="stats-widget-title-1">
                                        All
                                    </h6>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-info h-px-4 w-100"
                                            id="stats-widget-percentage-1" role="progressbar" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3 id="stats-widget-value-1">{data.in_progress}</h3>
                                    <h6 class="card-subtitle" id="stats-widget-title-2">
                                        In Progress
                                    </h6>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary h-px-4 w-100"
                                            id="stats-widget-percentage-2" role="progressbar" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3 id="stats-widget-value-1">{data.on_hold}</h3>
                                    <h6 class="card-subtitle" id="stats-widget-title-3">
                                        On Hold
                                    </h6>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger h-px-4 w-100"
                                            id="stats-widget-percentage-3" role="progressbar" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3 id="stats-widget-value-1">{data.completed}</h3>
                                    <h6 class="card-subtitle" id="stats-widget-title-4">
                                        Completed
                                    </h6>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success h-px-4 w-100"
                                            id="stats-widget-percentage-4" role="progressbar" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--stats panel-->
    
            <!-- page content -->
            <div class="row">
                <div class="col-12">
                    <!--projects table-->
                    <!--checkbox actions-->
                    <div class="col-12 align-self-center checkbox-actions box-shadow-minimum" class:hidden={!$someRowsSelected}>
                        <!--button-->
                        <div class="x-buttons">
                            <button type="button" class="btn btn-sm btn-default" on:click={()=> Delete({body:{action:'project',id:getSelectedIds($selectedDataIds)}})}>
                                <IconTrash size={12} /> Delete
                            </button>
                            <!--change status-->
                            <button type="button" class="btn btn-sm btn-default" on:click={()=> modal.open({comp:ChangeStatus,prop:{id:getSelectedIds($selectedDataIds)}})}>
                                <IconBookmark size={12} /> Change Status
                            </button>
                            <button type="button" class="btn btn-sm btn-default" on:click={()=> modal.open({comp:AssignedUser,prop:{id:getSelectedIds($selectedDataIds)}})}>
                                <IconUsers size={12} /> Assign Users
                            </button>
                        </div>
                    </div>
                    <!--main table view-->
                    <div class="count-9" id="projects-view-wrapper">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive list-table-wrapper">
                                    <table {...$tableAttrs} class="table m-t-0 m-b-0 table-hover no-wrap contact-list table-sort table-arrows">
                                        <thead>
                                           {#each $headerRows as headerRow (headerRow.id)}
                                                <Subscribe rowAttrs={headerRow.attrs()} let:rowAttrs>
                                                    <tr {...rowAttrs}>
                                                        {#each headerRow.cells as cell (cell.id)}
                                                            <Subscribe attrs={cell.attrs()} let:attrs props={cell.props()} let:props>
                                                            <th {...attrs}>
                                                                {#if cell.id == 'team' || cell.id == 'status'}
                                                                    <Render of={cell.render()} />
                                                                {:else}
                                                                    <a on:click={props.sort.toggle} href={void(0)} class="">
                                                                        <Render of={cell.render()} />
                                                                        {#if props.sort.order == 'asc'}
                                                                            <IconChevronDown />
                                                                        {/if}
    
                                                                        {#if props.sort.order == 'desc'}
                                                                            <IconChevronUp />
                                                                        {/if}
                                                                    </a>
                                                                {/if}
                                                            </th>
                                                            </Subscribe>
                                                        {/each}
                                                        <th class="projects_col_action with-table-config-icon">
                                                            Action
                                                            <!--[tableconfig]-->
                                                            <button class="btn btn-sm p-0 bg-transparent table-config-icon" on:click={()=>showHiddenFilter = true}>
                                                                <span class="text-default">
                                                                    <IconSettings />
                                                                </span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </Subscribe>
                                            {/each}
                                        </thead>
                                        <tbody {...$tableBodyAttrs}>
                                            {#each $rows as row, index (row.id)}
                                                <Subscribe rowAttrs={row.attrs()} rowProps={row.props()} let:rowAttrs let:rowProps>
                                                    <tr {...rowAttrs} class="text-uppercase">
                                                        {#each row.cells as cell (cell.id)}
                                                            <Subscribe attrs={cell.attrs()} let:attrs props={cell.props()} let:props>
                                                            <td {...attrs}>
                                                                {#if cell.column.id == 'title'}
                                                                    <a href="projects/{row.original.id}"><Render of={cell.render()} /></a>
                                                                {:else if cell.column.id == "contractor"}
                                                                    {row.original.contractor.name}
    
                                                                {:else if cell.column.id.includes('date')}
                                                                    {fDate(cell.value)}
    
                                                                {:else if cell.column.id == "progress"}
                                                                    <Progress style='height:12px' color='primary' max={100} value={cell.value} />
    
                                                                {:else if cell.column.id.includes('team')}
                                                                    {#each JSON.parse(cell.value) as user}
                                                                        <Avatar title={user?.name} src={user?.avatar||''} />
                                                                    {/each}
    
                                                                {:else if cell.column.id == 'Files'}
                                                                    <Render of={cell.render()} />
    
                                                                {:else if cell.column.id == 'status'}
                                                                    {parseStatus(cell.value)}
                                                                {:else}
                                                                    <Render of={cell.render()} />
                                                                {/if}
                                                            </td>
                                                            </Subscribe>
                                                        {/each}
                                                        <td class="projects_col_action actions_column">
                                                            <!--action button-->
                                                            <span class="list-table-action dropdown font-size-inherit">
                                                                <!--[delete]-->
                                                                <button type="button" title="Delete" on:click={()=> Delete({body:{id:row.original.id,action:'projects'}})} class="btn btn-outline-danger btn-circle btn-sm">
                                                                    <IconTrash />
                                                                </button>
                                                                <!--[edit]-->
                                                                <button type="button" id='edit' on:click={()=>modal.open({comp:EditProject,prop:{id:row.original.id,data:
                                                                {title:row.original.title,contractor:row.original.contractorId,start_date:row.original.start_date,
                                                                due_date:row.original.due_date,desc:row.original.description,progress:row.original.progress,date_of_award:row.original.date_of_award,number:row.original.project_number,contract_sum:row.original.contract_sum},state:'edit'}})} class="btn btn-outline-success btn-circle btn-sm">
                                                                    <IconNote class="sl-icon-note" />
                                                                    <Tooltip target='edit'>Edit</Tooltip>
                                                                </button>
                                                                <button type="button" title="Assigned Users" on:click={()=> modal.open({comp:AssignedUser,prop:{team:JSON.parse(row.original.team),id:row.original.id}})} class="btn btn-outline-warning btn-circle btn-sm">
                                                                    <IconUsers />
                                                                </button>
                                                            </span>
                                                            <!--action button-->
                                                            <!--more button (team)-->
                                                            <Dropdown class='list-table-action font-size-inherit d-inline'>
                                                                <DropdownToggle title='more' class='btn btn-outline-default-light btn-circle btn-sm'>
                                                                    <IconDots class="ti-more" />
                                                                </DropdownToggle>
                                                                <DropdownMenu>
                                                                    <DropdownItem on:click={()=>modal.open({comp:ChangeStatus,prop:{id:row.original.id}})}>Change Status</DropdownItem>
                                                                </DropdownMenu>
                                                            </Dropdown>
                                                        </td>
                                                    </tr>
                                                </Subscribe>
                                            {:else}
                                                <td colspan="20">
                                                    <NothingFound />
                                                </td>
                                            {/each}
                                        <!--each row-->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="20">
                                                    <!-- TODO add more button or pagination -->
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
    
                    <div class="right-sidebar" class:shw-rside={showHiddenFilter}>
                        <form id="table-config-form">
                            <div class="slimscrollright">
                                <div class="rpanel-title">
                                    <IconFilter /> Table Settings
                                    <span on:click={()=>showHiddenFilter = false}>
                                        <IconX />
                                    </span>
                                </div>
                    
                                <!--set ajax url on parent container-->
                                <div class="r-panel-body table-config-ajax">
                    
                                    {#each flatColumns as item, index}
                                        {#if index > 0}
                                            <!--tableconfig_column_2 [project_title]-->
                                            <div class="p-b-5">
                                                <label class="custom-control custom-checkbox table-config-checkbox-container">
                                                    <input type="checkbox" on:change={(e)=>toggleHiddenColumn(e,item.id)} class="custom-control-input table-config-checkbox cursor-pointer" checked={!$hiddenColumnIds.includes(item.id)}>
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">{item.header}</span>
                                                </label>
                                            </div>
                                        {/if}
                                    {/each}
                                    <!--buttons-->
                                    <div class="buttons-block">
                                        <button type="button" class="btn btn-rounded-x btn-secondary" on:click={()=>showHiddenFilter = false}>Close</button>
                                    </div>
                                </div>
                                <!--body-->
                            </div>
                        </form>
                    </div>
    
                     <!--export-->
                    <!-- right-sidebar -->
                    <div class="right-sidebar right-sidebar-export sidebar-lg">
                        <form>
                            <div class="slimscrollright">
                                <!--title-->
                                <div class="rpanel-title">
                                    <IconTableExport class="display-inline-block m-t--11 p-r-10" />Export Projects
                                    <span>
                                        <IconX class="ti-close js-toggle-side-panel" />
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
                                        <!--project_id-->
                                        {#each flatColumns as item}
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group form-group-checkbox row">
                                                    <div class="col-12 p-t-5">
                                                        <input type="checkbox" id="{item.id}" class="filled-in chk-col-light-blue" checked />
                                                        <label class="p-l-30" for="{item.id}">{item.header}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        {/each}
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--sidebar-->
                        <!--projects table-->
                    </div>
                </div>
                <!--page content -->
            </div>
            <!--main content -->
            <!-- /#main content -->
        </div>
        <!--page wrapper-->
    </div>
</DasboardLayout>