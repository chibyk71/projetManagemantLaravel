<script>
    import { ModalClose } from "@/lib/scripts/closeModal";
    import { useForm } from "@inertiajs/svelte";
    import { modal } from "@/lib/scripts/modalToggler";
    import { notify } from "@/lib/scripts/notify";
    import { base } from "@/lib/scripts/userStore";
    import { Input, Modal } from "@sveltestrap/sveltestrap";
    import { IconX } from "@tabler/icons-svelte";
    
    const form = useForm({
        current_password: null,
        password: null,
        password_confirmation:null
    })

    const submit = async () => {
        $form.post(route("password.update"),{
            onSuccess: ()=>{
                notify({ title: "Your Password Was Successfully Updated" });
                modal.close();
            }
        })
    }
</script>

<Modal isOpen keyboard={false} backdrop="static">
    <form action={route("password.update")} method="post" on:submit={submit}>
        <!--optional button for when header is hidden-->
        <span
            class="close x-extra-close-icon"
            use:ModalClose
            data-dismiss="modal"
            aria-hidden="true"
        >
            <IconX class="ti-close" />
        </span>
        <div class="modal-body min-h-200">
            <div class="splash-image" id="updatePasswordSplash">
                <img
                    src="{base}public/images/authentication-update-password.png"
                    alt="404 - Not found"
                />
            </div>
            <div class="splash-text">
                Change your password. Minimum of 6 characters.
            </div>
            <div class="form-group row">
                <label for="oldpassword">Old Password</label>
                <Input
                    name="current_password"
                    invalid={!!$form.errors.current_password}
                    feedback={$form.errors.current_password}
                    type="password"
                    placeholder="Password"
                />
            </div>
            <div class="form-group row">
                <label for="password">Password</label>
                <Input
                    name="password"
                    invalid={!!$form.errors.password}
                    feedback={$form.errors.password}
                    type="password"
                    placeholder="Password"
                />
            </div>
            <div class="form-group row">
                <label for="confirm">Confirm Pasword</label>
                <Input
                    type="password"
                    invalid={!!$form.errors.password_confirmation}
                    feedback={$form.errors.password_confirmation}
                    name="password_confirmation"
                    placeholder="Confirm Password"
                />
            </div>
        </div>
        <div class="modal-footer">
            <button
                type="button"
                class="btn btn-rounded-x btn-secondary text-left"
                use:ModalClose>Close</button
            >
            <button disabled={$form.proccessing}
                name="reset"
                type="submit"
                class="btn btn-rounded-x btn-danger text-left"
                >Submit
                {#if $form.proccessing}
                    <div
                        class="spinner-border spinner-border-sm text-primary"
                    ></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>
