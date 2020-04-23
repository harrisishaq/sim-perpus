@if(isset ($errors) && count($errors) > 0)
    <div class="alert alert-danger alert-notification alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
            <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success alert-notification alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-success alert-notification alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-check"></i>
            {{ $data }}
        </div>
    @endif
@endif