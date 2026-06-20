<aside class="sidebar w-64 bg-gradient-to-b from-indigo-600 to-purple-700 text-white rounded-xl shadow-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Buyer Menu</h2>
    <nav class="space-y-4">
        <a href="{{ route('buyer.dashboard') }}" class="block hover:text-yellow-300">🏠 Dashboard</a>
        <a href="{{ route('buyer.search') }}" class="block hover:text-yellow-300">🔎 Search Sellers</a>
        <a href="{{ route('buyer.reviews') }}" class="block hover:text-yellow-300">⭐ Write Reviews</a>
        <a href="{{ route('buyer.reports') }}" class="block hover:text-yellow-300">🚨 Fraud Reports</a>
        <a href="{{ route('profile.edit') }}" class="block hover:text-yellow-300">👤 Profile</a>
    </nav>
</aside>
