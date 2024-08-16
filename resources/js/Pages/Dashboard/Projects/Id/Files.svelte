<script lang="ts">
    import Swal from "sweetalert2"
	import { derived, writable } from 'svelte/store';
    import { useForm, page } from "@inertiajs/svelte";
    import { IconChevronDown, IconChevronUp, IconDots, IconDownload, IconFolder, IconTrash, IconCirclePlus, IconEdit } from '@tabler/icons-svelte';
    import { Lightbox } from 'svelte-lightbox';
    import { base, folders } from '@/lib/scripts/userStore';
    import { fDate } from '@/lib/scripts/fdate';
    import NothingFound from '@/lib/components/nothingFound.svelte';
    import { Delete } from '@/lib/scripts/deleteFromDb';
    import { Render, Subscribe, createRender, createTable } from 'svelte-headless-table';
    import { addSortBy, addSelectedRows } from 'svelte-headless-table/plugins';
    import SelectAll from '../selectAll.svelte';
    import SelectIndicator from '../selectIndicator.svelte';
    import ProjectLayout from './ProjectLayout.svelte';
    import type { ProjectFolders } from '@/types';
    import { Tooltip, Dropdown,  DropdownToggle, DropdownMenu, FormGroup, Input } from "@sveltestrap/sveltestrap";
    import { notify } from "@/lib/scripts/notify";
    
    export let data: ProjectFolders;
    $folders = data
    let folderView:"new"|"edit"|undefined = undefined;
    
    // Create a writable store for the active folder
    let activeFolder = writable($folders[0]);

    // Create a derived store for the images in the active folder
    const Images = derived(activeFolder, $activeFolder => $activeFolder.files);


    const table = createTable(Images,{
        sort: addSortBy(),
        select: addSelectedRows()
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
            header:"File Name",
            accessor: "name"
        }),
        table.column({
            id: "user",
            header:"Uploaded By",
            accessor: (item) => item.uploadedBy.name
        }),
        table.column({
            id: "date",
            header:"Date Uploaded",
            accessor: "date_uploaded"
        }),
    ])

    const {
        headerRows,
        rows,
        tableAttrs,
        tableBodyAttrs,
        pluginStates,
    } = table.createViewModel(column);

    const { allRowsSelected, someRowsSelected, selectedDataIds } = pluginStates.select

    const getSelectedIds = () => {
        let ids:number[] = []
        Object.keys($selectedDataIds).forEach(id=>{
           ids.push($rows[Number(id)].original.id)
        })
        return ids
    }

    const form = useForm({
        folders: $folders.map(folder => ({
            id: folder.id,
            name: folder.name
        }))
    });

    const createFolderForm = useForm({
        name: null,
        project_id:$page.props.project_id
    })

    const createForderSubmit = ()=>{
        $createFolderForm.post(route("folder.store"),{
            onSuccess:()=>{
                notify({
                    title:"Succesful",
                    icon:"success",
                    timer:1500,
                    toast:true
                })
            }
        })
    }

    const submit = () => {
        $form.post(route("folder.update"));
    };

    const DeleteFilesForm = useForm({
        ids: null,
    });



    const DeleteMultipeFilesSubmit = ()=>{
        $DeleteFilesForm.id = getSelectedIds();
        $DeleteFilesForm.delete(route("files.delete"),{
            onBefore: (e:Event)=>{
                Swal.fire<boolean|null>({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover these files",
                        icon: "warning",
                    })
                    .then((willDelete) => {
                    if (!willDelete) {
                        e.preventDefault()
                    }
                });
            }
        })
    }

    $:console.log($activeFolder);
    
    
