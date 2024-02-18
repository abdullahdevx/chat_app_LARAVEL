<div>

    @if($selectedConversation)
     <div class="relative flex items-center p-3 border-b border-gray-300">
                  @if($selectedConversation->receiver_id == auth()->user()->id)
                <img class="h-[36px] object-cover w-10 h-10 rounded-full" src="{{ asset('storage/'. $senderInstance->image) }}"> 
                <span class="block ml-2 font-bold text-gray-600">{{$senderInstance->name}}</span>
                {{-- <img class="h-[26px]" src="{{ asset('storage/'. $senderInstance->image) }}">  --}}

      @else
      <img class="h-[36px] object-cover w-10 h-10 rounded-full" src="{{ asset('storage/'. $receiverInstance->image) }}"> 
                <span class="block ml-2 font-bold text-gray-600">{{$receiverInstance->name}}</span>
                @endif
                {{-- <span class="absolute w-3 h-3 bg-green-600 rounded-full left-10 top-3"> --}}
                </span>
                {{-- dropdown start--}}
                <div x-data="{ open: false }" class="relative inline-block text-left  justify-end">

                  <!-- Trigger button -->
                  {{-- <div class="flex justify-end">
                  <button @click="open = !open" type="button" class="inline-flex justify-center items-center p-2 text-gray-400 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                      </svg>
                  </button>
                  </div> --}}
                  <!-- Dropdown content -->
                  {{-- <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                      <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                          <!-- Dropdown items go here -->
                          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Delete Chat</a>
                      </div>
                  </div> --}}
              
              </div>
              
            </div>
              
                
          <div class=" h-[45rem] relative w-full p-6 overflow-y-auto">             
            <ul class="space-y-2">
            @foreach($messages as $message)
                  @if($message->sender_id == auth()->user()->id)
                  <li class="flex justify-end ">
                <div class=" flex px-2 py-1.5  rounded shadow bg-blue-300 break-all">
                  <span>{{$message->body}}</span>
                </div>
                  </li>
                @elseif($message->sender_id != auth()->user()->id)
                <li class="flex justify-start">
                <div class="flex  px-2 py-1.5 text-gray-700 rounded shadow break-all">
                  <span>{{$message->body}}</span>
                </div>
                </li>
                @endif

          @endforeach       
        </ul>
      </div>
              @else
  <div class="flex justify-center">
                  No Conversation Selected
  </div>
          @endif
      
</div>