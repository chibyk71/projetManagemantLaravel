<script>
    import { useForm, inertia } from "@inertiajs/svelte";
    import { FormGroup, Input } from '@sveltestrap/sveltestrap';
    import { handleSubmit } from '@/lib/scripts/hhandleSubmit';
    import AuthLayout from '@/layouts/AuthLayout.svelte';
    import { notify } from "@/lib/scripts/notify";

    //     if (res.status) {
    //         notify({title: "password reset email has been sent"})
    //     }

    const Form = useForm({
        email: null
    })

    const submit = ()=>{
        $Form.post(route("password.email"),{
            onSuccess: ()=>{
                notify({title: "password reset email has been sent"})
            }
        })
    }
</script>
<AuthLayout>
    <div class="login-box m-t-20">
        <h3 class="box-title  m-t-10 text-center">Forgot Password</h3>
        <div class="text-center  m-b-20 ">
            <small>Please enter your account email address below.</small>
        </div>
        <form class="form-horizontal form-material" on:submit|preventDefault={submit}>
            <FormGroup label='Email'>
                <Input feedback={$Form.errors.email} type='email' bind:value={$Form.email} name="email" invalid={!!$Form.errors.email}/>
            </FormGroup>
            <div class="form-group text-center p-b-10">
                <div class="col-xs-12">
                    <button name="recover" disabled={$Form.processing} class="btn btn-info btn-lg btn-block" type="submit">Forgot Password
                        {#if $Form.processing}
                            <div class="spinner-border spinner-border-sm text-warning"></div>
                        {/if}
                    </button>
                </div>
            </div>
            <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                    <a use:inertia href="/login" class="text-info m-l-5">
                        <b>Back to login page</b>
                    </a>
                </div>
            </div>
        </form>
    </div>
</AuthLayout>