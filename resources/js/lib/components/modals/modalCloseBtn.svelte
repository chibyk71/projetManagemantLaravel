<script>
  import { ModalClose } from "@/lib//scripts/closeModal";
  import { IconX } from "@tabler/icons-svelte";

</script>

<button type="button" use:ModalClose class="close" data-dismiss="modal" aria-hidden="true">
    <IconX class="ti-close" />
</button>