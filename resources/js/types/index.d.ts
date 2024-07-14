export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

interface UploadedBy {
    id: number;
    name: string;
    avatar: string;
}

interface File {
    id: number;
    name: string;
    date_uploaded: string;
    uploadedBy: UploadedBy;
}

interface FilesPagination {
    total: number;
    next_url: string | null;
    previous_url: string | null;
}

interface Folder {
    id: number;
    name: string;
    projectId: number;
    files: File[];
    files_pagination: FilesPagination;
}

export type ProjectFolders = Folder[];

export interface Project {
    id: string;
    title: string;
    contractor: {
        id: string;
        name: string;
    } | null;
    start_date: string;
    due_date: string;
    canceled_date: string | null;
    completed_date: string | null;
    status: string;
    progress: string;
    desc: string;
    created_by_id: string;
    contract_sum: string;
    date_of_award: string;
    duration: string | null;
    project_number: string;
    milestones: string;
    team: {
        id: string;
        name: string;
        avatar:string
    }[];
}