<script>
    import { Modal, ModalBody, ModalFooter, ModalHeader, FormGroup, Label, Input, FormFeedback } from "@sveltestrap/sveltestrap";
    import { useForm } from "@inertiajs/svelte";
    import { modal } from "../scripts/modalToggler";
    import { notify } from "../scripts/notify";
    import 'filepond/dist/filepond.css';
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
    import FilePond, { registerPlugin } from 'svelte-filepond';

    // Import the Image EXIF Orientation and Image Preview plugins
    import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation'
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
    import ModalCloseBtn from "./modals/modalCloseBtn.svelte";

    // Register the plugins
    registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview);
    
    export let state = "new";
    export let name = null
    export let id = null
    export let title = null
    export let description = null

    const form = useForm({
        name,
        image: null,
        title,
        description
    })

    async function handleProcess(fieldName, file, metadata, load, error, progress, abort, transfer, options) {
        const formData = new FormData();
        formData.append(fieldName, file, file.name);

        const response = await axios.post(route("filepond-process"), formData);

        if (response.status === 200) {
            $form["image"] = response.data;
            load(response.data);
        } else {
            error('Upload failed');
        }
    }
    
    const url = state === "new"? route("sponsor.store") : route("sponsor.update",{id});

    const submit = async () => {
        $form.post(url,{
            onSuccess: async () => {
                notify({
                    text:"role created",
                    title: "Successful",
                    icon:"success",
                    timer: 1500,
                    timerProgressBar: true
                })
                setTimeout(()=>modal.close(),500)
            }
        })
    }
</script>

<Modal isOpen={$modal.length >= 1} keyboard={false} size="lg">
    <ModalHeader><h4 class="text-capitalize">{state=="new"?"Create A New": "Edit"} sponsor
        <ModalCloseBtn />
    </h4></ModalHeader>
    <ModalBody>
        <form id="permission" on:submit|preventDefault={submit}>
            <div class="row">
                <div class="col-lg-12">
                    <FormGroup>
                        <Label>Image</Label>
                        <FilePond server={{process:handleProcess, revert: route("filepond-revert")}} name="image"  />
                        <FormFeedback>{$form.errors.image}</FormFeedback>
                    </FormGroup>

                    <!--title-->
                    <FormGroup class="row">
                        <Label class="col-12 text-left control-label col-form-label required" >Sponsor's Name</Label>
                        <div class="col-12">
                            <Input type="text" invalid={$form.errors.name} feedback={$form.errors.name} bind:value={$form.name} name="name" bsSize="sm"/>
                        </div>
                    </FormGroup>

                    <FormGroup class="row">
                        <Label class="required col-12"> Title</Label>
                        <div class="col-12">
                            <Input type="text" name="title" bind:value={$form.title} invalid={$form.errors.title} feedback={$form.errors.title} bsSize="sm" />
                        </div>
                    </FormGroup>
                    
                    <FormGroup class="row">
                        <Label class="required col-12">Description</Label>
                        <div class="col-12">
                            <Input type="text" name="description" bind:value={$form.description} invalid={$form.errors.description} feedback={$form.errors.description} bsSize="sm" />
                        </div>
                    </FormGroup>
                </div>
            </div>
        </form>
    </ModalBody>
    <ModalFooter>
        <button type="button" on:click={()=>modal.close()} class="btn btn-rounded-x btn-secondary text-left">Close</button>
        <button form="permission" type="submit" class="btn btn-rounded-x btn-danger text-left">Submit
            {#if $form.processing}
             <div class="spinner-border spinner-border-sm text-primary"></div>
            {/if}
        </button>
    </ModalFooter>
</Modal>
