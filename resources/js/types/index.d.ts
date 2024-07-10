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