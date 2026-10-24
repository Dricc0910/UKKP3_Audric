<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengaduanRequest;
use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $q = trim((string) $request->query('q', ''));

        $items = Pengaduan::query()
            ->with('kategori')
            // customer hanya melihat pengaduan miliknya sendiri
            ->when(! $user->isAdmin(), fn ($query) => $query->where('user_id', $user->id))
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('nama', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%")
                      ->orWhere('no_hp', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pengaduan.index', compact('items', 'q'));
    }

    public function create(Request $request)
    {
        $user = $request->user();

        return view('pengaduan.create', [
            // nama dan email diisi otomatis dari akun, tapi masih bisa diubah
            'pengaduan' => new Pengaduan(['nama' => $user->name, 'email' => $user->email]),
            'kategori'  => Kategori::orderBy('nama')->get(),
        ]);
    }

    public function store(PengaduanRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $data['lampiran_path'] = $file->store('lampiran', 'public');
            $data['lampiran_nama'] = $file->getClientOriginalName();
        }

        unset($data['lampiran'], $data['hapus_lampiran']);

        Pengaduan::create($data);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function show(Pengaduan $pengaduan)
    {
        $this->pastikanBoleh($pengaduan);

        $pengaduan->load('kategori');

        return view('pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        return view('pengaduan.edit', [
            'pengaduan' => $pengaduan,
            'kategori'  => Kategori::orderBy('nama')->get(),
        ]);
    }

    public function update(PengaduanRequest $request, Pengaduan $pengaduan)
    {
        $data = $request->validated();

        if ($request->hasFile('lampiran')) {
            $this->hapusFile($pengaduan);
            $file = $request->file('lampiran');
            $data['lampiran_path'] = $file->store('lampiran', 'public');
            $data['lampiran_nama'] = $file->getClientOriginalName();
        } elseif ($request->boolean('hapus_lampiran')) {
            $this->hapusFile($pengaduan);
            $data['lampiran_path'] = null;
            $data['lampiran_nama'] = null;
        }

        unset($data['lampiran'], $data['hapus_lampiran']);

        $pengaduan->update($data);

        return redirect()->route('pengaduan.show', $pengaduan)->with('success', 'Perubahan berhasil disimpan.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $this->hapusFile($pengaduan);
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function lampiran(Pengaduan $pengaduan)
    {
        $this->pastikanBoleh($pengaduan);

        abort_unless(
            $pengaduan->lampiran_path && Storage::disk('public')->exists($pengaduan->lampiran_path),
            404
        );

        return Storage::disk('public')->download($pengaduan->lampiran_path, $pengaduan->lampiran_nama);
    }

    /** Admin boleh semua; customer hanya pengaduan miliknya. */
    private function pastikanBoleh(Pengaduan $pengaduan): void
    {
        $user = request()->user();

        abort_unless($user->isAdmin() || $pengaduan->user_id === $user->id, 403);
    }

    private function hapusFile(Pengaduan $pengaduan): void
    {
        if ($pengaduan->lampiran_path) {
            Storage::disk('public')->delete($pengaduan->lampiran_path);
        }
    }
}