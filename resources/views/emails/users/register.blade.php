@component('mail::message')
# Introduction

Hello {{$user->name}}
@component('mail::button', ['url' => ''])
visit us
@endcomponent

Thanks,for join us<br>
{{ config('app.name') }}
@endcomponent
