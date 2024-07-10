// import { redirect } from '@sveltejs/kit';
// import type { LayoutLoad } from './$types';
// import { base } from '$lib/scripts/userStore';

// export const load = (async ({params}) => {
//     const id =  params.id
//     const projectDetails = await fetch(base+"api/projects.php?id="+id+"&layout")
//     .then(r=>r.json())
//     .then(res => res.Projects)
    

//     if (projectDetails) {
//         return {projectDetails};
//     }

//     throw redirect(301,'/404/')
    
// }) satisfies LayoutLoad;