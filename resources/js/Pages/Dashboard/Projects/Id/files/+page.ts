// import { base } from '$lib/scripts/userStore';
// import { error } from '@sveltejs/kit';
// import type { PageLoad } from './$types';

// export const load = (async ({params}) => {
//     try {
//         const files = await fetch(base+"api/project_files.php?id="+params.id,{
//             method:"get"
//         }).then(r=>r.json())
//         .then((res)=> {
//             if(!res.status){
//                 return error(401,{message:res.message})
//             }
//             return res.files
//         })

//         return {files};
//     } catch (error) {
//         console.error('Error fetching data from the database:', error);
//     } 

// }) satisfies PageLoad;