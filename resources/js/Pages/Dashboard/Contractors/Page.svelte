<script>
	import NothingFound from '@/lib/components/nothingFound.svelte';
	import Export from './export.svelte';
	import FilterContractors from './filterContractors.svelte';
	import { Tooltip } from '@sveltestrap/sveltestrap';
    import { IconEdit, IconFilter, IconMail, IconPlus, IconSearch, IconTableExport, IconTrash } from "@tabler/icons-svelte";
    import { toggler } from '@/lib/scripts/panelToggler';
    import Add from './add.svelte';
    import { modal } from '@/lib/scripts/modalToggler';
    import { Delete } from '@/lib/scripts/deleteFromDb';
    import DasboardLayout from '@/layouts/dasboardLayout.svelte';
    export let contractors;

</script>

<DasboardLayout>
    <div class="page-wrapper" style="min-height: 799px;">
        <div class="container-fluid">
    
            <!--page heading-->
            <div class="row page-titles">
        
                <!-- Page Title & Bread Crumbs -->
                <!--CRUMBS CONTAINER (LEFT)-->
                <div class="col-md-12 col-lg-5 align-self-center list-pages-crumbs" id="breadcrumbs">
                    <h3 class="text-themecolor">Contractors</h3>
                    <!--crumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>
        
                        <li class="breadcrumb-item  active active-bread-crumb ">Contractors</li>
        
                    </ol>
                </div>
        
                <div class="col-md-12  col-lg-7 p-b-9 align-self-center text-right  " id="list-page-actions-container">
                    <div id="list-page-actions">
                        <!--SEARCH BOX-->
                        <div class="header-search" id="header-search">
                            <IconSearch class="sl-icon-magnifier" />
                            <input type="text" class="form-control search-records list-actions-search" id="search_query" name="search_query" placeholder="Search">
                        </div> 
        
                        <!--EXPORT-->
                        <button type="button" on:click={()=>toggler.open('export-contractors')} class="list-actions-button btn btn-page-actions" id="sidepanel-export-clients">
                            <Tooltip target='sidepanel-export-clients'>Export Contractors</Tooltip>
                            <IconTableExport class="ti-export d-block" />
                        </button>
        
        
                        <!--FILTERING-->
                        <button type="button" on:click={()=>toggler.open('filter-contractor')} class="list-actions-button btn btn-page-actions"
                            id="sidepanel-filter-clients">
                            <IconFilter class="d-block mdi mdi-filter-outline" />
                            <Tooltip target='sidepanel-filter-clients'>Filter</Tooltip>
                        </button>
        
                        <!--ADD NEW ITEM-->
                        <button type="button" class="btn btn-danger btn-add-circle edit-add-modal-button" on:click={()=> modal.open({comp:Add,prop:{data:{}}})}>
                            <IconPlus class="d-block ti-plus" />
                        </button>
        
                        <!--add new button (link)-->
                    </div>
                </div> <!-- action buttons -->
        
            </div>
            <!--page heading-->
        
            <!-- page content -->
            <div class="row">
                <div class="col-12">
                    <!--clients table-->
                    <!--main table view-->
                    <div class="card count-12" id="clients-table-wrapper">
                        <div class="card-body">
                            <div class="table-responsive list-table-wrapper">
                                <table id="clients-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                                    data-page-size="10">
                                    <thead>
                                        <tr>
                                            <!--tableconfig_column_1 [client_id]-->
                                            <th class="col_client_id displayed tableconfig_column_1">
                                                <a class="js-list-sorting" href={void(0)}>ID</a>
                                            </th>
        
                                            <!--tableconfig_column_2 [client_company_name]-->
                                            <th class="col_client_company_name displayed tableconfig_column_2">
                                                <a class="js-list-sorting" href={void(0)}>Company Name</a>
                                            </th>
    
                                             <!--tableconfig_column_2 [client_company_name]-->
                                             <th class="col_client_company_name displayed tableconfig_column_2">
                                                <a class="js-list-sorting" href={void(0)}>Company Email</a>
                                            </th>
    
                                             <!--tableconfig_column_4 [count_pending_projects]-->
                                             <th class="col_count_pending_projects displayed tableconfig_column_4">
                                                <a class="js-list-sorting" href={void(0)}>Website</a>
                                            </th>
        
                                            <!--tableconfig_column_5 [count_completed_projects]-->
                                            <th class="col_count_completed_projects tableconfig_column_5">
                                                <a class="js-list-sorting" href={void(0)}>Projects</a>
                                            </th>
        
                                            <!--actions-->
                                            <th class="col_action with-table-config-icon"><a href={void(0)}>Action</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="clients-td-container">
                                       
                                        {#each contractors.data as {id,name,email,url,projects} (id)}
                                            <tr id="client_22">
            
                                                <!--tableconfig_column_1 [client_id]-->
                                                <td class="clients_col_id displayed tableconfig_column_1">
                                                    {id}
                                                </td>
                                                <td class="clients_col_company displayed tableconfig_column_2"
                                                    id="clients_col_id_22">
                                                    <a href="/clients/22">{name}</a>
                                                </td>
                                                <td class="col_count_pending_projects displayed tableconfig_column_4">
                                                    {email}
                                                </td>
                                                <td class="col_count_completed_projects diplayed tableconfig_column_5">
                                                    {url}
                                                </td>
            
            
                                                <!--tableconfig_column_6 [count_pending_tasks]-->
                                                <td class="col_count_pending_tasks displayed tableconfig_column_6">
                                                    {projects}
                                                </td>
                                                <td class="clients_col_action actions_column" id="clients_col_action_22">
                                                    <!--action button-->
                                                    <span class="list-table-action dropdown font-size-inherit">
                                                        <!--delete-->
                                                        <button type="button" on:click={()=>Delete('contractor',id)} id="delete" class="btn btn-outline-danger btn-circle btn-sm confirm-action-danger">
                                                            <IconTrash class="sl-icon-trash" />
                                                            <Tooltip target='delete'>Delete Contractor</Tooltip>
                                                        </button>
                                                        <!--edit-->
                                                        <button type="button" class="btn btn-outline-success btn-circle btn-sm" on:click={()=>modal.open({comp:Add,prop:{data:{name,email,url},id}})}> 
                                                            <IconEdit class="sl-icon-note" /> 
                                                            <Tooltip target='edit'>Edit</Tooltip>
                                                        </button>
            
                                                        <!--send email-->
                                                        <a href="mailto:{email}" type="button" class="btn btn-outline-warning btn-circle btn-sm edit-add-modal-button">
                                                            <IconMail class="ti-email display-inline-block m-t-3" />
                                                            <Tooltip target='mail'>Send Mail</Tooltip>
                                                        </a>
                                                    </span>
                                                </td>
            
                                            </tr>
                                        {:else}
                                            <tr>
                                                <td colspan="20">
                                                    <NothingFound />
                                                </td>
                                            </tr>
                                        {/each}
                                        <!--each row--> <!--ajax content here-->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="20">
                                                <!--load more button-->
                                                <!-- dynamic load more button-->
                                                <!-- /#dynamic load more button--> <!--load more button-->
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--filter-->
                    <FilterContractors />
                </div>
        
            </div>
            <!--sidebar-->
            <!--export-->
            <Export />
            
        </div>
    </div>
</DasboardLayout>
