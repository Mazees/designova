<?php
$user = $_SESSION['user'] ?? null;
$userName = $user['name'] ?? 'Designova User';
$userRole = ucfirst($user['role'] ?? 'Peserta');
$userInitial = strtoupper(substr($userName, 0, 1));

// Deteksi menu aktif
$request_uri = $_SERVER['REQUEST_URI'];
$active_menu = 'dashboard';
if (strpos($request_uri, '/submission') !== false || strpos($request_uri, '/teams') !== false || strpos($request_uri, '/assessment') !== false) {
    $active_menu = 'submissions';
} elseif (strpos($request_uri, '/payment') !== false) {
    $active_menu = 'payment';
} elseif (strpos($request_uri, '/leaderboard') !== false) {
    $active_menu = 'leaderboard';
} elseif (strpos($request_uri, '/settings') !== false) {
    $active_menu = 'settings';
}

$team = $_SESSION['team'] ?? null;
$teamActive = (isset($team['is_active']) && $team['is_active'] == 1);
?>

<aside class="w-64 bg-base-100 border-r border-gray-100 flex flex-col justify-between p-6">
    <div class="space-y-8">
        <!-- User Profile Info -->
        <div class="flex items-center space-x-3.5">
            <div class="avatar">
                <div
                    class="size-11 rounded-full bg-primary text-primary-content flex items-center justify-center font-bold text-lg">
                    <?= $userInitial; ?>
                </div>
            </div>
            <h4 class="font-extrabold text-base-content text-sm tracking-tight leading-none">
                <?= htmlspecialchars($userName); ?>
            </h4>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-1">
            <?php if (strtolower($user['role'] ?? 'peserta') === 'peserta'): ?>
                <?php if ($teamActive): ?>
                    <!-- Menu Peserta Aktif -->
                    <a href="<?= BASE_URL; ?>/dashboard"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 <?= $active_menu === 'dashboard' ? 'bg-primary text-primary-content shadow-sm' : 'text-muted hover:bg-base-200 hover:text-base-content'; ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="<?= BASE_URL; ?>/submission"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 <?= $active_menu === 'submissions' ? 'bg-primary text-primary-content shadow-sm' : 'text-muted hover:bg-base-200 hover:text-base-content'; ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Submissions</span>
                    </a>
                <?php else: ?>
                    <!-- Menu Peserta Non-Aktif -->
                    <a href="<?= BASE_URL; ?>/payment"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 <?= $active_menu === 'payment' ? 'bg-primary text-primary-content shadow-sm' : 'text-muted hover:bg-base-200 hover:text-base-content'; ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span>Instruksi Pembayaran</span>
                    </a>
                    <div class="flex items-center space-x-3 px-4 py-3 text-sm font-semibold text-muted cursor-not-allowed select-none"
                        title="Selesaikan pembayaran terlebih dahulu">
                        <svg class="w-5 h-5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Dashboard</span>
                    </div>
                    <div class="flex items-center space-x-3 px-4 py-3 text-sm font-semibold text-muted cursor-not-allowed select-none"
                        title="Selesaikan pembayaran terlebih dahulu">
                        <svg class="w-5 h-5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Submissions</span>
                    </div>
                <?php endif; ?>
            <?php elseif (strtolower($user['role'] ?? '') === 'juri'): ?>
                <a href="<?= BASE_URL; ?>/juri/dashboard"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 <?= $active_menu === 'dashboard' ? 'bg-primary text-primary-content shadow-sm' : 'text-muted hover:bg-base-200 hover:text-base-content'; ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            <?php elseif (strtolower($user['role'] ?? '') === 'admin'): ?>
                <a href="<?= BASE_URL; ?>/admin/dashboard"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 <?= $active_menu === 'dashboard' ? 'bg-primary text-primary-content shadow-sm' : 'text-muted hover:bg-base-200 hover:text-base-content'; ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="<?= BASE_URL; ?>/admin/teams"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 <?= $active_menu === 'submissions' ? 'bg-primary text-primary-content shadow-sm' : 'text-muted hover:bg-base-200 hover:text-base-content'; ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Teams</span>
                </a>
                <a href="<?= BASE_URL; ?>/admin/leaderboard"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 <?= $active_menu === 'leaderboard' ? 'bg-primary text-primary-content shadow-sm' : 'text-muted hover:bg-base-200 hover:text-base-content'; ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Leaderboard</span>
                </a>
                <a href="<?= BASE_URL; ?>/admin/settings"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 <?= $active_menu === 'settings' ? 'bg-primary text-primary-content shadow-sm' : 'text-muted hover:bg-base-200 hover:text-base-content'; ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Settings</span>
                </a>
            <?php endif; ?>
        </nav>
    </div>

    <!-- Bottom Actions -->
    <div class="space-y-4">
        <form method="post" action="<?= BASE_URL; ?>/logout">
            <button type="submit" name="logout" class="btn btn-ghost w-full justify-start text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>