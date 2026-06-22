@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Pending Sellers -->
    <h2 class="mt-4">Pending Sellers</h2>
    @forelse($pendingSellers as $seller)
        <div class="card mb-3 p-3">
            <h4>{{ $seller->brand_name ?? 'Unnamed Seller' }}</h4>
            <p><strong>Category:</strong> {{ $seller->business_category }}</p>
            <p><strong>Location:</strong> {{ $seller->location }}</p>
            <p><strong>Phone:</strong> {{ $seller->phone_number }}</p>

            <form action="{{ route('admin.verifySeller', $seller->id) }}" method="POST" class="mt-2">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="verified">Verify</option>
                            <option value="rejected">Reject</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Risk Score</label>
                        <input type="number" name="risk_score" class="form-control" min="1" max="10" required>
                    </div>
                    <div class="col-md-3">
                        <label>Trust Score</label>
                        <input type="number" name="trust_score" class="form-control" min="0" max="100" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </div>
                </div>
            </form>
        </div>
    @empty
        <p>No pending sellers.</p>
    @endforelse

    <!-- Verified Sellers -->
    <h2 class="mt-5">Verified Sellers</h2>
    @forelse($verifiedSellers as $seller)
        <div class="card mb-3 p-3 border-success">
            <h4>{{ $seller->brand_name }}</h4>
            <span class="badge bg-success">Verified</span>
            <p><strong>Trust Score:</strong> {{ $seller->trust_score }}</p>
            <p><strong>Risk Score:</strong> {{ $seller->risk_score }}</p>
        </div>
    @empty
        <p>No verified sellers yet.</p>
    @endforelse

    <!-- Rejected Sellers -->
    <h2 class="mt-5">Rejected Sellers</h2>
    @forelse($rejectedSellers as $seller)
        <div class="card mb-3 p-3 border-danger">
            <h4>{{ $seller->brand_name }}</h4>
            <span class="badge bg-danger">Rejected</span>
        </div>
    @empty
        <p>No rejected sellers.</p>
    @endforelse
</div>
@endsection
