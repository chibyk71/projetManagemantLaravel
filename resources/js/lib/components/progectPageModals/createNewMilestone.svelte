<script lang="ts">
    import { modal } from "@/lib/scripts/modalToggler";
    import { FormGroup, Input, Modal } from "@sveltestrap/sveltestrap";
    import { useForm, page } from "@inertiajs/svelte";
    import ModalCloseBtn from "../modals/modalCloseBtn.svelte";
    import { ModalClose } from "@/lib/scripts/closeModal";
    import Svelecte from 'svelecte'
    import { onMount } from "svelte";
    import { base } from "@/lib/scripts/userStore";
    import { notify } from "@/lib/scripts/notify";

    export let state: 'new'|'edit' = 'new'
    export let data:{
        name: string;
        status: "IN_PROGRESS" | "YET_TO_COMMENCE" | "COMPLETED";
        progress: number;
        contractor: string;
    };
    export let id = $page;
    console.log(id);
    
    let contractors:Array<{
        name: string;
        id: number;
    }>

    const form = useForm({
        name: null,
        status: null,
        progress: 0,
        contractor: null,
        projectId:id
    })

    const submit = ()=>{
        $form.post(route("milestone.store"),{
            onSuccess: ()=> {
                notify({
                    title: "Successful",
                    titleText: "Milestone Created"
                })
                modal.close()
            }
        })
    }

    onMount(async ()=>{
        contractors = await fetch(base+'/api/team.php').then(async (res)=>{
            const r = await res.json()
            return r.contractors
        })
    })
</script>

<Modal keyboard={false} backdrop='static' isOpen size='lg' on:close={()=>modal.close()}>
    <form action={route("milestone.store")} method="post" on:submit|preventDefault={submit}>
        <div class="modal-header" id="commonModalHeader">
            <h4 class="modal-title text-capitalize">{state} Milestone</h4>
            <ModalCloseBtn />
        </div>
        <div class="modal-body min-h-200" id="commonModalBody">
            <input type="hidden" name="state" value={state}>
            <FormGroup>
                <label for="" class="col-12 text-left control-label col-form-label required">Milestone Name*</label>
                <Input type="text" class="text-black" invalid={!!$form.$errors.name} feedback={$form.$errors.name} name="name" bind:value={$form.name} />
            </FormGroup>

            <FormGroup>
                <label for="von" class="ext-left control-label col-form-label required">Contractor</label> 
                <Input id='von' list='contractors' bind:value={$form.contractor} name='contractor' type='text' invalid={!!$form.$errors.contractor} feedback={$form.$errors.contractor}/>
                <datalist id="contractors">
                    {#if contractors}
                        {#each contractors as item}
                             <option value={item.name}/>
                        {/each}
                    {/if}
                </datalist>
            </FormGroup>

            <FormGroup>
                <label for="" class="ext-left control-label col-form-label required">Status</label> 
                <Svelecte options={[{id:'IN_PROGRESS',label:'IN PROGRESS'},{id:'YET_TO_COMMENCE',label:'YET TO COMMENCE'},{id:'COMPLETED',label:'COMPLETED'}]} bind:value={$form.status} name='status' />
            </FormGroup>

            <FormGroup>
                <label for="" class="ext-left control-label col-form-label required">Progress ({$form.progress})%</label> 
                <Input bind:value={$form.progress} name='progress' type='range' min={0} max={100} invalid={!!$form.$errors.progress} feedback={$form.$errors.progress} />
            </FormGroup>
            <input type="hidden" name="id" value="{id}">
        </div>
        <div class="modal-footer" id="commonModalFooter" style="">
            <button type="button" use:ModalClose class="btn btn-rounded-x btn-secondary waves-effect text-left"
                data-dismiss="modal">Close</button>
            <button type="submit" disabled={$form.proccessing} class="btn btn-rounded-x btn-danger text-left">Submit
                {#if $form.proccessing}
                <div class="spinner-border spinner-border-sm text-primary"></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>