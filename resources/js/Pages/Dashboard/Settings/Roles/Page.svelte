<script>
    import DasboardLayout from "@/layouts/dasboardLayout.svelte";
    import AddRole from "@/lib/components/addRole.svelte";
    import { Delete } from "@/lib/scripts/deleteFromDb";
    import { modal } from "@/lib/scripts/modalToggler";
    import { IconEdit, IconPlus, IconTrash } from "@tabler/icons-svelte";

    export let roles;
    
</script>

<DasboardLayout>
    <div class="page-wrapper" id="settings-wrapper" style="min-height: 799px;">
        <!-- main content -->
        <div class="container-fluid">
            <!--page heading-->
            <div class="row page-titles">
                <!-- Page Title & Bread Crumbs -->
                <!--CRUMBS CONTAINER (LEFT)-->
                <div
                    class="col-md-12 col-lg-5 align-self-center main-pages-crumbs"
                    id="breadcrumbs"
                >
                    <h3 class="text-themecolor">Settings</h3>
                    <!--crumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>

                        <li class="breadcrumb-item">Settings</li>

                        <li class="breadcrumb-item active active-bread-crumb">
                            User Roles
                        </li>

                        <!--filtered results label-->
                    </ol>
                    <!--crumbs-->
                </div>
                <div class="col-md-12 col-lg-7 align-self-center text-right parent-page-actions">
                    <div id="list-page-actions">
                        <!--ADD NEW ITEM-->
                        <button type="button" on:click={()=>modal.open({comp:AddRole})} class="btn btn-danger btn-add-circle">
                            <IconPlus class="d-inline-block" />
                        </button>

                        <!--add new button (link)-->
                    </div>
                </div>
                <!-- action buttons -->
            </div>
            <!--page heading-->

            <!-- main content -->
            <!--custom fields - tab menu-->

            <!--other tab menus-->
            <div class="card min-h-300">
                <div class="card-body tab-body tab-body-embedded" id="embed-content-container">
                    <!-- action buttons -->
                    <!--heading-->
                    <div class="table-responsive">
                        <table id="demo-foo-addrow" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
                            <thead>
                                <tr>
                                    <th class="roles_col_name">Name</th>
                                    <th class="roles_col_users">Active Users</th>
                                    <th class="roles_col_type">Type</th>
                                    <th class="roles_col_status">Status</th>
                                    <th class="roles_col_action"><a href={void(0)}>Action</a></th>
                                </tr>
                            </thead>
                            <tbody id="roles-td-container">
                                <!--ajax content here-->
                                <!--each row-->
                                {#each roles as {name,id,users}}
                                    <tr id="role_9">
                                        <td class="roles_col_name text-capitalize">
                                            {name}
                                            <!--default-->
                                        </td>
                                        <td class="roles_col_users"> {users} </td>
                                        <td class="roles_col_type"> team </td>
                                        <td class="roles_col_status"> --- </td>
                                        <td class="roles_col_action actions_column">
                                            <!--action button-->
                                            <span class="list-table-action dropdown font-size-inherit">
                                                <!--edit-->
                                                <button type="button" on:click={()=>modal.open({comp:AddRole,prop:{name,id,state:"edit"}})} title="Edit" class="btn btn-outline-success btn-circle btn-sm">
                                                    <IconEdit />
                                                </button>
    
                                                <button type="button" on:click={()=>Delete("role", id)} title="Delete" class="btn btn-outline-danger btn-circle btn-sm">
                                                    <IconTrash />
                                                </button>
                                            </span>
                                            <!--action button-->
                                        </td>
                                    </tr>
                                {/each}                            
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- /#main content -->
        </div>
        <!--page content -->

        <!--main content -->
    </div>
</DasboardLayout>
