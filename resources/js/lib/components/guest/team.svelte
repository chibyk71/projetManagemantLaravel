<script>
    import { onMount } from "svelte";
    let sponsors = null;

	import { asset } from "../../scripts/userStore";
    import axios from "axios";

    onMount(async ()=>{
        await axios.get(route("sponsor.api"))
        .then((res)=>{
            sponsors = res.data
        }).catch((e)=>{
            console.log(e);  
        })
    })

</script>
  <!-- ======= Our Team Section ======= -->
<section id="team" class="team">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>Rescue Mission Team</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-y-5 place-content-center">

            {#if sponsors}
                {#each sponsors as {image,title,name,description}, index (image)}
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{asset+image}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info text-center">
                            <h4 class="uppercase"><small>{title}</small> <b>{name}</b></h4>
                            <span class="capitalize">{description}</span>
                        </div>
                    </div><!-- End Team Member -->
                {/each}
            {/if}
        </div>

    </div>
</section><!-- End Our Team Section -->