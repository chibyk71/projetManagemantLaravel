<script>
	import NothingFound from '@/lib/components/nothingFound.svelte';
    import { IconChevronDown, IconChevronUp, IconEdit, IconMail, IconPlus, IconSettings, IconTrash } from '@tabler/icons-svelte';
    import { modal } from '@/lib/scripts/modalToggler';
    import { base } from '@/lib/scripts/userStore';
    import { Delete } from '@/lib/scripts/deleteFromDb';
    import { readable } from 'svelte/store';
    import { Render, Subscribe, createTable } from 'svelte-headless-table';
    import { addSortBy } from 'svelte-headless-table/plugins';
    import CreateUser from '@/lib/components/createUser.svelte';
    import DasboardLayout from '@/layouts/dasboardLayout.svelte';
    import { inertia } from "@inertiajs/svelte";
    
    export let teams;

    const users = readable(teams.data)

    const table = createTable(users,{
        sort: addSortBy(),
    });

    
    const column = table.createColumns([
        table.column({
            header:"Name",
            accessor: "name"
        }),
        table.column({
            header:"Email",
            accessor: "email"
        }),
        table.column({
            header:"Phone",
            accessor: "phone"
        }),
        table.column({
            header:"Role",
            accessor: "role"
        }),
    ])
    
    const {
        headerRows,
        rows,
        tableAttrs,
        tableBodyAttrs,
    } = table.createViewModel(column);
</script>
<DasboardLayout>
    <div class="page-wrapper">
        <div class="container-fluid">
    
            <!--page heading-->
            
            <div class="row page-titles">
        
                <!-- Page Title & Bread Crumbs -->
                <!--CRUMBS CONTAINER (LEFT)-->
                <div class="col-md-12 col-lg-5 align-self-center list-pages-crumbs" id="breadcrumbs">
                    <h3 class="text-themecolor">Team Members</h3>
                    <!--crumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>
        
                        <li class="breadcrumb-item  active active-bread-crumb ">Team Members</li>
        
                        <!--filtered results label-->
                    </ol>
                    <!--crumbs-->
                </div>
    
                <!-- action buttons -->
                <div class="col-md-12  col-lg-7 p-b-9 align-self-center text-right">
                    <div id="list-page-actions">
        
                        <!--ADD NEW ITEM-->
                        <button on:click={()=>modal.open({comp:CreateUser})} type="button" class="btn btn-danger btn-add-circle edit-add-modal-button">
                            <IconPlus class="d-block ti-plus" />
                        </button>
                    </div>
                </div> <!-- action buttons -->
        
            </div>
            <!--page heading-->
        
            <!-- page content -->
            <div class="row">
                <div class="col-12">
                    <!--team table-->
                    <!--main table view-->
                    <div class="card" id="team-table-wrapper">
                        <div class="card-body">
                            <div class="table-responsive list-table-wrapper">
                                <table {...$tableAttrs} class="table m-t-0 m-b-0 table-hover no-wrap contact-list">
                                    <thead>
                                        {#each $headerRows as headerRow (headerRow.id)}
                                             <Subscribe rowAttrs={headerRow.attrs()} let:rowAttrs>
                                                 <tr {...rowAttrs}>
                                                     {#each headerRow.cells as cell (cell.id)}
                                                         <Subscribe attrs={cell.attrs()} let:attrs props={cell.props()} let:props>
                                                         <th {...attrs}>
                                                            <a on:click={props.sort.toggle} href={void(0)} class="">
                                                                <Render of={cell.render()} />
                                                                {#if props.sort.order == 'asc'}
                                                                    <IconChevronDown />
                                                                {/if}
    
                                                                {#if props.sort.order == 'desc'}
                                                                    <IconChevronUp />
                                                                {/if}
                                                            </a>
                                                         </th>
                                                         </Subscribe>
                                                     {/each}
                                                    <th class="team_col_action">Action</th>
                                                 </tr>
                                             </Subscribe>
                                         {/each}
                                    </thead>
                                    <tbody {...$tableBodyAttrs}>
                                        {#each $rows as row, index (row.id)}
                                                <Subscribe rowAttrs={row.attrs()} rowProps={row.props()} let:rowAttrs let:rowProps>
                                                    <tr {...rowAttrs}>
                                                        {#each row.cells as cell (cell.id)}
                                                            <Subscribe attrs={cell.attrs()} let:attrs props={cell.props()} let:props>
                                                            <td {...attrs}>
                                                                {#if cell.column.id == 'name'}
                                                                    <img src="storage/{row.original.avatar}" alt="{cell.value}" class="img-circle avatar-xsmall">
                                                                    <Render of={cell.render()} />
                                                                {:else}
                                                                    <Render of={cell.render()} />
                                                                {/if}
                                                            </td>
                                                            </Subscribe>
                                                        {/each}
                                                        
                                                        <td class="team_col_action">
                                                            <!--action buttons-->
                                                            <span class="list-table-action dropdown font-size-inherit">
                                                                <!--delete-->
                                                                <button type="button" on:click={()=>Delete('team',row.original.id)} title="Delete" class="btn btn-outline-danger btn-circle btn-sm">
                                                                    <IconTrash class="sl-icon-trash" />
                                                                </button>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </Subscribe>
                                            {:else}
                                                <td colspan="20">
                                                    <NothingFound />
                                                </td>
                                            {/each}
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
                    </div> <!--team table-->
                </div>
            </div>
            <!--page content -->
        </div>
    </div>
</DasboardLayout>