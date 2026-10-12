<div>
    <!-- Hero Banner Image -->
    <div class="relative w-full h-[320px] sm:h-[400px] md:h-[460px] overflow-hidden bg-gray-900">
        <img src="{{ asset('assets/img/sac_about_page.jpg') }}"
             alt="Student Activities Center"
             class="w-full h-full object-cover">
    </div>

    <!-- Floating Quick Feature Navigation Bar -->
    @livewire('layout.public.sub-navigation')

    <!-- Main Content -->
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-10 sm:py-14 space-y-10">

        <!-- Title Header -->
        <div class="border-b border-gray-200/80 pb-5">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-green-800 tracking-tight">Student Activities Center</h1>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Learner-centered student affairs and development hub of La Salle University - Ozamiz</p>
        </div>

        <!-- Vision & Mission (Separate Clean Cards - No Overlap) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Vision -->
            <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-100 shadow-sm flex flex-col justify-start">
                <div class="mb-3">
                    <h3 class="text-xs font-black uppercase tracking-wider text-green-800">Vision</h3>
                </div>
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed text-left">
                    The Student Activities Center aims to be the learner-centered student affairs and development source committed to the holistic formation of Lasallians integrating faith-life, leadership and community engagement, towards social transformation.
                </p>
            </div>

            <!-- Mission -->
            <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-100 shadow-sm flex flex-col justify-start">
                <div class="mb-3">
                    <h3 class="text-xs font-black uppercase tracking-wider text-green-800">Mission</h3>
                </div>
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed text-left">
                    To realize this vision, we commit to build the ‘total person’ of the individual student who is expected to become a catalyst for positive social change.
                </p>
            </div>
        </div>

        <!-- Programs and Services (3 Clean Cards) -->
        <div class="space-y-4">
            <div>
                <h3 class="text-xs font-black uppercase tracking-wider text-green-800">Programs and Services</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Leadership Training and Programs -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col">
                    <h4 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4">Leadership Training and Programs</h4>
                    <ul class="space-y-2.5 text-xs text-gray-600 flex-1">
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Orientation programs</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Event Management</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Tutorial Services</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Hang outs and team building sessions</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Organizational business</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Leadership Development Program (Lasallian Leadership Academy)</span>
                        </li>
                    </ul>
                </div>

                <!-- Student Empowerment -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col">
                    <h4 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4">Student Empowerment</h4>
                    <ul class="space-y-2.5 text-xs text-gray-600 flex-1">
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Showcase (theater, debate, music, etc.)</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Advocacy campaigns</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Community engagements</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Balay-Balay Program for Basic Education</span>
                        </li>
                    </ul>
                </div>

                <!-- Student Rights and Welfare -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col">
                    <h4 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4">Student Rights and Welfare</h4>
                    <ul class="space-y-2.5 text-xs text-gray-600 flex-1">
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Orientation/Mission week</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Handbook publication</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 font-bold shrink-0">•</span>
                            <span>Research-based innovations</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contact Details -->
        <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-100 shadow-sm">
            <div class="mb-4">
                <h3 class="text-xs font-black uppercase tracking-wider text-green-800">Contact Details</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="https://www.facebook.com/lsuozamizstudentaffairs" target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-3 p-3.5 rounded-xl bg-gray-50 hover:bg-green-50/80 border border-gray-100 hover:border-green-200 transition-colors group">
                    <div class="h-9 w-9 rounded-lg bg-white shadow-sm flex items-center justify-center shrink-0 border border-gray-100">
                        <svg class="h-5 w-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[10px] uppercase font-bold text-gray-400 block tracking-wider">Facebook</span>
                        <span class="text-xs font-medium text-gray-700 group-hover:text-green-800 truncate block">facebook.com/lsuozamizstudentaffairs</span>
                    </div>
                </a>

                <a href="mailto:sac@lsu.edu.ph"
                   class="flex items-center gap-3 p-3.5 rounded-xl bg-gray-50 hover:bg-green-50/80 border border-gray-100 hover:border-green-200 transition-colors group">
                    <div class="h-9 w-9 rounded-lg bg-white shadow-sm flex items-center justify-center shrink-0 border border-gray-100">
                        <svg class="h-5 w-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[10px] uppercase font-bold text-gray-400 block tracking-wider">Email</span>
                        <span class="text-xs font-medium text-gray-700 group-hover:text-green-800 truncate block">sac@lsu.edu.ph</span>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>