<script>
	import { IconSunElectricity, IconSunFilled, IconSunMoon, IconSunHigh } from "@tabler/icons-svelte";
</script>
 <!-- ======= Alt Services Section ======= -->
 <section id="alt-services" class="alt-services">
    <div class="container" data-aos="fade-up">

        <div class="grid lg:grid-cols-12 justify-around gap-x-4">
            <div class="lg:col-span-6 img-bg" style="background-image: url(img/alt-services.jpg);"
                data-aos="zoom-in" data-aos-delay="100"></div>

            <div class="lg:col-span-5 flex flex-col justify-center">
                <h3>Why Transparency Matters</h3>
                <p>An informed citizen is a powerful one. By allowing easy access to project reports, zamfara state project monitoring software empowers you to:</p>

                <div class="icon-box flex relative" data-aos="fade-up" data-aos-delay="100">
                    <IconSunElectricity class="flex-shrink-0" />
                    <div>
                        <h4><a href={void(0)} class="stretched-link">Track progress:</a></h4>
                        <p>See how awarded projects are developing, ensuring they stay on schedule and within budget.</p>
                    </div>
                </div><!-- End Icon Box -->

                <div class="icon-box flex relative" data-aos="fade-up" data-aos-delay="200">
                    <IconSunFilled class="flex-shrink-0" />
                    <div>
                        <h4><a href={void(0)} class="stretched-link">Hold government accountable: </a></h4>
                        <p>With clear information at your fingertips, you can effectively assess how your tax dollars are being spent.</p>
                    </div>
                </div><!-- End Icon Box -->

                <div class="icon-box flex relative" data-aos="fade-up" data-aos-delay="300">
                    <IconSunMoon class="flex-shrink-0" />
                    <div>
                        <h4><a href={void(0)} class="stretched-link">Foster civic engagement:</a></h4>
                        <p>Transparency breeds trust. By opening up access to project information, we encourage active participation in shaping your community.</p>
                    </div>
                </div><!-- End Icon Box -->

            </div>
        </div>

    </div>
</section><!-- End Alt Services Section -->