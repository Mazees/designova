<?php

class PaymentController extends Controller
{
    public function index()
    {
        $this->protectRoute(['peserta'], false);

        $team = $_SESSION['team'] ?? null;
        $error = '';
        $success = '';
        $whatsappUrl = '';

        $setting = new Setting();
        $basePrice = $setting->getBasePrice();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $team) {
            $senderName = trim($_POST['sender_name'] ?? '');
            $senderBank = trim($_POST['sender_bank'] ?? '');
            $submittedAmount = (int) ($_POST['amount'] ?? 0);

            if ($senderName === '' || $senderBank === '') {
                $error = 'Nama pengirim dan bank pengirim wajib diisi.';
            } elseif ($submittedAmount !== (int) $basePrice) {
                $error = 'Nominal pembayaran tidak sesuai dengan tagihan saat ini.';
            } else {
                $paymentModel = new Payment();
                $paymentId = $paymentModel->addPaymentData((string) $team['id'], $submittedAmount);

                if (!empty($paymentId)) {
                    $teamName = $team['team_name'] ?? 'Tim Anda';
                    $totalAmountStr = 'Rp ' . number_format($submittedAmount, 0, ',', '.');
                    $message = "Halo Admin Designova, saya ingin mengonfirmasi pembayaran pendaftaran kompetisi.\n\n*Detail Tim:*\n- Nama Tim: {$teamName}\n\n*Detail Pembayaran:*\n- Nama Pengirim: {$senderName}\n- Bank/E-Wallet: {$senderBank}\n- Nominal Tagihan: {$totalAmountStr}\n- Id Pembayaran: {$paymentId}\n\nMohon bantuannya untuk melakukan verifikasi tim kami agar status kami menjadi Aktif. Terima kasih!";
                    $whatsappNumber = '6281234567890';
                    $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($message);
                    $success = 'Data pembayaran berhasil dicatat. Silakan lanjutkan verifikasi via WhatsApp.';
                } else {
                    $error = 'Gagal menyimpan data pembayaran. Silakan coba lagi.';
                }
            }
        }

        $this->view('participant/payment', [
            'title' => 'Instruksi Pembayaran - Designova',
            'price' => $basePrice,
            'error' => $error,
            'success' => $success,
            'whatsappUrl' => $whatsappUrl
        ]);
    }
}
