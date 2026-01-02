<nav class="flex justify-between items-center max-w-7xl mx-auto py-4">
    <a href="{{ route('homepage') }}" class="text-2xl font-bold">
        PrimeTIX
    </a>

    @auth
        <a href="{{ route('akun') }}" class="flex items-center gap-3">
            <img
                src="{{ auth()->user()->avatar
                    ? asset('storage/' . auth()->user()->avatar)
                    : asset('images/avatar-default.png') }}"
                class="w-10 h-10 rounded-full object-cover border"
            >
            <span class="text-sm font-semibold">
                {{ auth()->user()->name }}
            </span>
        </a>
    @else
        <a href="{{ route('login') }}"
           class="px-4 py-2 border rounded-full text-sm hover:bg-black hover:text-white transition">
            Login
        </a>
    @endauth
</nav>
