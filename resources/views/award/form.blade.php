<form method="POST" action="{{ isset($award) ? route('admin.award.update', $award->id) : route('admin.award.store') }}"
    enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-row mb-3">
            <label for="name" class="col-sm-3 col-form-label text-right">Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    id="name" value="{{ old('name', isset($award) ? $award->name : '') }}">
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-3">
            <label for="description" class="col-sm-3 col-form-label text-right">Description</label>
            <div class="col-sm-6">
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                    id="description" value="{{ old('description', isset($award) ? $award->description : '') }}">
                @error('description')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-3">
            <label for="image" class="col-sm-3 col-form-label text-right">Image</label>
            <div class="col-sm-6">
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    id="image">
                @error('image')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
                @if (isset($award) && $award->path_image)
                    <img src="{{ asset('storage/' . $award->path_image) }}" alt="Award Image" class="img-thumbnail mt-2"
                        style="max-width: 200px;">
                    <input type="hidden" name="old_image" value="{{ $award->path_image }}">
                @endif
            </div>
        </div>
        <div class="form-row">
            <label for="category" class="col-sm-12 col-form-label text-center">RULES</label>
        </div>
        <div class="form-row mb-3">
            <label for="qso" class="col-sm-3 col-form-label text-right">Total Record QSO</label>
            <div class="col-sm-6">
                <input type="text" id="qso" name="qso"
                    class="form-control @error('qso') is-invalid @enderror"
                    value="{{ old('qso', isset($award) ? json_decode($award->rules)->qso : '') }}"
                    placeholder="Example: 2">
                @error('qso')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-3">
            <label for="band" class="col-sm-3 col-form-label text-right">Band</label>
            <div class="col-sm-6">
                <input type="text" id="band" name="band"
                    class="form-control @error('band') is-invalid @enderror"
                    value="{{ old('band', isset($award) ? json_decode($award->rules)->band : '') }}"
                    placeholder="Example: 40M,17M,10M">
                @error('band')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-3">
            <label for="mode" class="col-sm-3 col-form-label text-right">Mode</label>
            <div class="col-sm-6">
                <input type="text" id="mode" name="mode"
                    class="form-control @error('mode') is-invalid @enderror"
                    value="{{ old('mode', isset($award) ? json_decode($award->rules)->mode : '') }}"
                    placeholder="Example: SSB,FT8">
                @error('mode')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-3">
            <label for="member" class="col-sm-3 col-form-label text-right">Member</label>
            <div class="col-sm-6">
                <select id="member" name="member" class="form-control @error('member') is-invalid @enderror">
                    <option value="Gold"
                        {{ old('member', isset($award) ? json_decode($award->rules)->member : '') == 'Gold' ? 'selected' : '' }}>
                        Gold</option>
                    <option value="Premium"
                        {{ old('member', isset($award) ? json_decode($award->rules)->member : '') == 'Premium' ? 'selected' : '' }}>
                        Premium</option>
                    <option value="Platinum"
                        {{ old('member', isset($award) ? json_decode($award->rules)->member : '') == 'Platinum' ? 'selected' : '' }}>
                        Platinum</option>
                </select>
                @error('member')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Save Data
            </button>
        </div>
    </div>

</form>
