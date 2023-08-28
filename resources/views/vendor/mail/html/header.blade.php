<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('\logo\seventh-day-adventist-logo.png')}}" class="logo" alt="Seventh Day">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
