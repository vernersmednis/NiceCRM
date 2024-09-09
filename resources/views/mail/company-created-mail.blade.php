<x-mail::message>
# Congratulations, Your Company is Now Registered!

Hello {{ $company->owner_name }},

We are excited to inform you that your company, **{{ $company->name }}**, has been successfully registered in our CRM system.

You can now manage your company's details, contacts, and more through our platform. Click the button below to access your company profile and start managing your business:

<x-mail::button :url="route('companies.show', $company->id)">
View Company Profile
</x-mail::button>

If you have any questions or need assistance, feel free to reach out to our support team.

Thanks for choosing {{ config('app.name') }}!

Best regards,<br>
The {{ config('app.name') }} Team
</x-mail::message>
