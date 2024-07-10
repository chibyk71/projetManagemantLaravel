<script lang="ts">
    import { modal } from "$lib/scripts/modalToggler";
    import { FormGroup, Input, Modal } from "@sveltestrap/sveltestrap";
    import ModalCloseBtn from "../modals/modalCloseBtn.svelte";
    import { ModalClose } from "$lib/scripts/closeModal";
    import { milestone } from "$lib/scripts/schema";
    import { superForm, intProxy, defaults, setError } from "sveltekit-superforms";
    import Svelecte from 'svelecte'
    import { onMount } from "svelte";
    import { zod } from "sveltekit-superforms/adapters";
    import { base } from "$lib/scripts/userStore";
    import { convertToFormdata } from "$lib/scripts/convertToFormdata";
    import { notify } from "$lib/scripts/notify";
    import { page } from "$app/stores";

    export let state: 'new'|'edit' = 'new'
    export let data:{
        name: string;
        status: "IN_PROGRESS" | "YET_TO_COMMENCE" | "COMPLETED";
        progress: number;
        contractor: string;
    };
    export let id = $page.params.id,
    contractors:Array<{
        name: string;
        id: number;
    }>

    const { form, errors, enhance, constraints,delayed } = superForm(defaults(data,zod(milestone)),{
        SPA: true,
        validators: zod(milestone),
        async onUpdate({form}) {
            if (!form.valid) {
                setError(form,"Invalid Form Data")
                return
            }
            const res = await fetch(base+"api/project_milestone.php",{
                body: convertToFormdata({...form.data,state,id}),
                method: "post",
                credentials:"include"
             }).then(r=>r.json())

             if (res.status) {
                notify()
                modal.close()
             }else{
                notify({icon:"error",title:res.message})
             }
        },
        onError({result}) {
           console.log(result);
           
        }
    });

    onMount(async ()=>{
        contractors = await fetch(base+'/api/team.php').then(async (res)=>{
            const r = await res.json()
            return r.contractors
        })
    })

    const progressProxy = intProxy(form,'progress',{
        empty:'zero'
    });
    
</script>

<Modal keyboard={false} backdrop='static' isOpen size='lg' on:close={()=>modal.close()}>
    <form action="{base}api/project_milestone.php" method="post" use:enhance>
        <div class="modal-header" id="commonModalHeader">
            <h4 class="modal-title text-capitalize">{state} Milestone</h4>
            <ModalCloseBtn />
        </div>
        <div class="modal-body min-h-200" id="commonModalBody">
            <input type="hidden" name="state" value={state}>
            <FormGroup>
                <label for="" class="col-12 text-left control-label col-form-label required">Milestone Name*</label>
                <Input type="text" class="text-black" invalid={!!$errors.name} feedback={$errors.name} name="name" bind:value={$form.name} {...$constraints.name} />
            </FormGroup>

            <FormGroup>
                <label for="von" class="ext-left control-label col-form-label required">Contractor</label> 
                <Input id='von' list='contractors' bind:value={$form.contractor} name='contractor' type='text' invalid={!!$errors.contractor} {...$constraints.contractor} feedback={$errors.contractor}/>
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
                <Input bind:value={$progressProxy} name='progress' type='range' min={0} max={100} invalid={!!$errors.progress} {...$constraints.progress} feedback={$errors.progress} />
            </FormGroup>
            <input type="hidden" name="id" value="{id}">
        </div>
        <div class="modal-footer" id="commonModalFooter" style="">
            <button type="button" use:ModalClose class="btn btn-rounded-x btn-secondary waves-effect text-left"
                data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-rounded-x btn-danger text-left">Submit
                {#if $delayed}
                <div class="spinner-border spinner-border-sm text-primary"></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>