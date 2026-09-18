<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use Illuminate\Database\Seeder;

class BangladeshGeoSeeder extends Seeder
{
    public function run(): void
    {
        $geoData = [
            'Dhaka' => [
                'bn_name' => 'ঢাকা',
                'districts' => [
                    'Dhaka' => ['bn_name' => 'ঢাকা', 'upazilas' => ['Dhanmondi', 'Gulshan', 'Banani', 'Mirpur', 'Uttara', 'Mohammadpur', 'Motijheel', 'Tejgaon', 'Badda', 'Savar']],
                    'Gazipur' => ['bn_name' => 'গাজীপুর', 'upazilas' => ['Gazipur Sadar', 'Kaliakair', 'Kapasia', 'Sreepur', 'Kaliganj']],
                    'Narayanganj' => ['bn_name' => 'নারায়ণগঞ্জ', 'upazilas' => ['Narayanganj Sadar', 'Araihazar', 'Bandar', 'Rupganj', 'Sonargaon']],
                    'Tangail' => ['bn_name' => 'টাঙ্গাইল', 'upazilas' => ['Tangail Sadar', 'Gopalpur', 'Ghatail', 'Madhupur', 'Mirzapur']],
                ]
            ],
            'Chittagong' => [
                'bn_name' => 'চট্টগ্রাম',
                'districts' => [
                    'Chittagong' => ['bn_name' => 'চট্টগ্রাম', 'upazilas' => ['Panchlaish', 'Kotwali', 'Halishahar', 'Pahartali', 'Hathazari', 'Sitakunda']],
                    'Cox\'s Bazar' => ['bn_name' => 'কক্সবাজার', 'upazilas' => ['Cox\'s Bazar Sadar', 'Chakaria', 'Teknaf', 'Ramu', 'Ukhia']],
                    'Comilla' => ['bn_name' => 'কুমিল্লা', 'upazilas' => ['Comilla Sadar', 'Debidwar', 'Chandina', 'Laksam', 'Burichang']],
                ]
            ],
            'Rajshahi' => [
                'bn_name' => 'রাজশাহী',
                'districts' => [
                    'Rajshahi' => ['bn_name' => 'রাজশাহী', 'upazilas' => ['Boalia', 'Motihar', 'Rajpara', 'Paba', 'Godagari', 'Bagmara']],
                    'Bogra' => ['bn_name' => 'বগুড়া', 'upazilas' => ['Bogra Sadar', 'Sherpur', 'Shibganj', 'Gabtali', 'Dhunat']],
                ]
            ],
            'Khulna' => [
                'bn_name' => 'খুলনা',
                'districts' => [
                    'Khulna' => ['bn_name' => 'খুলনা', 'upazilas' => ['Khulna Sadar', 'Daulatpur', 'Khalishpur', 'Dumuria', 'Rupsha']],
                    'Jessore' => ['bn_name' => 'যশোর', 'upazilas' => ['Kotwali', 'Jhikargachha', 'Keshabpur', 'Manirampur']],
                ]
            ],
            'Sylhet' => [
                'bn_name' => 'সিলেট',
                'districts' => [
                    'Sylhet' => ['bn_name' => 'সিলেট', 'upazilas' => ['Kotwali', 'Beanibazar', 'Golapganj', 'Fenchuganj', 'Biswanath']],
                ]
            ],
            'Barisal' => [
                'bn_name' => 'বরিশাল',
                'districts' => [
                    'Barisal' => ['bn_name' => 'বরিশাল', 'upazilas' => ['Barisal Sadar', 'Bakerganj', 'Babuganj', 'Gournadi']],
                ]
            ],
            'Rangpur' => [
                'bn_name' => 'রংপুর',
                'districts' => [
                    'Rangpur' => ['bn_name' => 'রংপুর', 'upazilas' => ['Rangpur Sadar', 'Badarganj', 'Gangachara', 'Pirganj']],
                    'Dinajpur' => ['bn_name' => 'দিনাজপুর', 'upazilas' => ['Dinajpur Sadar', 'Birganj', 'Biral', 'Parbatipur']],
                ]
            ],
            'Mymensingh' => [
                'bn_name' => 'ময়মনসিংহ',
                'districts' => [
                    'Mymensingh' => ['bn_name' => 'ময়মনসিংহ', 'upazilas' => ['Mymensingh Sadar', 'Muktagachha', 'Trishal', 'Bhaluka']],
                ]
            ],
        ];

        foreach ($geoData as $divName => $divInfo) {
            $division = Division::firstOrCreate(
                ['name' => $divName],
                ['bn_name' => $divInfo['bn_name']]
            );

            foreach ($divInfo['districts'] as $distName => $distInfo) {
                $district = District::firstOrCreate(
                    ['division_id' => $division->id, 'name' => $distName],
                    ['bn_name' => $distInfo['bn_name']]
                );

                foreach ($distInfo['upazilas'] as $upazilaName) {
                    Upazila::firstOrCreate([
                        'district_id' => $district->id,
                        'name' => $upazilaName,
                    ]);
                }
            }
        }
    }
}
