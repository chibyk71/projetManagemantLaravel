<script>
    import ModalCloseBtn from "@/lib/components/modals/modalCloseBtn.svelte";
    import { useForm } from "@inertiajs/svelte";
    import { ModalClose } from "@/lib/scripts/closeModal";
    import { FormGroup, Input, Modal } from "@sveltestrap/sveltestrap";
    import Svelecte from "svelecte";
    import { modal } from "@/lib/scripts/modalToggler";
    import { notify } from "../scripts/notify";
    
    const form = useForm({
        name: null,
        email: null,
        phone: null,
        role: ""
    })

    const submit = ()=>{
        $form.post(route("register"),{
            onSuccess: ()=>{
                modal.close();
                notify({
                    position: "top-end",
                    icon: "success",
                    title: 'User Has Been Created',
                    showConfirmButton: false,
                    timer: 1500,
                    toast:true
                })
            },
            onError: ()=> {
               notify({
                    position: "top-end",
                    icon: "success",
                    title: 'User Has Been Created',
                    showConfirmButton: false,
                    timer: 1500,
                    toast:true
                }) 
            }
        })
    } 

</script>
<Modal backdrop='static' keyboard={false} isOpen size='lg'>
    <form action={route("register")} method="post" on:submit={submit}>
        <div class="modal-header" id="commonModalHeader">
            <h4 class="modal-title" id="commonModalTitle">Create A New User</h4>
            <ModalCloseBtn />
        </div>
        <div class="modal-body min-h-200" id="commonModalBody">
            <!--used for all types of users (team, contacts etc-->
            <div class="row">
                <div class="col-lg-12">
                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">FullName*</label> 
                        <Input bind:value={$form.name} name='name' type='text' invalid={!!$form.errors.name} feedback={$form.errors.name} />
                    </FormGroup>
                    <!--chrome workaround prevent autofill (as of dec 2016)-->
                    <div class="fx-fake-login">
                        <input type="text" name="fake_username_remembered">
                        <input type="password" name="fake_password_remembered">
                    </div>

                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">Email Address*</label> 
                        <Input bind:value={$form.email} name='email' type='email' invalid={!!$form.errors.email} feedback={$form.errors.email} />
                    </FormGroup>

                    <!--[edit] phone-->
                    <FormGroup>
                        <label slot="label" for="" class="ext-left control-label col-form-label required">Phone Number*</label> 
                        <Input bind:value={$form.phone} name='phone' type='tel' invalid={!!$form.errors.phone} feedback={$form.errors.phone} />
                    </FormGroup>
                    <!--/#[edit] phone-->

                    <FormGroup>  
                        <label slot="label" for="" class="ext-left control-label col-form-label required">role*</label>
                        <Svelecte options={['ADMIN','MODERATOR']} bind:value={$form.role} name='role' class='text-black' /> 
                        {#if !!$form.errors.role}
                            <span class="error text-danger">{$form.errors.role}</span>
                        {/if}
                    </FormGroup>

                    <!--notes-->
                    <div class="row">
                        <div class="col-12">
                            <div><small><strong>* Required</strong></small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" id="commonModalFooter" style="">
            <button type="button" use:ModalClose class="btn btn-rounded-x btn-secondary text-left">Close</button>
            <button type="submit" disabled={$form.processing} name="register" class="btn btn-rounded-x btn-danger text-left commonModalSubmitButton">
                Submit
                {#if $form.processing}
                    <div class="spinner-border spinner-border-sm text-primary"></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>