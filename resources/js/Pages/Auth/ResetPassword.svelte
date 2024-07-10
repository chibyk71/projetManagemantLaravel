<script>
    import { FormGroup, Input } from "@sveltestrap/sveltestrap";
    import { useForm, inertia } from "@inertiajs/svelte";
    import { handleSubmit } from "@/lib/scripts/hhandleSubmit";

    // const selector = $page.url.searchParams.get("selector");
    export let token;    

    const form = useForm({
        email: null,
        password: null,
        password_confirmation: null,
        token
    })
</script>

<div class="login-box m-t-20">
    <h3 class="box-title  m-t-10 text-center">Reset Password</h3>
    <div class="text-center  m-b-20 ">
        <small>Please enter New Password.</small>
    </div>
    <form class="form-horizontal form-material" on:submit|preventDefault={()=>handleSubmit($form,route("password.store"))}>
        <FormGroup label='Email'>
            <Input feedback={$form.errors.email} type='email' bind:value={$form.email} name="email" invalid={!!$form.errors.email}/>
        </FormGroup>

        <FormGroup label='Password'>
            <Input feedback={$form.errors.password} type='password' bind:value={$form.password} name="password" invalid={!!$form.errors.password}/>
        </FormGroup>

        <FormGroup label='Confirm Password'>
            <Input feedback={$form.errors.password_confirmation} type='password' bind:value={$form.password_confirmation} name="password_confirmation" invalid={!!$form.errors.password_confirmation}/>        
        </FormGroup>

        <!-- <input type="hidden" name="selector" value={selector}> -->
        <div class="form-group text-center p-b-10">
            <div class="col-xs-12">
                <button name="confirm" class="btn btn-info btn-lg btn-block" type="submit">Reset Password
                    {#if $form.processing}
                        <div class="ms-2 spinner-border spinner-border-sm text-primary"></div>
                    {/if}
                </button>
            </div>
        </div>
        <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
                <a use:inertia href={route("login")} class="text-info m-l-5 js-toggle-login-forms"
                    data-target="login-forms-login">
                    <b>Back to login page</b>
                </a>
            </div>
        </div>
    </form>
</div>