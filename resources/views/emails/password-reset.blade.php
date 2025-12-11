<x-mail::message>
    # Hi {{ $userName }}!

    Your password has been update

    @component('mail::button', ['url' => route('login')])
    Sing in to CloudDocs
    @endcomponent

    Thanks,<br>
    **The CloudDocs Team**
</x-mail::message>