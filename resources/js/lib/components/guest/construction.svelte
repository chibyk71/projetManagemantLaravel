<script lang="ts">
	import { base } from '$lib';
	import { onMount } from 'svelte';

	let projects: any[] = [];
	export let limit = 12;

	onMount(async () => {
		projects = await fetch(base + 'api/products.php?projects&limit=' + limit).then((res) =>
			res.json()
		);
	});
</script>

<div class="lg:grid gap-x-4 gap-y-8 grid-cols-2">
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
</div>
