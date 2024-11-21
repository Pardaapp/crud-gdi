@extends('layouts.app')
@section('title', 'Add Pegawai')
@section('contents')
<div class="container">
    <div class="text-end mb-5">
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Add New</a>
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
 
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-primary">
                <th>#</th>
                <th>Name</th>
                <th>Jabatan</th>
                <th>Photo</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse($pegawais as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->jabatan }}</td>
                    <td>
                        <div class="showPhoto">
                            <div id="imagePreview" style="@if ($row->photo != '') background-image:url('{{ url('/') }}/uploads/{{ $row->photo }}')@else background-image: url('{{ url('/img/avatar.png') }}') @endif;">
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href={{ route('pegawai.edit', ['id' => $row->id]) }} class="btn btn-primary"> Edit</a>
                        <button class="btn btn-danger" onClick="deleteFunction('{{ $row->id }}')">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No Pegawais Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@include ('admin.modal_delete')
@endsection
 
@push('js')
<script>
    function deleteFunction(id) {
        document.getElementById('delete_id').value = id;
        $("#modalDelete").modal('show');
    }
</script>
@endpush
 
<style>
    .showPhoto {
        width: 51%;
        height: 54px;
        margin: auto;
    }
 
    .showPhoto>div {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>