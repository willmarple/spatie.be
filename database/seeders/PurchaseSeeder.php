<?php

namespace Database\Seeders;

use App\Actions\Activations\CreateActivationAction;
use App\Actions\CreateLicenseAction;
use App\Models\Purchasable;
use App\Models\User;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    public function run()
    {
        User::each(function (User $user) {
            /** @var \App\Models\Purchasable $purchasable */
            $purchase = $user->purchases()->create([
                'purchasable_id' => Purchasable::firstWhere('title', 'Timber')->id,
                'paddle_fee' => 0,
                'earnings' => 0,
            ]);

            $license = (new CreateLicenseAction())->execute($user, $purchase->purchasable);

            (new CreateActivationAction())->execute('home', $license);
            (new CreateActivationAction())->execute('office', $license);
        });
    }
}
