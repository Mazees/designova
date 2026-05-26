<?php
$user = $_SESSION['user'] ?? null;
$userName = $user['name'] ?? 'Designova User';
$userRole = ucfirst($user['role'] ?? 'Peserta');
$userInitial = strtoupper(substr($userName, 0, 2));
$roleClass = match (strtolower($user['role'] ?? 'peserta')) {
    'admin' => 'badge-error',
    'juri' => 'badge-info',
    default => 'badge-primary',
};

// Deteksi menu aktif
$request_uri = $_SERVER['REQUEST_URI'];

$navbar = [
    'peserta' => [
        [
            'title' => 'Dashboard',
            'route' => '/dashboard',
            'icon' => '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" /></svg>'
        ],
        [
            'title' => 'Submissions',
            'route' => '/submission',
            'icon' => '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>'
        ],
    ],
    'juri' => [
        [
            'title' => 'Dashboard',
            'route' => '/juri/dashboard',
            'icon' => '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" /></svg>'
        ],
        [
            'title' => 'Penilaian',
            'route' => '/juri/dashboard',
            'icon' => '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>'
        ],
    ],
    'admin' => [
        [
            'title' => 'Statistik',
            'route' => '/admin/dashboard',
            'icon' => '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>'
        ],
        [
            'title' => 'Manajemen Tim',
            'route' => '/admin/teams',
            'icon' => '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>'
        ],
        [
            'title' => 'Leaderboard',
            'route' => '/admin/leaderboard',
            'icon' => '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>'
        ],
        [
            'title' => 'Pengaturan',
            'route' => '/admin/settings',
            'icon' => '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>'
        ],
    ],
];

?>

<aside class="w-72 bg-base-100 min-h-screen border-r border-base-200 flex flex-col justify-between">
    <!-- Top: Logo + User Profile -->
    <div>
        <!-- User Card -->
        <div class="px-4 py-4 mx-3 mt-4 mb-2 bg-base-200 border border-base-200 rounded-2xl">
            <div class="flex items-center gap-3">
                <div class="avatar placeholder">
                    <div
                        class="bg-primary text-primary-content rounded-xl w-11 font-bold text-sm flex items-center justify-center">
                        <span><?= $userInitial; ?></span>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-extrabold text-base-content text-sm truncate leading-tight">
                        <?= htmlspecialchars($userName); ?>
                    </p>
                    <span class="badge badge-sm <?= $roleClass; ?> font-bold mt-1 text-[10px] uppercase tracking-wider">
                        <?= $userRole; ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <ul class="menu w-full gap-4 px-3 py-2 gap-0.5">
            <?php foreach ($navbar as $nav => $navs): ?>
                <?php if ($user['role'] === $nav): ?>
                    <?php foreach ($navs as $navItem): ?>
                        <li>
                            <a href="<?= BASE_URL . $navItem['route']; ?>"
                                class="w-full rounded-xl px-4 py-2 <?= strpos($request_uri, $navItem['route']) ? 'active bg-primary text-primary-content' : 'text-base-content/70 hover:bg-base-200 hover:text-base-content'; ?>">
                                <?= $navItem['icon'] ?>
                                <span><?= $navItem['title'] ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Bottom: Logout -->
    <div class="px-3 py-4 border-t border-base-200">
        <form method="post" action="<?= BASE_URL; ?>/logout">
            <button type="submit" name="logout"
                class="btn btn-ghost w-full justify-start text-sm font-semibold text-error hover:bg-error/10 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>