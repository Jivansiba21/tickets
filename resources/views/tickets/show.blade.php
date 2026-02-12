@foreach($tickets->messages as $msg)

<div style="
    border:1px solid #ccc;
    padding:10px;
    margin-bottom:10px;

    @if($msg->user_id == auth()->id())
        background:#e6f7ff;
        text-align:right;
    @endif
">

<strong>{{ $msg->user->name }}</strong>

<p>{{ $msg->message }}</p>

</div>

@endforeach


<form action="{{ route('tickets.reply',$tickets->id) }}" method="POST">
    @csrf

    <textarea name="message" required></textarea>

    <button type="submit">Send</button>

</form>
