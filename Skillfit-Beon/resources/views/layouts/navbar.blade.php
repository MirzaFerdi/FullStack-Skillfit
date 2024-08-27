<!-- Navbar -->
<nav class="bg-white shadow-md text-gray-800 py-2 px-6">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex-grow"></div> <!-- Spacer to push the user info to the right -->
        <div class="flex items-center">
            @if(Auth::guard('web')->check())
                <!-- Card Container -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm flex items-center space-x-3 px-3 py-1.5">
                    <!-- User Photo or Default Icon -->
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11.25a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM12 14.25a6 6 0 00-6 6v1.5h12v-1.5a6 6 0 00-6-6z"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-sm font-medium">{{ Auth::guard('web')->user()->nama }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>
