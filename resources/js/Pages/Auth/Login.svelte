
<script>
    import { FormGroup, Input } from "@sveltestrap/sveltestrap";
    import AuthLayout from '@/layouts/AuthLayout.svelte';
    import { useForm, inertia } from "@inertiajs/svelte";
    import { handleSubmit } from '@/lib/scripts/hhandleSubmit';

    const LoginForm = useForm({
        email: null,
        password: null,
        remember: true,
    })
</script>
<AuthLayout>
    <div class="login-box m-t-20">
        <form class="form-horizontal form-material" method="post" action="/login" on:submit|preventDefault={()=>handleSubmit($LoginForm, route("login"))}>
            <div class="title">
                <h4 class="box-title m-t-10 text-center">Sign in to your account</h4>
                <div class="text-center  m-b-20 ">
                </div>
            </div>
            <FormGroup label='Email'>
                <Input feedback={$LoginForm.errors.email} type='email' bind:value={$LoginForm.email} name="email" invalid={!!$LoginForm.errors.email}/>
            </FormGroup>
    
            <FormGroup label='Password'>
                <Input feedback={$LoginForm.errors.password} type='password' bind:value={$LoginForm.password} name="password" invalid={!!$LoginForm.errors.password}/>
            </FormGroup>
    
            <div class="form-group">
                <label class="custom-control custom-checkbox cursor-pointer">
                    <input type="checkbox" class="custom-control-input" bind:checked={$LoginForm.remember} name="remember">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description">Remember me</span>
                </label>
            </div>
            <div class="form-group row p-t-10 p-b-10">
                <div class="col-md-12">
                    <a use:inertia href={route("password.request")} class="text-dark pull-right js-toggle-login-forms">Forgot Password</a>
                </div>
            </div>
    
            <!--DYANMIC TRUSTED CONTENT - No sanitizing required] for this trusted content (Google reCAPTCHA)-->
    
            <div class="form-group text-center p-b-10">
                <div class="col-xs-12">
                    <button name="login" class="btn btn-info btn-lg btn-block" type="submit">Login
                        {#if $LoginForm.processing}
                            <div class="spinner-border spinner-border-sm text-warning"></div>
                        {/if}
                    </button>
                </div>
            </div>
        </form>
    </div>
</AuthLayout>