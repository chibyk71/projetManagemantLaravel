<script lang="ts">
    import { Modal } from "@sveltestrap/sveltestrap";
    import ModalCloseBtn from "../modals/modalCloseBtn.svelte";
    import { ModalClose } from "@/lib/scripts/closeModal";
    import Svelecte from "svelecte";
    import { modal } from "@/lib/scripts/modalToggler";
    import { base } from "@/lib/scripts/userStore";
    import { notify } from "@/lib/scripts/notify";

    const ProjectStatus = ["IN_PROGRESS", "ON_HOLD", "COMPLETED", "NOT_STARTED", "CANCELED"]
    const statusList = ProjectStatus.map((v)=> {
        return {id:v,label:v.replace('_',' ')}
    })

     export let id:number;
     let creating = false
    console.log(id);
    
    const handleSubmit = async (e:Event&{currentTarget:HTMLFormElement})=>{
        creating = true;
        const form = e.currentTarget;
        const formdata = new FormData(form)
        const res = await fetch(form.action,{
            method:"post",
            body: formdata,
            credentials: "include"
        }).then(r=>r.json())
        if (res.status) {
            modal.close()
            notify({title:"Status Has Been Updated Successfully"})
            return
        }else{
            notify({title:res.message,icon:"error"})
        }
        creating = false;
    }

</script>

<Modal class='actions-modal' isOpen backdrop='static' size='sm' keyboard={false}>
    <form action="{base}api/projects.php" on:submit|preventDefault={handleSubmit} method="post">
        <div class="modal-header">
            <h4 class="modal-title" id="actionsModalTitle">Change Status</h4>
            <ModalCloseBtn />
        </div>
        <div class="modal-body" id="actionsModalBody">
            <div class="form-group row">
                <label for="example-month-input" class="col-12 col-form-label text-left">Status</label>
                <div class="col-sm-12">
                    <Svelecte name='status' required options={statusList} />
                </div>
            </div>
            <input type="hidden" name="project_id" value={id}>
            <input type="hidden" name="state" value="status">
        </div>
        <div class="modal-footer" id="actionsModalFooter" style="">
            <button type="button" use:ModalClose class="btn btn-rounded-x btn-secondary text-left" data-dismiss="modal">Close</button>
            <button type="submit" name="status" class="btn btn-rounded-x btn-danger text-left">Submit
                {#if creating}
                     <div class="spinner spinner-border"></div>
                {/if}
            </button>
        </div>
    </form>
</Modal>