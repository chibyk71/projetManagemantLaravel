<script>
    import { Modal } from "@sveltestrap/sveltestrap";
    import ModalCloseBtn from "../modals/modalCloseBtn.svelte";
    import { ModalClose } from "@/lib/scripts/closeModal";
    import { useForm } from "@inertiajs/svelte";
    import Svelecte from "svelecte"; 
    import { modal } from "@/lib/scripts/modalToggler";
    import { notify } from "@/lib/scripts/notify";
    
    export let id

    let projectId = Array.isArray(id)? id.join() : id;

    // this is the already assigned users
    export let assigned;

    const form =useForm({
        assigned,
        projectId
    })

    const submit = ()=>{
        $form.post(route("project.assigned.update"),{
            onSuccess: ()=>{
                notify({title:$form.assigned.length+" Successfully Assigned To this Post"})
                modal.close();
            }
        })
    }
</script>
<Modal isOpen={true} keyboard={false} backdrop='static'>
    <form action={route("project.assign.update")} method="post" on:submit|preventDefault={submit}>
        <div class="modal-header" id="commonModalHeader">
            <h4 class="modal-title" id="commonModalTitle">Edit Assigned Users</h4>
            <ModalCloseBtn />
        </div>
        <div class="modal-body min-h-200" id="commonModalBody">
            <div class="form-group row">
                <div class="col-sm-12">
                    <Svelecte multiple labelField="name" valueField="id" bind:value={$form.assigned} fetch={route("team.api")} name='assigned' />
                </div>
            </div>
            <div class="alert alert-info m-t-30"> To remove all assigned users, submit an empty form, this way only admin can update the project</div>
        </div>
        <div class="modal-footer" id="commonModalFooter" style="">
            <button type="button" use:ModalClose class="btn btn-rounded-x btn-secondary text-left">Close</button>
            <button type="submit" disabled={$form.proccessing} class="btn btn-rounded-x btn-danger text-left">Submit
                {#if $form.processing}
                    <div class="spinner-border spinner-border-sm text-primary"></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>