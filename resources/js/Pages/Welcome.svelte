<script lang="ts">
	import Footer from '@/lib/components/guest/footer.svelte';
	import Navbar from '@/lib/components/guest/navbar.svelte';
	import Team from '@/lib/components/guest/team.svelte';
	import AltService from '@/lib/components/guest/altService.svelte';
	import Construction from '@/lib/components/guest/construction.svelte';
    import GuestLayout from '@/layouts/guestLayout.svelte';
    import { asset } from '@/lib/scripts/userStore';

    export let title;
    export let subheading;
    export let front_img;
    export let projects;
</script>
<GuestLayout>
    <Navbar />
    
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">
    
        <div class="info flex items-center">
            <div class="container">
                <div class="flex flex-wrap justify-center">
                    <div class="lg:w-1/2 w-full text-center">
                        <h2 data-aos="fade-down" class="capitalize">{title}</h2>
                        <p data-aos="fade-up font-bold capitalize">{subheading}</p>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="hero-carousel" class="carousel slide">
            <div class="carousel-item active" style="background-image: url({asset+front_img})"></div>
        </div>
    
    </section><!-- End Hero Section -->
    
    <main id="main">
        <Team />
        <AltService />
    
        
        <!-- ======= Constructions Section ======= -->
        <section id="constructions" class="constructions">
            <div class="container" data-aos="fade-up">
    
                <div class="section-header">
                    <h2>Constructions</h2>
                </div>
    
                <Construction projects={projects.data} />
            </div>
        </section><!-- End Constructions Section -->
    </main><!-- End #main -->
    
    <Footer />
</GuestLayout>
