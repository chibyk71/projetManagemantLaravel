import { modal } from "./modalToggler"

export const ModalClose = (node:HTMLElement,evt='click') => {
    node.addEventListener(evt, (e) => {
        e.preventDefault()
        modal.close()
    })
}