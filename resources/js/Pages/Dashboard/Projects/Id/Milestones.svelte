<script>
    import { IconChevronDown, IconChevronUp, IconNote, IconTrash } from '@tabler/icons-svelte';
    import NothingFound from '@/lib/components/nothingFound.svelte';
    import { modal } from '@/lib/scripts/modalToggler';
    import CreateNewMilestone from '@/lib/components/progectPageModals/createNewMilestone.svelte';
    import { Delete } from '@/lib/scripts/deleteFromDb';
    import { parseStatus } from '@/lib/scripts/parceStatus';
    import { Progress } from '@sveltestrap/sveltestrap';
  import { readable } from 'svelte/store';      
    import { Render, Subscribe, createTable } from 'svelte-headless-table';
    import { addSortBy } from 'svelte-headless-table/plugins';
    import ProjectLayout from './ProjectLayout.svelte';
      
    export let datas;
    console.log(datas);
    const milestones = readable(datas.milestones);
    const table = createTable(milestones,{
        sort: addSortBy(),
    });

    const column = table.createColumns([
        table.column({
            header:"Name",
            accessor: "name"
        }),
        table.column({
            header:"Contractor",
            accessor: (item)=>item.contractor.name
        }),
        table.column({
            header:"Status",
            accessor: "status"
        }),
        table.column({
            header:"Progress",
            accessor: "progress"
        }),
    ])

    const {
        headerRows,
        rows,
        tableAttrs,
        tableBodyAttrs,
    } = table.createViewModel(column);
</script>
<ProjectLayout data>
    <div class="row m-t-10" id="projects-tab-single-screen">
        <!--dynamic ajax section-->
        <div class="col-lg-12">
            <div class="card min-h-300">
                <div class="tab-content">
                    <div class="tab-pane ext-ajax-container active" id="projects_ajaxtab" role="tabpanel">
                        <div class="card-body tab-body tab-body-embedded" id="embed-content-container">
                            <!--milestones table-->
                            <div class="card-embed-fix">
                                <!--main table view-->
                                <div class="card count-5" id="milestones-table-wrapper">
                                    <div class="card-body">
                                        <div class="table-responsive">
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
                                                                <th class="projects_col_action">
                                                                    Action
                                                                </th>
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
                                                                        {#if cell.column.id == "progress"}
                                                                            <Progress style='height:12px' color='primary' max={100} value={cell.value} />
                                                                        {:else if cell.column.id == 'status'}
                                                                            {parseStatus(cell.value)}
                                                                        {:else}
                                                                            <Render of={cell.render()} />
                                                                        {/if}
                                                                    </td>
                                                                    </Subscribe>
                                                                {/each}
                                                                
                                                                <td class="milestones_col_action actions_column">
                                                                    <!--action button-->
                                                                    <span class="list-table-action dropdown font-size-inherit">
                                                                        <!---delete milestone with confirm checkbox-->
                                                                        <span id="milestone_form_409">
                                                                            <button type="button" title="Delete" class="btn btn-outline-danger btn-circle btn-sm confirm-action-danger" on:click={()=>Delete('milestone',row.original.id)}>
                                                                                <IconTrash class="sl-icon-trash" />
                                                                            </button>
                                                                        </span>
                                                                        <!---/#delete milestone with confirm checkbox-->
                                                                        <button type="button" on:click={()=> modal.open({comp:CreateNewMilestone,prop:{state:'edit',data:{
                                                                            name: row.original.name, 
                                                                            status: row.original.status,
                                                                            progress: row.original.progress,
                                                                            contractor: row.original.contractor_id
                                                                        },id:row.original.id}})} title="Edit" class="btn btn-outline-success btn-circle btn-sm">
                                                                            <IconNote class="sl-icon-note" />
                                                                        </button>
                                                                    </span>
                                                                    <!--action button-->
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
                                </div>
                            </div>
                            <!--milestones table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</ProjectLayout>