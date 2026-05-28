<?php require_once '../app/views/layouts/header.php'; ?>

<?php $payments = $payments ?? []; ?>

<div class="max-w-5xl mx-auto space-y-8 pb-12" data-aos="fade-up">
    <!-- Header -->
    <div class="space-y-2">
        <h2 class="text-3xl font-black text-neutral-content tracking-tight">Verifikasi Pembayaran</h2>
        <p class="text-xs text-gray-400 font-medium max-w-2xl leading-relaxed">
            Persetujuan manual untuk transaksi pembayaran pendaftaran tim. Menyetujui pembayaran akan otomatis
            mengaktifkan status akun tim terkait.
        </p>
    </div>

    <!-- Search Area -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <!-- Search bar -->
        <form action="<?= BASE_URL; ?>/admin/payments" method="GET" class="join max-w-sm w-full">
            <input type="text" 
                   name="search" 
                   value="<?= htmlspecialchars((string) ($search ?? ''), ENT_QUOTES); ?>"
                   class="input input-bordered join-item text-xs h-10 w-full font-medium focus:outline-none focus:border-primary"
                   placeholder="Cari nama tim, pengirim, atau ID..." />
            <button type="submit" class="btn btn-primary join-item text-xs h-10 text-primary-content font-bold px-5">Cari</button>
            <?php if (!empty($search)): ?>
                <a href="<?= BASE_URL; ?>/admin/payments" class="btn btn-ghost join-item text-xs h-10 font-bold px-3">Reset</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Table Card -->
    <div class="card bg-base-100 border border-base-200 shadow-sm overflow-hidden rounded-2xl">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr
                        class="bg-base-200 border-b border-base-300 text-gray-500 text-[10px] font-black uppercase tracking-wider">
                        <th class="py-4 pl-8">ID Pembayaran</th>
                        <th class="py-4">Nama Tim &amp; Pengirim</th>
                        <th class="py-4">Tanggal Transaksi</th>
                        <th class="py-4">Nominal</th>
                        <th class="py-4">Status</th>
                        <th class="py-4 pr-8 text-right">Aksi Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-base-200 text-xs font-semibold text-gray-700">
                    <?php if (!empty($payments)): ?>
                        <?php foreach ($payments as $payment): ?>
                            <tr class="hover:bg-base-200/40 transition-colors">
                                <td class="py-5 pl-8 font-mono text-gray-400 text-[11px]">
                                    <?= htmlspecialchars((string) ($payment['id'] ?? '-'), ENT_QUOTES); ?>
                                </td>
                                <td class="py-5">
                                    <div class="flex flex-col gap-0.5">
                                        <span
                                            class="font-extrabold text-neutral-content text-sm"><?= htmlspecialchars((string) ($payment['team_name'] ?? '-'), ENT_QUOTES); ?></span>
                                        <span class="text-[10px] text-gray-400 font-medium">Pengirim:
                                            <?= htmlspecialchars((string) ($payment['sender_name'] ?? '-'), ENT_QUOTES); ?>
                                            (<?= htmlspecialchars((string) ($payment['sender_bank'] ?? '-'), ENT_QUOTES); ?>)</span>
                                    </div>
                                </td>
                                <td class="py-5 text-gray-400 font-mono">
                                    <?= htmlspecialchars((string) ($payment['date_formatted'] ?? '-'), ENT_QUOTES); ?>
                                </td>
                                <td class="py-5 font-bold text-neutral-content whitespace-nowrap">
                                    <?= htmlspecialchars((string) ($payment['amount_formatted'] ?? '-'), ENT_QUOTES); ?>
                                </td>
                                <td class="py-5">
                                    <span
                                        class="badge <?= htmlspecialchars((string) ($payment['status_badge_class'] ?? ''), ENT_QUOTES); ?> font-black text-[9px] uppercase tracking-wider py-2.5 px-3">
                                        <?= htmlspecialchars((string) ($payment['status_label'] ?? '-'), ENT_QUOTES); ?>
                                    </span>
                                </td>
                                <td class="py-5 pr-8 text-right">
                                    <?php if (!empty($payment['is_pending'])): ?>
                                        <div class="flex justify-end gap-2">
                                            <form
                                                action="<?= htmlspecialchars((string) ($payment['approve_url'] ?? '#'), ENT_QUOTES); ?>"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin menyetujui pembayaran untuk tim <?= htmlspecialchars((string) ($payment['team_name'] ?? '-'), ENT_QUOTES); ?>?')">
                                                <button type="submit"
                                                    class="btn btn-success btn-xs font-black text-white px-3 py-1.5 h-auto rounded-lg">Approve</button>
                                            </form>
                                            <form
                                                action="<?= htmlspecialchars((string) ($payment['reject_url'] ?? '#'), ENT_QUOTES); ?>"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin menolak pembayaran untuk tim <?= htmlspecialchars((string) ($payment['team_name'] ?? '-'), ENT_QUOTES); ?>?')">
                                                <button type="submit"
                                                    class="btn btn-error btn-xs font-black text-white px-3 py-1.5 h-auto rounded-lg">Reject</button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-xs text-gray-400 font-bold">Selesai</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-10 text-center text-sm text-gray-400 font-medium">
                                <?php if (!empty($search)): ?>
                                    Tidak ada pembayaran yang cocok dengan kata kunci "<?= htmlspecialchars((string) $search, ENT_QUOTES); ?>".
                                <?php else: ?>
                                    Belum ada pembayaran yang perlu diverifikasi.
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>