<script lang="ts">
  import type { Writable } from "svelte/store";

      export  let isSelected:Writable<boolean>

    let id = Math.random().toString(32)
</script>

<span class="list-checkboxes display-inline-block w-px-20">
    <input bind:checked={$isSelected} type="checkbox" id="ids[{id}]"  class="listcheckbox listcheckbox-projects filled-in chk-col-light-blue"/>
    <label for="ids[{id}]"></label>
</span>