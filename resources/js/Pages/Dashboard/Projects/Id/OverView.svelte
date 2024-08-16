<script lang="ts">
	import Avatar from '@/lib/components/avatar.svelte';
    import Progress from "@/lib/components/chart/progress.svelte";
  import { fDate } from '@/lib/scripts/fdate';
    import { base } from "@/lib/scripts/userStore";
    import ProjectLayout from './ProjectLayout.svelte';

    export let project;
</script>
<ProjectLayout data={project}>
    <!-- page content -->
    <div class="row m-t-10" id="projects-tab-split-screen">
    
        <!--project details section-->
        <div class="col-md-12 col-lg-6 hide_tabbed_section">
            <div class="card min-h-300">
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="card-body tab-body p-t-10">
                            <!-- Column -->
                            <div class="card" id="project_details">
                                <div class="card-body p-t-0 p-b-0">
                                    <div class="x-each-field m-b-18">
                                        <div class="panel-label p-b-3">Project Number</div>
                                        <div class="x-content">{project.project_number}</div>
                                    </div>
                                    <div class="x-each-field m-b-18">
                                        <div class="panel-label p-b-3">Contract Sum</div>
                                        <div class="x-content">{project.contract_sum}</div>
                                    </div>
                                    <div class="x-each-field m-b-18">
                                        <div class="panel-label p-b-3">Date Of Award</div>
                                        <div class="x-content">{fDate(project.date_of_award)}</div>
                                    </div>
                                    <div class="x-each-field m-b-18">
                                        <div class="panel-label p-b-3">Duration</div>
                                        <div class="x-content">{project.duration}</div>
                                    </div>
                                </div>
                                <div class="m-t-10 m-b-10">
                                    <hr>
                                </div>
                                <div class="card-body p-t-10 p-b-10" id="project_progress_container">
                                    <!--project progress-->
                                    <div class="d-flex no-block">
                                        <div class="align-self-end no-shrink">
                                            <h5 class="m-b-0">Progress</h5>
                                            <!--[team]-->
                                            <h6 class="text-muted">Manually Set Progress</h6>
                                        </div>
                                        <div class="ml-auto">
                                            <Progress data={project?.progress||0} />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="m-t-10 m-b-10">
                                    <hr>
                                </div>
                                <div class="card-body p-t-0 p-b-0">
                                    <!--[client details]-->
                                    <div class="p-b-20">
                                        <h6><a href={void(0)}>{project?.contractor.name}</a></h6>
                                    </div>
    
                                    <!--assigned-->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="panel-label p-b-3">Assigned</div>
                                            <div>
                                                {#if project?.team}
                                                    {#each project.team as user}
                                                         <Avatar title='{user?.name}' src={user?.avatar} />
                                                    {/each}
                                                {/if}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-10 m-b-10">
                                    <hr>
                                </div>
                                <!--dates-->
                                <div class="card-body p-t-0 p-b-0">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div>
                                                <div class="panel-label p-b-3">Start Date</div>
                                                <div>{fDate(project.start_date)}</div>
                                            </div>
    
                                        </div>
                                        <div class="col-sm-6">
                                            <div>
                                                <div class="panel-label p-b-3">Due Date</div>
                                                <div>{fDate(project.due_date)}</div>
                                            </div>
                                            <div class="m-t-20">
                                                <div class="panel-label p-b-3">Status</div>
                                                <div><span class="label label-outline-warning">{project.status}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-10 m-b-10">
                                    <hr>
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/#project details section-->
    
        <!--dynamic ajax section-->
        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="tab-content">
                    <div class="tab-pane active ext-ajax-container" id="projects_ajaxtab" role="tabpanel">
                        <div class="card-body tab-body tab-body-embedded project-timeline"
                            id="embed-content-container">
                            <div class="profiletimeline p-t-30" id="timeline-container">
                                {#if project.notifications}
                                    {#each project.notifications as {id,affected_user_id,message,date_created,created_by}}
                                        <div class="sl-item timeline">
                                            <div class="sl-left">
                                                <img src="public/storage/avatar/'+created_by.avatar}" alt={created_by.name} class="img-circle">
                                            </div>
                                            <div class="sl-right">
                                                <div>
                                                    <div class="x-meta"><a href={void(0)} class="link">{created_by.name}</a> <span class="sl-date">{fDate(date_created)}</span>
                                                    </div>
                                                    {@html message}
                                                </div>
                                            </div>
                                        </div>
                                    {:else}
                                        <p class="">Nothing to show</p>
                                    {/each}
                                {/if}                    
                            </div>
    
                            <!--load more-->
                            <div class="autoload loadmore-button-container" id="timeline_see_more_button">
                                <a href={void(0)} class="btn btn-rounded-x btn-secondary js-ajax-ux-request" id="load-more-button">show more</a>
                            </div>
                            <!--load more-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</ProjectLayout>
            