<script lang="ts">
	import { asset, base } from "@/lib/scripts/userStore";
	import { IconZoomIn } from "@tabler/icons-svelte";
	import { onMount } from "svelte";
    import 'glightbox/dist/css/glightbox.css';
    import { TabContent, TabPane } from "@sveltestrap/sveltestrap";

    onMount(async () => {
        const GLightbox = (await import('glightbox')).default
        const g = GLightbox({
            selector: '.glightbox',
        })
    })

     export let data;

     const stages = ["Pre-Production","Production","Post-Production"],
        firstAv = Object.keys(data)[0];
     
</script>

<section id="projects" class="projects">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-header !pb-8">
            <h2>Gallery</h2>
        </div>
        <TabContent>
            {#each ["BEFORE","DURING","COMPLETE"] as item, index}
                <TabPane tabId={item} tab={stages[index]} active={item === firstAv}>
                    <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
                            {#if data[item]}
                                {#each data[item].data as file}
                                    {#if file.name}
                                        <div class="portfolio-item">
                                            <div class="portfolio-content h-56">
                                                <img src="{asset+file.name}" class="img-fluid object-cover h-full" alt="">
                                                <div class="portfolio-info">
                                                    <a href="storage/{file.name}" data-gallery={item} class="glightbox preview-link"><IconZoomIn /></a>
                                                </div>
                                            </div>
                                        </div>
                                    {/if}<!-- End Projects Item -->
                                {/each}
                            {:else}
                                <div class="no-result-card">
                                    <div class="no-result-icon">
                                        <!-- You can use an SVG icon here -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a7 7 0 10-14 0 7 7 0 0014 0z" />
                                        </svg>
                                    </div>
                                    <h2>No Results Found</h2>
                                    <p>Sorry, we couldn't find any results for your search. Please try different keywords or adjust your filters.</p>
                                </div>
                            {/if}
                        </div><!-- End Projects Container -->
                    </div>
                </TabPane>
            {/each}
        </TabContent>
    </div>
</section>

<style>
    .no-result-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    border: 2px dashed #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
    text-align: center;
    width: 100%;
    max-width: 400px;
    margin: 20px auto;
}

.no-result-icon {
    font-size: 48px;
    color: #ccc;
    margin-bottom: 20px;
}

.no-result-card h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.no-result-card p {
    font-size: 16px;
    color: #777;
}

</style>