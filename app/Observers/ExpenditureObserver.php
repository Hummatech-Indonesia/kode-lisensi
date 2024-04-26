<?php

namespace App\Observers;

use App\Models\Expenditure;
use App\Models\Product;
use Faker\Provider\Uuid;

class ExpenditureObserver
{
    /**
     * Method creating
     *
     * @param Expenditure $expenditure [explicite description]
     *
     * @return void
     */
    public function creating(Expenditure $expenditure): void
    {
        $expenditure->id = Uuid::uuid();
    }
    /**
     * Method updating
     *
     * @param Expenditure $expenditure [explicite description]
     *
     * @return void
     */
    public function updating(Expenditure $expenditure): void
    {
        $expenditure->id = Uuid::uuid();
    }
}
