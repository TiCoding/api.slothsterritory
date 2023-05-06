@component('mail::message')


@component('mail::panel')
{{__('invoice')}} {{$id ? $invoice : '00000'+$id}}
@endcomponent

@component('mail::panel')
TOUR: {{$tour['name']}}<br>
{{__('client')}}: {{$customer['name']}}<br>
{{__('agency')}}: {{$agency['name']}}<br>
{{__('schedule')}}: {{$schedule}}<br>
{{__('reservation_date')}}: {{$date}} <br>
@endcomponent


@component('mail::table')
| Tour       | {{__('client')}}         | {{__('agency')}}  | {{__('schedule')}} | {{__('reservation_date')}}
| ------------- |:-------------:|:-------------:|:-------------:| --------:|
| {{ $tour['name'] }}      | {{ $customer['name'] }}      | {{ $agency['name'] }}      | {{ $schedule }}      | {{ $date }}      |
@endcomponent

@component('mail::table')
| {{__('adults')}}       | {{__('children')}}         | {{__('free_children')}}  |
| ------------- |:-------------:| --------:|
| {{ $amount_adults }}      | {{ $amount_children }}      | {{ $amount_children_free }}      |
@endcomponent

@component('mail::table')
| Total       |  {{ $invoice ? __('invoice') : ''}}         |
| ------------- | --------:|
| ${{$total_price_dollars }}  | {{ $invoice ? $invoice : '' }}      |
@endcomponent

{{__('thanks')}},<br>
{{ config('app.name') }}
@endcomponent
