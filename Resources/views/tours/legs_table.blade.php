<table class="table table-sm table-borderless table-striped text-start text-nowrap align-middle mb-0">
  <tr>
    <th>&nbsp;</th>
    <th>#</th>
    <th>@lang('DSpecial::common.orig')</th>
    <th>@lang('DSpecial::common.dest')</th>
    <th class="text-center">@lang('DSpecial::common.notes')</th>
    <th class="text-center">@lang('DSpecial::common.dist')</th>
    <th class="text-center">@lang('DSpecial::common.block_time')</th>
    <th class="text-center">@lang('common.status')</th>
  </tr>
  @foreach($tour->legs->sortby('route_leg') as $leg)
    <tr>
      <td><a href="{{ route('frontend.flights.show', [$leg->id]) }}"><i class="fas fa-info-circle ms-2"></i></a></td>
      <td>{{ $leg->route_leg }}</td>
      <td>
        <img class="img-h25 me-1" src="{{ public_asset('/image/flags_new/'.strtolower(optional($leg->dpt_airport)->country).'.png') }}" alt="">
        {{ optional($leg->dpt_airport)->full_name ?? $leg->dpt_airport_id }}
      </td>
      <td>
        <img class="img-h25 me-1" src="{{ public_asset('/image/flags_new/'.strtolower(optional($leg->arr_airport)->country).'.png') }}" alt="">
        {{ optional($leg->arr_airport)->full_name ?? $leg->arr_airport_id }}
      </td>
      <td class="text-center">
        @if($leg->start_date && $leg->end_date)
          <i class="fas fa-calendar-day mx-1 text-danger"
            title="Valid Between: {{ $leg->start_date->format('d.M.Y').' - '.$leg->end_date->format('d.M.Y') }}">
          </i>
        @endif
        @if($leg->subfleets_count > 0)
          <i class="fas fa-plane mx-1 text-primary" title="Valid Only With Assigned Subfleets"></i>
        @endif
      </td>
      <td class="text-center">@if($leg->distance[$units['distance']] > 0) {{ number_format($leg->distance[$units['distance']]).' '.$units['distance'] }} @endif</td>
      <td class="text-center">@if($leg->flight_time > 0) @minutestotime($leg->flight_time) @endif</td>
      <td class="text-center">
        @if($leg_checks[$leg->route_leg] === true)
          <i class="fas fa-check-circle text-success" title="@lang('DSpecial::tours.icontrue')"></i>
        @else
          <i class="fas fa-times-circle text-danger" title="@lang('DSpecial::tours.iconfalse')"></i>
        @endif
      </td>
    </tr>
  @endforeach
</table>