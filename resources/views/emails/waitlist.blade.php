@component('mail::message')
<h1 style="text-align: center;">Welcome To Americal Gulf School</h1>

<table class="table table-bordered"> 
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{$data['name']}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$data['email']}}</td>
        </tr> 
    </tbody>
</table>    

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thank you for your contact, we'll get in touch with you shortly.<br>
{{ config('app.name') }}
@endcomponent
