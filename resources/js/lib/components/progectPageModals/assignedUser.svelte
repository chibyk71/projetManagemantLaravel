<script lang="ts">
    import { Modal } from "@sveltestrap/sveltestrap";
    import ModalCloseBtn from "../modals/modalCloseBtn.svelte";
    import { ModalClose } from "@/lib/scripts/closeModal";
    import { useForm } from "@inertiajs/svelte";
    import Svelecte from "svelecte"; 
    import { onMount } from "svelte";
    import { modal } from "@/lib/scripts/modalToggler";
    import { notify } from "@/lib/scripts/notify";
    import axios from "axios";
    
    export let id

    id = Array.isArray(id)? id.join() : id;
    let teams: {id:number,label:string}[]
    let selected:string[] = []

    // this is the already assigned users
    export let assigned:{
        id: string;
        name: string;
        avatar: string;
    }[];

    const form =useForm({
        assigned: null
    })

    const submit = ()=>{
        $form.post(route("project.assigned.update"),{
            onSuccess: ()=>{
                notify({title:$form.assigned.length+" Successfully Assigned To this Post"})
                modal.close();
            }
        })
    }
    
    onMount(async ()=> {
        teams = await axios.get(route("team.api",[id]));

        if (assigned) {
            $form.assigned = assigned.map((val)=> {
                return val.id
            })
        }
    })
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
                    <Svelecte multiple options={teams} bind:value={$form.assigned} name='assigned' />
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