</script>
<ProjectLayout>
    <div class="row m-t-10" id="projects-tab-single-screen">
        <!--dynamic ajax section-->
        <div class="col-lg-12">
            <div class="card min-h-300">
                <div class="tab-content">
                    <div class="tab-pane ext-ajax-container active" id="projects_ajaxtab" role="tabpanel">
                        <div class="card-body tab-body tab-body-embedded" id="embed-content-container">
                            <!--files table-->
                            <div class="">
                                <!--main table view-->
                                <div class="file-folders enabled">
                                    <!--folders-->
                                    <div class="folder-panel">
    
                                        <!-- svelte-ignore a11y-no-static-element-interactions -->
                                        <div class="folder-header d-flex align-items-center justify-content-between">
                                            <h5><IconFolder class="display-inline-block m-r-4" /> Folders</h5>
                                            <!-- svelte-ignore a11y-click-events-have-key-events -->
                                             <Dropdown class="">
                                                <DropdownToggle class="btn-sm bg-transparent">
                                                    <IconDots />
                                                </DropdownToggle>
                                                <DropdownMenu>
                                                    <a class="dropdown-item" on:click={()=> createFolder = !createFolder} href={void(0)} >
                                                        <IconCirclePlus class='d-inline' size={18} /> Add New Folder</a>
                                                    <!--edit_folders-->
                                                    <a class="dropdown-item" href={void(0)} on:click={()=>editFolders = !editFolders}>
                                                        <IconEdit class='d-inline' size={18} /> Edit Folders</a>
                                                </DropdownMenu>
                                             </Dropdown>
                                        </div>
    
                                        <div class="folders-body p-t-15">
                                            {#if folderView === "edit"}
                                                <div class="folders-edit-view p-t-10">
                                                    {#each $form.folders as folder, index (folder.id)}
                                                        {#if folder.name === "default"}
                                                            <div class="form-group row">
                                                                <div class="col-12 each-folder">
                                                                    <input type="text" class="form-control form-control-sm" value="Default" disabled>
                                                                    <a href={void(0)} id="default" class="delete-button text-default">
                                                                        <Tooltip target='default' title="This is the default folder and cannot be deleted" />
                                                                        <IconTrash />
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        {:else}
                                                        <!--item-->
                                                            <div class="form-group row">
                                                                <div class="col-12 each-folder">
                                                                    <input type="text" class="form-control form-control-sm" bind:value={$form.folders[index].name}>
                                                                    <input type="hidden" bind:value={$form.folders[index].id}>
                                                                    <a href={void(0)} on:click={()=>Delete("folder",folder.id)} class="delete-button text-dangerr">
                                                                        <IconTrash />
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        {/if}
                                                    {/each}
                                                
                                                
                                                    <!--form buttons-->
                                                    <div class="text-right">
                                                        <button on:click={()=> folderView= undefined} class="btn btn-default btn-xs text-left">Cancel</button>
                                                        <button on:click={submit} class="btn btn-danger btn-xs text-left">Submit</button>
                                                    </div>
                                                
                                                </div>
                                            {:else if folderView === "new"}
                                                <div class="folders-add-view">
                                                    <!--item-->
                                                    <FormGroup>
                                                        <label for="" class="col-12 text-left control-label col-form-label">Folder Name</label>
                                                        <Input type="text" class="form-control form-control-sm" name="name" bind:value={$createFolderForm.name} feedback={$createFolderForm.errors.name} />
                                                    </FormGroup>
                                                    <!--form buttons-->
                                                    <div class="text-right">
                                                        <button on:click={()=> folderView = undefined} class="btn btn-default btn-xs">Cancel</button>
                                                        <button on:click={createForderSubmit} class="btn btn-danger btn-xs">Submit</button>
                                                    </div>
                                                </div>
                                            {:else}
                                                <div class="folders-list-view">
                                                    <ul>
                                                        {#each $folders as item , index}
                                                            <!-- svelte-ignore a11y-click-events-have-key-events -->
                                                            <!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
                                                            <li id="folder_{index}" on:click={()=>{ $activeFolder = item }} class="file-folder-menu-item" class:active={$activeFolder.id === item.id}>
                                                                <span>{item.name}</span>
                                                            </li>
                                                        {/each}
                                                    </ul>
                                                </div>
                                            {/if}
                                        </div>
    
                                    </div>
                                    <!--table wrapper-->
                                    <!--table-->
                                    <div class="card count-3 files-table-wrapper">
                                        <!-- checkbok action button -->
                                        {#if $someRowsSelected}
                                            <div class="col-12 align-self-center checkbox-actions">
                                                <div class="x-buttons">
                                                    <button type="button" class="btn btn-sm btn-default"><i class="ti-share-alt"></i> Move </button>
        
                                                    <!--delete button-->
                                                    <button on:click={DeleteMultipeFilesSubmit} type="button" class="btn btn-sm btn-default">
                                                        <IconTrash size={12} /> Delete
                                                    </button>
        
                                                </div>
        
                                            </div>
                                        {/if}
    
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table {...$tableAttrs}class="table m-t-0 m-b-0 table-hover no-wrap contact-list">
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
                                                                    </th>
                                                                </tr>
                                                            </Subscribe>
                                                        {/each}
                                                    </thead>
                                                    <tbody {...tableBodyAttrs}>
                                                        {#each $rows as row, index (row.id)}
                                                            <Subscribe rowAttrs={row.attrs()} rowProps={row.props()} let:rowAttrs let:rowProps>
                                                                <tr {...rowAttrs}>
                                                                    {#each row.cells as cell (cell.id)}
                                                                        <Subscribe attrs={cell.attrs()} let:attrs props={cell.props()} let:props>
                                                                        <td {...attrs}>
                                                                            {#if cell.column.id == "name"}
                                                                            <div class="preview-image-thumb">
                                                                                <Lightbox>
                                                                                    <img class="lists-table-thumb" alt="" src="public/storage/{cell.value}">
                                                                                </Lightbox>
                                                                            </div>                                                                        
                                                                                <a target="_blank" href="storage/{cell.value}">
                                                                                    <Render of={cell.render()} />
                                                                                </a>
                                                                            {:else if cell.column.id.includes('date')}
                                                                                {fDate(cell.value)}
                                                                            {:else if cell.column.id == "user"}
                                                                                <img src="public/storage/{row.original.uploadedBy.avatar}" alt="user" class="img-circle avatar-xsmall"> {cell.value}
                                                                            {:else}
                                                                                <Render of={cell.render()} />
                                                                            {/if}
                                                                        </td>
                                                                        </Subscribe>
                                                                    {/each}
                                                                    <td class="files_col_action actions_column">
                                                                        <!--action button-->
                                                                        <span class="list-table-action dropdown font-size-inherit">
                                                                            <!--delete-->
                                                                            <button type="button" on:click={()=> Delete('file',row.original.id)} title="Delete" class="btn btn-outline-danger btn-circle btn-sm confirm-action-danger"> <IconTrash class="sl-icon-trash" /></button>
                                                                            <a href="storage/{row.original.name}" title="Download" class="btn btn-outline-info btn-circle btn-sm" download>
                                                                                <IconDownload class="ti-download" />
                                                                            </a>
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
                            </div>
                            <!--files table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</ProjectLayout>