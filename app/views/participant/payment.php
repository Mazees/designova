<?php
require_once '../app/views/layouts/header.php';

$paymentStep = isset($paymentStep) ? (int) $paymentStep : 1;
$isPaymentLocked = !empty($isPaymentLocked);
$totalAmount = isset($totalAmount) ? (int) $totalAmount : 0;
$qrisQrUrl = $qrisQrUrl ?? '';
$statusBadgeClass = $statusBadgeClass ?? 'badge-warning';
$statusLabel = $statusLabel ?? 'Pending Verifikasi';
$paymentId = $paymentId ?? '-';
$senderNameValue = $senderNameValue ?? '-';
$senderBankValue = $senderBankValue ?? '-';
?>

<div class="min-h-[calc(100vh-2rem)] w-full flex flex-col items-start justify-start px-3 pt-4 pb-10 sm:items-center sm:justify-center sm:py-6"
    x-data="{
    step: <?= $paymentStep; ?>,
    locked: <?= $isPaymentLocked ? 'true' : 'false'; ?>,
    name: '',
    bank: '',
    totalAmount: <?= $totalAmount; ?>,
    copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        alert('Nomor rekening ' + text + ' berhasil disalin ke clipboard!');
    },
    goToStep(targetStep) {
        if (this.locked && targetStep < 3) {
            return;
        }
        this.step = targetStep;
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
}">
    <!-- Clean Centered DaisyUI Card -->
    <div class="card bg-base-100 border border-base-200 shadow-xl w-full max-w-sm sm:max-w-md mx-auto">
        <div class="card-body p-4 sm:p-5 gap-4 sm:gap-5">

            <!-- Header Info inside the card -->
            <div class="pb-3 sm:pb-4 border-b border-base-200 gap-2 sm:gap-3 flex items-center">
                <h2
                    class="card-title text-lg sm:text-2xl text-center mx-auto w-full font-black text-neutral-content tracking-tight leading-tight">
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
                        class="font-bold text-[9px] sm:text-[10px] transition-all duration-300">Scan QRIS</li>
                    <li :class="step >= 2 ? 'step step-primary' : 'step'"
                        class="font-bold text-[9px] sm:text-[10px] transition-all duration-300">Konfirmasi</li>
                    <li :class="step >= 3 ? 'step step-primary' : 'step'"
                        class="font-bold text-[9px] sm:text-[10px] transition-all duration-300">Status</li>
                </ul>
            </div>

            <!-- Step 1 Content: QRIS -->
            <div x-show="step === 1 && !locked" x-transition class="gap-4 sm:gap-5 flex flex-col items-center w-full">
                <!-- Dynamic QRIS Card -->
                <div
                    class="w-full bg-base-200 border border-base-300 rounded-2xl p-3 sm:p-4 text-center gap-3 flex flex-col items-center shadow-sm">
                    <div class="flex justify-between items-center gap-3 border-b border-base-300 pb-2.5 w-full">
                        <div class="flex flex-col items-start gap-0.5 text-left min-w-0">
                            <span class="text-[9px] sm:text-[10px] font-black text-base-content tracking-wider">QRIS
                                PAYMENT</span>
                            <span class="text-[8px] sm:text-[9px] text-muted font-semibold leading-snug">Scan untuk
                                melakukan pembayaran:</span>
                        </div>
                        <div
                            class="badge badge-xs bg-primary/20 text-primary-content border-none font-bold whitespace-nowrap">
                            Designova
                        </div>
                    </div>
                    <div class="bg-white p-2.5 sm:p-3 rounded-xl w-full max-w-55 sm:max-w-62.5 mx-auto">
                        <img class="w-full h-auto" src="<?= htmlspecialchars($qrisQrUrl, ENT_QUOTES); ?>"
                            alt="QR Code" />
                    </div>
                    <div class="w-full bg-base-100 border border-base-300 rounded-xl p-2.5 sm:p-3 flex flex-col gap-1">
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-muted">Nominal
                            Pembayaran</span>
                        <span class="text-lg sm:text-2xl font-black text-neutral-content leading-tight">Rp
                            <?= number_format($totalAmount, 0, ',', '.'); ?></span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="w-full pt-1 sm:pt-2 flex flex-col gap-4 sm:gap-5">
                    <button type="button" @click="goToStep(2)"
                        class="btn btn-primary btn-block text-xs sm:text-sm h-11 sm:h-12 gap-2">
                        <span>Lanjut ke Konfirmasi</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 2 Content: Sender Form -->
            <form x-show="step === 2 && !locked" x-transition class="gap-4 sm:gap-5 flex flex-col w-full" method="post"
                action="<?= BASE_URL; ?>/payment" id="paymentForm">

                <!-- Input Nama Pengirim -->
                <div class="form-control w-full gap-1">
                    <label class="label py-0 min-h-0">
                        <span
                            class="label-text font-bold text-[9px] sm:text-[10px] uppercase text-muted tracking-wider leading-snug">Nama
                            Pengirim
                            / Pemilik Rekening</span>
                    </label>
                    <input type="text" name="sender_name" x-model="name" required
                        class="input input-bordered w-full text-xs h-10 sm:h-11 font-medium"
                        placeholder="Contoh: John Doe" />
                </div>

                <!-- Input Bank Pengirim -->
                <div class="form-control w-full gap-1">
                    <label class="label py-0 min-h-0">
                        <span
                            class="label-text font-bold text-[9px] sm:text-[10px] uppercase text-muted tracking-wider leading-snug">Bank
                            Pengirim
                            / Nama E-Wallet</span>
                    </label>
                    <input type="text" name="sender_bank" x-model="bank" required
                        class="input input-bordered w-full text-xs h-10 sm:h-11 font-medium"
                        placeholder="Contoh: Bank BCA / GoPay / OVO" />
                </div>

                <input type="hidden" name="amount" value="<?= (int) $totalAmount; ?>" />

                <!-- Alert Notice -->
                <div
                    class="alert alert-warning text-[9px] sm:text-[10px] p-3 gap-2.5 rounded-xl leading-normal border border-yellow-250/20 bg-yellow-50/50 text-yellow-800">
                    <svg class="w-4 h-4 text-warning shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Setelah mengonfirmasi, Anda akan diarahkan ke WhatsApp untuk verifikasi manual oleh Admin agar
                        status pendaftaran tim Anda aktif.</span>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button type="button" @click="goToStep(1)"
                        class="btn bg-base-200 hover:bg-base-300 text-base-content border-none flex-1 font-bold text-xs h-10 sm:h-11">
                        Kembali
                    </button>
                    <button type="submit"
                        class="btn btn-primary flex-1 text-xs h-10 sm:h-11 gap-1.5 text-primary-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="currentColor"
                                d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                        </svg>

                        <span>Submit</span>
                    </button>
                </div>
            </form>

            <!-- Step 3 Content: Payment Status -->
            <div x-show="step === 3" x-transition class="gap-4 sm:gap-5 flex flex-col items-center w-full">
                <div
                    class="w-full bg-base-200 border border-base-300 rounded-2xl p-3 sm:p-4 text-center gap-3 flex flex-col items-center shadow-sm">
                    <div class="flex justify-between items-center gap-3 border-b border-base-300 pb-2.5 w-full">
                        <div class="flex flex-col items-start gap-0.5 text-left min-w-0">
                            <span class="text-[9px] sm:text-[10px] font-black text-base-content tracking-wider">STATUS
                                PEMBAYARAN</span>
                            <span class="text-[8px] sm:text-[9px] text-muted font-semibold leading-snug">Pembayaran Anda
                                sedang menunggu verifikasi
                                admin:</span>
                        </div>
                        <div class="badge badge-xs <?= $statusBadgeClass; ?> border-none font-bold text-white">
                            <?= htmlspecialchars($statusLabel, ENT_QUOTES); ?>
                        </div>
                    </div>

                    <div class="w-full grid gap-2.5 sm:gap-3 text-left">
                        <div class="bg-base-100 border border-base-300 rounded-xl p-2.5 sm:p-3 flex flex-col gap-1">
                            <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-muted">ID
                                Pembayaran</span>
                            <span
                                class="text-xs sm:text-sm font-black text-base-content break-all leading-snug"><?= htmlspecialchars((string) $paymentId, ENT_QUOTES); ?></span>
                        </div>
                        <div class="bg-base-100 border border-base-300 rounded-xl p-2.5 sm:p-3 flex flex-col gap-1">
                            <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-muted">Status
                                Pembayaran</span>
                            <span
                                class="text-xs sm:text-sm font-black text-base-content leading-snug"><?= htmlspecialchars($statusLabel, ENT_QUOTES); ?></span>
                        </div>
                        <div class="bg-base-100 border border-base-300 rounded-xl p-2.5 sm:p-3 flex flex-col gap-1">
                            <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-muted">Nama
                                Pengirim</span>
                            <span
                                class="text-xs sm:text-sm font-semibold text-base-content leading-snug"><?= htmlspecialchars((string) $senderNameValue, ENT_QUOTES); ?></span>
                        </div>
                        <div class="bg-base-100 border border-base-300 rounded-xl p-2.5 sm:p-3 flex flex-col gap-1">
                            <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-muted">Bank
                                Pengirim</span>
                            <span
                                class="text-xs sm:text-sm font-semibold text-base-content leading-snug"><?= htmlspecialchars((string) $senderBankValue, ENT_QUOTES); ?></span>
                        </div>
                    </div>

                    <div class="w-full bg-base-100 border border-base-300 rounded-xl p-2.5 sm:p-3 flex flex-col gap-1">
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-muted">Nominal
                            Pembayaran</span>
                        <span class="text-lg sm:text-xl font-black text-neutral-content leading-tight">Rp
                            <?= number_format($totalAmount, 0, ',', '.'); ?></span>
                    </div>
                </div>

                <div class="w-full pt-1 sm:pt-2 flex flex-col gap-4">

                    <?php if (!empty($whatsappUrl)): ?>
                        <a href="<?= htmlspecialchars($whatsappUrl, ENT_QUOTES); ?>" target="_blank"
                            class="btn btn-success btn-block text-white rounded-xl h-11 sm:h-12 gap-2 text-xs sm:text-sm">
                            <span>Konfirmasi Via Whatsapp</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M3 12l6 6L21 6" />
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error text-xs rounded-xl border border-red-200 bg-red-50/70 text-red-800">
                    <?= htmlspecialchars($error, ENT_QUOTES); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>