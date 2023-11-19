@props(['errors'])

@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'error-message']) }}>
        <div class="">
            {{ __('Whoops! Quelque chose cloche...') }}
        </div>
      
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif