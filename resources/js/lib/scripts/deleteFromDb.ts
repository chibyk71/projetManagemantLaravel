import Swal from "sweetalert2"
import { router } from '@inertiajs/svelte'
import { notify } from "./notify";

export const Delete = async (action:string,id:number|string) => {
    Swal.fire({
        title: "Are you sure?",
        text: action == 'team'? "Continuing will delete this users account and they won't be able to login again":"You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        showLoaderOnConfirm: true,
        preConfirm: async (login) => {
            try {
                router.delete(route(action+".delete",id),{
                    onSuccess: notify({
                        title: 'Successfull Deleted',
                        icon:'success',
                        toast: true,
                    })
                })
            } catch (error) {
                Swal.showValidationMessage(`Request failed: could not delete`);
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
      });
}