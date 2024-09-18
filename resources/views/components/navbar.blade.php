<div class="navbar w-full ccontainer p-0 m-auto" style="padding:8px 0px;">
    <div class="flex-none lg:hidden">
        <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                class="inline-block h-6 w-6 stroke-current">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </label>
    </div>
    <div class="flex-1">
        <img alt="شعار {{env('APP_NAME')}}" class="h-16" src="/logo.webp"/>
    </div>
    <div class="hidden flex-none lg:block">
        <div class="join">
            <input class="input input-bordered join-item" placeholder="البحث عن المتاجر والعروض" />
            <button class="btn join-item rounded-r-full btn-primary">بحث</button>
        </div>
    </div>
</div>
<div class=" hidden lg:block bg-primary">
    <div class="m-auto ccontainer p-0 w-full">
        <ul class="menu menu-horizontal px-1 gap-2 pr-2">
            <x-nav-menu/>
        </ul>
    </div>
</div>