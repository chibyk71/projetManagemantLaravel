<script lang="ts">
	import Navbar from '@/lib/components/guest/navbar.svelte';
	import { base } from '@/lib/scripts/userStore';
	import Construction from '@/lib/components/guest/construction.svelte';
	import Footer from '@/lib/components/guest/footer.svelte';
    import GuestLayout from '@/layouts/guestLayout.svelte';
	import { inertia } from "@inertiajs/svelte";

	export let projects;
</script>
<GuestLayout>
	<Navbar />
	
	<main id="main">
		<!-- ======= Breadcrumbs ======= -->
		<div
			class="breadcrumbs flex items-center"
			style="background-image: url('{base}storage/projects/home.jpg');"
		>
			<div class="container relative flex flex-col items-center" data-aos="fade">
				<h2>Projects</h2>
				<ol>
					<li><a href="/">Home</a></li>
					<li>Projects</li>
				</ol>
			</div>
		</div>
		<!-- End Breadcrumbs -->
	
		<!-- ======= Our Projects Section ======= -->
		<section id="projects" class="projects">
			<div class="container" data-aos="fade-up">
				<Construction projects={projects.data} />
			</div>
		</section>
		<!-- End Our Projects Section -->
		{#if projects.next_page_url}
			<div class="load-more-container">
				<!-- Your project data rendering goes here -->
			
				<!-- Load more button -->
				<button use:inertia={{href:projects.next_page_url}} class="load-more-button">Load More</button>
			</div>
		{/if}
		
	</main>
	<!-- End #main -->
	
	<Footer />
</GuestLayout>
<style>
	.load-more-container {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}

.load-more-button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.load-more-button:hover {
    background-color: #0056b3;
}

</style>