<?php

class PaymentController extends Controller
{
    public function index()
    {
        $setting = new Setting();
        $basePrice = $setting->getBasePrice();
        $this->protectRoute(['peserta'], false);
        $this->view('participant/payment', [
            'title' => 'Instruksi Pembayaran - Designova',
            'price' => $basePrice
        ]);
    }
}
