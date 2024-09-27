@extends('admin.layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="ps-2">Properties</h3>
                <p class="text-subtitle text-muted ps-2">
                     @if($request->tab == 'pending')
                        All pending properties (choose which property you want Approved or Rejected )
                      @elseif($request->tab == 'approve')
                         All approved properties (choose which property you want Rejected )
                      @elseif($request->tab == 'reject')
                        All rejected properties (choose which property you want Approved )
                      @else    
                        Pending, Approved and Rejected Properties
                      @endif  
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end pe-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Properties</li>
                        <li class="breadcrumb-item active" aria-current="page">
                        @if($request->tab == 'pending')
                        Pending
                        @elseif($request->tab == 'approve')
                        Approved
                        @else
                        Rejected
                        @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-sm ">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Rent (Move In)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($properties as $property)
                                    <tr>
                                        <td> 
                                        @if ($property->firstPhoto)
                                            <img src="{{ asset($property->firstPhoto->path) }}" alt="{{ $property->name }}" width="100">
                                        @else
                                            No Image Available
                                        @endif</td>
                                        <td><span class="pointer text-primary" onclick="openModal('{{ url('admin/property/detail?id='.$property->id) }}')">{{ ucfirst($property->name) }}</span></td>
                                        <td>{{ $property->address }}</td>
                                        <td>${{ $property->rent_move_in }}</td>
                                        <td>
                                            @if($request->tab == 'pending')
                                                <button type="button" onclick="confirmationById('{{ url('admin/property/change_status/'.$property->id.'?status=1&status_type=approved') }}', 'Are you sure? you want to approve this property.')" class="btn btn-success btn-sm approve-property">Approve</button>
                                                <button type="button" onclick="confirmationById('{{ url('admin/property/change_status/'.$property->id.'?status=2&status_type=rejected') }}', 'Are you sure? you want to reject this property.')" class="btn btn-danger btn-sm approve-property">Reject</button>
                                            @elseif($request->tab == 'approve')
                                                <button type="button" onclick="confirmationById('{{ url('admin/property/change_status/'.$property->id.'?status=2&status_type=rejected') }}', 'Are you sure? you want to reject this property.')" class="btn btn-danger btn-sm approve-property">Reject</button>
                                            @elseif($request->tab == 'reject')
                                                <button type="button" onclick="confirmationById('{{ url('admin/property/change_status/'.$property->id.'?status=1&status_type=approved') }}', 'Are you sure? you want to approve this property.')" class="btn btn-success btn-sm approve-property">Approve</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5">
                                            No property available for display.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection