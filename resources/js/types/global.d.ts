import { PageProps as InertiaPageProps } from '@inertiajs/core';
import { AxiosInstance } from 'axios';
import { route as routeFn } from 'ziggy-js';
import { PageProps as AppPageProps } from './';

declare global {
    interface Window {
        axios: AxiosInstance;
    }

    var route: typeof routeFn;
}

declare module '@inertiajs/svelte' {
    interface PageProps extends InertiaPageProps, AppPageProps {}
}

export {}