<script lang="ts">
	import { page } from '@inertiajs/svelte';
	import Navbar from '@/lib/components/guest/navbar.svelte';
	import { onMount } from 'svelte';
	import { base } from '@/lib/scripts/userStore';
	import Projects from '@/lib/components/guest/projects.svelte';
    import GuestLayout from '@/layouts/guestLayout.svelte';

    export let projects: {
		Files: string;
		milestones: string;
		status: 'IN_PROGRESS'|'ON_HOLD'|'COMPLETED'|'NOT_STARTED'|'CANCELED';
		date_of_award: string | number | Date;
		due_date: string | number | Date;
		start_date: string | number | Date;
		contractor: string;
		project_number: string;
		description: string; 
        title: string; 
    };

    export let stages;

    const toDate = (d:string | number | Date) =>{
        return new Date(d).toLocaleDateString("en-NG",{month:'short',year:"numeric"})
    }

    const convertStatus = (status:"YET_TO_COMMENCE"|"IN_PROGRESS"|"COMPLETED")=>{
        if (status === 'COMPLETED') {
            return 'completed.svg'
        }

        if (status === 'YET_TO_COMMENCE') {
            return 'cancelled.svg'
        }

        return 'in_progress.svg'
    } 

    let statusColor = 'bg-green-500'
    
    onMount(async ()=>{
        switch (projects.status) {
            case "CANCELED":
                statusColor = 'bg-red-500'
                break;
            case 'IN_PROGRESS':
            case 'COMPLETED':
                statusColor = 'bg-green-500'
                break;
            case 'ON_HOLD':
            case 'NOT_STARTED':
                statusColor = 'bg-gray-500'
                break;
            default:
                break;
        }
    })
    console.log(projects);
    
    $:loading = !projects
</script>
<GuestLayout>
    {#if !loading}
        <Navbar />
        
        <main id="main">
        
            <!-- ======= Breadcrumbs ======= -->
            <div class="breadcrumbs flex items-center" style="background-image: url('{base}storage/projects/home.jpg');">
                <div class="container relative flex flex-col items-center" data-aos="fade">
        
                    <h2>Project Details</h2>
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li>Project Details</li>
                    </ol>
        
                </div>
            </div><!-- End Breadcrumbs -->
        
            <!-- ======= Projet Details Section ======= -->
            <section id="project-details" class="project-details">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="grid grid-cols-12 gap-x-4 mt-4">
                        <div class="lg:col-span-8 col-span-12 order-2 lg:order-1">
                            <div class="portfolio-description">
                                <h2>{projects.title}</h2>
                                
                                <div class="">{@html projects.desc}</div>
        
                            </div>
                            <Projects data={stages} />
                        </div>
        
                        <div class="lg:col-span-4 col-span-12 order-1 lg:order-2">
                            <div class="portfolio-info">
                                <h3>Project information</h3>
                                <ul>
                                    <li><strong>Project NO.:</strong> <span>{projects.project_number}</li>
                                    <li class="flex"><strong>Project Status</strong> <span class="px-3 rounded-lg text-gray-200 {statusColor}">{projects.status.replaceAll("_"," ")}</li>
                                    <li><strong>Contractor</strong> <span>{projects.contractor[0].name}</span></li>
                                    <li><strong>Project Award Date</strong> <span>{toDate(projects.date_of_award)}</span></li>
                                    <li><strong>Project Start Date</strong> <span>{toDate(projects.start_date)}</span></li>
                                    <li><strong>Project Due Date</strong> <span>{toDate(projects.due_date)}</span></li>
                                    <li><strong>Project Sum Amount </strong> <span>#{projects.contract_sum}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
    
                    <section id="services" class="services section-bg">
                        <div class="container aos-init aos-animate" data-aos="fade-up">
            
                            <div class="section-header !pb-8">
                                <h2>Sub Projects</h2>
                            </div>
            
                            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-4">
                                {#each projects.milestones as item}
                                    <div class="aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                        <div class="service-item  position-relative">
                                            <div class="icon">
                                                <img src='{convertStatus(item.status)}' class="" alt="">
                                            </div>
                                            <h3>{item.name}</h3>
                                            <p>Contractor:{item.contractor.name}</p>
                                            <div class="w-full bg-gray-200 rounded-lg">
                                                <div class="bg-[var(--color-primary)] p-0.5 text-center text-xs font-medium leading-none text-primary-100"
                                                  style="width:{item.progress}%">
                                                  {item.progress}%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {/each}
                            </div>
            
                        </div>
                    </section>
        
                </div>
            </section><!-- End Projet Details Section -->
        
        </main>
    {:else}
        <div id="preloader"></div>
    {/if}
</GuestLayout>