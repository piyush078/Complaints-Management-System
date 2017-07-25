@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if ($errors->has('feedback'))
    <div class="alert alert-danger">
        Could not send the Complaint. Please try again.
    </div>
@endif

@include ('layouts.panel')

@if (count($complaints) === 0) 
    <div class="panel-body">No Complaints</div>
@else
    @foreach ($complaints as $complaint) 
    <div class="panel-body" style="margin-bottom: -40px">

        <div class="alert alert-info">
            <strong style="font-size: 16px;">
                {{ $complaint->device->name }}
            </strong>
            
            ({{ \Carbon\Carbon::createFromTimeStamp(strtotime($complaint->created_at))->diffForHumans() }})<br />
            @if ($complaint->text)
                <strong>Complaint Message</strong> by <strong>{{ $complaint->user->name }}</strong> - {{ $complaint->text }}<br />
            @endif

            @if ($complaint->feedback === null)

                <div class="form-group" style="width: 70%">
                    <input type="text" class="form-control" style="margin-top: 10px;" placeholder="Feedback" />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"
                        onclick="event.preventDefault();
                                 document.getElementById('send-feedback').setAttribute('action', '{{ url('feedback/'.$complaint->id) }}');
                                 document.getElementById('feedback').value = this.parentElement.previousElementSibling.childNodes[0].value;
                                 document.getElementById('send-feedback').submit();">Send</button>
                </div>

            @else
                @if ($complaint->feedback !== null)
                    <br/><strong>Feedback</strong> - {{ $complaint->feedback }}
                @endif
            @endif
        </div>
    </div>
    @endforeach
@endif
</div>
<form id="send-feedback" method="POST" style="display: none;">
    <input id="feedback" type="hidden" name="feedback" value="" />
    {{ csrf_field() }}
</form>
