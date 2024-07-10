<script lang="ts">
    let checked = false;
    export let title = ''
</script>

<div class="spacer row">
    <div class="col-sm-8">
        <span class="title">{title}</span>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="switch  text-right">
            <label>
                <input type="checkbox" bind:checked={checked} class="js-switch-toggle-hidden-content">
                <span class="lever switch-col-light-blue"></span>
            </label>
        </div>
    </div>
</div>
<div class:hidden={!checked}>
    <slot name="content"></slot>
</div>