<script lang='ts'>
	import { ModalClose } from './../../scripts/closeModal';
	import ModalCloseBtn from './../modals/modalCloseBtn.svelte';
    import { FormGroup, Input, Modal, ModalBody } from "@sveltestrap/sveltestrap";
    import Spacers from '../spacers.svelte';
    import Editor from '@tinymce/tinymce-svelte';
    import { OptionTinyMce } from '@/lib//scripts/tinymceProps';
    import { onMount } from 'svelte';
    import { base } from '@/lib//scripts/userStore';
    import Svelecte from 'svelecte';
    import { fDate } from '@/lib//scripts/fdate';
    import { useForm } from "@inertiajs/svelte";
    import { modal } from '@/lib/scripts/modalToggler';
    import { notify } from '@/lib/scripts/notify';
        
    export let state: 'new'|'edit' = 'new'
    export let user;
    export let data: {
        title: string;
        contractor: string;
        start_date: string;
        due_date: string;
        desc: string;
        progress: number;
        contract_sum: string;
        date_of_award: string;
        duration: string;
        assigned?: string[] | undefined;
        number?: string | undefined;
    };
    
    export let created_by = 'admin'
    
    export let id = null;

    const form = useForm({
        start_date: data.start_date,
        title: data.title,
        contractor: data.contractor,
        due_date: data.due_date,
        desc: data.desc,
        progress: data.progress,
        contract_sum: data.contract_sum,
        date_of_award: data.date_of_award,
        duration: data.duration,
        assigned: data.assigned,
        number: data.number,
        id
    })

    const url = id? "project.update" : "project.store";
    const submit = ()=> {
        $form.post(route(url),{
            onSuccess: ()=> {
                modal.close()
                notify({title: "Successful"})
            },
            onException: ()=>{
                notify({title:"An unexpected error occurred",icon:"error"})
            }
        })
    }

    let teams: {id:number,label:string}[],
    contractors: {id:number,label:string}[]

    onMount(async ()=> {
        // Todo rewrite to work
        await fetch(base+"api/team.php").then(async (res)=>{
            let r = await res.json()
            teams = r.users;
            contractors = r.contractors

            if (data) {
                $form.contractor = data.contractor+''
                $form.due_date = new Date(data.due_date as string).toISOString().substring(0,10);
                $form.start_date = new Date(data?.start_date as string).toISOString().substring(0,10);
                $form.date_of_award = new Date(data?.date_of_award as string).toISOString().substring(0,10);
            }
        })
    })

    
    
</script>
<Modal keyboard={false} backdrop='static' size='lg' scrollable={false} isOpen={true}>
    <form action={route(url)} method="post" on:submit={submit}>
        <div class="modal-header" id="commonModalHeader">
            <h4 class="modal-title" id="commonModalTitle">Edit Project</h4>
            <ModalCloseBtn />
        </div>
        <ModalBody>
            <div class="row" data-section="edit" data-project-progress="80">
                <div class="col-lg-12">
                    <!--meta data - creatd by-->
                    {#if state === 'edit'}
                        <div class="modal-meta-data">
                            <small><strong>Created By:</strong> {created_by} | {fDate($form.start_date)}</small>
                        </div>
                    {/if}

                    <!--TITLE-->
                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">Title*</label> 
                        <Input bind:value={$form.title} name='title' type='text' invalid={!!$form.errors.title} feedback={$form.errors.title} />
                    </FormGroup>
                    <!--/#TITLE-->

                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">Project Number</label> 
                        <Input bind:value={$form.number} name='number' type='text' invalid={!!$form.errors.number} feedback={$form.errors.number} />
                    </FormGroup>

                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">Date Of Award</label> 
                        <Input bind:value={$form.date_of_award} name='date_of_award' type='date' invalid={!!$form.errors.date_of_award} feedback={$form.errors.date_of_award} />
                    </FormGroup>

                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">Contract SUM*</label> 
                        <Input bind:value={$form.contract_sum} name='contract_sum' type='text' invalid={!!$form.errors.contract_sum} feedback={$form.errors.contract_sum} />
                    </FormGroup>

                    <!--START DATE-->
                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">Start Date*</label> 
                        <Input bind:value={$form.start_date} name='start_date' type='date' invalid={!!$form.errors.start_date} feedback={$form.errors.start_date} />
                    </FormGroup>
                    <!--/#START DATE-->

                    <!--DUE DATE-->
                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">Due Date*</label> 
                        <Input bind:value={$form.due_date} name='due_date' type='date' invalid={!!$form.errors.due_date} feedback={$form.errors.due_date} />
                    </FormGroup>

                    {#if state === 'new'}
                        <FormGroup>
                            <label slot="label" for="" class="ext-left control-label col-form-label required">Assign Teams*</label>
                            <Svelecte options={teams} name='assigned' class='svelect-color' bind:value={$form.assigned} multiple placeholder='assign users to manage project'/>
                        </FormGroup>
                    {/if}

                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">Contractor*</label>
                        <Svelecte options={contractors} valueField={'id'} class='svelect-color' name='contractor' bind:value={$form.contractor} placeholder='assign users to manage project'/>
                    </FormGroup>
                    <div class="line"></div>


                    <!--DESCRIPTION & DETAILS-->
                    <Spacers title='Description &amp; Details'>
                        <svelte:fragment slot="content">
                            <Editor conf={OptionTinyMce} bind:value={$form.desc} scriptSrc='{base}/tinymce/tinymce.min.js' />
                            <Input value="description" name='desc' type='text' class='d-none' invalid={!!$form.errors.desc} feedback={$form.errors.desc}/>
                        </svelte:fragment>
                    </Spacers>
                    <!--/#DESCRIPTION & DETAILS-->

                    <!--PROJECT PROGRESS-->
                    <Spacers title='Progress'>
                        <div slot="content" class="form-group row">
                            <div class="col-sm-10 p-l-30">
                                <Input class='w-100' name='progress' type='range' max={100} min={0} bind:value={$form.progress} invalid={!!$form.errors.progress} feedback={$form.errors.progress} />
                            </div>
                            <div class="col-sm-2 text-right">
                                <strong> <span id="edit_project_progress_display">{$form.progress||0}</span>%</strong>
                            </div>
                        </div>
                    </Spacers>
                    <!--/#PROJECT PROGRESS-->
                </div>
            </div>
            <input type="hidden" name="id" value="{id}">
            <!-- <SuperDebug data={$form} /> -->
        </ModalBody>
        <div class="modal-footer" id="commonModalFooter" style="">
            <button type="button" class="btn btn-rounded-x btn-secondary text-left" use:ModalClose data-dismiss="modal">Close</button>
            <button type="submit" disabled={$form.processing} class="btn btn-rounded-x btn-danger text-left commonModalSubmitButton">Submit
                {#if $form.processing}
                    <div class="spinner-border spinner-border-sm text-primary"></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>

<style>
    :global(.svelect-color){
        --sv-color: #0e0e0e
    }
</style>