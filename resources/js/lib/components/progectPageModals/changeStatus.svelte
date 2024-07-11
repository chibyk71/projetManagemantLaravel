<script lang="ts">
    import { Modal } from "@sveltestrap/sveltestrap";
    import { useForm } from "@inertiajs/svelte";
    import ModalCloseBtn from "../modals/modalCloseBtn.svelte";
    import { ModalClose } from "@/lib/scripts/closeModal";
    import Svelecte from "svelecte";
    import { modal } from "@/lib/scripts/modalToggler";
    import { base } from "@/lib/scripts/userStore";
    import { notify } from "@/lib/scripts/notify";

    const ProjectStatus = ["IN_PROGRESS", "ON_HOLD", "COMPLETED", "NOT_STARTED", "CANCELED"]
    const statusList = ProjectStatus.map((v)=> {
        return {id:v,label:v.replace('_',' ')}
    })

    export let id:number;
    
    const form = useForm({
        status: null
    })
    
    const handleSubmit = async ()=>{
        $form.put(route("project.status.change",id),{
            onSuccess: ()=>{
                modal.close()
            notify({title:"Status Has Been Updated Successfully"})
            }
        })
    }

</script>

<Modal class='actions-modal' isOpen backdrop='static' size='sm' keyboard={false}>
    <form action={route("project.status.change",id)} on:submit|preventDefault={handleSubmit} method="post">
        <div class="modal-header">
            <h4 class="modal-title" id="actionsModalTitle">Change Status</h4>
            <ModalCloseBtn />
        </div>
        <div class="modal-body" id="actionsModalBody">
            <div class="form-group row">
                <label for="example-month-input" class="col-12 col-form-label text-left">Status</label>
                <div class="col-sm-12">
                    <Svelecte name='status' bind:value={$form.status} required options={statusList} />
                </div>
            </div>
        </div>
        <div class="modal-footer" id="actionsModalFooter" style="">
            <button type="button" use:ModalClose class="btn btn-rounded-x btn-secondary text-left" data-dismiss="modal">Close</button>
            <button type="submit" disabled={$form.proccessing} name="status" class="btn btn-rounded-x btn-danger text-left">Submit
                {#if $form.proccessing}
                     <div class="spinner spinner-border"></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>