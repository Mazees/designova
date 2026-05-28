<?php

class PaymentController extends Controller
{
    public function index()
    {
        $this->protectRoute(['peserta'], false);

        $team = $_SESSION['team'] ?? null;
        $error = '';
        $whatsappUrl = '';
        $payment = null;
        $paymentStep = 1;
        $isPaymentLocked = false;
        $paymentId = '-';
        $paymentStatus = 'pending';
        $senderNameValue = '-';
        $senderBankValue = '-';
        $statusLabel = 'Pending Verifikasi';
        $statusBadgeClass = 'badge-warning';
        $teamName = $team['team_name'] ?? 'Tim Anda';
        $basePrice = 0;
        $totalAmount = 0;
        $qrisQrUrl = '';

        $setting = new Setting();
        $basePrice = (int) $setting->getBasePrice();
        $totalAmount = $basePrice;
        $paymentModel = new Payment();

        $payment = $team ? $paymentModel->getPendingPaymentByTeamId((string) $team['id']) : null;

        if ($payment) {
            $paymentStep = 3;
            $isPaymentLocked = true;
            $paymentId = (string) ($payment['id'] ?? '-');
            $paymentStatus = (string) ($payment['status'] ?? 'pending');
            $senderNameValue = (string) ($payment['sender_name'] ?? '-');
            $senderBankValue = (string) ($payment['sender_bank'] ?? '-');
            $statusLabel = $paymentStatus === 'confirmed' ? 'Terkonfirmasi' : ($paymentStatus === 'rejected' ? 'Ditolak' : 'Pending Verifikasi');
            $statusBadgeClass = $paymentStatus === 'confirmed' ? 'badge-success' : ($paymentStatus === 'rejected' ? 'badge-error' : 'badge-warning');
            $totalAmount = (int) ($payment['amount'] ?? $basePrice);
            $whatsappUrl = $this->buildWhatsappUrl($team, $payment);
        }

        $qrisPayload = QrisService::generateDynamicQris($totalAmount);
        $qrisQrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode($qrisPayload);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $team) {
            $senderName = trim($_POST['sender_name'] ?? '');
            $senderBank = trim($_POST['sender_bank'] ?? '');
            $submittedAmount = (int) ($_POST['amount'] ?? 0);

            $activePayment = $paymentModel->getPendingPaymentByTeamId((string) $team['id']);

            if ($activePayment) {
                header('Location: ' . BASE_URL . '/payment');
                exit;
            }

            if ($senderName === '' || $senderBank === '') {
                $error = 'Nama pengirim dan bank pengirim wajib diisi.';
                $paymentStep = 2;
            } elseif ($submittedAmount !== (int) $basePrice) {
                $error = 'Nominal pembayaran tidak sesuai dengan tagihan saat ini.';
                $paymentStep = 2;
            } else {
                $paymentData = $paymentModel->addPaymentData((string) $team['id'], $submittedAmount, $senderName, $senderBank);
                if (!empty($paymentData['id'])) {
                    header('Location: ' . BASE_URL . '/payment');
                    exit;
                }

                $error = 'Gagal menyimpan data pembayaran. Silakan coba lagi.';
                $paymentStep = 2;
            }
        }

        $this->view('participant/payment', [
            'title' => 'Instruksi Pembayaran - Designova',
            'price' => $basePrice,
            'error' => $error,
            'whatsappUrl' => $whatsappUrl,
            'payment' => $payment,
            'paymentStep' => $paymentStep,
            'isPaymentLocked' => $isPaymentLocked,
            'team' => $team,
            'teamName' => $teamName,
            'totalAmount' => $totalAmount,
            'paymentId' => $paymentId,
            'paymentStatus' => $paymentStatus,
            'senderNameValue' => $senderNameValue,
            'senderBankValue' => $senderBankValue,
            'statusLabel' => $statusLabel,
            'statusBadgeClass' => $statusBadgeClass,
            'qrisQrUrl' => $qrisQrUrl,
        ]);
    }

    private function buildWhatsappUrl(array $team, array $payment): string
    {
        $whatsappNumber = '6281234489008';
        $teamName = $team['team_name'] ?? 'Tim Anda';
        $totalAmountStr = 'Rp ' . number_format((int) ($payment['amount'] ?? 0), 0, ',', '.');
        $senderName = trim((string) ($payment['sender_name'] ?? '-'));
        $senderBank = trim((string) ($payment['sender_bank'] ?? '-'));

        $message = "Halo Admin Designova, saya ingin mengonfirmasi pembayaran pendaftaran kompetisi.\n\n*Detail Tim:*\n- Nama Tim: {$teamName}\n\n*Detail Pembayaran:*\n- Nama Pengirim: {$senderName}\n- Bank/E-Wallet: {$senderBank}\n- Nominal Tagihan: {$totalAmountStr}\n- Id Pembayaran: {$payment['id']}\n\nMohon bantuannya untuk melakukan verifikasi tim kami agar status kami menjadi Aktif. Terima kasih!";

        return 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($message);
    }

    public function approve($id)
    {
        $this->protectRoute(['admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $paymentModel = new Payment();
            $paymentModel->approvePayment($id);
        }
        header('Location: ' . BASE_URL . '/admin/payments');
        exit;
    }

    public function reject($id)
    {
        $this->protectRoute(['admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $paymentModel = new Payment();
            $paymentModel->rejectPayment($id);
        }
        header('Location: ' . BASE_URL . '/admin/payments');
        exit;
    }
}
