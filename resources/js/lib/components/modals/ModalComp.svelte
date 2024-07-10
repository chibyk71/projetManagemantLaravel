<script>
	import { modal } from './../../scripts/modalToggler';
    
    $:modalComponent = $modal[0]?.comp || undefined

    $:modalProp = $modal[0]?.prop || {}

</script>

<svelte:component this={modalComponent} {...modalProp}  />