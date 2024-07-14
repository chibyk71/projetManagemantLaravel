<script>
  import { base } from "@/lib/scripts/userStore";
    import { Tooltip } from "@sveltestrap/sveltestrap";
    let image
    export let title = "Annie"
    /**
   * @type {string}
   */
     export let src = base+"uploaded/avatar/avatar.jpg"

</script>

<img bind:this={image} src='/storage/{src}' alt={title} class="img-circle avatar-xsmall">
<Tooltip target={image}>{title}</Tooltip>