@extends('layouts.admin')

@section('content')
    <header>
        <div class="container-fluid bg-dark py-3 text-danger shadow">
            <div class="container d-flex align-items-center justify-content-between">
                <h1>
                    <strong>
                        Techs
                    </strong>
                </h1>
                <a class="btn btn-danger text-dark" href="{{ route('admin.technologies.create') }}">
                    <i class="fa-solid fa-plus fa-lg fa-fw"></i>
                    <span class="fw-bold px-1">
                        ADD TECH
                    </span>
                </a>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container">
            @include('partials.session-message')
            {{-- @dd(session('status')) --}}
            <h4 class="py-3">
                List of techs:
            </h4>
            <div class="table-responsive rounded-top-3">
                <table class="table table-secondary align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-danger" scope="col">ID</th>
                            <th class="text-danger" scope="col">NAME</th>
                            <th class="text-danger" scope="col">SLUG</th>
                            <th class="text-danger text-center" scope="col">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @forelse ($technologies as $technology)
                            <tr class="">
                                <td scope="row">{{ $technology->id }}</td>
                                <td scope="row">{{ $technology->name }}</td>
                                <td scope="row">{{ $technology->slug }}</td>
                                <td scope="row" class="text-center d-flex justify-content-evenly">
                                    <div class="">
                                        <a class="btn btn-dark" href="{{ route('admin.technologies.show', $technology) }}">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                    </div>
                                    <div class="">
                                        <a class="btn btn-dark" href="{{ route('admin.technologies.edit', $technology) }}">
                                            <i class="fas fa-pencil fa-sm fa-fw"></i>
                                        </a>
                                    </div>
                                    <div class="">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $technology->id }}">
                                            <i class="fas fa-trash-can fa-sm fa-fw"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modalId-{{ $technology->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Are you sure to delete {{ $technology->name }} tech ?
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">❌care❌care❌</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('admin.technologies.destroy', $technology) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                Delete this tech
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="">
                                <td scope="row" colspan="4">No techs to show..</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $technologies->links('pagination::bootstrap-5') }}
        </div>
    </section>
@endsection
