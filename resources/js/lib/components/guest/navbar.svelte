<script>
	import { IconList, IconX } from "@tabler/icons-svelte";
	import { afterUpdate, onMount } from "svelte";
	import { page } from '$app/stores';

	onMount(()=>{
		const mobileNavShow = document.querySelector('.mobile-nav-show');
		const mobileNavHide = document.querySelector('.mobile-nav-hide');

		document.querySelectorAll('.mobile-nav-toggle').forEach(el => {
			el.addEventListener('click', function(event) {
			event.preventDefault();
			mobileNavToogle();
			})
		});

		function mobileNavToogle() {
			document.body.classList.toggle('mobile-nav-active');
			mobileNavShow?.classList.toggle('hidden');
			mobileNavHide?.classList.toggle('hidden');
		}
	})

	afterUpdate(()=>{
		document.body.classList.remove('mobile-nav-active');
	})

	const path = $page.url.pathname
</script>

<header id="header" class="header flex items-center">
	<div class="container flex items-center justify-between">
		<a href="/" class="logo flex items-center">
			<h1>ProjectMonitoring<span>.</span></h1>
		</a>

		<IconList size={42} class="mobile-nav-toggle mobile-nav-show" />
		<IconX size={42} class="mobile-nav-toggle mobile-nav-hide hidden" />
		<nav id="navbar" class="navbar">
			<ul>
				<li><a href="/" class:active={path === '/'}>Home</a></li>
				<li><a href="/about" class:active={path.startsWith('/about')}>About</a></li>
				<li><a href="/project" class:active={path.startsWith('/project')}>Projects</a></li>
			</ul>
		</nav>
	</div>
</header>
<!-- end here -->
