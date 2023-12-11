<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
عذراً ... حدث خطأ غير متوقع !!!
@else
<b dir="rtl">👋🏻 مرحباً في موقع {{Site()->site_name}}</b>
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'success',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation 
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ config('app.name') }}
@endif
--}}

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
<span dir="rtl">@lang(
    "اذا واجهت مشكلة في الضغط على زر \":actionText\" , قم بالضغط على الرابط التالي :\n",
    [
        'actionText' => $actionText,
    ]
) </span> <br> <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
