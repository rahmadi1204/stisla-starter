@extends('layouts.app')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Akses</th>
                                        @foreach ($role as $item)
                                            <th>{{ ucwords($item->name) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($permission as $key => $value)
                                        <tr>
                                            {{-- <td>
                                            <input type="checkbox" name="checkbox">
                                        </td> --}}
                                            <td>{{ $no++ }}</td>
                                            <td>{{ ucwords($value) }}</td>
                                            @foreach ($role as $item)
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                class="custom-switch-input"
                                                                @isset($item->permissions) @foreach ($item->permissions as $list)
                                                                @if ($list->name == $value)
                                                                checked @endif
                                                                data-role="{{ $item->name }}"
                                                                data-permission="{{ $value }}" @endforeach @endisset>
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            @endforeach

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('modal')
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "scrollX": true,
                "scrollY": 500,
            });
        });
    </script>
    @can('role change')
        <script>
            $(document).ready(function() {

                $('input[type="checkbox"]').click(function() {

                    if ($(this).prop("checked") == true) {
                        let role = $(this).data('role');
                        let permission = $(this).data('permission');


                        $.ajax({
                            type: "get",
                            url: "{{ route('role.add') }}",
                            data: "role=" + role + "&permission=" + permission,
                            success: function(response) {
                                // console.log(response);
                                if (response != 'success') {
                                    Swal.fire(
                                        'Waduh!',
                                        response,
                                        'error'
                                    )
                                }
                            }
                        })

                    } else if ($(this).prop("checked") == false) {
                        let role = $(this).data('role');
                        let permission = $(this).data('permission');
                        $.ajax({
                            type: "get",
                            url: "{{ route('role.remove') }}",
                            data: "role=" + role + "&permission=" + permission,
                            success: function(response) {
                                if (response != 'success') {
                                    Swal.fire(
                                        'Waduh!',
                                        response,
                                        'error'
                                    )
                                }
                            }
                        })
                    }
                })
            });
        </script>
    @elsecannot('role change')
        <script>
            $('input[type="checkbox"]').click(function() {
                Swal.fire(
                    'Waduh!',
                    'Anda Tidak Memiliki Akses',
                    'error'
                )
            });
        </script>
    @endcan
@endsection
