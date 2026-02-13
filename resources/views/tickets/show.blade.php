{{-- @foreach($tickets->messages as $msg)

@if($msg->user_id == auth()->id())

    <div style="background:#cfe2ff; padding:10px; margin:10px; text-align:right;">
        <b>{{ $msg->user->name }}</b><br>
        {{ $msg->message }}
    </div>

@else

    <div style="background:#eeeeee; padding:10px; margin:10px; text-align:left;">
        <b>{{ $msg->user->name }}</b><br>
        {{ $msg->message }}
    </div>

@endif

@endforeach



<form action="{{ route('tickets.reply',$tickets->id) }}" method="POST">
    @csrf

    <textarea name="message" required></textarea>

    <button type="submit">Send</button>

</form>
 --}}

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
       </div>


        <div class="card-footer">
            <form action="{{ route('tickets.reply',$tickets->id) }}" method="POST">
                @csrf

                <div class="input-group">
                    <textarea name="message" class="form-control" required></textarea>

                    <button class="btn btn-primary">
                        Send
                    </button>
                </div>

            </form>
        </div>

    </div>

</div>

@endsection

{{-- <script>
    function fetchMessages() {
        fetch("{{ route('tickets.messages', $tickets->id) }}")
            .then(response => response.json())
            .then(messages => {
                const messageBox = document.getElementById('message-box');
                messageBox.innerHTML = '';

                messages.forEach(msg => {
                    const msgDiv = document.createElement('div');
                    msgDiv.classList.add('p-2', 'mb-2');

                    if (msg.user_id === {{ auth()->id() }}) {
                        msgDiv.classList.add('bg-primary', 'text-white', 'text-end');
                    } else {
                        msgDiv.classList.add('bg-light', 'text-start');
                    }

                    msgDiv.innerHTML = `<strong>${msg.user.name}</strong><br>${msg.message}`;
                    messageBox.appendChild(msgDiv);
                });

                messageBox.scrollTop = messageBox.scrollHeight;
            });
    }

    setInterval(fetchMessages, 3000);
    fetchMessages();
</script> --}}

<script>
function fetchMessages() {

    fetch("{{ route('tickets.messages', $tickets->id) }}")
    .then(res => res.json())
    .then(messages => {

        let box = document.getElementById('message-box');
        box.innerHTML = "";

        messages.forEach(msg => {

            if(msg.user_id == {{ auth()->id() }}){
                box.innerHTML += `<div style="text-align:right;">${msg.message}</div>`;
            }else{
                box.innerHTML += `<div style="text-align:left;">${msg.message}</div>`;
            }

        });

    });
}

setInterval(fetchMessages, 3000);
fetchMessages();
</script>

