<script>
    import { Modal, ModalBody, ModalFooter, ModalHeader, FormGroup, Label, Input, Table, Tooltip } from "@sveltestrap/sveltestrap";
    import { IconInfoCircle } from "@tabler/icons-svelte";
    import Svelecte from "svelecte";
    import { useForm } from "@inertiajs/svelte";
    import { modal } from "../scripts/modalToggler";
    import { notify } from "../scripts/notify";
    import axios from "axios";

    export let state = "new";
    export let name = null
    export let id = null

    const permissions = ["none","view","create","edit","delete","all"];
    const models = ["file","milestone","project","team"]

    const form = useForm({
        name: name ?? null,
        file: null,
        milestone: null,
        project: null,
        team: null
    })
    if (state === "edit") {
        axios.get(route("role.permission.show",id))
        .then((res)=> {
            $form.file = res.data.file;
            $form.milestoen = res.data.milestoen;
            $form.project = res.data.project;
            $form.team = res.data.user;
        })
    }
    
    const url = state === "new"? route("role.store") : route("role.store",{id});

    const submit = async () => {
        $form.post(url,{
            onComplete: async () => {
                modal.close();
            },
            onSuccess: async () => {
                notify({
                    text:"role created",
                    title: "Successful",
                    icon:"success",
                    timer: 1500,
                    timerProgressBar: true
                })
            }
        })
    }
</script>

<Modal isOpen={true} keyboard={false} backdrop="static" size="lg">
    <ModalHeader>Create A New Role</ModalHeader>
    <ModalBody>
        <form id="permission" on:submit|preventDefault={submit}>
            <div class="row">
                <div class="col-lg-12">
                    <!--title-->
                    <FormGroup class="row">
                        <Label class="col-12 text-left control-label col-form-label required" >Role Name</Label>
                        <div class="col-12">
                            <Input disabled={state === "edit"} type="text" invalid={$form.errors.name} feedback={$form.errors.name} bind:value={$form.name} name="name" bsSize="sm"/>
                        </div>
                    </FormGroup>

                    <div class="table-responsive">
                        <Table bordered class="w-99">
                            <thead>
                                <tr>
                                    <th>Resource</th>
                                    <th id="fx-settings-roles-th-1"> Permissions
                                        <Tooltip target="#permision" placement="top" title="[edit] &amp; [delete] permissions only apply to content created by the user"></Tooltip>
                                        <span id="permision" class="align-middle text-themecontrast font-16"><IconInfoCircle size="12" /></span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--projects-->
                                {#each models as model}
                                    <tr>
                                        <td class="text-capitalize">{model}</td>
                                        <td>
                                            <div class="form-group row m-0">
                                                <div class="col-12 text-center">
                                                    <Svelecte bind:value={$form[model]} name={model} options={permissions} multiple={true}></Svelecte>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                {/each}
                            </tbody>
                        </Table>
                    </div>
                </div>
            </div>
        </form>
    </ModalBody>
    <ModalFooter>
        <button type="button" on:click={()=>modal.close()} class="btn btn-rounded-x btn-secondary text-left">Close</button>
        <button form="permission" type="submit" class="btn btn-rounded-x btn-danger text-left">Submit</button>
    </ModalFooter>
</Modal>
