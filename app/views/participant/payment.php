<?php
require_once '../app/views/layouts/header.php';

// Cek data tim dan hitung nominal pembayaran
$team = $_SESSION['team'] ?? null;
$teamName = $team['team_name'] ?? 'Tim Anda';
$teamId = $team['id'] ?? 1;

$basePrice = isset($price) ? (int) $price : 0;
$totalAmount = $basePrice;

// Generate dynamic QRIS string
$qrisPayload = QrisService::generateDynamicQris($totalAmount);
$qrisQrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($qrisPayload);
?>

<div class="min-h-[calc(100vh-2rem)] flex items-center justify-center" x-data="{
    step: 1,
    name: '',
    bank: '',
    totalAmount: <?= $totalAmount; ?>,
    teamName: '<?= htmlspecialchars($teamName, ENT_QUOTES); ?>',
    whatsappNumber: '6281234567890',
    copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        alert('Nomor rekening ' + text + ' berhasil disalin ke clipboard!');
    },
    confirmLogout() {
        Swal.fire({
            title: 'Eitsss',
            text: 'Apakah anda yakin untuk keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            customClass: {
                popup: '!rounded-[24px] !p-6 !bg-neutral',
                title: '!text-2xl !font-bold !text-white',
                htmlContainer: '!text-white',
                actions: 'flex flex-col !w-full !mt-6 gap-3 !text-white',
                confirmButton: 'btn btn-primary w-[90%] !text-white',
                cancelButton: 'btn btn-outline w-[90%] !text-white',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    },
    confirmPayment() {
        const form = document.getElementById('paymentForm');
        if (form) {
            form.requestSubmit();
        }
    }
}">
    <!-- Clean Centered DaisyUI Card -->
    <div class="card bg-base-100 border border-base-200 shadow-xl w-full max-w-md">
        <div class="card-body p-5 sm:p-6 gap-5">

            <!-- Header Info inside the card -->
            <div class="pb-4 border-b border-base-200 gap-3 flex items-center">
                <h2
                    class="card-title text-2xl text-center mx-auto w-full font-black text-neutral-content tracking-tight">
                    Pembayaran Kompetisi
                </h2>
                <form id="logoutForm" method="post" action="<?= BASE_URL; ?>/logout">
                    <button type="button" @click="confirmLogout()"
                        class="btn btn-ghost btn-circle btn-sm text-error self-end" aria-label="Logout">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Steps Progress -->
            <div class="flex justify-center">
                <ul class="steps steps-horizontal w-full">
                    <li :class="step >= 1 ? 'step step-primary' : 'step'"
                        class="font-bold text-[10px] transition-all duration-300">Scan QRIS</li>
                    <li :class="step >= 2 ? 'step step-primary' : 'step'"
                        class="font-bold text-[10px] transition-all duration-300">Konfirmasi</li>
                </ul>
            </div>

            <!-- Step 1 Content: QRIS -->
            <div x-show="step === 1" x-transition class="gap-5 flex flex-col items-center w-full">
                <!-- Dynamic QRIS Card -->
                <div
                    class="w-full bg-base-200 border border-base-300 rounded-2xl p-4 text-center gap-3 flex flex-col items-center shadow-sm">
                    <div class="flex justify-between items-center border-b border-base-300 pb-2.5 w-full">
                        <div class="flex flex-col items-start gap-0.5 text-left">
                            <span class="text-[10px] font-black text-base-content tracking-wider">QRIS PAYMENT</span>
                            <span class="text-[9px] text-muted font-semibold">Scan untuk melakukan pembayaran:</span>
                        </div>
                        <div class="badge badge-xs bg-primary/20 text-primary-content border-none font-bold">Designova
                        </div>
                    </div>
                    <div class="bg-white p-3 rounded-xl w-full max-w-50 min-w-50 min-h-50 mx-auto">
                        <img class="w-full h-auto" src="<?= htmlspecialchars($qrisQrUrl, ENT_QUOTES); ?>"
                            alt="QR Code" />
                    </div>
                    <div class="w-full bg-base-100 border border-base-300 rounded-xl p-3 flex flex-col gap-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-muted">Nominal
                            Pembayaran</span>
                        <span class="text-xl sm:text-2xl font-black text-neutral-content">Rp
                            <?= number_format($totalAmount, 0, ',', '.'); ?></span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="w-full pt-2 flex flex-col gap-5">
                    <button type="button" @click="step = 2" class="btn btn-primary btn-blocktext-sm h-12">
                        <span>Lanjut ke Konfirmasi</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 2 Content: Sender Form -->
            <form x-show="step === 2" x-transition class="gap-5 flex flex-col w-full" method="post"
                action="<?= BASE_URL; ?>/payment" id="paymentForm">

                <!-- Input Nama Pengirim -->
                <div class="form-control w-full gap-1">
                    <label class="label py-0">
                        <span class="label-text font-bold text-[10px] uppercase text-muted tracking-wider">Nama Pengirim
                            / Pemilik Rekening</span>
                    </label>
                    <input type="text" name="sender_name" x-model="name" required
                        class="input input-bordered w-full text-xs h-10 font-medium" placeholder="Contoh: John Doe" />
                </div>

                <!-- Input Bank Pengirim -->
                <div class="form-control w-full gap-1">
                    <label class="label py-0">
                        <span class="label-text font-bold text-[10px] uppercase text-muted tracking-wider">Bank Pengirim
                            / Nama E-Wallet</span>
                    </label>
                    <input type="text" name="sender_bank" x-model="bank" required
                        class="input input-bordered w-full text-xs h-10 font-medium"
                        placeholder="Contoh: Bank BCA / GoPay / OVO" />
                </div>

                <input type="hidden" name="amount" value="<?= (int) $totalAmount; ?>" />

                <!-- Alert Notice -->
                <div
                    class="alert alert-warning text-[10px] p-3 gap-2.5 rounded-xl leading-normal border border-yellow-250/20 bg-yellow-50/50 text-yellow-800">
                    <svg class="w-4 h-4 text-warning shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Setelah mengonfirmasi, Anda akan diarahkan ke WhatsApp untuk verifikasi manual oleh Admin agar
                        status pendaftaran tim Anda aktif.</span>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="step = 1"
                        class="btn bg-base-200 hover:bg-base-300 text-base-content border-none flex-1 font-bold text-xs h-10">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary flex-2 text-xs h-10 gap-1.5 text-primary-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="currentColor"
                                d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                        </svg>

                        <span>Konfirmasi via WA</span>
                    </button>
                </div>
            </form>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error text-xs rounded-xl border border-red-200 bg-red-50/70 text-red-800">
                    <?= htmlspecialchars($error, ENT_QUOTES); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div
                    class="alert alert-success text-xs rounded-xl border border-green-200 bg-green-50/70 text-green-800 flex flex-col items-start gap-3">
                    <span><?= htmlspecialchars($success, ENT_QUOTES); ?></span>
                    <?php if (!empty($whatsappUrl)): ?>
                        <a href="<?= htmlspecialchars($whatsappUrl, ENT_QUOTES); ?>" target="_blank"
                            class="btn btn-success btn-sm text-white rounded-lg">
                            Buka WhatsApp
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>