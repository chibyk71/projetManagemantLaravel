import type { ComponentType } from "svelte";
import { writable } from "svelte/store";

type modalData = {
    comp: ComponentType|undefined;
    prop?: Record<string,any>
}

const {subscribe, set, update} = writable<modalData[]>([])

export const modal = {
    subscribe,
    set,
    update,
    open (data: modalData){
        set([data])
    },
    push (data: modalData) {
        update((oldValue) =>{
            oldValue.push(data)
            return oldValue
        })
    },
    prepend(data: modalData) {
        update((oldValue) =>{
            oldValue.unshift(data)
            return oldValue
        })
    },
    close(){
        update((oldValue) =>{
            oldValue.shift()
            return oldValue
        })
    },
    clear(){
        set([])
    }
    
}