<script lang="ts">
	import { base } from '$lib';
	import AltService from '$lib/altService.svelte';
	import Footer from '$lib/footer.svelte';
	import Navbar from '$lib/navbar.svelte';
	import Team from '$lib/team.svelte';
    import type { PageData } from './$types';
    export let data: PageData;
    import { IconMoodSmile, IconAddressBook, IconListTree, IconSquareCheckFilled } from "@tabler/icons-svelte";
    import Countup from "svelte-countup";
</script>

<Navbar />


<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs flex items-center"
        style="background-image: url('{base}storage/projects/breadcrumbs-bg.jpg');">
        <div class="container relative flex flex-col items-center" data-aos="fade">

            <h2>About</h2>
            <ol>
                <li><a href="index.html">Home</a></li>
                <li>About</li>
            </ol>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="flex flex-wrap relative">

                <div class="lg:w-7/12 w-full about-img" style="background-image: url({base}storage/projects//about.jpg);"></div>

                <div class="lg:w-7/12 w-full">
                    <div class="our-story sm:p-4 lg:p-10">
                        <h3>Our Mission</h3>
                        <p>Our mission is to provide citizens with easy access to information about government contracts and projects.</p>
                        <p>We aim to promote transparency and empower citizens by sharing project details in a user-friendly manner.</p>
                        <ul>
                            <li><IconSquareCheckFilled />Transparency: <span>Citizens can access real-time information on government projects, fostering trust and accountability.</span></li>
                            <li><IconSquareCheckFilled /> Informed Decision-Making: <span>By understanding project details, citizens can participate in discussions and provide feedback.</span></li>
                            <li><IconSquareCheckFilled /> Empowerment:  <span>Accessible data allows citizens to monitor progress, identify issues, and engage with policymakers.</span></li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End About Section -->

    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter section-bg">
        <div class="container">

            <div class="grid lg:grid-cols-3 md:col-span-2 gap-x-4">

                <div class="">
                    <div class="stats-item flex items-center w-full h-full">
                        <IconMoodSmile class="w-12 h-12 color-blue flex-shrink-0" />
                        <div>
                            <Countup value={232} class='color-blue' duration={1000} />
                            <p>Happy Clients</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="">
                    <div class="stats-item flex items-center w-full h-full">
                        <IconAddressBook class="color-orange flex-shrink-0" />
                        <div>
                            <Countup value={521} duration={1000} />
                            <p>Projects</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="">
                    <div class="stats-item flex items-center w-full h-full">
                        <IconListTree class="color-green flex-shrink-0" />
                        <div>
                            <Countup value={1463} duration={1000} />
                            <p>Hours Of Support</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->
            </div>

        </div>
    </section><!-- End Stats Counter Section -->

   <AltService />

    <Team />

</main><!-- End #main -->

<Footer />