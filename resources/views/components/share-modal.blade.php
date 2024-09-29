<dialog id="share_modal_{{$id}}_o" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold mb-6 mt-2">شارك الكوبون مع اصدقائك ومعارفك</h3>
        <ul class="grid items-stretch justify-center grid-cols-3 gap-3">
            <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{$url}}" 
                    target="_blank"
                    class="btn btn-primary w-full h-[10em] flex-center-col" 
                    rel="noopener" 
                    aria-label="Share on Facebook"
                    title="Share on Facebook">
                    <x-tabler-brand-facebook class="h-16 w-16" />
                    <span>
                        Facebook
                    </span>
                </a>
            </li>

            <!-- Twitter -->
            <li>
                <a href="https://twitter.com/intent/tweet?url={{$url}}&text=%0A{{$title}}%0A" 
                    target="_blank"
                    class="btn btn-primary w-full h-[10em] flex-center-col" 
                    rel="noopener" 
                    aria-label="Share on Twitter"
                    title="Share on Twitter">
                    <x-tabler-brand-x class="h-16 w-16" />
                    <span>
                        X (Twitter)
                    </span>
                </a>
            </li>

            <!-- Reddit -->
            <li>
                <a href="https://www.reddit.com/submit?url={{$url}}&title={{$title}}" 
                    target="_blank"
                    class="btn btn-primary w-full h-[10em] flex-center-col" 
                    rel="noopener" 
                    aria-label="Share on Reddit"
                    title="Share on Reddit">
                    <x-tabler-brand-reddit class="h-16 w-16" />
                    <span>
                        Reddit
                    </span>
                </a>
            </li>

            <!-- LinkedIn -->
            <li>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{$url}}" 
                    target="_blank"
                    class="btn btn-primary w-full h-[10em] flex-center-col" 
                    rel="noopener" 
                    aria-label="Share on LinkedIn"
                    title="Share on LinkedIn">
                    <x-tabler-brand-linkedin class="h-16 w-16" />
                    <span>
                        LinkedIn
                    </span>
                </a>
            </li>

            <!-- WhatsApp -->
            <li>
                <a href="https://wa.me/?text={{$title}}%20{{$url}}" 
                    target="_blank"
                    class="btn btn-primary w-full h-[10em] flex-center-col" 
                    rel="noopener" 
                    aria-label="Share on WhatsApp"
                    title="Share on WhatsApp">
                    <x-tabler-brand-whatsapp class="h-16 w-16" />
                    <span>
                        WhatsApp
                    </span>
                </a>
            </li>

            <!-- Telegram -->
            <li>
                <a href="https://telegram.me/share/url?url={{$url}}&text={{$title}}" 
                    target="_blank"
                    class="btn btn-primary w-full h-[10em] flex-center-col" 
                    rel="noopener" 
                    aria-label="Share on Telegram"
                    title="Share on Telegram">
                    <x-tabler-brand-telegram class="h-16 w-16" />
                    <span>
                        Telegram
                    </span>
                </a>
            </li>

            <!-- Snapchat -->
            <li>
                <a href="https://snapchat.com/scan?share={{$url}}" 
                    target="_blank"
                    class="btn btn-primary w-full h-[10em] flex-center-col" 
                    rel="noopener" 
                    aria-label="Share on Snapchat"
                    title="Share on Snapchat">
                    <x-tabler-brand-snapchat class="h-16 w-16" />
                    <span>
                        Snapchat
                    </span>
                </a>
            </li>

            <!-- Pintrest -->
            <li>
                <a href="https://pinterest.com/pin/create/button/?url={{$url}}&description={{$title}}" 
                    target="_blank"
                    class="btn btn-primary w-full h-[10em] flex-center-col" 
                    rel="noopener" 
                    aria-label="Share on Pinterest"
                    title="Share on Pinterest">
                    <x-tabler-brand-pinterest class="h-16 w-16" />
                    <span>
                        Pinterest
                    </span>
                </a>
            </li>

            <!-- VK -->
            <li>
                <a href="https://vk.com/share.php?url={{$url}}&title={{$title}}" 
                    target="_blank"
                    class="btn btn-primary w-full h-[10em] flex-center-col" 
                    rel="noopener" 
                    aria-label="Share on VK"
                    title="Share on VK">
                    <x-tabler-brand-vk class="h-16 w-16" />
                    <span>
                        VK
                    </span>
                </a>
            </li>
        </ul>
        <form method="dialog" class="absolute p-2 top-0 left-0">
            <button aria-label="اغلاق" class="btn btn-circle btn-sm"><x-tabler-x /></button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button aria-label="اغلاق" >اغلاق</button>
    </form>
</dialog>
