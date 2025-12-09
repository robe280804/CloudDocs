<x-mail::message>
    # Hi {{ $userName }}!

    You are now a new member of **CloudDocs**. 🎉

    We’re excited to have you on board! Click the button below to access your dashboard:

    @component('mail::button', ['url' => route('dashboard')])
    Go to Dashboard
    @endcomponent

    Thanks,<br>
    **The CloudDocs Team**
</x-mail::message>