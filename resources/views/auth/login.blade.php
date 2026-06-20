<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" required autofocus
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                       focus:border-green-500 focus:ring-green-500" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                       focus:border-green-500 focus:ring-green-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-4">
            <input id="remember_me" type="checkbox" name="remember"
                class="rounded border-gray-300 text-green-600 focus:ring-green-500" />
            <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
        </div>

        <!-- Forgot Password -->
        <div class="mb-4 text-right">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                   class="text-sm text-green-600 hover:text-green-700">
                    Forgot your password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <div>
            <button type="submit"
                class="w-full bg-green-600 text-white py-2 px-4 rounded-md 
                       hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                Log in
            </button>
        </div>
    </form>
</x-guest-layout>
