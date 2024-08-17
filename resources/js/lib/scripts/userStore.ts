import { ProjectFolders } from "@/types";
import { writable } from "svelte/store";

type User = {
    id: string;
    role: string;
    name: string;
    email: string;
    phone: string;
    avatar: string;
}
  

export const userStore = writable<User>()

export const base = 'https://projectsmonitoring.com/'
export const asset = import.meta.env.DEV? "storage/": "public/storage/";


export const folders = writable<ProjectFolders>([])