<form method="POST" action="{{ $action }}" enctype="multipart/form-data" id="form-pengaduan" class="card form">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="field @error('nama') field--error @enderror">
        <label for="nama">Nama <span class="req">*</span></label>
        <input id="nama" type="text" name="nama" value="{{ old('nama', $pengaduan->nama) }}" placeholder="Nama lengkap kamu" maxlength="100" required autofocus>
        @error('nama') <p class="field__error">{{ $message }}</p> @enderror
    </div>

    <div class="grid-2">
        <div class="field @error('kategori_id') field--error @enderror">
            <label for="kategori_id">Kategori <span class="req">*</span></label>
            <select id="kategori_id" name="kategori_id" required>
                <option value="">Pilih kategori</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id }}" @selected(old('kategori_id', $pengaduan->kategori_id) == $k->id)>{{ $k->nama }}</option>
                @endforeach
            </select>
            @error('kategori_id') <p class="field__error">{{ $message }}</p> @enderror
            @if ($kategori->isEmpty())
                <p class="field__hint">Belum ada kategori di database.</p>
            @endif
        </div>

        <div class="field @error('no_meja') field--error @enderror">
            <label for="no_meja">No. meja/kursi <span class="req">*</span></label>
            <select id="no_meja" name="no_meja" required>
                <option value="">Pilih nomor</option>
                @for ($i = 1; $i <= 30; $i++)
                    <option value="{{ $i }}" @selected(old('no_meja', $pengaduan->no_meja) == $i)>{{ $i }}</option>
                @endfor
            </select>
            @error('no_meja') <p class="field__error">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid-2">
        <div class="field @error('email') field--error @enderror">
            <label for="email">Email <span class="req">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email', $pengaduan->email) }}" placeholder="nama@email.com" maxlength="150" required>
            @error('email') <p class="field__error">{{ $message }}</p> @enderror
        </div>

        <div class="field @error('no_hp') field--error @enderror">
            <label for="no_hp">No. HP <span class="req">*</span></label>
            <input id="no_hp" type="tel" name="no_hp" value="{{ old('no_hp', $pengaduan->no_hp) }}" placeholder="081234567890" inputmode="tel" maxlength="20" required>
            @error('no_hp') <p class="field__error">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="field @error('lampiran') field--error @enderror">
        <label for="lampiran">Lampiran <span class="opt">(opsional)</span></label>
        <label class="dropzone" for="lampiran">
            <input id="lampiran" type="file" name="lampiran" accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx,.xls,.xlsx,.zip">
            <span class="dropzone__icon">⬆</span>
            <span class="dropzone__text"><strong>Pilih file</strong> atau tarik ke sini</span>
            <span class="dropzone__hint">JPG, PNG, WEBP, PDF, DOC, XLS, ZIP · maks. 2 MB</span>
            <span class="dropzone__name" data-file-name></span>
        </label>
        @error('lampiran') <p class="field__error">{{ $message }}</p> @enderror

        @if ($pengaduan->lampiran_path)
            <div class="current-file">
                <span>Lampiran saat ini:</span>
                <a class="link" href="{{ route('pengaduan.lampiran', $pengaduan) }}">{{ $pengaduan->lampiran_nama }}</a>
                <label class="check">
                    <input type="checkbox" name="hapus_lampiran" value="1" @checked(old('hapus_lampiran'))>
                    <span>Hapus lampiran ini</span>
                </label>
            </div>
        @endif
    </div>

    <div class="field @error('masukan') field--error @enderror">
        <label for="masukan">Masukan <span class="req">*</span></label>
        <textarea id="masukan" name="masukan" rows="8" maxlength="5000" placeholder="Tulis masukan kamu di sini..." required>{{ old('masukan', $pengaduan->masukan) }}</textarea>
        @error('masukan') <p class="field__error">{{ $message }}</p> @enderror
    </div>

    <div class="form__actions">
        <a class="btn btn--ghost" href="{{ route('pengaduan.index') }}">Batal</a>
        <button class="btn" type="submit">{{ $submit }}</button>
    </div>
</form>