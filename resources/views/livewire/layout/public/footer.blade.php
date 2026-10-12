<footer class="bg-gradient-to-b from-green-950 via-slate-950 to-black text-gray-300 border-t-4 border-yellow-400">
    <!-- Main Footer Content -->
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
            <!-- 1. University Brand & Mission -->
            <div class="space-y-4">
                <a href="/" wire:navigate.hover class="inline-block">
                    <img class="h-10 w-auto object-contain" src="{{ asset('assets/img/lsu-logotype-white 1.png') }}" alt="La Salle University">
                </a>
                <p class="text-xs leading-relaxed text-gray-300">
                    The official campus event and activity portal of <span class="text-white font-semibold">La Salle University - Ozamiz</span>, managed by the <span class="text-yellow-400 font-semibold">Student Activities Center (SAC)</span>.
                </p>
                <div class="flex items-start gap-2.5 text-xs text-gray-400 pt-1">
                    <svg class="h-4 w-4 text-yellow-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    <span>La Salle St., Brgy. Aguada, Ozamiz City, Misamis Occidental, 7200 Philippines</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-xl bg-green-900/40 border border-green-800/80 px-3 py-1.5 text-[11px] text-green-200">
                    <span>Animo La Salle! • Faith • Service • Communion</span>
                </div>
            </div>

            <!-- 2. Colleges & Organizations -->
            <div class="space-y-3">
                <h3 class="text-xs font-black uppercase tracking-wider text-yellow-400">Colleges & Organizations</h3>
                <ul class="space-y-2 text-xs text-gray-400">
                    <li>CCSEA (Computer Studies, Eng'g & Architecture)</li>
                    <li>CBA (College of Business & Accountancy)</li>
                    <li>CTE (College of Teacher Education)</li>
                    <li>CON (College of Nursing)</li>
                    <li>Basic & Higher Education Programs</li>
                    <li>ABO & IBO Student Organizations</li>
                </ul>
            </div>

            <!-- 3. Contact & SAC Office -->
            <div class="space-y-3">
                <h3 class="text-xs font-black uppercase tracking-wider text-yellow-400">Student Activities Center (SAC)</h3>
                <p class="text-xs text-gray-400">
                    For inquiries, event approvals, or organization accreditation, visit the SAC Office or contact us directly.
                </p>
                <div class="space-y-2 text-xs text-gray-300 pt-1">
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-yellow-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <span>sac@lsu.edu.ph</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-yellow-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        <span>(088) 521-0342 local 116</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-400">
                        <svg class="h-4 w-4 text-yellow-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Office Hours: Mon - Fri | 8:00 AM - 5:00 PM</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-12 border-t border-gray-800/80 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-400">
            <div>
                © {{ date('Y') }} <span class="text-white font-semibold">La Salle University - Ozamiz</span>. All rights reserved.
            </div>
            <div class="flex items-center gap-4 text-[11px]">
                <a href="/about-us" wire:navigate.hover class="hover:text-yellow-300">About SAC</a>
                <span>•</span>
                <a href="/frequently-asked-questions" wire:navigate.hover class="hover:text-yellow-300">Student FAQs</a>
                <span>•</span>
                <a href="/login" wire:navigate.hover class="text-yellow-400 hover:text-yellow-300 font-bold">Admin Portal</a>
            </div>
        </div>
    </div>
</footer>
