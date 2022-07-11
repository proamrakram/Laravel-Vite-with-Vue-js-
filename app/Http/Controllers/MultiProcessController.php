<?php

namespace App\Http\Controllers;
use App\Traits\MultiProcesses;
use Illuminate\Http\Request;

class MultiProcessController extends Controller
{
    use MultiProcesses;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function delete()
    {
        return $this->deleteProducts($this->request);
    }

    public function restore()
    {
        return $this->restoreProducts($this->request);
    }

    public function forceDelete()
    {
        return $this->forceDeleteProducts($this->request);
    }

    public function editCategory()
    {
        return $this->editCategoryProducts($this->request);
    }

    public function editPrice()
    {
        return $this->editPriceProducts($this->request);
    }

    public function editAvailability()
    {
        return $this->editAvailabilityProducts($this->request);
    }

    public function editDescription()
    {
        return $this->editDescriptionProducts($this->request);
    }

    public function editBarcode()
    {
        return $this->editBarcodeProducts($this->request);
    }

    public function editUnit()
    {
        return $this->editUnitProducts($this->request);
    }

    public function editProductionDate()
    {
        return $this->editProductionDateProducts($this->request);
    }

    public function editExpiryDate()
    {
        return $this->editExpiryDateProducts($this->request);
    }
}
