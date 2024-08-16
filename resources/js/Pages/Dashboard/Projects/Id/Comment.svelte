<script lang="ts">
    import { IconTrash } from '@tabler/icons-svelte';
  import { base } from '@/lib/scripts/userStore';
    import ProjectLayout from './ProjectLayout.svelte';
    
    export let data;
</script>
<ProjectLayout data>
    <div class="row m-t-10" id="projects-tab-single-screen">
        <!--dynamic ajax section-->
        <div class="col-lg-12">
            <div class="card min-h-300">
                <div class="tab-content">
                    <div class="tab-pane ext-ajax-container active" id="projects_ajaxtab" role="tabpanel">
                        <div class="card-body tab-body tab-body-embedded" id="embed-content-container">
                            <div class="card" id="comments-wrapper">
    
                                <div class="comments card-body" id="js-trigger-comments" data-payload="Zaj9XSjw3R">
    
                                    <!--complete commenting form-->
                                    <div class="post-comment display-flex flex-row" id="form-Zaj9XSjw3R">
                                        <div class="x-avatar">
                                            <img src="public/storage/avatars/u605LHNjrJleptBe6fn47Cb3jHG24GVYiZYAdeG8/avatar.jpg"
                                                class="img-circle" alt="user" width="40">
                                        </div>
                                        <!--placeholder textbox-->
                                        <div class="form-group row x-message-field x-message-field-placeholder js-toggle-placeholder-element"
                                            id="placeholder-container-Zaj9XSjw3R"
                                            data-show-element-container="editor-container-Zaj9XSjw3R">
                                            <textarea class="form-control form-control-sm w-100"
                                                rows="1">Post a comment...</textarea>
                                        </div>
                                        <!--TODO rich text editor-->
                                    </div>
                                    <!--/#complete commenting form-->
    
                                    <!--ajax content here-->
                                    <div class="comment-widgets" id="comments-container">
                                        <div class="display-flex flex-row comment-row" id="comment_272">
                                            <div class="p-2">
                                                <img src="public/storage/avatars/u605LHNjrJleptBe6fn47Cb3jHG24GVYiZYAdeG8/avatar.jpg" class="img-circle" alt="user" width="40">
                                            </div>
                                            <div class="comment-text w-100 js-hover-actions">
                                                <div class="row">
                                                    <div class="col-sm-6 x-name">Steven</div>
                                                    <div class="col-sm-6 x-meta text-right">
                                                        <!--actions-->
                                                        <span class="comment-actions js-hover-actions-target hidden">
                                                            <a href={void(0)}>
                                                                <i class="sl-icon-trash"></i>
                                                            </a>
                                                        </span>
                                                        <!--actions-->
                                                        <span class="text-muted x-date"><small>1 hour ago</small></span>
                                                    </div>
                                                </div>
                                                <div>You can also review this second layout.<br><br><br><img
                                                        src="public/storage/files/7W2x7B6ANWzjF4NqU6UUYL1WPFR0cvI8sewm0XXx/img.jpg"
                                                        alt="" width="583" height="387"></div>
                                            </div>
                                        </div>
                                        <!--each comment -->
                                        <!-- each comment -->
                                        <div class="display-flex flex-row comment-row" id="comment_271">
                                            <div class="p-2">
                                                <img src="public/storage/avatars/u605LHNjrJleptBe6fn47Cb3jHG24GVYiZYAdeG8/avatar.jpg"
                                                    class="img-circle" alt="user" width="40">
                                            </div>
                                            <div class="comment-text w-100 js-hover-actions">
                                                <div class="row">
                                                    <div class="col-sm-6 x-name">Steven</div>
                                                    <div class="col-sm-6 x-meta text-right">
                                                        <!--actions-->
                                                        <span class="comment-actions js-hover-actions-target hidden">
                                                            <a href={void(0)} class="btn-outline-danger confirm-action-danger">
                                                                <IconTrash class="sl-icon-trash" />
                                                            </a>
                                                        </span>
                                                        <!--actions-->
                                                        <span class="text-muted x-date"><small>1 hour ago</small></span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p>Please review this new design and let me know if any changes are
                                                        required.</p>
                                                    <p><img src="public/storage/files/Ytfxp64Ce2NL8T2IKNaoBNCEnAi8n01cUInUCNct/img.jpg"
                                                            alt="" width="497" height="371"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--each comment -->
                                    </div>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</ProjectLayout>