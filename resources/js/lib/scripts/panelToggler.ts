import { writable } from "svelte/store";

const { subscribe, set, update} = writable<string>('');

export const toggler = {
    subscribe,
    set,
    update,
    open: (pannelId:string) => {
        update((panels) => {
            panels = panels === pannelId? '': pannelId
            return panels
        })
    },
    close: () => {
        set('')
    }
}