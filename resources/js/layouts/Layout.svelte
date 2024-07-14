<script lang="ts">
    import { onMount } from "svelte";
    import ModalComp from "@/lib/components/modals/ModalComp.svelte";
    // import { Styles } from '@sveltestrap/sveltestrap';

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
<!-- <Styles /> -->