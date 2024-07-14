<script>
    import 'filepond/dist/filepond.css';
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
    import FilePond, { registerPlugin } from 'svelte-filepond';
    import { useForm, page } from "@inertiajs/svelte";
	import { ModalClose } from '@/lib/scripts/closeModal';
    // Import the Image EXIF Orientation and Image Preview plugins
    import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation'
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview'

    import { FormFeedback, FormGroup, Input, Modal } from "@sveltestrap/sveltestrap";
    import ModalCloseBtn from "../modals/modalCloseBtn.svelte";
    import { folders } from '@/lib/scripts/userStore';
    import { notify } from '@/lib/scripts/notify';
    import Svelecte from 'svelecte';
    import axios from 'axios';
    import { modal } from '@/lib/scripts/modalToggler';

  // Register the plugins
    registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview);
    export let id;
    let fileCont

    const form = useForm({
        folder: null,
        names: null,
        project_id:$page.props.project_id,
        stage: null,
    })

    const ProcessedFiles = [];
    async function handleProcess(fieldName, file, metadata, load, error, progress, abort, transfer, options) {
        const formData = new FormData();
        formData.append(fieldName, file);

        const response = await axios.post(route("filepond-process"), formData);

        if (response.status === 200) {
            ProcessedFiles.push(response.data);
            load(response.data);
        } else {
            error('Upload failed');
        }
    }

    const submit = ()=>{
        $form.names = ProcessedFiles;
        $form.post(route("file.store"),{
            onSuccess: ()=>{
                notify({title:"Successful",titleText:"Files Have Been Succefully Uploaded",icon:"success",toast:true})
                modal.close();
            },
            onException: (e)=>{
                console.log(e);
            }
        })
    }

</script>
<Modal isOpen backdrop='static' keyboard={false}>
    <form class="" action={route("file.store")} method="post" on:submit|preventDefault={submit}>
        <div class="modal-header" id="commonModalHeader">
            <h4 class="modal-title" id="commonModalTitle">Add File</h4>
            <ModalCloseBtn />
        </div>
        <div class="modal-body" id="commonModalBody"><!--fileupload-->
            <div class="form-group row">
                <div class="col-12">
                    <FilePond bind:this={fileCont} name='names[]' allowMultiple={true} max-file={10} server={{ process: handleProcess, revert: route("filepond-revert") }} />
                    <FormFeedback>{$form.errors.names||""}</FormFeedback>
                </div>
            </div>
            <FormGroup>
                <Svelecte bind:value={$form.stage} required name='stage' placeholder="Select The Stage Of The Project" options={["COMPLETE","BEFORE","DURING"]} />
                <FormFeedback>{$form.errors.stage||""}</FormFeedback>
            </FormGroup>
            
            <FormGroup>
                <label for="browser">Choose your folder or create one by typing it from the list:</label>
                <Svelecte options={$folders} bind:value={$form.folder} name="folder" required creatable keepCreated labelField="name" valueField="name" />
                <FormFeedback>{$form.errors.folder||""}</FormFeedback>
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