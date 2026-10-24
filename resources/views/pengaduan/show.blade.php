@extends('layouts.app')
@section('title', 'Detail Pengaduan')
@section('heading', 'Detail pengaduan')
@section('sub', 'Masuk ' . $pengaduan->created_at->translatedFormat('d F Y, H:i'))

@section('actions')
    <a class="btn btn--ghost" href="{{ route('pengaduan.index') }}">Kembali</a>
    @if (auth()->user()->isAdmin())
        <a class="btn" href="{{ route('pengaduan.edit', $pengaduan) }}">Edit</a>
    @endif
@endsection

@section('content')
    <div class="detail">
        <section class="card">
            <h2 class="card__title">Masukan</h2>
            <div class="prose">{{ $pengaduan->masukan }}</div>
        </section>

        <aside class="card">
            <h2 class="card__title">Pengirim</h2>
            <div class="person person--big">
                <span class="avatar avatar--big" aria-hidden="true">{{ mb_strtoupper(mb_substr($pengaduan->nama, 0, 1)) }}</span>
                <div class="person__name">{{ $pengaduan->nama }}</div>
            </div>

            <dl class="details">
                <div>
                    <dt>Kategori</dt>
                    <dd>
                        @if ($pengaduan->kategori)
                            <span class="badge badge--teal">{{ $pengaduan->kategori->nama }}</span>
                        @else
                            <span class="muted">Tanpa kategori</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt>No. meja/kursi</dt>
                    <dd>{{ $pengaduan->no_meja ?? '-' }}</dd>
                </div>
                <div>
                    <dt>Email</dt>
                    <dd><a class="link" href="mailto:{{ $pengaduan->email }}">{{ $pengaduan->email }}</a></dd>
                </div>
                <div>
                    <dt>No. HP</dt>
                    <dd><a class="link" href="tel:{{ $pengaduan->no_hp }}">{{ $pengaduan->no_hp }}</a></dd>
                </div>
                <div>
                    <dt>Lampiran</dt>
                    <dd>
                        @if ($pengaduan->lampiran_path)
                            <a class="btn btn--ghost btn--sm" href="{{ route('pengaduan.lampiran', $pengaduan) }}">⬇ {{ \Illuminate\Support\Str::limit($pengaduan->lampiran_nama, 28) }}</a>
                        @else
                            <span class="muted">Tidak ada</span>
                        @endif
                    </dd>
                </div>
            </dl>

            @if (auth()->user()->isAdmin())
                <form method="POST" action="{{ route('pengaduan.destroy', $pengaduan) }}" data-confirm="Hapus pengaduan dari {{ $pengaduan->nama }}?" class="danger-zone">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn--danger" type="submit">Hapus pengaduan</button>
                </form>
            @endif
        </aside>
    </div>
@endsection