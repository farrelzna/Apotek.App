@extends('templates.app', ['title' => 'Obat  || Apotek '])

@section('content-dinamis')
    <form action="{{ route('orders.store') }}" method="POST" class="card d-block mx-auto my-3 p-5">
        @csrf
        <h1 class="text-center">Buat Pembelian</h1>

        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif

        <div class="form-group">
            <label for="name_customer" class="form-label">Nama pembeli</label>
            <input type="text" name="name_customer" id="name_customer" class="form-control"
                value="{{ old('name_customer') }}">
            @error('name_customer')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        @if (old('medicines'))
            @foreach (old('medicines') as $no => $item)
                <div class="form-group" id="medicines-{{ $no }}">
                    <label for="medicines" class="form-label">Obat {{ $no + 1 }}

                        @if ($no > 0)
                            <span style="cursor: pointer; font-weight:bold; padding:5px; color:red"
                                onclick="deleteSelect('medicines-{{ $no }}')">X</span>
                        @endif
                    </label>

                    <select name="medicines[]" id="medicine" class="form-select">
                        <option disabled selected hidden>Pilih</option>
                        @foreach ($medicines as $medicine)
                            <option value="{{ $medicine['id'] }}" {{ $item == $medicine['id'] ? 'selected' : '' }}>
                                {{ $medicine['name'] }} - Rp. {{ number_format($medicine['price'], 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        @else
            <div class="form-group">
                <label for="medicines" class="form-label">Obat 1</label>

                <select name="medicines[]" id="medicine" class="form-select">
                    <option disabled selected hidden>Pilih</option>
                    @foreach ($medicines as $medicine)
                        <option value="{{ $medicine['id'] }}">{{ $medicine['name'] }} - Rp.
                            {{ number_format($medicine['price'], 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>
        @endif


        <div id="medicines-more">
        </div>
        <span class="btn btn-primary mt-2 mb-2" id="btn-more" style=" cursor: pointer;">Tambah obat</span>
        <br>
        <button type="submit" class="btn btn-success">submit</button>


    </form>

@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        let no = {{ old('medicines') ? count(old('medicines')) + 1 : 2 }};

        $("#btn-more").on("click", function() {
            let elselect = `<div class="form-group" id="medicines-${no}">
            <label for="medicines" class="form-label">Obat ${no}
                <span style="cursor: pointer; font-weight:bold; padding:5px; color:red" onclick="deleteSelect('medicines-${no}')">X</span></label>
            <select name="medicines[]" id="medicine-${no}" class="form-select">
                <option disabled selected hidden>Pilih</option>
                @foreach ($medicines as $medicine)
                    <option value="{{ $medicine['id'] }}">{{ $medicine['name'] }} - Rp. {{ number_format($medicine['price'], 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>`;

            $("#medicines-more").append(elselect);
            no++;
        });

        function deleteSelect(elementId) {
            let elementIdForDelete = "#" + elementId;
            $(elementIdForDelete).remove();
            no--;
        }
    </script>

    </script>
@endpush



<title>Orders</title>
