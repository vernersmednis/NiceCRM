<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    
    public function definition(): array
    {
        // Generate a random company domain
        $companyDomain = $this->faker->domainName();
    
        // Fetch the company logo from Clearbit's API
        $logoUrl = "https://logo.clearbit.com/{$companyDomain}";
    
        // Fetch the logo contents
        $logoContents = Http::get($logoUrl)->body();
    
        // Save the logo in public/storage/logos
        $logoName = 'logo_' . $this->faker->unique()->uuid . '.png';
        Storage::disk('public')->put('logos/' . $logoName, $logoContents);
    
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'logo' => 'logos/' . $logoName,  // Store the path to the locally saved logo
        ];
    }
    
}
