import Swal, { type SweetAlertOptions } from "sweetalert2"

export const notify = (opt?:SweetAlertOptions)=> {
    Swal.fire({
        position: 'top-end',
        icon: opt?.icon || "success",
        title: opt?.title ||'Your work has been saved',
        showConfirmButton: false,
        timer: 1500,
        toast:true
    })
}