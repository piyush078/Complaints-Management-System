@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if ($errors->has('text'))
    <div class="alert alert-danger">
        Could not send the Complaint. Please try again.
    </div>
@endif

@include ('layouts.panel')

@if (count($devices) === 0) 
    <div class="panel-body">No Devices</div>
@else
    @foreach ($devices as $device) 

    <div class="panel-body" style="margin-bottom: -40px">
        @if ($device->complaint)
            @if ($device->complaint->fixed === 0) 
                <div class="alert alert-danger">
            @else
                <div class="alert alert-info">
            @endif
        @else 
            <div class="alert alert-info">
        @endif

            
        <strong style="font-size: 16px;">
            {{ $device->name }}
        </strong>
        @if ($device->complaint)
            @if ($device->complaint->fixed === 0) 
                &nbsp;&nbsp;<span style="color:white; font-size: 12px; background: red; padding: 0px 5px">faulty</span>
            @endif
        @endif
        <br />
        

        @if (!$device->complaint || $device->complaint->fixed === 1)

            <div class="form-group" style="width: 70%">
                <input type="text" class="form-control" style="margin-top: 10px;" placeholder="Enter Complaint" />
            </div>

            <div class="form-group" style="width: 29%">
                <select class="form-control" id="select_mai_id">
                    <label for="mai_id">Select the Engineer:</label>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-danger"
                    onclick="event.preventDefault();
                            document.getElementById('send-complain').setAttribute('action', '{{ url('complaint/'.$device->dev_id) }}');
                            document.getElementById('text').value = this.parentElement.previousElementSibling.previousElementSibling.childNodes[0].value;
                            document.getElementById('mai_id').value = document.getElementById('select_mai_id').value;
                            document.getElementById('send-complain').submit();">Mark as Faulty</button>
            </div>

        @else

            @if ($device->complaint->text !== null)
                <strong>Complaint</strong> - {{ $device->complaint->text }}
                <br />
                <strong>Complaint Sent to - </strong>{{ $device->complaint->maintainer->name }}
            @endif
            
            <div class="form-group">
                <button type="submit" class="btn btn-success" style="margin-top: 10px"  
                    onclick="event.preventDefault();
                            document.getElementById('send-complain').setAttribute('action', '{{ url('delete/'.$device->dev_id) }}');
                            document.getElementById('send-complain').submit();">Mark as Repaired</button>
            </div>

        @endif

        @if ($device->complaint) 
            @if ($device->complaint->feedback && $device->complaint->fixed === 0) 
                <strong>Complaint seen by the Maintainer</strong>
                <strong>Feedback</strong> - {{ $device->complaint->feedback }}
            @endif
        @endif
        </div>
    </div>
    @endforeach
@endif
<form id="send-complain" method="POST" style="display: none;">
    <input id="text" type="hidden" name="text" value="" />
    <input id="mai_id" type="hidden" name="mai_id" value="" />
    {{ csrf_field() }}
</form>