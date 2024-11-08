@extends('templates.app', ['title' => 'Obat || Apotek '])

@section('content-dinamis')
<div class="container mt-5">
    <div class="col-md-8 mx-auto card border-light shadow-sm p-4">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            
            @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-4">Order Medicine</h3>
                    <a class="btn btn-dark btn-sm mt-2" href="{{ route('orders') }}">Back</a>
                </div>
                
                <!-- Nama Pembeli -->
                <div class="mb-3">
                    <label for="name_customer" class="form-label">Nama Pembeli</label>
                    <input type="text" name="name_customer" id="name_customer" class="form-control"
                        value="{{ old('name_customer') }}">
                    @error('name_customer')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Obat Selection -->
                @if (old('medicines'))
                    @foreach (old('medicines') as $no => $item)
                        <div class="d-flex align-items-center mb-3" id="medicines-{{ $no }}">
                            <label for="medicines" class="form-label">Obat {{ $no + 1 }}</label>
                            <select name="medicines[]" class="form-select">
                                <option disabled selected hidden>Pilih</option>
                                @foreach ($medicines as $medicine)
                                    <option value="{{ $medicine['id'] }}" {{ $item == $medicine['id'] ? 'selected' : '' }}>
                                        {{ $medicine['name'] }} - Rp. {{ number_format($medicine['price'], 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($no > 0)
                                <!-- Added more margin to the button -->
                                <button type="button" class="btn-close ms-3" aria-label="Close" onclick="deleteSelect('medicines-{{ $no }}')"></button>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="d-flex align-items-center mb-3">
                        <label for="medicines" class="form-label" style="width: 70%">Obat 1</label>
                        <select name="medicines[]" class="form-select">
                            <option disabled selected hidden>Pilih</option>
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine['id'] }}">{{ $medicine['name'] }} - Rp. {{ number_format($medicine['price'], 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div id="medicines-more"></div>

                <!-- Add Medicine Button -->
                <button type="button" id="btn-more" class="btn btn-sm btn-secondary mt-2">Tambah Obat</button>
                
                <!-- Submit Button -->
                <button type="submit" class="btn btn-sm btn-outline-success mt-2">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        let no = {{ old('medicines') ? count(old('medicines')) + 1 : 2 }};

        // Add new medicine selection field
        $("#btn-more").on("click", function() {
            let selectField = `
                <div class="d-flex align-items-center mb-3" id="medicines-${no}">
                    <label for="medicines" class="form-label" style="width: 55%">Obat ${no}</label>
                    <button type="button" class="btn-close ms-3 me-4" aria-label="Close" onclick="deleteSelect('medicines-${no}')"></button>
                    <select name="medicines[]" class="form-select">
                        <option disabled selected hidden>Pilih</option>
                        @foreach ($medicines as $medicine)
                            <option value="{{ $medicine['id'] }}">{{ $medicine['name'] }} - Rp. {{ number_format($medicine['price'], 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>`;
            $("#medicines-more").append(selectField);
            no++;
        });

        // Remove medicine selection field
        function deleteSelect(elementId) {
            $("#" + elementId).remove();
            no--;
        }
    </script>
@endpush
