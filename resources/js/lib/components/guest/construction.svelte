<script>
    import { parseStatus } from '@/lib/scripts/parceStatus';
    import { asset } from '@/lib/scripts/userStore';
    import { inertia } from "@inertiajs/svelte";

	export let projects;

</script>
<div class="lg:grid gap-x-4 gap-y-8 grid-cols-2">
    {#each projects as item}
        <div class="construction-card">
            <div class="card-image">
                <img src="{asset}{item.image}" alt="Project Image">
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