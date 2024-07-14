<script>
    import { parseStatus } from '@/lib/scripts/parceStatus';
    import { inertia } from "@inertiajs/svelte";

	export let projects;

</script>
<div class="lg:grid gap-x-4 gap-y-8 grid-cols-2">
    {#each projects as item}
        <div class="construction-card">
            <div class="card-image">
                <img src="storage/{item.image}" alt="Project Image">
            </div>
            <div class="card-content">
                <h3 class="project-title">{item.title}</h3>
                <p class="project-description">{item.description}</p>
                <div class="progress-bar">
                    <div class="progress" style="width: {item.progress}%;"></div>
                </div>
                <div class="card-footer">
                    <span class="project-status">Status: {parseStatus(item.status)}</span>
                    <a use:inertia href={route("guest.project.show",item.id)} class="cta-button">Learn More</a>
                </div>
            </div>
        </div>
    {/each}
</div>


<style>
    .construction-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s;
}

.construction-card:hover {
    transform: scale(1.02);
}

.card-image img {
    width: 100%;
    height: auto;
}

.card-content {
    padding: 16px;
}

.project-title {
    font-size: 1.5em;
    margin-bottom: 8px;
}

.project-description {
    font-size: 1em;
    margin-bottom: 16px;
    color: #666;
}

.progress-bar {
    background-color: #f3f3f3;
    border-radius: 5px;
    overflow: hidden;
    margin-bottom: 16px;
}

.progress {
    height: 10px;
    background-color: #4caf50;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.project-status {
    font-size: 0.9em;
    color: #333;
}

.cta-button {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.cta-button:hover {
    background-color: #0056b3;
}

</style>

<!-- <div class="lg:grid gap-x-4 gap-y-8 grid-cols-2">
	{#each projects as item}
        <details class="text-gray-600 my-5" data-aos="fade-up" data-aos-delay="100">
            <summary class="card-title">{item.title}</summary>
            <a href="/project/{item.id}" class="grid xl:grid-cols-12 gap-4">
                <div class="xl:col-span-5">
                    <div
                        class="card-bg h-full bg-contain"
                        style="background-image: url({base}uploaded/projects/{item.image});"
                    />
                </div>
                <div class="xl:col-span-7 flex items-center">
                    <div class="card-body">
                        <ul>
                            <li class="capitalize font-bold">
                                project no.: <span class="text-lg/none">{item.project_number}</span>
                            </li>
                            <li class="capitalize line-clamp-1 font-bold">
                                start date <span class="text-lg/none"
                                    >{new Date(item.due_date).toLocaleDateString('en-NG')}</span
                                >
                            </li>
                            <li class="capitalize line-clamp-1 font-bold">
                                due date <span class="text-lg/none"
                                    >{new Date(item.start_date).toLocaleDateString('en-NG')}</span
                                >
                            </li>
                            <li class="capitalize font-bold">
                                contractor <span class="text-lg/none">{item.contractor_name}</span>
                            </li>
                            <li class="capitalize font-bold">
                                progress
                                <div class="h-4 rounded-full relative bg-gray-400">
                                    <div
                                        class="h-4 rounded-full bg-purple-500 animate"
                                        style="width: {item.progress}%"
                                    ></div>
                                    <span
                                        class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white"
                                        >{item.progress}</span
                                    >
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </a>
        </details>
	{/each}
</div> -->
