{{-- Sidebar --}}
<div class="bg-gray-800 text-white h-screen w-64 flex flex-col">
    <div class="p-4 flex-grow">
        <h1 class="text-xl font-bold mb-4">Perumahan Indah Permai</h1>
        <p class="text-sm text-gray-400 mb-2">Menu</p>
        <ul>
            <li class="mb-2 {{ request()->routeIs('dashboard') ? 'bg-gray-700 rounded' : '' }}">
                <a href="{{route('dashboard')}}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    <i class="fa-solid fa-list mr-2"></i> Dashboard
                </a>
            </li>
            <li class="mb-2 {{ request()->routeIs('rumah') ? 'bg-gray-700 rounded' : '' }}">
                <a href="{{route('rumah')}}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    <i class="fa-solid fa-house mr-2"></i> Rumah
                </a>
            </li>
            <li class="mb-2 {{ request()->is('penghuni') ? 'bg-gray-700 rounded' : '' }}">
                <a href="{{route('penghuni')}}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    <i class="fa-solid fa-users mr-2"></i> Penghuni
                </a>
            </li>
            <li class="mb-2 {{ request()->is('riwayat-penghuni') ? 'bg-gray-700 rounded' : '' }}">
                <a href="{{route('riwayat-penghuni')}}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    <i class="fa-solid fa-user-clock mr-2"></i> Riwayat Penghuni
                </a>
            </li>
            <li class="mb-2 {{ request()->is('pembayaran') ? 'bg-gray-700 rounded' : '' }}">
                <a href="{{route('pembayaran')}}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    <i class="fa-solid fa-file-invoice mr-4"></i> Pembayaran
                </a>
            </li>
            <li class="mb-2 {{ request()->is('pengeluaran') ? 'bg-gray-700 rounded' : '' }}">
                <a href="{{route('pengeluaran')}}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    <i class="fa-solid fa-money-bill-transfer mr-2"></i> Pengeluaran
                </a>
            </li>
        </ul>
    </div>
    <hr class="border-gray-600">
    <div class="px-4 py-1">
        <ul>
            <li class="mb-2 {{ request()->is('logout') ? 'bg-gray-700' : '' }}">
                <a href="{{route('logout')}}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>
