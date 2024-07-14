<script lang='ts'>
	import { IconArrowUp } from "@tabler/icons-svelte";
	import { onMount } from "svelte";

     /**
   * Scroll top button
   */
  let scrollTop: HTMLAnchorElement

    onMount(()=> {
        if (scrollTop && scrollTop !== undefined) {
            const togglescrollTop = function() {
                window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
            }
            window.addEventListener('load', togglescrollTop);
            document.addEventListener('scroll', togglescrollTop);
            scrollTop.addEventListener('click', () => {window.scrollTo({
            top: 0,
            behavior: 'smooth'
            })});
        }

    })
</script>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer py-4">
        <div class="footer-legal text-center relative">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>UpConstruction</span></strong>. All Rights Reserved
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <a bind:this={scrollTop} href={void(0)} class="scroll-top flex items-center justify-center"><IconArrowUp class="" /></a>