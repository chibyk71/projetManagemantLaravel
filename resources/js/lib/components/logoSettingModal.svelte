<script>
    import {
        Modal,
        ModalBody,
        ModalFooter,
        ModalHeader,
    } from "@sveltestrap/sveltestrap";
    import ModalCloseBtn from "./modals/modalCloseBtn.svelte";
    import 'filepond/dist/filepond.css';
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
    import FilePond, { registerPlugin } from 'svelte-filepond';

    // Import the Image EXIF Orientation and Image Preview plugins
    import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation'
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
    import { modal } from "../scripts/modalToggler";
    import { parseStatus } from "../scripts/parceStatus";

    // Register the plugins
    registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview);

    export let placeholder = null

    const form = useForm({
        large_logo: null,
        small_logo: null,
        front_img: null,
        about_img: null
    })

    async function handleProcess(fieldName, file, metadata, load, error, progress, abort, transfer, options) {
        const formData = new FormData();
        formData.append(fieldName, file, file.name);

        const response = await axios.post(route("filepond-process"), formData);

        if (response.status === 200) {
            $form[placeholder] = response.data;
            load(response.data);
        } else {
            error('Upload failed');
        }
    }

    const submit = ()=>{
        $form.post(route("setting.website.store"),{
            onSuccess: ()=>{
                modal.close()
                notify({title:"successful",icon:"success",toast:true})
            }
        })
    }

</script>

<Modal>
    <ModalHeader title="Update {parseStatus(placeholder)}">
        <ModalCloseBtn />
    </ModalHeader>
    <form action={route("setting.website.store")} method="post" on:submit|preventDefault={submit}>
        <ModalBody>
            <div class="splash-image" id="updatePasswordSplash">
                <img src="https://midnight.growcrm.io/public/images/upload-logo.png" alt="update logo"/>
            </div>
            <div class="splash-text">Update Your Company Logo</div>

            <!--fileupload-->
            <div class="form-group row">
                <div class="col-12">
                    <FilePond server={{revert: route("filepond-revert"), process: handleProcess}} />
                </div>
            </div>
        </ModalBody>
        <ModalFooter>
            <button on:click={()=>modal.close()} type="button" class="btn btn-rounded-x btn-secondary text-left">Close</button>
            <button type="submit" class="btn btn-rounded-x btn-danger text-left" disabled={$form.processing}>Submit
                {#if $form.proccessing}
                    <div class="spinner-border spinner-border-sm text-primary"></div>
                {/if}
            </button>
        </ModalFooter>
    </form>
</Modal>
