<script>
    import { base } from '@/lib/scripts/userStore';
    import Editor from '@tinymce/tinymce-svelte';
    import { OptionTinyMce } from '@/lib/scripts/tinymceProps';
    import { page, useForm } from '@inertiajs/svelte';
    import { notify } from '@/lib/scripts/notify';
    import ProjectLayout from './ProjectLayout.svelte';
    
    export let details;

    let editing = false,
        ProjectId = $page.props.project_id;
    export let isPermited = false

    const form = useForm({
        description: details,
    })

    async function handleSubmit() {
        $form.post(route("project.update",ProjectId),{
            onSuccess: ()=>{
                notify({title:"successful"})
                editing = false
            },
            onError: ()=>{
                notify({title:"Form Not Submited",icon:"error"})
            }
        })
    }
</script>
<ProjectLayout>
    <div class="row m-t-10" id="projects-tab-single-screen">
        <!--dynamic ajax section-->
        <div class="col-lg-12">
            <div class="card min-h-300">
                <div class="tab-content">
                    <div class="tab-pane ext-ajax-container active" id="projects_ajaxtab" role="tabpanel">
                        <div class="card-body tab-body tab-body-embedded" id="embed-content-container">
                            <div class="row project-details" id="project-details-container">
                                <div class="col-sm-12 tinymce-transparent">
                                    {#if !editing}
                                        {@html details}
                                    {:else}
                                        <form id="editor" on:submit|preventDefault={handleSubmit} action="{route("profile.update",ProjectId)}" method="post">
                                            <Editor conf={OptionTinyMce} bind:value={details} scriptSrc='public/storage/tinymce/tinymce.min.js' />
                                            <!--dynamic description field-->
                                            <input type="hidden" name="id" value={ProjectId}>
                                        </form>
                                    {/if}
    
                                    <hr>
    
                                    <!--buttons: edit-->
                                    {#if isPermited && !editing}
                                        <div id="project-description-edit" class="p-t-20 text-right">
                                            <button type="button" on:click={()=>editing=true} class="btn btn-xs btn-info">Edit Description</button>
                                        </div>
                                    {/if}
    
                                    <!--button: subit & cancel-->
                                    {#if isPermited && editing}
                                        <div class="p-t-20 text-right">
                                            <button on:click={()=>editing = false} type="button" class="btn btn-xs btn-default">Cancel</button>
                                            <button form="editor" type="submit" class="btn btn-xs btn-danger">Save</button>
                                        </div>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</ProjectLayout>