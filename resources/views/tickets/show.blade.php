@extends('layout.app')
@section('content')

<div class="container mt-4">

    <div class="card">
        <div class="card-header bg-primary text-white">
            Ticket Chat
        </div>

       <div id="message-box"
            class="card-body"
            style="height:400px; overflow-y:auto; background:#f5f7fb;">
            {{-- @dd($messages['value']) --}}
            @foreach ($ticket->messages as $msg )
            {{-- @dd($msg) --}}
                @if($msg->user_id == auth()->user()->id)
                        <div  style="background:#cfe2ff; padding:10px; margin:10px; text-align:right;">
                            <b> {{ $msg->user->name}}</b><br>
                                {{$msg->message}}
                        </br>
                        <div class="content">
                           @foreach ($msg->attachments as $att )
                                <img  src ="{{ asset('/storage/'.$att->filepath) }}" class="img-thumbnail" style="width:250px; height:200px; object-fit:cover; display:inline-block; margin-right:8px;" >                               
                           @endforeach
                        </div>
                        </div>

                           
                    @else
                         
                        <div  style="background:#eeeeee; padding:10px; margin:10px; text-align:left;">
                        <b> {{$msg->user->name}}</b><br>
                            {{$msg->message}} 
                    </div>
                    @endif
                @endforeach

       </div>


        <div class="card-footer">
            {{-- @dd($ticket) --}}
            <form action="{{ route('tickets.reply',$ticket->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row ">
                <div class="d-flex justify-content-evenly">
                
                <div class="col-md-9">
                    <textarea name="message" class="form-control" aria-label="With textarea"></textarea>
                </div>
                <div class="col-md-2">
                     <input class="form-control form-control-sm" id="formFileSm" type="file" multiple name="photo[]" accept=".jpg,.png,.jpeg">
                </div>
                <div class="col-md-1">
                     <button type="submit" class="btn btn-primary" > Send </button>
                </div>
                </div>
            </div>

            </form>
        </div>

    </div>

</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
function fetchMessages() {
    var id = {{ $ticket->id }}; 
    var authId = {{ auth()->user()->id }};
   
    $.ajax({
     url: '/tickets/'+id+'/messages', // URL to send the request to
     type: 'GET', // HTTP method (GET, POST, etc.)
     dataType: 'json', // Expected data type from the server
     success: function(response) {
       // Code to execute if the request is successful
       if(response.error == false){
         var messages = response.messages;
            console.log(messages);
            messages.forEach(msg => {
                if(msg.user_id == authId){
                    var html = 
                    '<div  style="background:#cfe2ff; padding:10px; margin:10px; text-align:right;">'+
                    '<b>'+ msg.user.name+'</b><br>'+
                           msg.message +
                    '</div>';

                        $('#message-box').append(html);
                         readMessage(msg.id);
                       
                }else{
                     var html = 
                    '<div  style="background:#eeeeee; padding:10px; margin:10px; text-align:left;">'+
                    '<b>'+ msg.user.name+'</b><br>'+
                           msg.message +
                    '</div>';
                    $('#message-box').append(html);
                     readMessage(msg.id);
                }
            });
       }else{
        alert(response.message);
       }
            
     },
     error: function(xhr, status, error) {
       // Code to execute if the request fails
       console.error(error);
     }
});
}

    

function readMessage(messageId){
    $.ajax({
        url:"/tickets/read-message",
        type:"POST",
        dataType: 'json',
        data: {
           messageId:messageId,
           _token : $('input[name="csrf-token"]').attr('content'),
            
        },
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       
        success: function(response){
            console.log(response)
        },
        error: function(xhr, status, error) {
       // Code to execute if the request fails
       console.error(error);
     }

    })
}
setInterval(fetchMessages, 3000);
fetchMessages();
</script>

