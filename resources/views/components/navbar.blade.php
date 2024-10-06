<div class="navbar w-full ccontainer p-0 m-auto" style="padding:8px 0px;">
    <div class="flex-none md:hidden">
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
        <a href="/" class="md:h-16 h-11 w-auto" >
            <img alt="شعار {{env('APP_NAME')}}" width="64" height="44px" class="md:h-16 h-11 w-auto" src="/logo.webp"/>
        </a>
    </div>
    <div class="flex-none">
        <form action="{{route('store.index')}}" class="join m-0 ml-2 md:ml-6">
            <input aria-label="بحث" value="{{app('request')->input('search')}}" name="search" class="input input-bordered join-item w-[9em]" placeholder="بحث …" />
            <button aria-label="بحث" type="submit" class="btn join-item rounded-r-full btn-primary">بحث</button>
        </form>
    </div>
</div>
<div class="hidden md:block bg-primary">
    <div itemscope itemtype="https://schema.org/SiteNavigationElement" class="m-auto ccontainer p-0 w-full">
        <ul class="menu menu-horizontal px-1 gap-2 pr-2">
            <x-nav-menu/>
        </ul>
    </div>
</div>
<div class="md:hidden block bg-primary py-2">
</div>