<?php
$request_uri = $_SERVER['REQUEST_URI'];
$is_auth = (strpos($request_uri, '/login') !== false || strpos($request_uri, '/register') !== false);
$is_payment = (strpos($request_uri, '/payment') !== false);
$is_dashboard = (strpos($request_uri, '/dashboard') !== false || 
                  strpos($request_uri, '/submission') !== false || 
                  strpos($request_uri, '/juri/') !== false || 
                  strpos($request_uri, '/admin/') !== false);
?>

<?php if ($is_auth || $is_payment): ?>
    </main>
</body>
</html>
<?php elseif ($is_dashboard): ?>
        </main>
    </div>
</body>
</html>
<?php else: ?>
    </main>

    <!-- Footer Premium -->
    <footer class="bg-neutral text-neutral-content py-12 border-t border-base-200">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-6 md:mb-0">
                <span class="text-2xl font-extrabold text-primary tracking-wider font-sans">designova</span>
            </div>
            <div class="text-sm text-gray-400 mb-6 md:mb-0">
                &copy; 2023 Designova. All rights reserved.
            </div>
            <div class="flex space-x-6 text-gray-400">
                <a href="#" class="hover:text-primary transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm8 3c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 2c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3z"/></svg>
                </a>
                <a href="#" class="hover:text-primary transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-8-2h4v2h-4V4zm8 15H4V8h16v11z"/></svg>
                </a>
                <a href="#" class="hover:text-primary transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
<?php endif; ?>
