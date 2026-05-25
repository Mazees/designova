<?php
require_once '../app/views/layouts/header.php';

// Cek data tim dan hitung nominal pembayaran
$team = $_SESSION['team'] ?? null;
$teamName = $team['team_name'] ?? 'Tim Anda';
$teamId = $team['id'] ?? 1;

$settingModel = new Setting();
$settings = $settingModel->getSystemSettings();
$basePrice = $settings['base_price'] ?? 50000;

// Buat nominal unik berdasarkan team ID
$uniqueCode = str_pad($teamId % 1000, 3, '0', STR_PAD_LEFT);
$totalAmount = $basePrice + ($teamId % 1000);
?>

<div class="max-w-md mx-auto" x-data="{
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
    confirmPayment() {
        const nameVal = this.name.trim();
        const bankVal = this.bank.trim();
        if (!nameVal || !bankVal) {
            alert('Harap isi nama pengirim dan bank pengirim terlebih dahulu!');
            return;
        }
        const totalAmountStr = 'Rp ' + Number(this.totalAmount).toLocaleString('id-ID');
        const message = `Halo Admin Designova, saya ingin mengonfirmasi pembayaran pendaftaran kompetisi.\n\n*Detail Tim:*\n- Nama Tim: ${this.teamName}\n\n*Detail Pembayaran:*\n- Nama Pengirim: ${nameVal}\n- Bank/E-Wallet: ${bankVal}\n- Nominal Tagihan: ${totalAmountStr} (termasuk kode unik)\n\nMohon bantuannya untuk melakukan verifikasi tim kami agar status kami menjadi Aktif. Terima kasih!`;
        const encodedMessage = encodeURIComponent(message);
        const whatsappUrl = `https://wa.me/${this.whatsappNumber}?text=${encodedMessage}`;
        window.open(whatsappUrl, '_blank');
    }
}">
    <!-- Clean Centered DaisyUI Card -->
    <div class="card bg-base-100 border border-base-200 shadow-xl">
        <div class="card-body p-6 sm:p-8 gap-6">

            <!-- Header Info inside the card -->
            <div class="text-center pb-4 border-b border-base-200 gap-1.5 flex flex-col items-center">
                <h2 class="card-title text-2xl font-black text-neutral-content tracking-tight">Pembayaran Kompetisi</h2>
                <div class="flex items-center space-x-1.5">
                    <span class="text-xs text-muted font-medium">Tim:</span>
                    <div class="badge badge-primary font-bold text-[10px]"><?= htmlspecialchars($teamName); ?></div>
                </div>
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
                    class="w-full bg-base-200 border border-base-300 rounded-2xl p-5 text-center gap-4 flex flex-col items-center shadow-sm">
                    <div class="flex justify-between items-center border-b border-base-300 pb-2.5 w-full">
                        <span class="text-[10px] font-black text-base-content tracking-wider">QRIS DINAMIS</span>
                        <div class="badge badge-xs bg-primary/20 text-primary-content border-none font-bold">Designova
                        </div>
                    </div>

                    <!-- QRIS Mockup Image -->
                    <div
                        class="bg-base-100 p-3 rounded-xl border border-base-300 inline-block overflow-hidden max-w-[170px]">
                        <img src="<?= BASE_URL; ?>/assets/images/qris_mockup.png" alt="QRIS Mockup"
                            class="w-full h-auto rounded-lg object-contain shadow-sm" />
                    </div>

                    <div class="gap-0.5 flex flex-col">
                        <span class="text-[9px] text-muted font-semibold uppercase tracking-wider block">Total
                            Tagihan</span>
                        <span class="text-2xl font-black text-neutral-content block">Rp
                            <?= number_format($totalAmount, 0, ',', '.'); ?></span>
                        <span class="text-[9px] text-red-500 font-semibold block">*Termasuk kode unik
                            (<?= $uniqueCode; ?>)</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="w-full pt-2">
                    <button type="button" @click="step = 2"
                        class="btn btn-primary btn-block font-extrabold text-sm h-12">
                        <span>Lanjut ke Konfirmasi</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 2 Content: Sender Form -->
            <div x-show="step === 2" x-transition class="gap-5 flex flex-col w-full">

                <!-- Input Nama Pengirim -->
                <div class="form-control w-full gap-1">
                    <label class="label py-0">
                        <span class="label-text font-bold text-[10px] uppercase text-muted tracking-wider">Nama Pengirim
                            / Pemilik Rekening</span>
                    </label>
                    <input type="text" x-model="name" required
                        class="input input-bordered w-full text-xs h-10 font-medium" placeholder="Contoh: John Doe" />
                </div>

                <!-- Input Bank Pengirim -->
                <div class="form-control w-full gap-1">
                    <label class="label py-0">
                        <span class="label-text font-bold text-[10px] uppercase text-muted tracking-wider">Bank Pengirim
                            / Nama E-Wallet</span>
                    </label>
                    <input type="text" x-model="bank" required
                        class="input input-bordered w-full text-xs h-10 font-medium"
                        placeholder="Contoh: Bank BCA / GoPay / OVO" />
                </div>

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
                    <button type="button" @click="confirmPayment()"
                        class="btn btn-primary flex-2 font-extrabold text-xs h-10 gap-1.5 text-primary-content">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.47L0 24zm5.706-3.8l.374.223c1.55.922 3.327 1.409 5.167 1.411 5.485 0 9.948-4.464 9.952-9.953.002-2.66-1.033-5.16-2.91-7.04C16.47 2.96 13.97 1.92 11.999 1.92c-5.498 0-9.96 4.46-9.964 9.949-.002 1.916.501 3.791 1.458 5.408l.254.432-.975 3.562 3.65-.957zM17.487 14.39c-.314-.157-1.858-.917-2.143-1.02-.284-.105-.49-.157-.698.156-.206.314-.8.156-.98.363-.18.207-.36.23-.674.074-.315-.158-1.33-.49-2.532-1.562-.936-.83-1.568-1.856-1.75-2.17-.183-.315-.02-.485.137-.642.142-.143.315-.367.472-.55.157-.185.21-.317.315-.525.105-.207.052-.39-.026-.547-.078-.157-.698-1.683-.956-2.308-.25-.6-.525-.52-.722-.53-.186-.01-.397-.01-.61-.01-.212 0-.557.08-.85.4.293.32 1.134 1.11 1.134 2.71 0 1.6-1.164 3.15-1.32 3.36-.157.21-2.288 3.49-5.548 4.9-1.026.44-1.826.7-2.45.9-.997.32-1.9.27-2.61.16-.8-.12-2.45-.6-2.79-.88c-.34-.28-.56-.47-.56-.8 0-.32.05-.48.2-.64l1.3-1.3z" />
                        </svg>
                        <span>Konfirmasi via WA</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>