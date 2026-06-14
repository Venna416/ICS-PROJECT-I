<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Seller Verification System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-700 text-white p-4">
        <div class="max-w-7xl mx-auto flex justify-between">

            <h1 class="font-bold text-xl">
                SellerVerify
            </h1>

            <div>
                <a href="{{ route('login') }}" class="mr-4 hover:underline">
                    Login
                </a>

                <a href="{{ route('register') }}" class="bg-white text-blue-700 px-4 py-2 rounded">
                    Register
                </a>
            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-20">

        <h1 class="text-5xl font-bold mb-4">
            Online Seller Verification & Risk Scoring
        </h1>

        <p class="text-xl text-gray-600 mb-8">
            Verify sellers, detect fraud and shop with confidence.
        </p>

        <a href="{{ route('register') }}"
           class="bg-blue-700 text-white px-6 py-3 rounded-lg">
            Get Started
        </a>

    </section>

    <!-- Features -->
    <section class="max-w-6xl mx-auto py-10">

        <h2 class="text-3xl font-bold text-center mb-8">
            Features
        </h2>

        <div class="grid md:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-2">
                    Seller Verification
                </h3>

                <p>
                    Verify seller identities before transactions.
                </p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-2">
                    Trust Scores
                </h3>

                <p>
                    Evaluate seller credibility instantly.
                </p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-2">
                    Fraud Reporting
                </h3>

                <p>
                    Report suspicious activities and scams.
                </p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-2">
                    Risk Analysis
                </h3>

                <p>
                    View seller risk levels before purchasing.
                </p>
            </div>

        </div>

    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4 mt-10">
        © {{ date('Y') }} Online Seller Verification System
    </footer>

</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Seller Verification System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-700 text-white p-4">
        <div class="max-w-7xl mx-auto flex justify-between">

            <h1 class="font-bold text-xl">
                SellerVerify
            </h1>

            <div>
                <a href="{{ route('login') }}" class="mr-4 hover:underline">
                    Login
                </a>

                <a href="{{ route('register') }}" class="bg-white text-blue-700 px-4 py-2 rounded">
                    Register
                </a>
            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-20">

        <h1 class="text-5xl font-bold mb-4">
            Online Seller Verification & Risk Scoring
        </h1>

        <p class="text-xl text-gray-600 mb-8">
            Verify sellers, detect fraud and shop with confidence.
        </p>

        <a href="{{ route('register') }}"
           class="bg-blue-700 text-white px-6 py-3 rounded-lg">
            Get Started
        </a>

    </section>

    <!-- Features -->
    <section class="max-w-6xl mx-auto py-10">

        <h2 class="text-3xl font-bold text-center mb-8">
            Features
        </h2>

        <div class="grid md:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-2">
                    Seller Verification
                </h3>

                <p>
                    Verify seller identities before transactions.
                </p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-2">
                    Trust Scores
                </h3>

                <p>
                    Evaluate seller credibility instantly.
                </p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-2">
                    Fraud Reporting
                </h3>

                <p>
                    Report suspicious activities and scams.
                </p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-2">
                    Risk Analysis
                </h3>

                <p>
                    View seller risk levels before purchasing.
                </p>
            </div>

        </div>

    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4 mt-10">
        © {{ date('Y') }} Online Seller Verification System
    </footer>

</body>
</html>