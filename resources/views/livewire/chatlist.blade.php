{{-- @persist('lelw') --}}

<div>

  <ul class="overflow-auto h-[50rem] ">
      <h2 class="my-2 mb-2 ml-2 text-lg text-gray-600">Chats</h2>
      <li>  
        @if(count($conversations) > 0)
        
        @foreach($conversations as $conversation)
          <a wire:click="chatUserSelected({{$conversation}}, {{$conversation->receiverInverseRelation->id}}, {{$conversation->senderInverseRelation->id}})"
            class="flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none">
            {{-- <img class="object-cover w-10 h-10 rounded-full"
              src="https://cdn.pixabay.com/photo/2018/09/12/12/14/man-3672010__340.jpg" alt="username" /> --}}
            <div class="w-full pb-2">
              <div class="flex justify-between">
                @if($conversation->receiver_id == auth()->user()->id) 
                <span class="block ml-2 font-semibold text-gray-600">{{$conversation->senderInverseRelation->name}}</span>
                <img class="flex object-cover h-[32px] w-10 h-10 rounded-full " src="{{ asset('storage/'. $conversation->senderInverseRelation->image) }}"> 

                @else
                <span class="block ml-2 font-semibold text-gray-600">{{$conversation->receiverInverseRelation->name}}</span>
                <img class="h-[32px] w-10 h-13 rounded-full " src="{{ asset('storage/'. $conversation->receiverInverseRelation->image) }}"> 

                @endif
                {{-- <button wire:click="mount()">dd</button> --}}
                {{-- <span class="block ml-2 text-sm text-gray-600">25 minutes</span> --}}
              </div>
              <span class="block ml-2 text-sm text-gray-600"> 
                {{$conversation->last_message}}
         </span>
            </div>
          
          </a>    
          @endforeach
      
          @else
             <div class="text-center"> No conversations </div>
          @endif
          
      
      </li>
    </ul>

</div>
{{-- @endpersist --}}
