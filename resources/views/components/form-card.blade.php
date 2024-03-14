<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
    </div>

    <form>
        <div class="card-body">
            {{ $slot }}
        </div>
        @if(isset($footer))
        <div class="card-footer">
                {{ $footer }}
        </div>
        @endif
    </form>
</div>