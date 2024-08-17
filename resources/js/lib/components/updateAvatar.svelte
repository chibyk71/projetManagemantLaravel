<script>
    import { ModalClose } from "@/lib/scripts/closeModal";
    import { modal } from "@/lib/scripts/modalToggler";
    import { Modal } from "@sveltestrap/sveltestrap";
    import { IconX } from "@tabler/icons-svelte"
    import { notify } from "@/lib/scripts/notify";
    
    import 'filepond/dist/filepond.css';
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
    import FilePond, { registerPlugin } from 'svelte-filepond';

    // Import the Image EXIF Orientation and Image Preview plugins
    import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation'
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
    import axios from "axios";
    import { useForm } from "@inertiajs/svelte";
    import { asset } from "../scripts/userStore";

    // Register the plugins
    registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview);

     let fileCont

     const form = useForm({
        avatar: null
     })

    async function handleProcess(fieldName, file, metadata, load, error, progress, abort, transfer, options) {
        const formData = new FormData();
        formData.append(fieldName, file, file.name);

        const response = await axios.post(route("filepond-process"), formData);

        if (response.status === 200) {
            $form.avatar = response.data;
            load(response.data);
        } else {
            error('Upload failed');
        }
    }

    const submit = ()=>{
        $form.post(route("avatar.update"),{
            onSuccess: ()=>{
                modal.close()
                notify({title:"successful",icon:"success",toast:true})
            }
        })
    }
</script>

<Modal isOpen keyboard={false} backdrop='static'>
    <form action={route("avatar.update")} method="post" on:submit|preventDefault={submit}>
        <!--optional button for when header is hidden-->
        <span class="close x-extra-close-icon" use:ModalClose data-dismiss="modal" aria-hidden="true">
            <IconX class="ti-close" />
        </span>
        <div class="modal-body min-h-200" id="commonModalBody">
            <div class="splash-image" id="updatePasswordSplash">
                <img src="{asset}images/update-avatar.png" alt="update avatar">
            </div>
            <div class="splash-text">
                Update your profile picture
            </div>

            <input type="hidden" name="userid" value="true">
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-12">
                    <FilePond bind:this={fileCont} name='avatar' server={{ process: handleProcess,
                        revert: route("filepond-revert"), }} />
                </div>
            </div>
        </div>
        <div class="modal-footer" id="commonModalFooter">
            <button type="button" use:ModalClose class="btn btn-rounded-x btn-secondary text-left" data-dismiss="modal">Close</button>
            <button type="submit" disabled={$form.proccessing} class="btn btn-rounded-x btn-danger text-left commonModalSubmitButton">
                Submit
                {#if $form.proccessing}
                    <div class="spinner-border spinner-border-sm text-primary"></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>