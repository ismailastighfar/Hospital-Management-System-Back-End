<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
       
        \App\Models\User::factory(1,['role' => '0'])->create();
        
        \App\Models\Patient::factory(10)->create();
       
        \App\Models\Categorie::factory(['name' => 'Liquid', 'description' => 'The active part of the medicine is combined with a liquid to make it easier to take or better absorbed. A liquid may also be called a mixture, solution or syrup. Many common liquids are now available without any added colouring or sugar.'])->create();
        \App\Models\Categorie::factory(['name' => 'Tablet', 'description' => 'The active ingredient is combined with another substance and pressed into a round or oval solid shape. There are different types of tablet. Soluble or dispersible tablets can safely be dissolved in water.' ])->create();
        \App\Models\Categorie::factory(['name' => 'Capsules', 'description' => 'The active part of the medicine is contained inside a plastic shell that dissolves slowly in the stomach. You can take some capsules apart and mix the contents with your childs favourite food. Others need to be swallowed whole, so the medicine isn’t absorbed until the stomach acid breaks down the capsule shell.'])->create();
        \App\Models\Categorie::factory(['name' => 'Topical medicines', 'description' => 'These are creams, lotions or ointments applied directly onto the skin. They come in tubs, bottles or tubes depending on the type of medicine. The active part of the medicine is mixed with another substance, making it easy to apply to the skin.'])->create();
        \App\Models\Categorie::factory(['name' => 'Suppositories', 'description' => 'The active part of the medicine is combined with another substance and pressed into a bullet shape so it can be inserted into the bottom. Suppositories must not be swallowed.'])->create();
        \App\Models\Categorie::factory(['name' => 'Drops', 'description' => 'These are often used where the active part of the medicine works best if it reaches the affected area directly. They tend to be used for eye, ear or nose.'])->create();
        \App\Models\Categorie::factory(['name' => 'Inhalers', 'description' => 'The active part of the medicine is released under pressure directly into the lungs. Young children may need to use a ‘spacer’ device to take the medicine properly. Inhalers can be difficult to use at first so your pharmacist will show you how to use them.'])->create();
        \App\Models\Categorie::factory(['name' => 'Injections', 'description' => 'There are different types of injection, in how and where they are injected. Subcutaneous or SC injections are given just under the surface of the skin. Intramuscular or IM injections are given into a muscle. Intrathecal injections are given into the fluid around the spinal cord. Intravenous or IV injections are given into a vein. Some injections can be given at home but most are given at your doctor s surgery or in hospital'])->create();
        \App\Models\Categorie::factory(['name' => 'Implants or patches', 'description' => 'These medicines are absorbed through the skin, such as nicotine patches for help in giving up smoking, or contraceptive implants.'])->create();

        \App\Models\Medicine::factory(['name' => 'Penicillin' , 'description' => 'As the first antibiotic, it pointed the way to the treatment of microbial disease. Without penicillin, 75% of the people now alive would not be alive because their parents or grandparents would have succumbed to infections. The effects of a drug like this are absolutely mind-boggling.' , 'quantity' => '500' , 'price' => '120' , 'categorie' => '1'])->create();
        \App\Models\Medicine::factory(['name' => 'Insulin' , 'description' => 'Patients with advanced diabetes cant use the energy stored in their bodies. No matter how much they eat, they starve. Why? Their bodies stop making a hormone known as insulin, needed to convert sugar into energy.' , 'quantity' => '200' , 'price' => '150' , 'categorie' => '2'])->create();
        \App\Models\Medicine::factory(['name' => 'Ether' , 'description' => 'Patients with advanced diabetes cant use the energy stored in their bodies. No matter how much they eat, they starve. Why? Their bodies stop making a hormone known as insulin, needed to convert sugar into energy.' , 'quantity' => '50' , 'price' => '200'  , 'categorie' => '3'])->create();






        \App\Models\Medicine::factory(['name' => 'Penicillin' , 'description' => 'As the first antibiotic, it pointed the way to the treatment of microbial disease. Without penicillin, 75% of the people now alive would not be alive because their parents or grandparents would have succumbed to infections. The effects of a drug like this are absolutely mind-boggling.' , 'quantity' => '500' , 'price' => '120' , 'categorie' => '1'])->create();
        \App\Models\Medicine::factory(['name' => 'Insulin' , 'description' => 'Patients with advanced diabetes cant use the energy stored in their bodies. No matter how much they eat, they starve. Why? Their bodies stop making a hormone known as insulin, needed to convert sugar into energy.' , 'quantity' => '200' , 'price' => '150' , 'categorie' => '2'])->create();
        \App\Models\Medicine::factory(['name' => 'Ether' , 'description' => 'Patients with advanced diabetes cant use the energy stored in their bodies. No matter how much they eat, they starve. Why? Their bodies stop making a hormone known as insulin, needed to convert sugar into energy.' , 'quantity' => '50' , 'price' => '200'  , 'categorie' => '3'])->create();

       
        

    }
}
