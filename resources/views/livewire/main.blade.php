<div >
  @if(auth()->user())
  <br>
    <div class="container mx-auto">
      <div class="min-w-full border rounded lg:grid lg:grid-cols-3 " >
        {{-- <div class="min-w-full border rounded lg:grid lg:grid-cols-3 " > --}}
          <div class="border-r border-gray-300 lg:col-span-1">
            <div class="mx-6 my-13">
              {{-- Serach component Inside of Main.blade.php --}}
              {{-- Send the id of user to function to start a conversation--}}
              <div class="relative text-gray-600">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    viewBox="0 0 24 24" class="w-6 h-6 text-gray-300">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
                </span>
                
                <form>
                <input wire:model.live.debounce.500ms="searchUser" type="search" class="block w-full py-2 pl-10 bg-gray-100 rounded outline-none" name="search"
                  placeholder="Search Users" required />
                </form>
               
               @if(!empty($searchUser))
                @foreach($result as $results)
                <div class="dropdown-menu d-block py-1">
                  <div class="px-2 py-1 border-bottom">
                      <div class="d-flex items-center ml-3">
          
                          <img class="h-[26px]" src="{{ asset('storage/'. $results->image) }}"> 
                          <span class="ml-2"> {{$results->name}} <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-0 px-2 rounded-full" wire:click="createConversation({{$results->id}})">chat</button></span>
                          <small></small>
                      </div>
                  </div>
              </div>
                @endforeach

                @if(count($result) <= 0)
                <div class="dropdown-menu d-block py-1">
                    <div class="px-3 py-2 border-bottom">
                        <div class="d-flex flex-column ml-3">
                            <span>No Users found!</span>
                        </div>
                    </div>
                </div>
                @endif
                @endif
              </div>
            </div>
            @livewire('chatlist')
          </div>
          <div class="hidden lg:col-span-2 lg:block">
            <div class="w-full">
              @livewire('chatbox')
              @livewire('sendmessage')
            </div>
          </div>
        </div>
      </div>

    
@else
<div class="flex justify-center py-60 ">
  <B>chatappLARAVEL IS A CHAT APPLICATION BUILT WITH LARAVEL & LIVEWIRE. BUILT WITH REALTIME COMMUNICATION USING PUSHER CHANNEL!<br>
      <a class="dark:text-blue-800" href='/login' LOG IN>LOG IN </a> TO THE APPLICATION TO START CHATTING.</B>
</div>


@endif
    </div>
