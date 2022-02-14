@component('mail::message')
<h1 style="text-align: center;">Welcome To Americal Gulf School</h1>

<table class="table table-bordered"> 
    <tbody>
        <tr>
            <td>Guardian Name</td>
            <td>{{$data['parent_name']}}</td>
        </tr>
        <tr>
            <td>Guardian Email</td>
            <td>{{$data['parent_email']}}</td>
        </tr> 
        <tr>
            <td>Guardian Number</td>
            <td>{{$data['parent_phone']}}</td>
        </tr> 
        <tr>
            <td>Child DOB</td>
            <td>{{$data['child_dob']}}</td>
        </tr> 
    </tbody>
</table>    

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thank you for your contact, we'll get in touch with you shortly.<br>
{{ config('app.name') }}
@endcomponent
