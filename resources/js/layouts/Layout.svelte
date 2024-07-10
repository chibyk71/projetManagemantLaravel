<script lang="ts">
    import { onMount } from "svelte";
    import ModalComp from "@/lib/components/modals/ModalComp.svelte";

    let isloaded = false

    onMount(() => isloaded=true)
</script>

<!--preloader-->
{#if !isloaded}
    <div class="preloader">
        <div class="loader">
            <div class="loader-loading"></div>
        </div>
    </div>
{/if}
<!--preloader-->

<slot />
<ModalComp />