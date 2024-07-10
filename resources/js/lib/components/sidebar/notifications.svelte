<script>
    import { toggler } from '@/lib/scripts/panelToggler';
    import { IconBell, IconX } from '@tabler/icons-svelte';
    import { slide } from 'svelte/transition';
  import { Svrollbar } from 'svrollbar';

    const id = 'notification';

    let viewport;
    let contents;

    $:open = $toggler === id;
</script>

<!--notifications panel-->
<!-- right-sidebar (reusable)-->
{#if open}
    <div class="right-sidebar right-sidepanel-with-menu shw-rside" bind:this={viewport} id="sidepanel-notifications" transition:slide={{axis:'x'}}>
        <form>
            <div class="slimscrollright"  bind:this={contents}>
                <!--title-->
                <div class="rpanel-title">
                    <div class="x-top">
                        <IconBell class="sl-icon-bell" />Notifications
                        <span on:click={()=> toggler.close()}>
                            <IconX class="js-close-side-panels"/>
                        </span>
                    </div>
                    <div class="x-top-nav">
                        <a
                            class="right-sidepanel-menu active ajax-request"
                            href={void(0)}
                            id="right-sidepanel-menu-unread"
                            data-url="https://midnight.growcrm.io/events/topnav?eventtracking_status=unread"
                            data-loading-target="sidepanel-notifications-body"
                            data-target="sidepanel-notifications"
                            data-progress-bar="hidden">Unread</a
                        >
                        <span class="x-spacer">|</span>
                        <a
                            class="right-sidepanel-menu ajax-request"
                            href={void(0)}
                            data-url="https://midnight.growcrm.io/events/topnav"
                            data-loading-target="sidepanel-notifications-body"
                            data-target="sidepanel-notifications"
                            data-progress-bar="hidden">All</a
                        >
                    </div>
                </div>
                <!--title-->
                <!--body-->
                <div class="r-panel-body p-t-40" id="sidepanel-notifications-body">
                    <!--mark all read-->
                    <div class="sidepanel-notifications-mark-all-read hidden" id="sidepanel-notifications-mark-all-read">
                        <a
                            href={void(0)}
                            id="topnav-notification-mark-all-read"
                            data-url="https://midnight.growcrm.io/events/mark-allread-my-events"
                            data-progress-bar="hidden"
                            >Dismiss All Notifications
                        </a>
                    </div>
                    <a href={void(0)} id="topnav-notification-mark-all-read" data-url="https://midnight.growcrm.io/events/mark-allread-my-events" data-progress-bar="hidden">
                        <div id="sidepanel-notifications-events">
                            <!--dynamic content-->
                        </div>
    
                        <!--load more button-->
                    </a>
                    <div class="autoload d-none" id="events-panel-loadmore-button-container">
                        <a href={void(0)} id="topnav-notification-mark-all-read" data-url="https://midnight.growcrm.io/events/mark-allread-my-events" data-progress-bar="hidden">
                        </a>
                        <a data-url="" data-loading-target="" href={void(0)} class="btn btn-rounded btn-secondary js-ajax-ux-request" id="events-panel-load-more-button d-none">show more</a
                        >
                    </div>
                    <!--load more button-->
                </div>
                <!--body-->
            </div>
        </form>
        <Svrollbar {viewport} {contents} />
    </div>
{/if}
<!--sidebar-->