@extends('admin.layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="ps-2">Footer Settings</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end pe-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Site Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Footer Menu</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary" onclick="openModal('{{ url('admin/site_setting/footer/add') }}', 'modal-md')">Add Menu</button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>S.No</th>
                        <th>Menu name</th>
                        <th>Link</th>
                        <th>Under</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @forelse ($footer_menus as $footer_menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $footer_menu->name }}</td>
                                <td>{{ $footer_menu->link }}</td>
                                <td>{{ $footer_menu->under }}</td>
                                <td>{{ $footer_menu->status == '1' ? 'Active' : 'In-Active' }}</td>
                                <td>
                                    <button class="btn btn-primary" onclick="openModal('{{ url('admin/site_setting/footer/add?id='.$footer_menu->id) }}', 'modal-md')">Edit</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger" onclick="confirmationById('{{ url('admin/site_setting/footer/delete/'.$footer_menu->id) }}', 'Are you sure? you want to delete this menu.')" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">There is no menu for display.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection