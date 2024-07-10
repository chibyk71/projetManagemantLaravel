<script>
    export let allRowsSelected
</script>

<span class="list-checkboxes display-inline-block w-px-20">
    <input type="checkbox" id="listcheckbox-projects" class="listcheckbox-all filled-in chk-col-light-blue"
        bind:checked={$allRowsSelected} />
    <label for="listcheckbox-projects"></label>
</span>