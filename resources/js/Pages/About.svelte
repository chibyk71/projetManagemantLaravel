<script>
	import { base } from '@/lib/scripts/userStore';
	import AltService from '@/lib/components/guest/altService.svelte';
	import Footer from '@/lib/components/guest/footer.svelte';
	import Navbar from '@/lib/components/guest/navbar.svelte';
	import Team from '@/lib/components/guest/team.svelte';
    import { IconMoodSmile, IconAddressBook, IconListTree, IconSquareCheckFilled } from "@tabler/icons-svelte";
    import Countup from "svelte-countup";
    import GuestLayout from '@/layouts/guestLayout.svelte';

    export let data
</script>
<GuestLayout>
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
    
                    <div class="lg:w-7/12 w-full about-img" style="background-image: url(public/storage/project/about.jpg);"></div>
    
                    <div class="lg:w-7/12 w-full">
                        <div class="our-story sm:p-4 lg:p-10">
                            <h3>Our Mission</h3>
                            <p>Our mission is to provide citizens with easy access to information about government contracts and projects.</p>
                            <p>We aim to promote transparency and empower citizens by sharing project details in a user-friendly manner.</p>
                            <ul class="lg:-mr-4">
                                <li><IconSquareCheckFilled /> <span class="text-lg font-bold">Transparency</span>: <span>Citizens can access real-time information on government projects, fostering trust and accountability.</span></li>
                                <li><IconSquareCheckFilled /> <span class="text-lg font-bold">Informed Decision-Making:</span> <span>By understanding project details, citizens can participate in discussions and provide feedback.</span></li>
                                <li><IconSquareCheckFilled /> <span class="text-lg font-bold">Empowerment:</span>  <span>Accessible data allows citizens to monitor progress, identify issues, and engage with policymakers.</span></li>
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
                                <Countup value={data.total_projects} class='color-blue' duration={1000} />
                                <p>All Projects</p>
                            </div>
                        </div>
                    </div><!-- End Stats Item -->
    
                    <div class="">
                        <div class="stats-item flex items-center w-full h-full">
                            <IconAddressBook class="color-orange flex-shrink-0" />
                            <div>
                                <Countup value={data.completed_projects} duration={1000} />
                                <p>Compleded Projects</p>
                            </div>
                        </div>
                    </div><!-- End Stats Item -->
    
                    <div class="">
                        <div class="stats-item flex items-center w-full h-full">
                            <IconListTree class="color-green flex-shrink-0" />
                            <div>
                                <Countup value={data.ongoing_projects} duration={1000} />
                                <p>Ongoing Projects</p>
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
</GuestLayout>