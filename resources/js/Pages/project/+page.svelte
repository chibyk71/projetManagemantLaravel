<script lang="ts">
	import Navbar from '$lib/navbar.svelte';
	import type { PageData } from './$types';
	import { base } from '$lib';
	import Construction from '$lib/construction.svelte';
	import Footer from '$lib/footer.svelte';

	export let data: PageData;
</script>

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
			<Construction limit={50} />
		</div>
	</section>
	<!-- End Our Projects Section -->
</main>
<!-- End #main -->

<Footer />
