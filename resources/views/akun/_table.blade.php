@if ($items->isEmpty())
    <div class="empty">
        <div class="empty__emoji">👤</div>
        <h3>Akun tidak ditemukan</h3>
        <p>Coba kata kunci lain.</p>
    </div>
@else
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Akun</th>
                    <th>Peran</th>
                    <th>Pengaduan</th>
                    <th>Terdaftar</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($items as $u)
                <tr>
                    <td>
                        <div class="person">
                            <span class="avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($u->name, 0, 1)) }}</span>
                            <div>
                                <div class="person__name">{{ $u->name }}</div>
                                <div class="person__sub">{{ $u->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if ($u->isAdmin())
                            <span class="badge badge--teal">Admin</span>
                        @else
                            <span class="badge badge--gray">Customer</span>
                        @endif
                    </td>
                    <td>{{ $u->pengaduan_count }}</td>
                    <td class="muted nowrap" title="{{ $u->created_at->translatedFormat('d M Y, H:i') }}">{{ $u->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif