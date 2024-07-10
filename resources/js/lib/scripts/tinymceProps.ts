import Swal from "sweetalert2";
import { base } from "./userStore";

let useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

interface HTMLInputEvent extends Event {
    target: HTMLInputElement & EventTarget;
}


export const OptionTinyMce = {
    statusbar: false,
    menubar: false,
    plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
    toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    importcss_append: true,
    file_picker_callback: (callback: (arg0: string) => void,value: any,meta: { filetype: string; }) => {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.addEventListener('change',(e)=> {
            const file = (e.target! as HTMLInputElement).files![0];
            const reader = new FileReader();
                            
            // FormData
            var fd = new FormData();
            var files = file;
            fd.append('filetype',meta.filetype);
            fd.append("file",files);
    
            var filename = "";
    
            // AJAX
            let xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', base+'api/upload_mce.php');
    
            xhr.onload = function() {
                let json;
                if (xhr.status != 200) {
                    Swal.fire({
                        text:'HTTP Error: ' + xhr.statusText,
                        toast: true,
                        icon: 'error',
                        timer: 1500,
                        position: 'top-right'
                    });
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json) {
                    alert('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                filename = base+json;
                reader.onload = function(e) {
                    callback(filename);
                };
                reader.readAsDataURL(file);
            };
            xhr.send(fd);
            return
        })
        input.click();
    },
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image table',
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
}