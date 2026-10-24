@php($isAdmin = auth()->user()->isAdmin())

@if ($items->isEmpty())
    <div class="empty">
        <div class="empty__emoji">📭</div>
        <h3>Belum ada pengaduan nih</h3>
        @if ($isAdmin)
            <p>Pengaduan dari customer akan muncul di sini.</p>
        @else
            <p>Yuk, buat pengaduan pertama kamu.</p>
            <a class="btn" href="{{ route('pengaduan.create') }}">+ Buat pengaduan</a>
        @endif
    </div>
@else
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Pengirim</th>
                    <th>Kategori</th>
                    <th>Meja</th>
                    <th>No. HP</th>
                    <th>Masukan</th>
                    <th>Lampiran</th>
                    <th>Masuk</th>
                    <th class="t-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($items as $p)
                <tr>
                    <td>
                        <div class="person">
                            <span class="avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($p->nama, 0, 1)) }}</span>
                            <div>
                                <div class="person__name">{{ $p->nama }}</div>
                                <div class="person__sub">{{ $p->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if ($p->kategori)
                            <span class="badge badge--teal">{{ $p->kategori->nama }}</span>
                        @else
                            <span class="badge badge--gray">-</span>
                        @endif
                    </td>
                    <td class="nowrap">{{ $p->no_meja ?? '-' }}</td>
                    <td class="nowrap">{{ $p->no_hp }}</td>
                    <td class="cell-text">{{ $p->ringkasan }}</td>
                    <td>
                        @if ($p->lampiran_path)
                            <span class="badge badge--teal">Ada file</span>
                        @else
                            <span class="badge badge--gray">Tidak ada</span>
                        @endif
                    </td>
                    <td class="muted nowrap" title="{{ $p->created_at->translatedFormat('d M Y, H:i') }}">{{ $p->created_at->diffForHumans() }}</td>
                    <td class="t-right">
                        <div class="actions">
                            <a class="btn btn--ghost btn--sm" href="{{ route('pengaduan.show', $p) }}">Lihat</a>
                            @if ($isAdmin)
                                <a class="btn btn--ghost btn--sm" href="{{ route('pengaduan.edit', $p) }}">Edit</a>
                                <form method="POST" action="{{ route('pengaduan.destroy', $p) }}" data-confirm="Hapus pengaduan dari {{ $p->nama }}?">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn--danger btn--sm" type="submit">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif