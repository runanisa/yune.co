@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h4>Pembayaran Berhasil ✅</h4>
    <p>Struk telah dicetak.</p>

    <a href="{{ route('overview') }}" class="btn btn-primary mt-3">
        Kembali ke Halaman Utama
    </a>
</div>
@endsection
