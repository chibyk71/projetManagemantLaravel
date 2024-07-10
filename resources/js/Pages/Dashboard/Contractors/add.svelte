<script>
    import { useForm } from "@inertiajs/svelte";
    import { ModalClose } from "@/lib/scripts/closeModal";
    import ModalCloseBtn from "@/lib/components/modals/modalCloseBtn.svelte";
    import { modal } from "@/lib/scripts/modalToggler";
    import { FormGroup, Input, Modal } from "@sveltestrap/sveltestrap";
    import { notify } from "@/lib/scripts/notify";
    export let state = "new";
    export let id = null;
    const link = id ? "contractor.store" : "contractor.edit";
    export let data

    const form = useForm({
        name: null,
        email: null,
        url: null,
        id,
    });

    const submit = () => {
        $form.post(route(link), {
            onSuccess: ()=>{
                modal.close(),
                notify({title:"Form Submitted"})
            },
            onError: ()=>{
                notify({title:"An Unknown Error Occured"})
            }
        });
    };
</script>

<Modal isOpen keyboard={false} backdrop="static">
    <form action={route(link)} method="post" on:submit|preventDefault={submit}>
        <input type="hidden" name="state" value={state} />
        <div class="modal-header" id="commonModalHeader">
            <h4 class="modal-title" id="commonModalTitle">Add Contractor</h4>
            <ModalCloseBtn />
        </div>
        <div class="modal-body min-h-200" id="commonModalBody">
            <!--modal-->
            <div
                class="row"
                id="js-trigger-clients-modal-add-edit"
                data-payload="create"
            >
                <div class="col-lg-12">
                    <FormGroup class="row">
                        <label
                            slot="label"
                            for=""
                            class="col-12text-left control-label col-form-label required"
                            >Company Name*</label
                        >
                        <Input
                            bind:value={$form.name}
                            name="name"
                            class="col-12"
                            type="text"
                            invalid={!!$form.errors.name}
                            feedback={$form.errors.name}
                        />
                    </FormGroup>

                    <FormGroup class="row">
                        <label
                            slot="label"
                            for=""
                            class="col-12text-left control-label col-form-label required"
                            >Company Email*</label
                        >
                        <Input
                            bind:value={$form.email}
                            name="email"
                            class="col-12"
                            type="email"
                            invalid={!!$form.errors.email}
                            feedback={$form.errors.email}
                        />
                    </FormGroup>
                    
                    <FormGroup class="row">
                        <label
                            slot="label"
                            for=""
                            class="col-12text-left control-label col-form-label required"
                            >Company Website*</label
                        >
                        <Input
                            bind:value={$form.url}
                            name="url"
                            class="col-12"
                            type="url"
                            invalid={!!$form.errors.url}
                            feedback={$form.errors.url}
                        />
                    </FormGroup>

                    <input type="hidden" name="id" value={id} />

                    <div class="line"></div>

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <small><strong>* Required</strong></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" id="commonModalFooter" style="">
            <button
                type="button"
                class="btn btn-rounded-x btn-secondary text-left"
                use:ModalClose>Close</button
            >
            <button type="submit" class="btn btn-rounded-x btn-danger text-left"
                >Submit
                {#if $form.processing}
                    <div
                        class="spinner-border spinner-border-sm text-primary"
                    ></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>
