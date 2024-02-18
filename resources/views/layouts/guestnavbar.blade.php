


<nav x-data="{ open: false }" class=" bg-white bg-blue-500 dark:bg-gray-400 border-b border-gray-100">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
        <div class="flex">
            <!-- Logo -->
            <div class="shrink-0 flex items-center ">
                {{-- <a href="{{ route('welcome') }}"> --}}
                    <x-application-logo class="block h-5 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>            
            </div>
     </div>
    </div>
</div>
</nav>

  
<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-end z-10">
           
    @auth
       
    {{-- <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Dashboard</a> --}}
    @else
   
            <div class="sm:fixed sm:top-0 sm:right-10 p-5 text-end z-10">
              
                
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" >    {{ __('Login') }}
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" >    {{ __('Register') }}
            </a>
            </div>
            @endif
    @endauth
</div>
