<script lang="ts">
    import { asset } from "@/lib/scripts/userStore";
    import Layout from "./Layout.svelte";

</script>
<Layout>
    <!--main content-->
    <div id="main-wrapper">
        <!--signup-->
        <div class="login-logo m-t-30 p-b-5">
            <a href={void(0)} class="text-center db">
                <img src="{asset}logo/app/logo.png" alt="Home">
            </a>
        </div>

        <slot />
        <div class="login-background">
            <div class="x-left">
                <img alt="" src="{asset}images/login-1.png" class="login-images" />
            </div>
            <div class="x-right hidden">
                <img src="{asset}images/login-2.png" alt="404 - Not found" />
            </div>
        </div>
        <!--signup-->
    </div>
</Layout>