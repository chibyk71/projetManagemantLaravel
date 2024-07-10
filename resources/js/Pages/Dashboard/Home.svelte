<script lang="ts">
    import Total from "@/lib/components/chart/total.svelte";
    import Income from "@/lib/components/chart/income.svelte";
    import { IconCertificate, IconCheckbox, IconClockPause, IconProgress } from "@tabler/icons-svelte";
    import { Progress } from "@sveltestrap/sveltestrap";
    import Timeline from "@/lib/components/index/timeline.svelte";
    import DasboardLayout from "@/layouts/dasboardLayout.svelte";
  
    export let data
  
    const {completedToday,pendingProjects,totalProjects,heldProjects} = data;
  </script>
<DasboardLayout>  
    <div class="page-wrapper">
          <!--overlay-->
          <div class="page-wrapper-overlay hidden" data-target=""></div>
          <!--overlay-->
      
          <!-- main content -->
          <!-- main content -->
          <div class="container-fluid">
              <!--admin dashboard-->
              <!--TOP STATS-->
              <div id="js-trigger-home-admin-wrapper">
                  <div class="row">
                  
                      <div class="col-lg-3 col-md-6 click-url cursor-pointer">
                          <div class="card">
                              <div class="card-body p-l-15 p-r-15">
                                  <div class="d-flex p-10 no-block">
                                      <span class="align-slef-center">
                                          <h2 class="m-b-0">{completedToday}</h2>
                                          <h6 class="text-muted m-b-0">Completed- Today</h6>
                                      </span>
                                      <div class="align-self-center display-6 ml-auto">
                                          <IconCheckbox class="text-success icon-Credit-Card2" size={36} />
                                      </div>
                                  </div>
                              </div>
                              <Progress value="100" bar color="success" class='h-px-3' />
                          </div>
                      </div>
                      
                      <div class="col-lg-3 col-md-6 click-url cursor-pointer">
                          <div class="card">
                              <div class="card-body p-l-15 p-r-15">
                                  <div class="d-flex p-10 no-block">
                                      <span class="align-slef-center">
                                          <h2 class="m-b-0">{totalProjects}</h2>
                                          <h6 class="text-muted m-b-0">Total Projects</h6>
                                      </span>
                                      <div class="align-self-center display-6 ml-auto py-9">
                                          <IconCertificate class="text-info icon-Credit-Card2" size={36} />
                                      </div>
                                  </div>
                              </div> 
                              <Progress value="100" bar class='h-px-3 bg-info' />
                          </div>
                      </div>
                     
                      <div class="col-lg-3 col-md-6 click-url cursor-pointer">
                          <div class="card">
                              <div class="card-body p-l-15 p-r-15">
                                  <div class="d-flex p-10 no-block">
                                      <span class="align-slef-center">
                                          <h2 class="m-b-0">{pendingProjects}</h2>
                                          <h6 class="text-muted m-b-0">Pending Projects</h6>
                                      </span>
                                      <div class="align-self-center display-6 ml-auto py-9">
                                          <IconClockPause class="text-warning icon-Coin" size={36} />
                                      </div>
                                  </div>
                              </div>
                              <Progress value="100" bar class='h-px-3 bg-warning' />
                          </div>
                      </div>
                     
                      <div class="col-lg-3 col-md-6 click-url cursor-pointer">
                          <div class="card">
                              <div class="card-body p-l-15 p-r-15">
                                  <div class="d-flex p-10 no-block">
                                      <span class="align-slef-center">
                                          <h2 class="m-b-0">{heldProjects}</h2>
                                          <h6 class="text-muted m-b-0">On-going Projects</h6>
                                      </span>
                                      <div class="align-self-center display-6 ml-auto">
                                          <IconProgress class="text-danger" size={36} />
                                      </div>
                                  </div>
                              </div>
                              <Progress value="100" bar class='h-px-3 bg-success' />
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <!--INCOME-->
                      <div class="col-lg-8 col-md-12">
                          <Income />
                      </div>
                      <!--LEADS-->
                      <!-- Column -->
                      <div class="col-lg-4 col-md-12">
                          <Total />
                      </div>
                  </div>
      
                  <div class="row">
                      <!--TIMELINE-->
                      <Timeline />
                      <!--COMMENTS-->
      
                      <!--PROJECTS-->
                      <div class="col-lg-4 col-md-12">
                          <div class="card">
                              <div class="card card-body mailbox m-b-0">
                                  <h5 class="card-title">Projects</h5>
                                  <div class="message-center dashboard-projects-admin">
                                      <!-- not started -->
                                      <a href={void 0}>
                                          <div class="btn label-default btn-circle">0</div>
                                          <div class="mail-contnet">
                                              <h5>Not Started</h5>
                                              <span class="mail-desc">Assigned to me: <strong>0</strong></span>
                                          </div>
                                      </a>
      
                                      <!-- in progress -->
                                      <a href={void 0}>
                                          <div class="btn btn-info btn-circle">3</div>
                                          <div class="mail-contnet">
                                              <h5>In Progress</h5>
                                              <span class="mail-desc">Assigned to me: <strong>0</strong></span>
                                          </div>
                                      </a>
      
                                      <!-- on hold -->
                                      <a href={void 0}>
                                          <div class="btn btn-warning btn-circle">2</div>
                                          <div class="mail-contnet">
                                              <h5>On Hold</h5>
                                              <span class="mail-desc">Assigned to me: <strong>2</strong></span>
                                          </div>
                                      </a>
      
                                      <!-- completed -->
                                      <a href={void 0}>
                                          <div class="btn btn-success btn-circle">2</div>
                                          <div class="mail-contnet">
                                              <h5>Completed</h5>
                                              <span class="mail-desc">Assigned to me: <strong>2</strong></span>
                                          </div>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /#main content -->
    </div>  
</DasboardLayout>