<script>
  import { toggler } from "$lib/scripts/panelToggler";


  import { IconFilterBolt, IconX } from "@tabler/icons-svelte";
    import Svelecte from "svelecte";
    const id = 'filter-contractor'
</script>
<!-- right-sidebar -->
<div class="right-sidebar animate__animated animate__bounceIn" class:shw-rside={$toggler == id}>
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <IconFilterBolt class="icon-Filter-2" />Filter Clients
                <span on:click={()=>toggler.close()}>
                    <IconX class="ti-close" />
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <!--company name-->
                <div class="filter-block">
                    <div class="title">
                        Company Name
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <!--select2 basic search-->
                                <Svelecte options={[]} />
                                <!--select2 basic search-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--company name-->

                <!--categories-->
                <div class="filter-block">
                    <div class="title">
                        Category
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <Svelecte options={[]} />
                            </div>
                        </div>
                    </div>
                </div>
                <!--categories-->

                <!--tags-->
                <div class="filter-block">
                    <div class="title">
                        Tags
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <Svelecte options={[]} />
                            </div>
                        </div>
                    </div>
                </div>
                <!--tags-->

                <!--filter item-->
                <div class="filter-block">
                    <div class="title">
                        Date Created
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="date" name="filter_date_created_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="Start">
                            </div>
                            <div class="col-md-6">
                                <input type="date" name="filter_date_created_end" autocomplete="off"
                                    class="form-control form-control-sm pickadate" placeholder="End">
                            </div>
                        </div>
                    </div>
                </div>
                <!--filter item-->

                <!--status-->
                <div class="filter-block">
                    <div class="title">
                        Status
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <Svelecte options={[]} />
                            </div>
                        </div>
                    </div>
                </div>
                <!--status -->

                <!--buttons-->
                <div class="buttons-block">
                    <button type="reset" name="foo1" class="btn btn-rounded-x btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-rounded-x btn-danger apply-filter-button">Apply Filter</button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>