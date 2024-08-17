<script lang='ts'>
	import { ModalClose } from './../../scripts/closeModal';
	import ModalCloseBtn from './../modals/modalCloseBtn.svelte';
    import RangeSlider from "svelte-range-slider-pips";
    import { FormGroup, Input, Modal, ModalBody } from "@sveltestrap/sveltestrap";
    import Spacers from '../spacers.svelte';
    import Editor from '@tinymce/tinymce-svelte';
    import { OptionTinyMce } from '@/lib//scripts/tinymceProps';
    import Svelecte from 'svelecte';
    import { fDate } from '@/lib//scripts/fdate';
    import { useForm, page } from "@inertiajs/svelte";
    import { modal } from '@/lib/scripts/modalToggler';
    import { notify } from '@/lib/scripts/notify';
    import { removeLeadingAsterisk } from '@/lib/scripts/removeLeadingAsterics';
    import { asset } from '@/lib/scripts/userStore';
        
    export let state: 'new'|'edit' = 'new'
    export let user;
    export let data: {
        title: string;
        contractor: any;
        start_date: string;
        due_date: string;
        description: string;
        progress: number;
        contract_sum: string;
        date_of_award: string;
        duration: string;
        team: {id:number,name:string,avatar:string}[];
        project_number?: string | undefined;
    } = $page.props.project;
    
    export let created_by = 'admin'
    
    function formatDate(dt) {
        const date = new Date(dt);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // getMonth() is zero-based
        const day = String(date.getDate()).padStart(2, '0');
        
        return `${year}-${month}-${day}`;
    }

    export let id = $page.props.project_id;
    
    const form = useForm({
        start_date: formatDate(data.start_date),
        title: data.title,
        contractor: data.contractor.name,
        due_date: formatDate(data.due_date),
        description: data.description,
        progress: null,
        contract_sum: data.contract_sum,
        date_of_award: formatDate(data.date_of_award),
        duration: data.duration,
        assigned: data.team,
        project_number: data.project_number,
        id
    })

    let progress = [data.progress];
    console.log(data.progress,progress);
    
    const url = id? "project.update" : "project.store";
    const submit = ()=> {
        $form.contractor = removeLeadingAsterisk($form.contractor);
        $form.assigned = $form.assigned.map(({name})=>{
            return [name]
        });
        $form.progress = progress
        $form.post(route(url,id),{
            onSuccess: ()=> {
                modal.close()
                notify({title: "Successful"})
            },
            onException: ()=>{
                notify({title:"An unexpected error occurred",icon:"error"})
            }
        })
    }   
</script>
<Modal keyboard={false} backdrop='static' size='lg' scrollable={false} isOpen={true}>
    <form action={route(url,id)} method="post" on:submit|preventDefault={submit}>
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
                        <Input bind:value={$form.project_number} name='project_number' type='text' invalid={!!$form.errors.project_number} feedback={$form.errors.project_number} />
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
                            <Svelecte fetch={route("team.api")} labelField='name' valueField="id" name='assigned[]' required class='svelect-color' bind:value={$form.assigned} multiple valueAsObject placeholder='assign users to manage project'/>
                        </FormGroup>
                    {/if}

                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">Contractor*</label>
                        <Svelecte fetch={route("contractor.api")} keepCreated creatable valueField='name' labelField="name" class='svelect-color' name='contractor' bind:value={$form.contractor} placeholder='assign users to manage project'/>
                    </FormGroup>
                    <div class="line"></div>


                    <!--DESCRIPTION & DETAILS-->
                    <Spacers title='Description &amp; Details'>
                        <svelte:fragment slot="content">
                            <Editor conf={OptionTinyMce} bind:value={$form.description} scriptSrc='{asset}tinymce/tinymce.min.js' />
                            <Input value="description" name='description' type='text' class='d-none' invalid={!!$form.errors.description} feedback={$form.errors.description}/>
                        </svelte:fragment>
                    </Spacers>
                    <!--/#DESCRIPTION & DETAILS-->

                    <!--PROJECT PROGRESS-->
                    <Spacers title='Progress'>
                        <div slot="content" class="form-group row">
                            <div class="col-sm-10 p-l-30">
                                <RangeSlider class='w-100' name='progress' float max={100} min={0}  bind:values={progress} invalid={!!$form.errors.progress} feedback={$form.errors.progress} />
                            </div>
                            <div class="col-sm-2 text-right">
                                <strong> <span id="edit_project_progress_display">{progress}</span>%</strong>
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