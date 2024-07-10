<script lang="ts">
    import 'filepond/dist/filepond.css';
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
    import FilePond, { registerPlugin } from 'svelte-filepond';
    import { useForm } from "@inertiajs/svelte";
	import { ModalClose } from '@/lib/scripts/closeModal';
    // Import the Image EXIF Orientation and Image Preview plugins
    import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation'
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview'

    import { FormGroup, Input, Modal } from "@sveltestrap/sveltestrap";
    import ModalCloseBtn from "../modals/modalCloseBtn.svelte";
    import { base, folders } from '@/lib/scripts/userStore';
    import { notify } from '@/lib/scripts/notify';

  // Register the plugins
    registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview);
    export let id;
    let fileCont

    const form = useForm({
        folder: null,
        project_files: null,
        project_id:id
    })

    const submit = ()=>{
        // TODO add $form.project_files here
        $form.post(route("file.store"),{
            onSuccess: ()=>{
                notify({title:"Successful",titleText:"Files Have Been Succefully Uploaded",icon:"success",toast:true})
            }
        })
    }

</script>
<Modal isOpen backdrop='static' keyboard={false}>
    <form class="" action="{base}api/save_uploaded_project_files.php" method="post" on:submit|preventDefault={submit}>
        <div class="modal-header" id="commonModalHeader">
            <h4 class="modal-title" id="commonModalTitle">Add File</h4>
            <ModalCloseBtn />
        </div>
        <div class="modal-body" id="commonModalBody"><!--fileupload-->
            <div class="form-group row">
                <div class="col-12">
                    <FilePond bind:this={fileCont} name='project_files[]' allowMultiple={true} max-file={10} server={{url:base,process:{
                        url:"/api/upload_project_files.php"
                    }}} />
                </div>
            </div>
            
            <FormGroup>
                <label for="browser">Choose your folder or create one by typing it from the list:</label>
                <Input list="folders" value='Default' name="folder" id="browser" required />
                <datalist id="folders">
                    <option value='Default'></option>
                    {#if $folders.length > 0}
                        {#each $folders as item}
                            <option value={item}>
                        {/each}
                    {/if}
                </datalist>
            </FormGroup>
            <input type="hidden" name="project_id" value={id}>
        </div>
        <div class="modal-footer" id="commonModalFooter" style="">
            <button type="button" class="btn btn-rounded-x btn-secondary waves-effect text-left" use:ModalClose>Close</button>
            <button type="submit" disabled={$form.proccessing} class="btn btn-rounded-x btn-danger waves-effect text-left commonModalSubmitButton">Submit
                {#if $form.processing}
                    <div class="spinner-border spinner-border-sm text-primary"></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>